@extends('layouts.layout')
@section('title', $page->meta_title)
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
@push('noindex')
{{--@include('layouts.components.noindex')--}}
@endpush
@push('headStyle')
    <link rel="stylesheet" href="{{ asset('css/flex-gallery.css') }}">
@endpush
@section('content')
    <section id="banner" class="pdf-file">
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
        @if($page->pdf_file)
        <div class="banner-down"><div class="grid"><a href="{{ $page->pdf_url }}" class="btn white" target="_blank">{{ $page->__('pdf') ?? 'Смотреть презентацию' }}</a></div></div>
        @endif
    </section>
    @if($page->__('description'))
    <section id="banquet" class="children">
        <div class="grid">
            <div class="banquet-wrap">
                <div class="banquet-text">
                    {!! $page->__('description') !!}
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(count($page->sliders))
        @if(!empty($page->title_gallery))
            <section id="heading"><div class="grid"><h2>{{ $page->title_gallery }}</h2></div></section>
        @endif
            <section id="gallery" class="gallery" itemscope itemtype="http://schema.org/ImageGallery">
                <div class="gallery-list">
                    @foreach ($page->sliders as $index => $image)
                        @if($index + 1 > 10) @break @endif
                        <a href="{{ $image->image_url }}" class="gallery-item g{{ $index + 1 }}" data-src="{{ $image->image_url }}" data-fancybox="gallery" itemprop="contentUrl">
                            <img data-src="{{ $image->thumbnail_url }}" class="lazyload blur" itemprop="thumbnail" alt="Фото №{{ $image->id }}">
                        </a>
                    @endforeach
                </div>
            </section>
    @endif
    @include('layouts.components.pages.contact')
@endsection
@push('scripts')
@include('layouts.components.js-maps')
@include('layouts.components.scripts.fancybox')
@endpush
