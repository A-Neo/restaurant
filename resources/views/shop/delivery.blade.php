@extends('layouts.layout')
@section('title', $page->meta_title)
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
@push('style')
    <link rel="stylesheet" href="{{ asset('css/popup-phone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sms.css') }}">
@endpush
@section('content')
    <section id="banner">
        <div class="banner-images">
            <div class="banner-overlay" style="background: rgba(0, 0, 0, {{ $setting->overlay }})"></div>
            <img loading="lazy" class="lazyload" data-src="{{ $page->image_url }}" alt="{{ $page->title_ru }}">
        </div>
        <div class="banner-text">
            <div class="grid">
                <h1>{{ $page->__('title') }}</h1>
                <p>{{ $page->__('subtitle') }}</p>
            </div>
        </div>
    </section>
    <section id="menu">
        <div class="food-sort">
            <div class="grid">
                <x-menu-list :categories="$categories" />
            </div>
        </div>
    </section>
    <section id="delivery">
        <div class="grid">
            <x-delivery :categories="$categories"/>
        </div>
    </section>
@endsection

@push('scripts')
@include('layouts.components.scripts.sms_code')
@include('layouts.components.scripts.delivery')
@endpush
