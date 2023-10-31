<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentArrearService
{
    /**
     * datatables
     *
     * @param  mixed $request
     * @return void
     */
    public function datatables($request)
    {
        try {
            $data = DB::table('payments as p')
                ->select('p.user_id', 'c.name as class_name', 'd.name as department_name', 'u.name as student', 'pc.id as category_id', 'pc.type', 'pc.target_type', 'pt.name as payment_type_name', 'ay.first_year', 'ay.last_year', 'ay.semester')
                ->selectRaw('COALESCE(SUM(pl.amount), 0) as payment_list_amount')
                ->selectRaw('COALESCE(SUM(j.amount), 0) as journal_amount')
                ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
                ->leftJoin('classes as c', 'u.class_id', '=', 'c.id')
                ->leftJoin('departments as d', 'c.department_id', '=', 'd.id')
                ->leftJoin('payment_lists as pl', 'p.payment_list_id', '=', 'pl.id')
                ->leftJoin('payment_categories as pc', 'pl.payment_category_id', '=', 'pc.id')
                ->leftJoin('payment_types as pt', 'pc.payment_type_id', '=', 'pt.id')
                ->leftJoin('academic_years as ay', 'pc.academic_year_id', '=', 'ay.id')
                ->leftJoin('journals as j', 'p.id', '=', 'j.payment_id')
                ->groupBy('p.user_id', 'c.name', 'd.name', 'u.name', 'pc.id', 'pc.type', 'pc.target_type', 'pt.name', 'ay.first_year', 'ay.last_year', 'ay.semester')
                ->havingRaw('payment_list_amount != journal_amount')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    if (permissionCheck('update-transaksi-tunggakan')) {
                        $button .= '<a href="' . route('tunggakan.detail', ['id' => encryptData($data->user_id), 'category_id' => encryptData($data->category_id)]) . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Bayar">
                                <i class="fas fa-list" aria-hidden="true"></i> </a>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->editColumn('payment_name', function ($data) {
                    return $data->payment_type_name . " (" . $data->first_year . '/' . $data->last_year . ' - ' . ($data->semester == 1 ? 'Ganjil' : 'Genap') . ")";
                })
                ->editColumn('type', function ($data) {
                    return paymentCategoryTypeBadge($data->type);
                })
                ->editColumn('class', function ($data) {
                    return $data->class_name . ' - ' . $data->department_name;
                })
                ->editColumn('payment_list_amount', function ($data) {
                    return formatIDR($data->payment_list_amount, true);
                })
                ->editColumn('journal_amount', function ($data) {
                    return formatIDR($data->journal_amount, true);
                })
                ->rawColumns(['action', 'type', 'payment_name', 'payment_list_amount', 'journal_amount', 'class'],)
                ->make(true);
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function getDetail($user_id)
    {
        try {
            $dataId = decryptData($user_id);
            $data = Payment::where('user_id', $dataId)->get();
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
