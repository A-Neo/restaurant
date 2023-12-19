@extends('layouts.layout')
@section('title', $page->meta_title)
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
@section('content')
    <section id="banner">
        <div class="banner-images">
            <div class="banner-overlay" style="background: rgba(0, 0, 0, {{ $setting->overlay }})"></div>
            <img loading="lazy" class="lazyload" src="{{ $page->image_url }}" alt="{{ $page->title_ru }}">
        </div>
        <div class="banner-text">
            <div class="grid">
                <h1>{{ $page->__('title') }}</h1>
                <p>{{ $page->__('subtitle') }}</p>
            </div>
        </div>
    </section>
    <section id="reserv">
        <div class="grid">
            <div class="reserv-wrap">
                <div class="reserv-left">
                    <img src="{{ asset('assets/front/img/reservation-chef.png') }}" alt="Img">
                </div>
                <div class="reserv-right">
                    <div class="form-wrap">
                        <x-form id="1"/>
                        <div class="form-black-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.components.pages.contact')
@endsection
@push('scripts')
    @include('layouts.components.js-maps')
@endpush
