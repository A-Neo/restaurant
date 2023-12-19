@extends('layouts.layout')
@section('title', 'Страница не найдена')
@section('content')
    <section id="banner">
        <div class="banner-images">
            <div class="banner-overlay"></div>
            <img src="{{ asset('assets/front/img/404-main.jpg') }}" alt="404">
        </div>
        <div class="banner-text">
            <div class="grid">
                <h1>Страница не найдена</h1>
                <p>Ошибка 404</p>
            </div>
        </div>
    </section>
    <section id="error">
        <div class="grid">
            <div class="error-wrap">
                <div class="error-img error-img_tl"><img src="{{ asset('assets/front/img/symbol-georgia.png') }}" alt="Symbol Georgia"></div>
                <div class="error-img error-img_tr"><img src="{{ asset('assets/front/img/symbol-georgia.png') }}" alt="Symbol Georgia"></div>
                <div class="error-img error-img_br"><img src="{{ asset('assets/front/img/symbol-georgia.png') }}" alt="Symbol Georgia"></div>
                <div class="error-img error-img_bl"><img src="{{ asset('assets/front/img/symbol-georgia.png') }}" alt="Symbol Georgia"></div>
                <div class="error-text">
                    <h2>404</h2>
                    <p>УПС! Запрошенная вами страница не найдена!</p>
                    <a href="/" style="z-index: 1">Вернуться на главную</a>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('scripts')
@endpush
