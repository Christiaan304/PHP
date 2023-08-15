<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $slider = Slider::where('slider_status', 1)->orderBy('slider_number', 'asc')->get();
        return view('frontend.home', ['sliders' => $slider]);
    }
}
