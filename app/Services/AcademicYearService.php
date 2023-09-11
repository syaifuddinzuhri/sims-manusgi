<?php

namespace App\Services;

use App\Models\AcademicYear;

class AcademicYearService
{
    public function getDetail($id)
    {
        try {
            $dataId = decryptData($id);
            $data = AcademicYear::find($dataId);
            return $data;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
