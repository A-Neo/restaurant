@extends('layouts.layout')
@section('title', 'Форма успешно отправлена!')
@section('content')
    <section id="banner">
        <div class="banner-images">
            <div class="banner-overlay" style="background: rgba(0, 0, 0, {{ $setting->overlay }})"></div>
            <img loading="lazy" class="lazyload" data-src="{{ $page->image_url }}" alt="Успешно">
        </div>
        <div class="banner-text">
            <div class="grid" style="text-align: center;">
                <h1>Форма успешно отправлена!</h1>
                <p>Спасибо за обращение! Наш менеджер свяжется с вами в самое ближайшее время! <br>Вы можете <a href="/" style="color: #fff;">вернуться на главную</a>!</p>
            </div>
        </div>
    </section>
    <section id="contact">
        <div class="grid">
            <div class="contact-wrap">
                <div class="contact-item">
                    <h2>@lang('contact.for_all_questions')</h2>
                    <ul>
                        <li><span><a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a></span></li>
                        <li><span><a href="tel:+79255092260">+7 (925) 509-22-60</a></span></li>
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
@endsection
@push('scripts')
@endpush
