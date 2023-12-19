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
    <section id="lenta">
        <div class="grid">
            <div class="lenta-wrap">
                <div class="lenta-left">
                    <div class="lenta-list">
                        @foreach($articles as $article)
                        <div class="lenta-item">
                            <a href="{{ route('article', ['slug' => $article->slug]) }}">
                                <h2>{{ $article->__('title') }}</h2>
                            </a>

                            <div class="lenta-up">
                                <div class="lenta-data">
                                    <img src="{{ asset('assets/front/img/data.svg') }}" alt="Data">
                                    <span>{{ date('d-m-Y', strtotime($article->created_at)) }}</span>
                                </div>
                                <div class="lenta-mark">
                                    <img src="{{ asset('assets/front/img/mark.svg') }}" alt="Mark">
                                    <span>{{ $article->rubrics->__('title') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('article', ['slug' => $article->slug]) }}">
                                <div class="lenta-img"><img src="{{ $article->getImage() }}" alt="{{ $article->__('title') }}"></div>
                            </a>
                            <div class="lenta-text"> @if(mb_strlen($article->__('description')) < 270){!! $article->__('description') !!} @else {!! mb_substr($article->__('description'), 0, 270) . "..." !!} @endif </div>
                            <div class="lenta-btn">
                                <a href="{{ route('article', ['slug' => $article->slug]) }}">Читать далее</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $articles->links('pagination::default') }}
                </div>
                <div class="lenta-right">
                    <div class="lenta-category">
                        <h3>@lang('lenta.category')</h3>
                        <ul>
                            @foreach($rubrics as $rubric)
                                <li><a href="{{ route('articles', ['slug' => $rubric->slug]) }}">{{ $rubric->__('title') }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="lenta-random">
                        <h3>@lang('lenta.random')</h3>
                        <div class="lenta-list">
                            @foreach($randoms as $random)
                            <div class="lenta-item">
                                <div class="lenta-up">
                                    <div class="lenta-data">
                                        <img src="{{ asset('assets/front/img/data.svg') }}" alt="Data">
                                        <span>29.01.2022</span>
                                    </div>
                                    <div class="lenta-mark">
                                        <img src="{{ asset('assets/front/img/mark.svg') }}" alt="Mark">
                                        <span>{{ $random->rubrics->__('title') }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('article', ['slug' => $random->slug]) }}">
                                    <h4>{{ $random->__('title') }}</h4>
                                </a>
                                <p> @if(mb_strlen(strip_tags(htmlspecialchars_decode($random->__('description')))) < 85){!! strip_tags(htmlspecialchars_decode($random->__('description'))) !!} @else {!! mb_substr(strip_tags(htmlspecialchars_decode($random->__('description'))), 0, 85) . "..." !!} @endif </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

@endpush
