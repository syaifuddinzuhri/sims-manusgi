<?php

namespace App\Services;

use App\Constants\GlobalConstant;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class StaffService
{
    public function datatables($request)
    {
        try {
            $data = User::IsNotStudent()->IsNotAlumni()->latest()->get();
            return DataTables::of($data)
                ->setRowAttr([
                    'url' => function ($data) {
                        return route('staff.destroy', encryptData($data->id));
                    }
                ])
                ->addIndexColumn()
                ->editColumn('photo', function ($data) {
                    $photo = $data->photo ? $data->photo : asset('img/avatar/avatar-1.png');
                    return '<img alt="image" src="' . $photo . '"
                    class="rounded-circle mr-1" width="30" height="30">';
                })
                ->editColumn('gender', function ($data) {
                    return genderBadger($data->gender);
                })
                ->editColumn('roles', function ($data) {
                    return $data->roles[0]->name;
                })
                ->editColumn('last_login', function ($data) {
                    return Carbon::parse($data->last_login)->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    if (isAdmin()) {
                        $button .= '<a href="' . route('staff.password.index', encryptData($data->id)) . '" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-key" aria-hidden="true"></i> </a>';
                    }
                    if (permissionCheck('update-master-staff')) {
                        $button .= '<a href="' . route('staff.edit', encryptData($data->id)) . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit">
                        <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    }
                    if (permissionCheck('delete-master-staff') && $data->name != GlobalConstant::ADMIN) {
                        $button .= '<button type="button" data-toggle="modal" data-target="#modal-delete" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-danger delete" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['gender', 'action', 'last_login', 'photo', 'roles'])
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
            $data = User::create($payload);
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

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
            $query = User::query();
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
