<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Services\GroupService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class GroupController extends Controller
{
    use GlobalTrait;

    private $service;

    public function __construct()
    {
        $this->middleware('permission:read-master-group', ['only' => 'index', 'show']);
        $this->middleware('permission:create-master-group', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-master-group', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-master-group', ['only' => ['destroy']]);
        $this->service = new GroupService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->datatables($request->all());
        }
        return view('pages.master.group.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.group.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $this->service->store($payload);
            return $this->commitTransaction('Data berhasil ditambahkan', 'grup.index');
        } catch (\Throwable $th) {
            return $this->rollbackTransaction($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $is_editing = true;
        $data = $this->service->getDetail($id);
        return view('pages.master.group.form', compact('is_editing', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $id)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $this->service->update($payload, $id);
            return $this->commitTransaction('Data berhasil diubah', 'grup.index');
        } catch (\Throwable $th) {
            return $this->rollbackTransaction($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->startTransaction();
        try {
            $this->service->delete($id);
            return $this->commitTransaction('Data berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->rollbackTransaction($th->getMessage());
        }
    }

    /**
     * permissionPage
     *
     * @param  mixed $id
     * @return void
     */
    public function permissionPage($id)
    {
        $data = $this->service->getDetail($id);
        $permissions = $this->service->getPermissions($id);
        return view('pages.master.group.permission', compact('data', 'permissions', 'id'));
    }

    /**
     * submitPermission
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function submitPermission(Request $request, $id)
    {
        $this->startTransaction();
        try {
            $payloadPermissions = $request->permission;
            $newPermissions = [];
            foreach ($payloadPermissions as $key => $value) {
                $name = array_keys($value)[0];
                if (!in_array($name, $newPermissions)) {
                    $exp = explode('-', $name);
                    if ($exp[0] == 'read') {
                        $parent = $exp[0] . '-' . $exp[1];
                        if (!in_array($parent, $newPermissions)) {
                            array_push($newPermissions, $parent);
                        }
                    }
                    array_push($newPermissions, $name);
                }
            }
            $role = $this->service->getDetail($id);
            $role->syncPermissions($newPermissions);
            return $this->commitTransaction('Data berhasil disimpan', 'grup.index');
        } catch (\Throwable $th) {
            return $this->rollbackTransaction($th->getMessage());
        }
    }
}
