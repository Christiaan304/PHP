@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('New Slider') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Manage Website') }}</div>
                <div class="breadcrumb-item">{{ __('New Slider') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.slider.store') }}" method="post" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="type">{{ __('Type') }}</label>
                                    <input type="text" class="form-control" name="type" id="type"
                                        value="{{ old('type') }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        value="{{ old('title') }}">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="starting_price">{{ __('Starting Price') }}</label>
                                    <input type="number" class="form-control" name="starting_price" id="starting_price"
                                        min="0" step=".01" value="{{ old('starting_price') }}">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="button_url">{{ __('Button URL') }}</label>
                                    <input type="text" class="form-control" name="button_url" id="button_url"
                                        value="{{ old('button_url') }}">
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="image">{{ __('Slider Image') }}</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="slider_number">{{ __('Slider Number') }}</label>
                                    <input type="number" class="form-control" name="slider_number" id="slider_number"
                                        min="0" step="any" value="{{ old('slider_number') }}">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="slider_status">{{ __('Slider Status') }}</label>
                                    <select class="form-control" name="slider_status" id="slider_status">
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Inactive') }}</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">{{ __('Create') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
