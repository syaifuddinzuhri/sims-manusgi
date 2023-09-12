<?php

namespace App\Services;

use App\Models\JournalCategory;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class JournalCategoryService
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
            $data = JournalCategory::latest()->get();
            return DataTables::of($data)
                ->setRowAttr([
                    'url' => function ($data) {
                        return route('kategori.destroy', encryptData($data->id));
                    }
                ])
                ->addIndexColumn()
                ->editColumn('type', function ($data) {
                    return journalTypeBadge($data->type);
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    if (!$data->is_lock && permissionCheck('update-journal-kategori')) {
                        $button .= '<a href="' . route('kategori.edit', encryptData($data->id)) . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    }
                    if (!$data->is_lock && permissionCheck('delete-journal-kategori')) {
                        $button .= '<button type="button" data-toggle="modal" data-target="#modal-delete" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-danger delete" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'type'])
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
            $data = JournalCategory::create($payload);
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
            $query = JournalCategory::query();
            $data = $query->find($dataId);
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
