<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class GroupService
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
            $data = Role::latest()->get();
            return DataTables::of($data)
                ->setRowAttr([
                    'url' => function ($data) {
                        return route('grup.destroy', encryptData($data->id));
                    }
                ])
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="' . route('permission.index', encryptData($data->id)) . '" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Manajemen Akses">
                            <i class="fa fa-lock" aria-hidden="true"></i> </a>';
                    if (!checkGroup($data->name) && permissionCheck('update-master-group')) {
                        $button .= '<a href="' . route('grup.edit', encryptData($data->id)) . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    }
                    if (!checkGroup($data->name) && permissionCheck('delete-master-group')) {
                        $button .= '<button type="button" data-toggle="modal" data-target="#modal-delete" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-danger delete" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns([])
                ->make(true);
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    /**
     * getRoleUser
     *
     * @return void
     */
    public function getRoleUser()
    {
        try {
            $role = Auth::user()->roles[0];
            $roles = $this->getDetail($role->id);
            return $roles;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    /**
     * getPermissions
     *
     * @param  mixed $id
     * @return void
     */
    public function getPermissions($id)
    {
        try {
            $roles = $this->getDetail($id);
            $permissions = Permission::whereNull('parent_id')->get();
            foreach ($permissions as $key => $value) {
                $permissionsChildren = Permission::where('parent_id', $value->id)->get();
                $value['is_checked'] = collect($roles->permissions)->where('name', $value->name)->first() ? 1 : 0;
                $value['children'] = $permissionsChildren;
                foreach ($value['children'] as $key2 => $child) {
                    $child['is_checked'] = collect($roles->permissions)->where('name', $child->name)->first() ? 1 : 0;
                }
            }
            return $permissions;
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
            $data = Role::create($payload);
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

    public function getDetail($value, $relation = [])
    {
        try {
            $dataId = decryptData($value);
            $query = Role::query();
            array_push($relation, 'permissions');
            $query->with($relation);
            $data = $query->find($dataId);
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function getRoleByName($name)
    {
        try {
            return Role::where('name', $name)->first();
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
