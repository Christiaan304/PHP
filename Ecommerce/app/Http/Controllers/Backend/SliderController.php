<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSliderRequest;

class SliderController extends Controller
{
    use \App\Traits\ImageUploadTrait;

    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(CreateSliderRequest $request)
    {
        $slider = new Slider();
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->button_url = $request->button_url;
        $slider->slider_image = $request->slider_image;
        $slider->slider_number = $request->slider_number;
        $slider->slider_status = $request->slider_status;

        $slider->slider_image = $this->upload_image($request, 'image', 'uploads/slider');

        $slider->save();

        toastr('Slider has been created successfully', 'success');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
