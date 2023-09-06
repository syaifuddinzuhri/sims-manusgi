<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class GroupController extends Controller
{
    public function getGroup(Request $request)
    {
        try {
            $searchValue = trim(strtolower($request->keyword));
            $filter = ['name'];
            $result = Role::whereLike($filter, isset($searchValue) ? $searchValue : "")->limit(50);

            $json = $result->get()->map(function ($data) {
                return [
                    'id' => $data->id,
                    'text' => $data->name,
                ];
            });
            return response()->success($json, 'Success');
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 400);
        }
    }
}