<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentArrearService
{
    private $paymentCategoryService;

    public function __construct()
    {
        $this->paymentCategoryService = new PaymentCategoryService();
    }

    /**
     * datatables
     *
     * @param  mixed $request
     * @return void
     */
    public function datatables($request)
    {
        try {
            $subquery = DB::table('payments as p')
                ->join('users as u', 'p.user_id', '=', 'u.id')
                ->join('classes as c', 'u.class_id', '=', 'c.id')
                ->join('departments as d', 'c.department_id', '=', 'd.id')
                ->leftJoin('payment_lists as pl', 'p.payment_list_id', '=', 'pl.id')
                ->leftJoin('payment_categories as pc', 'pl.payment_category_id', '=', 'pc.id')
                ->leftJoin('payment_types as pt', 'pc.payment_type_id', '=', 'pt.id')
                ->leftJoin('academic_years as ay', 'pc.academic_year_id', '=', 'ay.id')
                ->leftJoin('journals as j', 'p.id', '=', 'j.payment_id')
                ->whereNull('p.deleted_at')
                ->groupBy(
                    'p.user_id',
                    'c.name',
                    'd.name',
                    'u.name',
                    'pc.id',
                    'pc.type',
                    'pc.target_type',
                    'pt.name',
                    'ay.first_year',
                    'ay.last_year',
                    'ay.semester',
                    'pl.amount'
                )
                ->select(
                    'p.user_id',
                    'c.name as class_name',
                    'd.name as department_name',
                    'u.name as student',
                    'pc.id as category_id',
                    'pc.type',
                    'pc.target_type',
                    'pt.name as payment_type_name',
                    'ay.first_year',
                    'ay.last_year',
                    'ay.semester',
                    DB::raw('COALESCE(SUM(j.amount), 0) as journal_amount'),
                    DB::raw("IF(pc.type = 'free', pl.amount, COALESCE(SUM(pl.amount), 0)) as amount")
                );

            $data = DB::table(DB::raw("({$subquery->toSql()}) as subquery"))
                ->mergeBindings($subquery)
                ->groupBy(
                    'user_id',
                    'class_name',
                    'department_name',
                    'student',
                    'category_id',
                    'type',
                    'target_type',
                    'payment_type_name',
                    'first_year',
                    'last_year',
                    'semester',
                    'amount'
                )
                ->select(
                    'user_id',
                    'class_name',
                    'department_name',
                    'student',
                    'category_id',
                    'type',
                    'target_type',
                    'payment_type_name',
                    'first_year',
                    'last_year',
                    'semester',
                    DB::raw('COALESCE(SUM(journal_amount), 0) as journal_amount'),
                    DB::raw("IF(type = 'free', amount, COALESCE(SUM(amount), 0)) as total_amount")
                )
                ->havingRaw('total_amount > journal_amount')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->setRowAttr([
                    'url' => function ($data) {
                        return route('tunggakan.delete', ['id' => encryptData($data->user_id), 'category_id' => encryptData($data->category_id)]);
                    },
                ])
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    if (permissionCheck('update-transaksi-tunggakan')) {
                        $button .= '<a href="' . route('tunggakan.detail', ['id' => encryptData($data->user_id), 'category_id' => encryptData($data->category_id)]) . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Bayar">
                                <i class="fas fa-list" aria-hidden="true"></i> </a>';
                    }
                    if (permissionCheck('delete-transaksi-tunggakan')) {
                        $button .= '<button type="button" data-toggle="modal" data-target="#modal-delete" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-danger delete" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->editColumn('payment_name', function ($data) {
                    $year = " (TA. " . $data->first_year . '/' . $data->last_year . ' - ' . ($data->semester == 1 ? 'Ganjil' : 'Genap') . ")";
                    return $data->payment_type_name . $year;
                })
                ->editColumn('type', function ($data) {
                    return paymentCategoryTypeBadge($data->type);
                })
                ->editColumn('class', function ($data) {
                    return $data->class_name . ' - ' . $data->department_name;
                })
                ->editColumn('total_amount', function ($data) {
                    return formatIDR($data->total_amount, true);
                })
                ->editColumn('journal_amount', function ($data) {
                    return formatIDR($data->journal_amount, true);
                })
                ->rawColumns(['action', 'type', 'payment_name', 'amount', 'journal_amount', 'class'],)
                ->make(true);
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function getDetail($user_id, $category_id)
    {
        try {
            $dataId = decryptData($user_id);
            $data = Payment::with(['list', 'journals'])
                ->whereHas('list', function ($q) use ($category_id) {
                    $q->where('payment_category_id', decryptData($category_id));
                })
                ->where('user_id', $dataId)->get();
            $paymentCategory = $this->paymentCategoryService->getDetail($category_id, ['payment_type']);
            $user = User::with(['class.department'])->find($dataId);

            return [
                'user' => $user,
                'data' => $data,
                'category' => $paymentCategory
            ];
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function delete($user_id, $category_id)
    {
        try {
            $dataId = decryptData($user_id);
            $data = Payment::with(['list', 'journals'])
                ->whereHas('list', function ($q) use ($category_id) {
                    $q->where('payment_category_id', decryptData($category_id));
                })
                ->where('user_id', $dataId)
                ->delete();
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function destroyAll()
    {
        try {
            $data = Payment::get();
            foreach ($data as $key => $value) {
                $value->delete();
            }
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
