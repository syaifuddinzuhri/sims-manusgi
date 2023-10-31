<?php

namespace App\Services;

use App\Constants\GlobalConstant;
use App\Models\Journal;
use Yajra\DataTables\Facades\DataTables;

class JournalService
{
    /**
     * datatables
     *
     * @param  mixed $request
     * @return void
     */
    public function datatables($request, $type)
    {
        try {
            $data = Journal::with('category')
                ->whereHas('category', function ($q) use ($type) {
                    $q->where('type', $type);
                })->latest()->get();
            return DataTables::of($data)
                ->setRowAttr([
                    'url' => function ($data) {
                        return route('pemasukan.destroy', encryptData($data->id));
                    }
                ])
                ->addIndexColumn()
                ->editColumn('amount', function ($data) {
                    return formatIDR($data->amount, true);
                })
                ->addColumn('action', function ($data) use ($type) {
                    $button = '<div class="btn-group" role="group">';
                    if ($type == GlobalConstant::JOURNAL_IN) {
                        if (permissionCheck('update-journal-pemasukan')) {
                            $button .= '<a href="' . route('pemasukan.edit', encryptData($data->id)) . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                        }
                        if (permissionCheck('delete-journal-pemasukan')) {
                            $button .= '<button type="button" data-toggle="modal" data-target="#modal-delete" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-danger delete" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>';
                        }
                    } else {
                        if (permissionCheck('update-journal-pengeluaran')) {
                            $button .= '<a href="' . route('pengeluaran.edit', encryptData($data->id)) . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                        }
                        if (permissionCheck('delete-journal-pengeluaran')) {
                            $button .= '<button type="button" data-toggle="modal" data-target="#modal-delete" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-danger delete" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>';
                        }
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'amount'])
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
            $data = Journal::create($payload);
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

    public function getDetail($value)
    {
        try {
            $dataId = decryptData($value);
            $query = Journal::query();
            $data = $query->find($dataId);
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
