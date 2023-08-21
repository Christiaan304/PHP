@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Edit category') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.category.update', $category->id) }}" method="post" class="row">
                                @csrf
                                @method('PUT')
                                <div class="col-md-4">
                                    <label for="category_icon">{{ __('Category icon') }}</label>
                                    <div>
                                        <button class="btn btn-primary" data-iconset="fontawesome5"
                                            data-icon="{{ $category->icon }}" data-selected-class="btn-primary"
                                            data-unselected-class="btn-info" role="iconpicker"
                                            name="category_icon"></button>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="category_name">{{ __('Category name') }}</label>
                                    <input type="text" class="form-control" name="category_name" id="category_name"
                                        value="{{ $category->name }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="category_status">{{ __('Category Status') }}</label>
                                    <select class="form-control" name="category_status" id="category_status">
                                        <option {{ $category->status == 1 ? 'selected' : '' }} value="1">
                                            {{ __('Active') }}</option>
                                        <option {{ $category->status == 1 ? 'selected' : '' }} value="0">
                                            {{ __('Inactive') }}</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">{{ __('Edit category') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
