@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Edit subcategory') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="post"
                                class="row">
                                @csrf
                                @method('PUT')
                                <div class="col-md-4">
                                    <label for="parent_category">{{ __('Parent category') }}</label>
                                    <select class="form-control" name="parent_category" id="parent_category">
                                        <option>{{ __('Select') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="subcategory_name">{{ __('Subcategory name') }}</label>
                                    <input type="text" class="form-control" name="subcategory_name" id="subcategory_name"
                                        value="{{ $subcategory->name }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="subcategory_status">{{ __('Subcategory Status') }}</label>
                                    <select class="form-control" name="subcategory_status" id="subcategory_status">
                                        <option {{ $subcategory->status == 1 ? 'selected' : '' }} value="1">
                                            {{ __('Active') }}</option>
                                        <option {{ $subcategory->status == 0 ? 'selected' : '' }} value="0">
                                            {{ __('Inactive') }}</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">{{ __('Update subcategory') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
