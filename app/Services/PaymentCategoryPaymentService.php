<?php

namespace App\Services;

use App\Models\PaymentCategoryPayment;

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
}
