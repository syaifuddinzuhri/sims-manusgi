<?php

namespace App\Http\Controllers;

use App\Constants\GlobalConstant;
use App\Http\Requests\JournalRequest;
use App\Services\JournalService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

class JournalPengeluaranController extends Controller
{
    use GlobalTrait;

    private $service;

    public function __construct()
    {
        $this->middleware('permission:read-journal-pengeluaran', ['only' => 'index', 'show']);
        $this->middleware('permission:create-journal-pengeluaran', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-journal-pengeluaran', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-journal-pengeluaran', ['only' => ['destroy']]);
        $this->service = new JournalService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->datatables($request, GlobalConstant::JOURNAL_OUT);
        }
        return view('pages.jurnal.pengeluaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.jurnal.pengeluaran.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JournalRequest $request)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $payload['amount'] = dbIDR($payload['amount']);
            $this->service->store($payload);
            return $this->commitTransaction('Data berhasil ditambahkan', 'pengeluaran.index');
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
        return view('pages.jurnal.pengeluaran.form', compact('is_editing', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JournalRequest $request, $id)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $payload['amount'] = dbIDR($payload['amount']);
            $this->service->update($payload, $id);
            return $this->commitTransaction('Data berhasil diubah', 'pengeluaran.index');
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
