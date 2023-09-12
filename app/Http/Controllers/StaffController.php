<?php

namespace App\Http\Controllers;

use App\Constants\UploadPathConstant;
use App\Http\Requests\StaffRequest;
use App\Services\GroupService;
use App\Services\StaffService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    use GlobalTrait;

    private $service;
    private $groupService;

    public function __construct()
    {
        $this->service = new StaffService();
        $this->groupService = new GroupService();
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
        return view('pages.master.staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.staff.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $upload_dir = UploadPathConstant::USER_PHOTOS;
                $file_name = $this->uploadFile($file, $upload_dir);
                $payload['photo'] = $file_name;
            }
            $user = $this->service->store($payload);
            $role = $this->groupService->getDetail(encryptData($payload['grup']));
            $user->syncRoles($role);
            return $this->commitTransaction('Data berhasil ditambahkan', 'staff.index');
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
        return view('pages.master.staff.form', compact('is_editing', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, $id)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $upload_dir = UploadPathConstant::USER_PHOTOS;
                $file_name = $this->uploadFile($file, $upload_dir);
                $payload['photo'] = $file_name;
            } else {
                unset($payload['photo']);
            }
            $this->service->update($payload, $id);
            $user = $this->service->getDetail($id);
            $role = $this->groupService->getDetail(encryptData($payload['grup']));
            $user->syncRoles($role);
            return $this->commitTransaction('Data berhasil diubah', 'staff.index');
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
}
