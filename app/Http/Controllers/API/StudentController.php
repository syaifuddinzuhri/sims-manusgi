<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getStudent(Request $request)
    {
        try {
            $searchValue = trim(strtolower($request->keyword));
            $filter = ['name'];
            $result = User::with(['class.department'])->where('is_student', 1)->whereLike($filter, isset($searchValue) ? $searchValue : "")->limit(50);

            $json = $result->get()->map(function ($data) {
                return [
                    'id' => $data->id,
                    'text' => $data->name . " | " . $data->class->name . " - " . $data->class->department->name,
                ];
            });
            return response()->success($json, 'Success');
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 400);
        }
    }
}
