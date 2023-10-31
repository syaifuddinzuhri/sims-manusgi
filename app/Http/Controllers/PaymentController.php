<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\PaymentListService;
use App\Services\PaymentService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use GlobalTrait;

    private $service;
    private $paymentListService;

    public function __construct()
    {
        $this->middleware('permission:read-transaksi-pembayaran', ['only' => 'index', 'show']);
        $this->middleware('permission:create-transaksi-pembayaran', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-transaksi-pembayaran', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-transaksi-pembayaran', ['only' => ['destroy']]);
        $this->service = new PaymentService();
        $this->paymentListService = new PaymentListService();
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
        return view('pages.transaksi.pembayaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->payment_list_id) {
            return redirect()->back();
        }
        $data = $this->paymentListService->getById($request->payment_list_id);
        return view('pages.transaksi.pembayaran.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $payload['journal_category_id'] = 1;
            $payload['amount'] = dbIDR($payload['amount']);
            $this->service->store($payload);
            return $this->commitTransaction('Data berhasil ditambahkan', 'pembayaran.index');
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
