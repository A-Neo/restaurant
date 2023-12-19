@extends('layouts.layout')
@section('title', $page->meta_title)
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
@push('style')
<link rel="stylesheet" href="{{ asset('css/delivery.css') }}">
<link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endpush
@section('content')
    <section id="banner">
        <div class="banner-images">
            <div class="banner-overlay" style="background: rgba(0, 0, 0, {{ $setting->overlay }})"></div>
            <img loading="lazy" class="lazyload" data-src="{{ $page->image_url }}" alt="{{ $page->__('title') }}">
        </div>
        <div class="banner-text">
            <div class="grid">
                <h1>{{ $page->__('title') }}</h1>
                <p>{{ $page->__('subtitle') }}</p>
            </div>
        </div>
    </section>
    <section id="order">
        <div class="grid">
            <div class="order-wrapper">
                <div class="order-left">
                    <div id="order-tabs">
                        <!-- Кнопки -->
                        <ul class="tabs-nav">
                            <li><a href="#tab-1" class="click-delivery" data-id="0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 12H12V13.5H3V12Z" fill="#687188" />
                                        <path d="M1.5 8.25H9V9.75H1.5V8.25Z" fill="#687188" />
                                        <path
                                            d="M22.4388 12.4545L20.1888 7.2045C20.131 7.06956 20.0349 6.95455 19.9124 6.87375C19.7899 6.79295 19.6463 6.74992 19.4995 6.75H17.2495V5.25C17.2495 5.05109 17.1705 4.86032 17.0299 4.71967C16.8892 4.57902 16.6984 4.5 16.4995 4.5H4.49952V6H15.7495V15.417C15.4078 15.6154 15.1087 15.8796 14.8695 16.1942C14.6303 16.5088 14.4558 16.8676 14.356 17.25H9.64302C9.46047 16.543 9.02635 15.9269 8.42201 15.517C7.81768 15.1072 7.08463 14.9319 6.36027 15.0239C5.63591 15.1159 4.96997 15.4689 4.48728 16.0168C4.00459 16.5647 3.73828 17.2698 3.73828 18C3.73828 18.7302 4.00459 19.4353 4.48728 19.9832C4.96997 20.5311 5.63591 20.8841 6.36027 20.9761C7.08463 21.0681 7.81768 20.8928 8.42201 20.483C9.02635 20.0731 9.46047 19.457 9.64302 18.75H14.356C14.5192 19.3937 14.8923 19.9646 15.4164 20.3724C15.9404 20.7802 16.5855 21.0016 17.2495 21.0016C17.9136 21.0016 18.5586 20.7802 19.0827 20.3724C19.6067 19.9646 19.9799 19.3937 20.143 18.75H21.7495C21.9484 18.75 22.1392 18.671 22.2799 18.5303C22.4205 18.3897 22.4995 18.1989 22.4995 18V12.75C22.4996 12.6484 22.4789 12.5479 22.4388 12.4545ZM6.74952 19.5C6.45285 19.5 6.16284 19.412 5.91616 19.2472C5.66949 19.0824 5.47723 18.8481 5.3637 18.574C5.25017 18.2999 5.22046 17.9983 5.27834 17.7074C5.33622 17.4164 5.47908 17.1491 5.68886 16.9393C5.89864 16.7296 6.16591 16.5867 6.45688 16.5288C6.74785 16.4709 7.04945 16.5006 7.32354 16.6142C7.59763 16.7277 7.8319 16.92 7.99672 17.1666C8.16155 17.4133 8.24952 17.7033 8.24952 18C8.24912 18.3977 8.09096 18.779 7.80974 19.0602C7.52852 19.3414 7.14722 19.4996 6.74952 19.5ZM17.2495 8.25H19.0045L20.6125 12H17.2495V8.25ZM17.2495 19.5C16.9528 19.5 16.6628 19.412 16.4162 19.2472C16.1695 19.0824 15.9772 18.8481 15.8637 18.574C15.7502 18.2999 15.7205 17.9983 15.7783 17.7074C15.8362 17.4164 15.9791 17.1491 16.1889 16.9393C16.3986 16.7296 16.6659 16.5867 16.9569 16.5288C17.2479 16.4709 17.5495 16.5006 17.8235 16.6142C18.0976 16.7277 18.3319 16.92 18.4967 17.1666C18.6615 17.4133 18.7495 17.7033 18.7495 18C18.7491 18.3977 18.591 18.779 18.3097 19.0602C18.0285 19.3414 17.6472 19.4996 17.2495 19.5ZM20.9995 17.25H20.143C19.9778 16.6076 19.6041 16.0381 19.0804 15.6309C18.5568 15.2238 17.9128 15.0018 17.2495 15V13.5H20.9995V17.25Z"
                                            fill="#687188" />
                                    </svg>
                                    <span>@lang('order.delivery')</span>
                                </a></li>
                            <li><a href="#tab-2" class="click-pickup" data-id="1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M22.1113 6.46799L14.6113 2.34299C14.5005 2.28207 14.3762 2.25012 14.2498 2.25012C14.1234 2.25012 13.999 2.28207 13.8883 2.34299L6.38827 6.46799C6.27068 6.53274 6.17262 6.62785 6.10432 6.74342C6.03603 6.85898 6 6.99076 6 7.12499C6 7.25923 6.03603 7.39101 6.10432 7.50657C6.17262 7.62213 6.27068 7.71725 6.38827 7.78199L13.4998 11.6932V19.7325L11.2228 18.48L10.4998 19.7932L13.8883 21.657C13.999 21.7181 14.1233 21.7501 14.2498 21.7501C14.3762 21.7501 14.5006 21.7181 14.6113 21.657L22.1113 17.532C22.2289 17.4673 22.327 17.3722 22.3953 17.2566C22.4637 17.141 22.4997 17.0093 22.4998 16.875V7.12499C22.4997 6.99073 22.4637 6.85894 22.3953 6.74338C22.327 6.62781 22.2289 6.53271 22.1113 6.46799ZM14.2498 3.85649L20.1935 7.12499L14.2498 10.3935L8.30602 7.12499L14.2498 3.85649ZM20.9998 16.4317L14.9998 19.7317V11.6925L20.9998 8.39249V16.4317Z"
                                            fill="#222222" />
                                        <path d="M7.5 12H1.5V10.5H7.5V12Z" fill="#222222" />
                                        <path d="M9 18H3V16.5H9V18Z" fill="#222222" />
                                        <path d="M10.5 15H4.5V13.5H10.5V15Z" fill="#222222" />
                                    </svg>
                                    <span>@lang('order.pickup')</span>
                                </a></li>
                        </ul>

                        <!-- Контент -->
                        <div class="tabs-items">
                            <div class="tabs-item" id="tab-1">
                                <h3>@lang('order.data_time')</h3>
                                <div class="order-groups">
                                    <div class="order-group">
                                        <label for="date">@lang('order.value_data')</label>
                                        <select name="date" id="order-date-one">
                                            @foreach($dates as $date)
                                                <option value="{{ $date->format('d-m-Y') }}">{{ $date->format('d-m-Y') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="order-group">
                                        <label for="time">@lang('order.value_time')</label>
                                        <select name="time" id="order-time-one">
                                            <option value="0" selected>@lang('order.value_time_fast')</option>
                                            @for ($i = 12; $i <= 23; $i++)
                                                @if($i > 11 && $i < 23)
                                                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                                                    <option value="{{ $i }}:30">{{ $i }}:30</option>
                                                @elseif($i == 24)
                                                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                                                @elseif($i == 11)
                                                    <option value="{{ $i }}:30">{{ $i }}:30</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                    @if($setting->__('delivery'))
                                    <span>* {{ $setting->__('delivery') }}</span>
                                    @endif
                                </div>
                                <div class="order-streets">
                                    <div class="order-street">
                                        <label for="street">@lang('order.save_adrress')</label>
                                        <div class="street-wrap">
                                            <x-street />
                                        </div>
                                        <a href="#" class="street-btn">@lang('order.add_adrress')</a>
                                    </div>
                                </div>
                                <h3>@lang('order.enter_data')</h3>
                                <div class="ordes-user">
                                    <div class="ordes-user__group">
                                        <input name="name" type="text" placeholder="@lang('form.name') *" required>
                                    </div>
                                    <div class="ordes-user__group">
                                        <input name="phone" type="tel" value="{{ auth()->user()->phone ?? '+7 ' }}" required readonly>
                                    </div>
                                    <div class="ordes-user__group">
                                        <input name="email" type="email" placeholder="E-mail">
                                    </div>
                                    <div class="ordes-user__group">
                                        <input name="order-text" type="text" placeholder="@lang('order.wishes_order')">
                                    </div>
                                </div>
                                <div class="order-checkbox">
                                    <input type="checkbox" name="instrumentation" id="instrumentation" >
                                    <label for="instrumentation">@lang('order.devices_not')</label>
                                </div>
                            </div>
                            <div class="tabs-item" id="tab-2">
                                <h3>@lang('order.data_time')</h3>
                                <div class="order-groups">
                                    <div class="order-group">
                                        <label for="date">@lang('order.value_data')</label>
                                        <select name="date" id="order-date-two">
                                            @foreach($dates as $date)
                                                <option value="{{ $date->format('d-m-Y') }}">{{ $date->format('d-m-Y') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="order-group">
                                        <label for="time">@lang('order.value_time')</label>
                                        <select name="time" id="order-time-two">
                                            <option value="0" selected>@lang('order.value_time_fast')</option>
                                            @for ($i = 12; $i <= 23; $i++)
                                                @if($i > 11 && $i < 23)
                                                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                                                    <option value="{{ $i }}:30">{{ $i }}:30</option>
                                                @elseif($i == 24)
                                                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                                                @elseif($i == 11)
                                                    <option value="{{ $i }}:30">{{ $i }}:30</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                    <!--<span>* {{ $setting->__('delivery') }}</span>-->
                                </div>
                                <h3>@lang('order.enter_data')</h3>
                                <div class="ordes-user">
                                    <div class="ordes-user__group">
                                        <input name="name" type="text" placeholder="@lang('form.name') *" required>
                                    </div>
                                    <div class="ordes-user__group">
                                        <input name="phone" type="tel" value="+7" required readonly>
                                    </div>
                                    <div class="ordes-user__group">
                                        <input name="email" type="email" placeholder="E-mail">
                                    </div>
                                    <div class="ordes-user__group">
                                        <input name="order-text" type="text" placeholder="@lang('order.wishes_order')">
                                    </div>
                                </div>
                                <div class="order-checkbox">
                                    <input type="checkbox" name="instrumentation" id="instrumentation">
                                    <label for="instrumentation">@lang('order.devices_not')</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-right">
                    @include('layouts.components.blocks.order.form')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@include('layouts.components.scripts.order')
@include('layouts.components.scripts.addressSave')
@endpush
