<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class GroupService
{
    public function getDetail($id)
    {
        try {
            $dataId = decryptData($id);
            $data = Role::find($dataId);
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
