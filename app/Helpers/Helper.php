<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;
use RealRashid\SweetAlert\Facades\Alert;

if (!function_exists('formatIDR')) {
    function formatIDR($value, $is_prefix = false)
    {
        $format = number_format($value, 0, '.', '.');
        return $is_prefix ? 'Rp ' . $format : $format;
    }
}

if (!function_exists('dbIDR')) {
    function dbIDR($value)
    {
        return str_replace('.', '', $value);
    }
}

if (!function_exists('authUser')) {
    function authUser()
    {
        return User::find(auth()->user()->id);
    }
}

if (!function_exists('showSuccessToast')) {
    function showSuccessToast($message)
    {
        toast($message, 'success');
    }
}

if (!function_exists('showErrorToast')) {
    function showErrorToast($message)
    {
        toast($message, 'error');
    }
}

if (!function_exists('showSuccessAlert')) {
    function showSuccessAlert($message)
    {
        Alert::success('Success', $message);
    }
}

if (!function_exists('showErrorAlert')) {
    function showErrorAlert($message)
    {
        Alert::error('Error', $message);
    }
}

if (!function_exists('dropColumnIfExist')) {
    function dropColumnIfExist($table, $column, $callable)
    {
        if (Schema::hasColumn($table, $column)) {
            Schema::table($table, function (Blueprint $blueprint) use ($column) {
                $blueprint->dropColumn($column);
            });
        }

        Schema::table($table, function (Blueprint $blueprint) use ($column, $callable) {
            call_user_func_array($callable, [$blueprint, $column]);
        });
    }
}

if (!function_exists('encryptData')) {
    function encryptData($value)
    {
        return Crypt::encrypt($value);
    }
}

if (!function_exists('decryptData')) {
    function decryptData($value)
    {
        return Crypt::decrypt($value);
    }
}

if (!function_exists('apiException')) {
    function apiException($msg)
    {
        throw new Exception($msg, 400);
    }
}
