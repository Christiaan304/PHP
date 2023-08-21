@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Create category') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.category.store') }}" method="post" class="row">
                                @csrf
                                <div class="col-md-4">
                                    <label for="category_icon">{{ __('Category icon') }}</label>
                                    <div>
                                        <button class="btn btn-primary" data-iconset="fontawesome5"
                                            data-selected-class="btn-primary" data-unselected-class="btn-info"
                                            role="iconpicker" name="category_icon"></button>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="category_name">{{ __('Category name') }}</label>
                                    <input type="text" class="form-control" name="category_name" id="category_name"
                                        value="{{ old('category_name') }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="category_status">{{ __('Category Status') }}</label>
                                    <select class="form-control" name="category_status" id="category_status">
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Inactive') }}</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">{{ __('Create category') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
