<?php

namespace App\Services;

use App\Models\PaymentCategory;
use Yajra\DataTables\Facades\DataTables;

class PaymentCategoryService
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
            $data = PaymentCategory::with(['payment_type', 'academic'])->latest()->get();
            return DataTables::of($data)
                ->setRowAttr([
                    'url' => function ($data) {
                        return route('jenis.destroy', encryptData($data->id));
                    }
                ])
                ->addIndexColumn()
                ->editColumn('pos', function ($data) {
                    return $data->payment_type ? $data->payment_type->name : "-";
                })
                ->editColumn('tahun', function ($data) {
                    return $data->academic ?  $data->academic->first_year . '/' . $data->academic->last_year . ' - ' . ($data->academic->semester == 1 ? 'Ganjil' : 'Genap') : "-";
                })
                ->editColumn('type', function ($data) {
                    return paymentCategoryTypeBadge($data->type);
                })
                ->addColumn('payment', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    if (permissionCheck('update-pembayaran-jenis')) {
                        $button .= '<a href="' . route('jenis.payment.index', encryptData($data->id)) . '" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-money-bill-transfer" aria-hidden="true"></i> Atur Tarif Pembayaran</a>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    if (permissionCheck('update-pembayaran-jenis')) {
                        $button .= '<a href="' . route('jenis.edit', encryptData($data->id)) . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    }
                    if (permissionCheck('delete-pembayaran-jenis')) {
                        $button .= '<button type="button" data-toggle="modal" data-target="#modal-delete" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-danger delete" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['pos', 'type', 'tahun', 'action', 'payment'])
                ->make(true);
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    /**
     * store
     *
     * @param  mixed $payload
     * @return void
     */
    public function store($payload)
    {
        try {
            $data = PaymentCategory::create($payload);
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    /**
     * update
     *
     * @param  mixed $payload
     * @param  mixed $id
     * @return void
     */
    public function update($payload, $id)
    {
        try {
            $data = $this->getDetail($id);
            $data->update($payload);
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        try {
            $data = $this->getDetail($id);
            $data->delete();
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function getDetail($value, $relations = [])
    {
        try {
            $dataId = decryptData($value);
            $query = PaymentCategory::query();
            if (count($relations) > 0) {
                $query->with($relations);
            }
            $data = $query->find($dataId);
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}