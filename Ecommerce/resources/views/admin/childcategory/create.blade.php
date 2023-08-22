@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Create childcategory') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.childcategory.store') }}" method="post" class="row">
                                @csrf
                                <div class="col-md-3">
                                    <label for="parent_category">{{ __('Parent category') }}</label>
                                    <select class="form-control main-category" name="parent_category" id="parent_category">
                                        <option>{{ __('Select') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="sub_category">{{ __('Sub category') }}</label>
                                    <select class="form-control sub-category" name="sub_category" id="sub_category">
                                        <option value="">{{ __('Select') }}</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="subcategory_name">{{ __('Subcategory name') }}</label>
                                    <input type="text" class="form-control" name="subcategory_name" id="subcategory_name"
                                        value="{{ old('subcategory_name') }}" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="subcategory_status">{{ __('Subcategory Status') }}</label>
                                    <select class="form-control" name="subcategory_status" id="subcategory_status">
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Inactive') }}</option>
                                    </select>
                                </div>

                                <button type="submit"
                                    class="btn btn-primary mt-4">{{ __('Create childcategory') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get.subcategory') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.sub-category').html(
                            `<option value="">{{ __('Select') }}</option>`);
                            
                        $.each(data, function(i, item) {
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
