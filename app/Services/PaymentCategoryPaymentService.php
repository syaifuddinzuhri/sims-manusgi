<?php

namespace App\Services;

use App\Constants\GlobalConstant;
use App\Models\Classes;
use App\Models\Journal;
use App\Models\PaymentCategoryDetail;
use App\Models\PaymentCategoryPayment;
use App\Models\User;

class PaymentCategoryPaymentService
{
    private $paymentCategoryService;

    public function __construct()
    {
        $this->paymentCategoryService = new PaymentCategoryService();
    }

    public function getByPaymentCategoryId($category_id)
    {
        try {
            $dataId = decryptData($category_id);
            $data = PaymentCategoryPayment::where('payment_category_id', $dataId)->first();
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function getPaymentCategory($payment)
    {
        try {
            if ($payment) {
                $data = PaymentCategoryDetail::with(['user.class.department'])->where('payment_category_payment_id', $payment->id)->get();
                if ($payment->type == 'class') {
                    $array = [];
                    foreach ($data as $key => $value) {
                        $array[] = $value->user->class_id;
                    }
                    $uniqueArray = array_values(array_flip(array_flip(array_unique($array))));
                    $classes = Classes::with(['department'])->whereIn('id', $uniqueArray);
                    $result = $classes->get()->map(function ($item) {
                        return (object) [
                            'id' => $item->id,
                            'text' => $item->name . " - " . $item->department->name,
                        ];
                    });
                    return $result;
                } else {
                    $result = $data->map(function ($item) {
                        return (object) [
                            'id' => $item->user_id,
                            'text' => $item->user->name . " | " . $item->user->class->name . " - " . $item->user->class->department->name,
                        ];
                    });
                }
                return $result;
            }
            return NULL;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function store($request, $category_id)
    {
        try {
            $dataId = decryptData($category_id);
            $category = $this->paymentCategoryService->getDetail($category_id);
            $data = PaymentCategoryPayment::where('payment_category_id', $dataId)->first();
            if ($category->type == 'free') {
                if (!$request['free_amount']) apiException('Jumlah harus diisi');
            }

            foreach ($request as $key => $value) {
                $request[$key] = $value != "" ? dbIDR($value) : $value;
            }

            if ($data) {
                $data->update($request);
            } else {
                $payload = array_merge($request, ['payment_category_id' => $dataId]);
                $data = PaymentCategoryPayment::create($payload);
            }
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function storeStudent($request, $category_id)
    {
        try {
            $dataId = decryptData($category_id);
            if (!isset($request['type'])) apiException('Target harus dipilih salah satu');
            if ($request['type'] === GlobalConstant::PAYMENT_CATEGORY_PAYMENTS_CLASS) {
                if (!isset($request['class_form']) || count($request['class_form']) == 0) apiException('Kelas harus diisi');
            } else if ($request['type'] === GlobalConstant::PAYMENT_CATEGORY_PAYMENTS_CUSTOM) {
                if (!isset($request['student_form']) || count($request['student_form']) == 0) apiException('Siswa harus diisi');
            }
            PaymentCategoryPayment::find($dataId)->update([
                'type' => $request['type']
            ]);
            PaymentCategoryDetail::where('payment_category_payment_id', $dataId)->forceDelete();
            $dataArray = [];
            if ($request['type'] === GlobalConstant::PAYMENT_CATEGORY_PAYMENTS_CLASS) {
                $student = User::where('is_student', 1)->whereIn('class_id', $request['class_form'])->pluck('id')->toArray();
                $dataArray = $student;
            } else if ($request['type'] === GlobalConstant::PAYMENT_CATEGORY_PAYMENTS_CUSTOM) {
                $dataArray = $request['student_form'];
            } else {
                $student = User::where('is_student', 1)->pluck('id')->toArray();
                $dataArray = $student;
            }
            foreach ($dataArray as $key => $value) {
                PaymentCategoryDetail::create([
                    'payment_category_payment_id' => $dataId,
                    'user_id' => $value
                ]);
            }
            return true;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
