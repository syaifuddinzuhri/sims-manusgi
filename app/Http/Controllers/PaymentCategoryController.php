<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentCategoryRequest;
use App\Services\PaymentCategoryService;
use App\Services\PaymentListService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

class PaymentCategoryController extends Controller
{
    use GlobalTrait;

    private $service;
    private $paymentListService;

    public function __construct()
    {
        $this->middleware('permission:read-pembayaran-jenis', ['only' => 'index', 'show']);
        $this->middleware('permission:create-pembayaran-jenis', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-pembayaran-jenis', ['only' => ['edit', 'update', 'showPayment', 'submitPayment', 'submitTargetStudent']]);
        $this->middleware('permission:delete-pembayaran-jenis', ['only' => ['destroy']]);
        $this->service = new PaymentCategoryService();
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
        return view('pages.pembayaran.jenis.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pembayaran.jenis.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentCategoryRequest $request)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $this->service->store($payload);
            return $this->commitTransaction('Data berhasil ditambahkan', 'jenis.index');
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
        return view('pages.pembayaran.jenis.form', compact('is_editing', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentCategoryRequest $request, $id)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $this->service->update($payload, $id);
            return $this->commitTransaction('Data berhasil diubah', 'jenis.index');
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

    public function showPayment($id)
    {
        $data = $this->service->getDetail($id);
        $payment = $this->paymentListService->getByPaymentCategoryId($id);
        $paymentLists = $this->paymentListService->getPaymentTarget($payment, $id);
        $selected = [];
        foreach ($paymentLists as $key => $item) {
            $selected[$item->id] = $item->id;
        }
        return view('pages.pembayaran.jenis.payment', compact('selected', 'data', 'payment', 'id',));
    }

    public function submitPayment(Request $request, $id)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $this->paymentListService->store($payload, $id);
            return $this->commitTransaction('Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->rollbackTransaction($th->getMessage());
        }
    }

    public function submitTargetStudent(Request $request, $id)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $this->paymentListService->storeStudent($payload, $id);
            return $this->commitTransaction('Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->rollbackTransaction($th->getMessage());
        }
    }
}
