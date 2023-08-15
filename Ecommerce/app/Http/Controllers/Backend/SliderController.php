<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateSliderRequest;

class SliderController extends Controller
{
    use \App\Traits\ImageHandleTrait;

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
        $slider->slider_image = $this->upload_image($request, 'image', 'uploads/slider');
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->button_url = $request->button_url;
        $slider->slider_image = $request->slider_image;
        $slider->slider_number = $request->slider_number;
        $slider->slider_status = $request->slider_status;
        $slider->save();

        toastr('Slider has been created successfully', 'success');
        return redirect()->route('admin.slider.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return view('admin.slider.edit', ['slider' => Slider::findOrFail($id)]);
    }

    public function update(UpdateSliderRequest $request, string $id)
    {
        $slider = Slider::findOrFail($id);

        $image_path = $this->update_image($request, 'image', 'uploads/slider', $slider->slider_image);
        $slider->slider_image = empty(!$image_path) ? $image_path : $slider->slider_image; // if image is empty then keep old image (if not empty then update image)

        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->button_url = $request->button_url;
        $slider->slider_image = $request->slider_image;
        $slider->slider_number = $request->slider_number;
        $slider->slider_status = $request->slider_status;
        $slider->save();

        toastr('Slider has been updated successfully', 'success');
        return redirect()->route('admin.slider.index');
    }

    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->delete_image($slider->slider_image);
        $slider->delete();
        toastr('Slider has been deleted successfully', 'success');
        return redirect()->route('admin.slider.index');
    }
}
