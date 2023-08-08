@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">{{ __('Profile') }}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">{{ __('Hi') }}, {{ auth()->user()->name }}</h2>
            <p class="section-lead">
                {{ __('Change information about yourself on this page.') }}
            </p>

            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card">
                        <form method="post" action="{{ route('admin.update.profile') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>{{ __('Edit Profile') }}</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label>{{ __('Image') }}</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>

                                    <div class="form-group col-4">
                                        <label>{{ __('First Name') }}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ auth()->user()->name }}" required>
                                        @error('name')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-4">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ auth()->user()->email }}" required>
                                        @error('email')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{ __('Save Changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <form method="post" action="{{ route('admin.update.password') }}">
                            @csrf
                            <div class="card-header">
                                <h4>{{ __('Edit Password') }}</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label>{{ __('Current password') }}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="current_password" required>
                                    </div>

                                    <div class="form-group col-4">
                                        <label>{{ __('New password') }}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" required>
                                    </div>

                                    <div class="form-group col-4">
                                        <label>{{ __('Confirm new password') }}</label>
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{ __('Save Changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
