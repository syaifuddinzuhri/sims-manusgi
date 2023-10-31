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
                ->select('p.user_id', 'u.name as student', 'pc.type', 'pc.target_type', 'pt.name as payment_type_name', 'ay.first_year', 'ay.last_year', 'ay.semester')
                ->selectRaw('COUNT(p.id) as payment_count')
                ->selectRaw('COUNT(j.id) as payment_finish')
                ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
                ->leftJoin('payment_lists as pl', 'p.payment_list_id', '=', 'pl.id')
                ->leftJoin('payment_categories as pc', 'pl.payment_category_id', '=', 'pc.id')
                ->leftJoin('payment_types as pt', 'pc.payment_type_id', '=', 'pt.id')
                ->leftJoin('academic_years as ay', 'pc.academic_year_id', '=', 'ay.id')
                ->leftJoin('journals as j', 'p.id', '=', 'j.payment_id')
                ->groupBy('p.user_id', 'u.name', 'pc.type', 'pc.target_type', 'pt.name', 'ay.first_year', 'ay.last_year', 'ay.semester')
                ->havingRaw('payment_finish != payment_count')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    if (permissionCheck('create-transaksi-pembayaran')) {
                        $button .= '<a href="' . route('pembayaran.create') . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Bayar">
                                <i class="fas fa-money-bill-transfer" aria-hidden="true"></i> </a>';
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
                ->rawColumns(['action', 'type', 'payment_name'],)
                ->make(true);
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
