<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Services\GroupService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class GroupController extends Controller
{
    use GlobalTrait;

    private $service;

    public function __construct()
    {
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
            return $this->commitTransaction('Data berhasil dihapus', 'group.index');
        } catch (\Throwable $th) {
            return $this->rollbackTransaction($th->getMessage());
        }
    }
}
