<section id="wsus__banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__banner_content">
                    <div class="row banner_slider">
                        @foreach ($sliders as $slider)
                            <div class="col-xl-12">
                                <div class="wsus__single_slider"
                                    style="background: url({{ asset($slider->slider_image) }});">
                                    <div class="wsus__single_slider_text">
                                        <h3>{{ $slider->type }}</h3>
                                        <h1>{{ $slider->title }}</h1>
                                        <h6>$ {{ number_format($slider->starting_price, 2, '.', ',') }}</h6>
                                        <a class="common_btn" href="{{ $slider->button_url }}">{{ __('Shop Now') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
