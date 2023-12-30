<?php

namespace App\Services;

use App\Constants\GlobalConstant;
use App\Models\Journal;
use App\Models\Payment;
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
                        $div .= '<span class="badge badge-pill badge-info ml-2">' . ucfirst($data->payment->list->name) . '</span>';
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
            $payment = $this->getTotalPayment($payload['payment_id']);
            if ($payload['amount'] > $payment->tagihan) apiException('Jumlah tagihan baru melebihi jumlah kekurangan tagihan');
            $payment = $this->getTotalPayment($payload['payment_id']);
            if ($payment->is_lunas === true) {
                $payment->data->update([
                    'status' =>  GlobalConstant::PAID
                ]);
            } else {
                $journal = Journal::create($payload);
            }

            $this->updateStatus($payload['payment_id']);
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function updateStatus($payment_id)
    {
        try {
            $payment = $this->getTotalPayment($payment_id);
            if ($payment->is_lunas === true) {
                $payment->data->update([
                    'status' =>  GlobalConstant::PAID
                ]);
            }
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function getTotalPayment($payment_id)
    {
        try {
            $data = Payment::with(['user.class.department', 'list.payment_category'])->find($payment_id);
            $totalPayment = Journal::where('payment_id', $payment_id)->sum('amount');
            $tagihan = $data->list->amount - $totalPayment;
            return (object)[
                'data' => $data,
                'totalPayment' => $totalPayment,
                'tagihan' => $tagihan,
                'is_lunas' => $totalPayment < $data->list->amount ? false : true
            ];
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
