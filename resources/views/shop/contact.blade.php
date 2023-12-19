@extends('layouts.layout')
@section('title', $page->meta_title)
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
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
    <section id="contact">
        <div class="grid">
            <div class="contact-wrap">
                <div class="contact-item">
                    <h2>@lang('contact.for_all_questions')</h2>
                    <ul>
                        <li><a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a></li>
                        <li><a href="tel:+79255092260">+7 (925) 509-22-60</a></li>
                        <li><a href="mailto:{{ $setting->mail }}">{{ $setting->mail }}</a></li>
                    </ul>
                </div>
                <div class="contact-item">
                    <h2>@lang('contact.working_hours')</h2>
                    <ul>
                        <li>{{ $setting->__('time') }}</li>
                        <li></li>
                    </ul>
                </div>
                <div class="contact-item">
                    <h2>@lang('contact.our_location')</h2>
                    <ul>
                        <li>{{ $setting->__('street') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="c-contact">
        <div class="c-contact__maps">
         <div id="map"></div>
        </div>
        <div class="c-contact__form">
            <div class="grid">
                <div class="form-wrap">
                    <h2>Связаться с нами</h2>
                    <x-form id="3"/>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@include('layouts.components.js-maps')
@endpush
