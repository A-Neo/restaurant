<section id="m-mobile">
    <div class="grid">
        <div class="mobile-wrap">
            <div class="mobile-text">
                <h3>{{ $addition->__('title') }}</h3>
                <p>{{ $addition->__('description') }}</p>
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
            <div class="mobile-img"><img loading="lazy" class="lazyload" data-src="{{ $addition->getImage() }}" alt="Mobile-App"></div>
        </div>
    </div>
</section>
<section id="m-contact" class="reserv-block">
    <div class="grid">
        <h2>@lang('headings.main_contact')</h2>
        <div class="contact-maps">
            <div loading="lazy" class="lazyload" id="map"></div>
            <div class="contact-data">
                <div class="contact-item">
                    <h5>@lang('contact.for_all_questions')</h5>
                    <ul>
                        <li><span><a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a></span></li>
                        <li><span><a href="tel:+79255092260">+7 (925) 509-22-60</a></span></li>
                        <li><span><a href="mailto:{{ $setting->mail }}">{{ $setting->mail }}</a> </span></li>
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
