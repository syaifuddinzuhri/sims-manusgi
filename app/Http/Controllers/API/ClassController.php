<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function getClass(Request $request)
    {
        try {
            $searchValue = trim(strtolower($request->keyword));
            $filter = ['name', 'department.name'];
            $result = Classes::with(['department'])->whereLike($filter, isset($searchValue) ? $searchValue : "")->limit(50);

            $json = $result->get()->map(function ($data) {
                return [
                    'id' => $data->id,
                    'text' => $data->name . " - " . $data->department->name,
                ];
            });
            return response()->success($json, 'Success');
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 400);
        }
    }
}
