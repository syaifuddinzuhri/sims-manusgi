<?php

namespace App\Http\Controllers;

use App\Constants\GlobalConstant;
use App\Constants\UploadPathConstant;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\StudentRequest;
use App\Imports\StudentImport;
use App\Models\Classes;
use App\Services\GroupService;
use App\Services\StudentService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    use GlobalTrait;

    private $service;
    private $groupService;

    public function __construct()
    {
        $this->middleware('permission:read-master-siswa', ['only' => 'index', 'show']);
        $this->middleware('permission:create-master-siswa', ['only' => ['create', 'store', 'importPage', 'importSubmit']]);
        $this->middleware('permission:update-master-siswa', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-master-siswa', ['only' => ['destroy']]);
        $this->service = new StudentService();
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
            return $this->service->datatables($request);
        }
        return view('pages.master.siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.siswa.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $upload_dir = UploadPathConstant::USER_PHOTOS;
                $filename = $payload['username'];
                $upload_filename = $this->uploadFile($file, $upload_dir, $filename);
                $payload['photo'] = $upload_filename;
            }
            $payload['password_encrypted'] = $payload['password'];
            $user = $this->service->store($payload);
            $role = $this->groupService->getRoleByName(GlobalConstant::ROLE_STUDENT);
            $user->syncRoles($role);
            return $this->commitTransaction('Data berhasil ditambahkan', 'siswa.index');
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
        return view('pages.master.siswa.form', compact('is_editing', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $upload_dir = UploadPathConstant::USER_PHOTOS;
                $filename = $payload['username'];
                $upload_filename = $this->uploadFile($file, $upload_dir, $filename);
                $payload['photo'] = $upload_filename;
            } else {
                unset($payload['photo']);
            }
            $this->service->update($payload, $id);
            return $this->commitTransaction('Data berhasil diubah', 'siswa.index');
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


    public function passwordPage($id)
    {
        if (!isAdmin()) abort(403, 'You are not a administrator');
        $data = $this->service->getDetail($id);
        return view('pages.master.siswa.password', compact('data'));
    }

    public function changePassword(ChangePasswordRequest $request, $id)
    {
        $this->startTransaction();
        try {
            $payload = $request->only(['password']);
            $payload['password_encrypted'] = $payload['password'];
            $this->service->update($payload, $id);
            return $this->commitTransaction('Data berhasil diubah');
        } catch (\Throwable $th) {
            return $this->rollbackTransaction($th->getMessage());
        }
    }

    public function importPage()
    {
        return view('pages.master.siswa.import');
    }

    public function importSubmit(ImportRequest $request)
    {
        $this->startTransaction();
        try {
            $file = $request->file('file');
            $upload_dir = UploadPathConstant::STUDENT_IMPORT;
            $filename = 'import-siswa';
            $upload_filename = $this->uploadFile($file, $upload_dir, $filename);
            $path = public_path('/' . $upload_dir . '/' . $upload_filename);
            Excel::import(new StudentImport, $path);
            return $this->commitTransaction('Import data berhasil', 'siswa.index');
        } catch (\Throwable $th) {
            return $this->rollbackTransaction($th->getMessage());
        }
    }
}
