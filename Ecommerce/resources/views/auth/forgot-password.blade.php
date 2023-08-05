@extends('frontend.layouts.master')

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ __('forget password') }}</h4>
                        <ul>
                            <li><a href="{{ route('login') }}">{{ __('login') }}</a></li>
                            <li><a href="{{ route('password.request') }}">{{ __('forget password') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__forget_area">
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <h4>{{ __('forget password ?') }}</h4>
                        <p>enter the email address to register with <span>e-shop</span></p>
                        <div class="wsus__login">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="wsus__login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input type="email" name="email" placeholder="Your Email">
                                </div>

                                <button class="common_btn" type="submit">{{ __('Send') }}</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{ route('login') }}">{{ __('Go To Login') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
