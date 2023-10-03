<?php

namespace App\Http\Controllers;

use App\Services\SettingService;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use GlobalTrait;

    private $service;

    public function __construct()
    {
        $this->middleware('permission:read-pengaturan-umum', ['only' => 'index']);
        $this->middleware('permission:update-journal-kategori', ['only' => ['update']]);
        $this->service = new SettingService();
    }

    public function index()
    {
        $setting = $this->service->get();
        return view('pages.pengaturan.umum.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $this->startTransaction();
        try {
            $payload = $request->all();
            $this->service->update($payload);
            return $this->commitTransaction('Data berhasil disimpan');
        } catch (\Throwable $th) {
            return $this->rollbackTransaction($th->getMessage());
        }
    }
}
