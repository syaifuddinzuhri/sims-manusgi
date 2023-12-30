<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentCategoryDetail;
use App\Services\PaymentArrearService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentArrearController extends Controller
{
    use GlobalTrait;

    private $service;

    public function __construct()
    {
        $this->middleware('permission:read-transaksi-tunggakan', ['only' => 'index', 'show']);
        $this->middleware('permission:create-transaksi-tunggakan', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-transaksi-tunggakan', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-transaksi-tunggakan', ['only' => ['destroy']]);
        $this->service = new PaymentArrearService();
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
        return view('pages.transaksi.tunggakan.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    public function detail($id, $category_id)
    {
        $data = $this->service->getDetail($id, $category_id);
        return view('pages.transaksi.tunggakan.detail', compact('data'));
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
