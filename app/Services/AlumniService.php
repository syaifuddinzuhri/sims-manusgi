<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AlumniService
{
    public function datatables($request)
    {
        try {
            $query = User::IsAlumni();
            $data = $query->latest()->get();
            return DataTables::of($data)
                ->setRowAttr([
                    'url' => function ($data) {
                        return route('siswa.destroy', encryptData($data->id));
                    }
                ])
                ->addIndexColumn()
                ->editColumn('photo', function ($data) {
                    $photo = $data->photo ? $data->photo : asset('img/avatar/avatar-1.png');
                    return '<img alt="image" src="' . $photo . '"
                    class="rounded-circle mr-1" width="30" height="30">';
                })
                ->editColumn('gender', function ($data) {
                    return genderBadger($data->gender);
                })
                ->editColumn('last_login', function ($data) {
                    return $data->last_login ? Carbon::parse($data->last_login)->format('d-m-Y H:i:s') : NULL;
                })
                ->rawColumns(['gender', 'last_login', 'photo'])
                ->make(true);
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
