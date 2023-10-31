<?php

namespace App\Services;

use App\Constants\GlobalConstant;
use App\Models\Classes;
use App\Models\Journal;
use App\Models\Payment;
use App\Models\PaymentCategory;
use App\Models\PaymentList;
use App\Models\User;

class PaymentListService
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
            $data = PaymentList::where('payment_category_id', $dataId)->get();
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function getPaymentTarget($payment, $category_id)
    {
        try {
            if ($payment) {
                $dataId = decryptData($category_id);
                $targetType = PaymentCategory::find($dataId)->target_type;
                $paymentListIds = PaymentList::where('payment_category_id', $dataId)->pluck('id')->toArray();

                $data = Payment::with(['user.class.department'])->whereIn('payment_list_id', $paymentListIds)->get();

                if ($targetType == 'class') {
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
                    $array = [];
                    foreach ($data as $key => $value) {
                        $array[] = $value->user->id;
                    }
                    $uniqueArray = array_values(array_flip(array_flip(array_unique($array))));
                    $student = User::with(['class.department'])->where('is_student', 1)->whereIn('id', $uniqueArray)->get();
                    $result = $student->map(function ($item) {
                        return (object) [
                            'id' => $item->id,
                            'text' => $item->name . " | " . $item->class->name . " - " . $item->class->department->name,
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
            PaymentList::where('payment_category_id', $dataId)->forceDelete();
            if ($category->type == 'free') {
                if (!$request['free']) apiException('Jumlah harus diisi');
            }

            unset($request['_token']);
            foreach ($request as $key => $value) {
                if ($value != "") {
                    PaymentList::create([
                        'payment_category_id' => $category->id,
                        'name' => $key,
                        'amount' => dbIDR($value)
                    ]);
                }
            }
            return true;
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
            PaymentCategory::find($dataId)->update([
                'target_type' => $request['type']
            ]);

            if ($request['type'] === GlobalConstant::PAYMENT_CATEGORY_CLASS) {
                if (!isset($request['class_form']) || count($request['class_form']) == 0) apiException('Kelas harus diisi');
            } else if ($request['type'] === GlobalConstant::PAYMENT_CATEGORY_CUSTOM) {
                if (!isset($request['student_form']) || count($request['student_form']) == 0) apiException('Siswa harus diisi');
            }

            $paymentListIds = PaymentList::where('payment_category_id', $dataId)->pluck('id')->toArray();
            Payment::whereIn('payment_list_id', $paymentListIds)->forceDelete();
            $dataArray = [];
            if ($request['type'] === GlobalConstant::PAYMENT_CATEGORY_CLASS) {
                $student = User::where('is_student', 1)->whereIn('class_id', $request['class_form'])->pluck('id')->toArray();
                $dataArray = $student;
            } else if ($request['type'] === GlobalConstant::PAYMENT_CATEGORY_CUSTOM) {
                $dataArray = $request['student_form'];
            } else {
                $student = User::where('is_student', 1)->pluck('id')->toArray();
                $dataArray = $student;
            }
            foreach ($paymentListIds as $key1 => $paymentList) {
                foreach ($dataArray as $key => $value) {
                    Payment::create([
                        'payment_list_id' => $paymentList,
                        'user_id' => $value
                    ]);
                }
            }
            return true;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function getById($id)
    {
        try {
            $dataId = decryptData($id);
            $data = Payment::with(['user.class.department', 'list.payment_category'])->find($dataId);
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
