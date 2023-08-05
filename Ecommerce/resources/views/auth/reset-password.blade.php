@extends('frontend.layouts.master')

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ __('Change Password') }}</h4>
                        <ul>
                            <li><a href="#">{{ __('Login') }}</a></li>
                            <li><a href="#">change password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        {{-- password reset token --}}
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="wsus__change_password">
                            <h4>{{ __('Change Password') }}</h4>
                            <div class="wsus__single_pass">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Email"
                                    value="{{ old('email', $request->email) }}" autofocus>
                            </div>

                            <div class="wsus__single_pass">
                                <label>{{ __('New Password') }}</label>
                                <input type="password" name="password" placeholder="{{ __('New Password') }}">
                            </div>

                            <div class="wsus__single_pass">
                                <label>{{ __('Confirm Password') }}</label>
                                <input type="password" name="password_confirmation"
                                    placeholder="{{ __('Confirm Password') }}">
                            </div>

                            <button class="common_btn" type="submit">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
