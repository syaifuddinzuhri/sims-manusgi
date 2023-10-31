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
            $data = Journal::with(['category', 'payment.user.class.department', 'payment.list.payment_category'])
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
                ->editColumn('type', function ($data) {
                    $div = '';
                    $div .= paymentCategoryTypeBadge($data->payment->list->payment_category->type);
                    if ($data->payment->list->payment_category->type == 'month') {
                        $div .= '<span class="badge badge-pill badge-warning ml-2">' . ucfirst($data->payment->list->name) . '</span>';
                    }
                    return $div;
                })
                ->editColumn('class', function ($data) {
                    return $data->payment->user->class ? $data->payment->user->class->name . ' - ' . $data->payment->user->class->department->name : '-';
                })
                ->addColumn('action', function ($data) {
                })
                ->rawColumns(['action', 'amount', 'student', 'class', 'type'])
                ->make(true);
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function store($payload)
    {
        try {
            return Journal::create($payload);
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
