@extends('layouts.layout')
@section('title', $page->meta_title)
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
@push('style')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush
@section('content')
    <section id="main">
        <div class="main-list">
            @foreach($banners as $banner)
                <div class="main-item">
                    <div class="main-img_overlay" style="background: rgba(0, 0, 0, {{ $setting->overlay }})"></div>
                    @if($banner->mode_bg == 1)
                        <img src="{{ $banner->getImage('bg_image') }}" alt="Main">
                    @else
                    <img src="{{ $banner->getImage('bg_image') }}">
                    <div class="vidcontainer">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $banner->video_link }}?playsinline=1&autoplay=1&mute=1&playsinline=0&showinfo=0&controls=0&fs=0&modestbranding=1&loop=1&playlist={{ $banner->video_link }}&autohide=1&playsinline=1" frameborder="0" allowfullscreen="allowfullscreen" allow="autoplay" class="vidY"></iframe>
                    </div>
                    @endif
                    <div class="grid">
                        @if($banner->mode_content == 1)
                        <div class="main-block main-left @if($banner->mode_align == 2) main-center-img @endif">
                            <div class="main-block__span">
                                <span>@lang('banner.restaurant')</span>
                                <span>@lang('banner.georgian_cuisine')</span>
                                <span>@lang('banner.delivery')</span>
                            </div>
                            <h1>{{ $banner->__('title') }}</h1>
                            <p>{!! $banner->__('subtitle') !!}</p>
                            <a href="https://delivery.dedi.rest" class="btn-a">{{ $banner->__('btn') }}</a>
                        </div>
                        @else
                        <div class="main-block main-left @if($banner->mode_align == 2) main-center-img @endif">
                            <img src="{{ $banner->getImage('image') }}" alt="{{ $banner->title_ru }}" @if($banner->mode_align == 1) style="width: auto;" @endif>
                            <p>{!! $banner->__('subtitle') !!}</p>
                            <a href="https://delivery.dedi.rest" class="btn-a">{{ $banner->__('btn') }}</a>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section id="m-about">
        <div class="grid">
            <div class="about-wrap">
                <div class="about-img">
                    <img src="{{ $about->getImage('image') }}" alt="{{ $about->subtitle_ru }}">
                    <div class="img-overlay"></div>
                </div>
                <div class="about-text">
                    <h2>{{ $about->__('subtitle') }}</h2>
                    <p>{!! $about->__('describe') !!}</p>
                    <a href="{{ route('about') }}" class="btn-a">{{ $about->__('btn') }}</a>
                </div>
            </div>
        </div>
    </section>
    @if($products && $products->count())
    <section id="m-menu">
        <div class="grid">
            <h2>Наше меню</h2>
            <div class="menu-list">
                <ul>
                    @foreach($products as $product)
                    <li>
                        <div class="menu-list__up">
                            <span>{{ $product->__('title') }}</span>
                            <span>{{ $product->price }} ₽</span>
                        </div>
                        <div class="menu-list__down">@if(mb_strlen($product->__('describe')) < 35){!! $product->__('describe') !!} @else {!! mb_substr($product->__('describe'), 0, 35) . "..." !!} @endif</div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="menu-btns">
                <a href="{{ route('food', ['slug' => $menu]) }}" class="btn-a">@lang('btn.menu_all')</a>
                <a href="{{ route('delivery') }}" class="btn-a">@lang('btn.delivery')</a>
            </div>
        </div>
    </section>
    @endif
    <section id="m-mobile" class="home-mobile">
        <div class="grid">
            <div class="mobile-wrap">
                <div class="mobile-text">
                    <h3>{{ $addition->__('title') }}</h3>
                    <p>{!! $addition->__('description') !!}</p>
                    <div class="mobile-text__btns">
                        @if($addition->mode == 2)
                        <a href="{{ $addition->apple_link }}" onclick="ym(93100421,'reachGoal','loyalty'); return true;" target="_blank">
                            <span>{{ $addition->google_link }}</span>
                        </a>
                        @else
                            <a href="{{ $addition->btn_link }}" class="btn-a">{{ $addition->__('btn') }}</a>
                        @endif
                    </div>
                </div>
                <div class="mobile-img"><img src="{{ $addition->getImage() }}" alt="Mobile-App"></div>
            </div>
        </div>
    </section>
    <scrtion id="m-reserv">
        <div class="grid">
            <div class="reserv-wrap">
                <div class="form-wrap">
                    <x-form id="1"/>
                    <div class="form-black-overlay"></div>
                </div>
                <div class="reserv-right">
                    <h3>{{ $reservation->__('title') }}</h3>
                    <p>{!! $reservation->__('description') !!}</p>
                </div>
            </div>
        </div>
    </scrtion>
    <section id="m-about">
        <div class="grid">
            <div class="about-wrap m-chef">
                <div class="about-img">
                    <img src="{{ $chef->getImage() }}" alt="Chef">
                    <div class="img-overlay"></div>
                </div>
                <div class="about-text">
                    <h2>{{ $chef->__('title') }}</h2>
                    <p>{!! $chef->__('description') !!}</p>
                    <a href="{{ route('food', ['slug' => $menu]) }}" class="btn-a">@lang('btn.all_menu')</a>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.components.pages.contact')
@endsection
@push('scripts')
@include('layouts.components.js-maps')
<script>
    @if($banner->mode_bg !== 1)
        if($(window).width() < 1060) {
            $('.vidcontainer').remove();
        }
    @endif
    @if($banners->count() == 1)
        setTimeout(function() {
            $('#main .slick-dots').css('display', 'none');
        }, 1000);
    @endif
</script>
@endpush
