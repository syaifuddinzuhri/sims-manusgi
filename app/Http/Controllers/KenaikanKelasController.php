<?php

namespace App\Http\Controllers;

use App\Services\KenaikanKelasService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

class KenaikanKelasController extends Controller
{
    use GlobalTrait;

    private $service;

    public function __construct()
    {
        $this->middleware('permission:read-siswa-kenaikan', ['only' => 'index', 'show']);
        $this->middleware('permission:create-siswa-kenaikan', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-siswa-kenaikan', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-siswa-kenaikan', ['only' => ['destroy']]);
        $this->service = new KenaikanKelasService();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.manajemen-siswa.kenaikan-kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $this->service->store($payload);
            return $this->commitTransaction('Data berhasil ditambahkan');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
