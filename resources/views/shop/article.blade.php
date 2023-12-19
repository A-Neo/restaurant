@extends('layouts.layout')
@section('title', $article->meta_title)
@section('description', $article->meta_description)
@section('keywords', $article->meta_keywords)
@section('content')
    <section id="banner">
        <div class="banner-images">
            <div class="banner-overlay" style="background: rgba(0, 0, 0, {{ $setting->overlay }})"></div>
            <img loading="lazy" class="lazyload" data-src="{{ $article->getImage() }}" alt="{{ $article->__('title') }}">
        </div>
        <div class="banner-text">
            <div class="grid">
                <h1>{{ $article->__('title') }}</h1>
                <p>{{ $article->__('subtitle') }}</p>
            </div>
        </div>
    </section>
    <section id="lenta">
        <div class="grid">
            <div class="lenta-wrap">
                <div class="lenta-left">
                    <div class="lenta-list">
                        <div class="lenta-item publication-item">
                            <div class="lenta-text">
                                {!! $article->__('description') !!}
                                @if($article->form)
                                    <div class="form-wrap form-publication">
                                        <x-form id="{{ $article->form }}"/>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
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
    <section id="m-contact" class="publication-map">
        <div class="grid">
            <h2>@lang('headings.main_contact')</h2>
            <div class="contact-maps">
                <div id="map"></div>
                <div class="contact-data">
                    <div class="contact-item">
                        <h5>@lang('contact.for_all_questions')</h5>
                        <ul>
                            <li>@lang('contact.phone_number'): <span><a href="tel:+{{ $setting->phone }}">{{ $setting->phone }}</a></span></li>
                            <li>@lang('contact.our_mail'): <span><a href="mailto:{{ $setting->mail }}">{{ $setting->mail }}</a> </span></li>
                        </ul>
                    </div>
                    <div class="contact-item">
                        <h5>@lang('contact.working_hours')</h5>
                        <ul>
                            <li>{{ $setting->__('time') }}</li>
                            <li>{{ $setting->__('delivery') }}</li>
                        </ul>
                    </div>
                    <div class="contact-item">
                        <h5>@lang('contact.our_location')</h5>
                        <ul>
                            <li>{{ $setting->__('street') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@include('layouts.components.js-maps')
<script>
    // Slider - Start
    let slides = {};

    @foreach($article->sliders as $k => $v)
        slides["{{ $k }}"] = "{{ $v->image ?? $v->image_url }}";
    @endforeach

    let group = '';


    $.map(slides, function(s) {
        group += "<div class='lenta-image'><a href="+ s +" data-fancybox='gallery' itemprop='contentUrl' data-src=" + s + "><img data-src="+ s +" class='lazyload blur' itemprop='thumbnail' alt='Img'></a></div>";
    });

    let slider;

    slider = "<div class='lenta-slider'>";
    slider += "<span class='slide-prev'><img src='{{ asset('assets/front/img/left.svg') }}' alt='Left'></span>";
    slider += "<span class='slide-next'><img src='{{ asset('assets/front/img/right.svg') }}' alt='Right'></span>";
    slider += "<div class='lenta-images'>";
    slider += group;
    slider += "</div>";
    slider += "</div>";

    $('p:contains("x-slider")').html($.parseHTML(slider));
    // Slider - End

    // Gallery - Start
    let gallery = {};

    let galleryCount = parseInt({{ count($article->galleries) }});

    @foreach($article->galleries as $k => $v)
        gallery["{{ $k }}"] = "{{ $v->image_url }}";
    @endforeach


    let cycle = 0,
        qntImage = 0;

    for(let i = galleryCount; i >= 0; i--) {
        let wrap = '';
        if(i % 3 === 0 && i > 0) {
            var j = false;
            $.map(gallery, function(s, i) {

                if (j <= 2) {
                cycle++;

                switch (cycle) {
                    case 1: case 4: case 7: case 10: case 13: case 16: case 19: case 22:
                        wrap += "<div class='image-wrap__one'>";
                        wrap += "<a href="+ s +" data-fancybox='gallery' itemprop='contentUrl' data-src=" + s + ">";
                        wrap += "<img data-src="+ s +" class='lazyload blur' itemprop='thumbnail' alt='Img'>";
                        wrap += "</a>";
                        wrap += "</div>";
                        delete gallery[qntImage];
                        qntImage++;
                        break;
                    case 2: case 5: case 8: case 11: case 14: case 17: case 20: case 23:
                        wrap += "<div class='image-wrap__two'>";
                        wrap += "<a href="+ s +" data-fancybox='gallery' itemprop='contentUrl' data-src=" + s + ">";
                        wrap += "<img data-src="+ s +" class='lazyload blur' itemprop='thumbnail' alt='Img'>";
                        wrap += "</a>";
                        delete gallery[qntImage];
                        qntImage++;
                        break;
                    case 3: case 6: case 9: case 12: case 15: case 18: case 21: case 24:
                        wrap += "<a href="+ s +" data-fancybox='gallery' itemprop='contentUrl' data-src=" + s + ">";
                        wrap += "<img data-src="+ s +" class='lazyload blur' itemprop='thumbnail' alt='Img'>";
                        wrap += "</a>";
                        wrap += "</div>";
                        delete gallery[qntImage];
                        qntImage++;
                        break;
                }

                j++;
                }
            });
            galleries = "<div class='image-wrap'>";
            galleries += wrap;
            galleries += "</div>";

            if (cycle <= 3) {
                $('p:contains("x-galleries")').html($.parseHTML(galleries));
            } else {
                $('.image-wrap:last-child').after($.parseHTML(galleries));
            }
        }

        i++;
        i -= 3;
    }
    // Gallery - End
</script>
@include('layouts.components.scripts.fancybox')
@endpush
