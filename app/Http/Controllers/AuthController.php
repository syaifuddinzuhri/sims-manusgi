<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('pages.auth.login');
    }

    public function loginSubmit(LoginRequest $request)
    {
        $column = [filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' :  'username'];
        $user = User::where([$column[0] => $request->username])->first();

        if (!$user) {
            showErrorToast('Username atau email tidak ditemukan');
            return redirect()->back();
        }

        if (!Hash::check($request->password, $user->password)) {
            showErrorToast('Password salah');
            return redirect()->back();
        }

        if (!$user->is_active) {
            showErrorToast('Akun anda tidak aktif. Silahkan hubungi administrator!');
        }

        Auth::login($user);

        $user->update([
            'last_login' => Carbon::now(),
        ]);
        showSuccessToast('Login berhasil');
        return redirect()->route('dashboard.index');
    }

    public function profilePage()
    {
        $user = authUser();
        // return view('pages.auth.profile', compact('user'));
    }


    public function logoutSubmit(Request $request)
    {
        Auth::logout();
        showSuccessToast('Logout berhasil');
        return redirect()->route('login.show');
    }
}
