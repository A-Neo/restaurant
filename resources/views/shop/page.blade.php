@extends('layouts.layout')
@section('title', $page->meta_title)
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
@section('content')
    <section id="lenta">
        <div class="grid">
            <div class="lenta-wrap">
                <div class="lenta-left" style="width: 100%;">
                    <div class="lenta-list">
                        <div class="lenta-item publication-item">
                            <h2>{{ $page->__('title') }}</h2>
                            <div class="lenta-text">
                                {!! $page->__('description') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

@endpush
