<?php

namespace App\Services;

use App\Constants\GlobalConstant;
use App\Models\Journal;
use Yajra\DataTables\Facades\DataTables;

class PaymentService
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
            $data = Journal::with(['category', 'payment.user.class.department', 'payment.category_payment.payment_category'])
                ->whereHas('category', function ($q) {
                    $q->where('type', GlobalConstant::JOURNAL_IN);
                })
                ->where('journal_category_id', 1)
                ->latest()->get();
            return DataTables::of($data)
                ->setRowAttr([
                    'url' => function ($data) {
                        return route('pembayaran.destroy', encryptData($data->id));
                    }
                ])
                ->addIndexColumn()
                ->editColumn('amount', function ($data) {
                    return formatIDR($data->amount, true);
                })
                ->editColumn('student', function ($data) {
                    return $data->payment->user->name;
                })
                ->addColumn('action', function ($data) {
                })
                ->rawColumns(['action', 'amount', 'student'])
                ->make(true);
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}