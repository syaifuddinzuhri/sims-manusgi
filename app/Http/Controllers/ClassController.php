<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRequest;
use App\Services\ClassService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    use GlobalTrait;

    private $service;

    public function __construct()
    {
        $this->middleware('permission:read-master-kelas', ['only' => 'index', 'show']);
        $this->middleware('permission:create-master-kelas', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-master-kelas', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-master-kelas', ['only' => ['destroy']]);
        $this->service = new ClassService();
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
        return view('pages.master.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.kelas.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRequest $request)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $this->service->store($payload);
            return $this->commitTransaction('Data berhasil ditambahkan', 'kelas.index');
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
        return view('pages.master.kelas.form', compact('is_editing', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassRequest $request, $id)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $this->service->update($payload, $id);
            return $this->commitTransaction('Data berhasil diubah', 'kelas.index');
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
