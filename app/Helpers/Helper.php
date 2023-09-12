<?php

use App\Models\Classes;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

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

if (!function_exists('semesterBadge')) {
    function semesterBadge($value)
    {
        if ($value == 1) {
            return '<span class="badge badge-pill badge-primary">Ganjil</span>';
        } else {
            return '<span class="badge badge-pill badge-success">Genap</span>';
        }
    }
}

if (!function_exists('genderBadger')) {
    function genderBadger($value)
    {
        if ($value == 'L') {
            return '<span class="badge badge-pill badge-primary">Laki-laki</span>';
        } else if ($value == 'P') {
            return '<span class="badge badge-pill badge-info">Perempuan</span>';
        }
    }
}

if (!function_exists('yearOptions')) {
    function yearOptions($max = 1)
    {
        $startYear = Carbon::now()->subYear(50)->format('Y');
        $endYear = Carbon::now()->addYear($max)->format('Y');
        $years = [];
        for ($i = $endYear; $i >= $startYear; $i--) {
            $years[] = [
                'id' => (string) $i,
                'text' => (string) $i,
            ];
        }
        return $years;
    }
}

if (!function_exists('groupOptions')) {
    function groupOptions($is_student = false)
    {
        return Role::select('id', 'name as text')->where(function ($query) use ($is_student) {
            if (!$is_student) {
                $query->where('name', '!=', 'Siswa');
            }
        })->get();
    }
}

if (!function_exists('classOptions')) {
    function classOptions()
    {
        $result = Classes::with('department')->get()->map(function ($data) {
            return [
                'id' => $data->id,
                'text' => $data->name . ' - ' . $data->department->name,
            ];
        });
        return $result;
    }
}

if (!function_exists('departmentOptions')) {
    function departmentOptions()
    {
        return Department::select('id', 'name as text')->get();
    }
}

if (!function_exists('classOptions')) {
    function classOptions()
    {
        return Classes::select('id', 'name as text')->get();
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        $role = Auth::user()->roles[0];
        $roles = Role::find($role->id);
        if ($roles->name == 'Administrator') {
            return true;
        }
        return false;
    }
}

if (!function_exists('permissionCheck')) {
    function permissionCheck($name)
    {
        return Auth::user()->can($name);
    }
}

if (!function_exists('fileUrl')) {
    function fileUrl($path, $field)
    {
        return URL::to('/') . '/' . $path . '/' . $field;
    }
}
