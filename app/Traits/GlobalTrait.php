<?php

namespace App\Traits;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait GlobalTrait
{
    public static function datatables($request, $query, $orderBy = 'created_at')
    {
        $orderBy = $request->orderBy ?? $orderBy;
        $sortBy = $request->sortBy && in_array($request->sortBy, ['asc', 'desc']) ? $request->sortBy : 'desc';
        $request->perPage ? $perPage = $request->perPage : $perPage = 10;
        $result = $query->orderBy($orderBy, (string)$sortBy)->paginate($perPage)->appends($request->all());
        return $result;
    }

    public function phoneNumberValidation($phone)
    {
        $verifiedNumber = NULL;
        if ($phone) {
            $f = substr($phone, 0, 1);
            if ($f == "0") {
                $verifiedNumber = $phone;
                $r = substr($phone, 1, strlen($phone));
                $verifiedNumber = "62$r";
            } else if ($f == "+") {
                $r = substr($phone, 1, strlen($phone) - 1);
                $verifiedNumber = "62$r";
            } else if ($f == "6") {
                $r = substr($phone, 2, strlen($phone) - 2);
                $cc = substr($phone, 0, 2);
            } else {
                $verifiedNumber = $phone;
            }
        }
        return $verifiedNumber;
    }

    public static function jsonCheck($string)
    {
        $result = json_decode($string);
        if (json_last_error() === JSON_ERROR_NONE) {
            return TRUE;
        }
        return FALSE;
    }

    public function groupByToArray($items, $single = false)
    {
        $data = [];
        foreach ($items as $key => $value) {
            array_push($data, $value);
        }
        if (count($data) > 0) {
            return $single == true ? $data[0] : $data;
        }
        return [];
    }

    public static function apiException($msg, $code = 400)
    {
        throw new \Exception($msg, $code);
    }

    public static function generateGuid()
    {
        if (function_exists('com_create_guid') === true)
            return trim(com_create_guid(), '{}');

        $data    = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public static function amountFormat($value)
    {
        return number_format((float)$value, 2, '.', '');
    }

    public static function getArrayData($array, $key, $default = '')
    {
        if (!is_array($array)) {
            return '';
        }

        if (!isset($array[$key])) {
            return '';
        }

        if (empty($array[$key])) {
            return $default;
        }

        return $array[$key];
    }

    public static function isValidTime($dateTime)
    {
        if (preg_match('/^' .
            '(\d{4})-(\d{2})-(\d{2})T' . // YYYY-MM-DDT ex: 2014-01-01T
            '(\d{2}):(\d{2}):(\d{2})' .  // HH-MM-SS  ex: 17:00:00
            '((-|\+)\d{2}:\d{2})' .  //+01:00 or -01:00
            '$/', $dateTime, $parts) == true) {
            try {
                new DateTime($dateTime);
                return true;
            } catch (Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function isValidPhone($phone)
    {
        if (strpos($phone, '062+8') === 0 || strpos($phone, '08') === 0) {
            return true;
        }

        return false;
    }

    public static function sanitizePhone($phone)
    {
        $phone = preg_replace('/\s/', '', $phone);

        if (strpos($phone, '062+8') === 0) {
            $suffix    = substr($phone, strlen('062+8'));
            $sanitized = '062+8' . preg_replace('/\D/', '', $suffix);
        } else {
            $sanitized = preg_replace('/\D/', '', $phone);
        }

        return $sanitized;
    }

    public static function startTransaction()
    {
        DB::beginTransaction();
    }

    public static function rollbackTransaction($messages)
    {
        DB::rollback();
        showErrorToast($messages);
        return redirect()->back();
    }

    public static function commitTransaction($message, $route = null)
    {
        DB::commit();
        showSuccessToast($message);
        if ($route) {
            return redirect()->route($route);
        }
        return redirect()->back();
    }

    public static function uploadFile($file, $path, $rekursif = true)
    {
        if ($file) {
            $name = Storage::disk('public_uploads')->put($path, $file);
            chmod($path, 0777);
            $exp = explode('/', $name);
            return end($exp);
        }
    }
}
