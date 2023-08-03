<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorController extends Controller
{
    public function dashboard()
    {
        return view('vendor.dashboard');
    }
}
