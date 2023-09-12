<?php

namespace App\Http\Controllers;

use App\Constants\UploadPathConstant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index');
    }
}
