@extends('frontend.dashboard.layouts.master')

@section('content')
    @include('frontend.dashboard.layouts.side-bar')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> {{ __('Profile') }}</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <h4>{{ __('basic information') }}</h4>
                                <form method="POST" action="{{ route('user.update.profile') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-xl-9">
                                            <div class="col-xl-3 col-sm-6 col-md-6">
                                                <div class="wsus__dash_pro_img">
                                                    <img src="{{ auth()->user()->image_path ? asset(auth()->user()->image_path) : asset('frontend/images/ts-2.jpg') }}"
                                                        alt="img" class="img-fluid w-100">
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-xl-12 col-md-12">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-user-tie"></i>
                                                        <input type="text" name="name" placeholder="First Name"
                                                            value="{{ auth()->user()->name }}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="far fa-phone-alt"></i>
                                                        <input type="text" name="phone" placeholder="Phone"
                                                            value="{{ auth()->user()->phone_id }}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fal fa-envelope-open"></i>
                                                        <input type="email" name="email" placeholder="Email"
                                                            value="{{ auth()->user()->email }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <button class="common_btn mb-4 mt-2"
                                                type="submit">{{ __('update profile') }}</button>
                                        </div>
                                </form>
                                <hr>
                                <h4>{{ __('update password') }}</h4>
                                <form method="POST" action="{{ route('user.update.password') }}">
                                    @csrf
                                    <div class="wsus__dash_pass_change mt-2">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-unlock-alt"></i>
                                                    <input type="password" name="current_password"
                                                        placeholder="Current Password">
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-6">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-lock-alt"></i>
                                                    <input type="password" name="password" placeholder="New Password">
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-lock-alt"></i>
                                                    <input type="password" name="password_confirmation"
                                                        placeholder="Confirm Password">
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <button class="common_btn"
                                                    type="submit">{{ __('update password') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
