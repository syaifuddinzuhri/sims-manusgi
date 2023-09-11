<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Services\GroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class GroupController extends Controller
{

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
            $data = Role::latest()->get();
            return DataTables::of($data)
                ->setRowAttr([
                    'url' => function ($data) {
                        return route('grup.destroy', encryptData($data->id));
                    },
                ])
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="' . route('grup.edit', encryptData($data->id)) . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit">
                        <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<button type="button" data-toggle="modal" data-target="#modal-delete" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-danger delete" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns([])
                ->make(true);
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
        DB::beginTransaction();
        try {
            $payload = $request->all();

            Role::create($payload);
            DB::commit();
            showSuccessToast('Data berhasil ditambahkan');
            return redirect()->route('grup.index');
        } catch (\Throwable $th) {
            DB::rollback();
            showErrorToast($th->getMessage());
            return redirect()->back();
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

        DB::beginTransaction();
        try {
            $payload = $request->all();
            $data = $this->service->getDetail($id);
            $data->update($payload);
            DB::commit();
            showSuccessToast('Data berhasil dibuah');
            return redirect()->route('grup.index');
        } catch (\Throwable $th) {
            DB::rollback();
            showErrorToast($th->getMessage());
            return redirect()->back();
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
        DB::beginTransaction();
        try {
            $data = $this->service->getDetail($id);
            $data->delete();
            DB::commit();
            showSuccessToast('Data berhasil dihapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            showErrorToast($th->getMessage());
            return redirect()->back();
        }
    }
}
