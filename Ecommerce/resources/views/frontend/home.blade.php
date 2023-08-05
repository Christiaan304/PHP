@extends('frontend.layouts.master')

@section('content')
    @include('frontend.sections.mobile-menu')
    @include('frontend.sections.product-modal')
    {{-- @include('frontend.sections.pop-up') --}}
    @include('frontend.sections.banner-slider')
    @include('frontend.sections.flash-sell')
    @include('frontend.sections.monthly-top-product')
    @include('frontend.sections.brand-slider')
    @include('frontend.sections.single-banner')
    @include('frontend.sections.hot-deals')
    @include('frontend.sections.electronic-1')
    @include('frontend.sections.electronic-2')
    @include('frontend.sections.large-banner')
    @include('frontend.sections.weekly-best-item')
    @include('frontend.sections.home-services')
    @include('frontend.sections.home-blog')
@endsection
