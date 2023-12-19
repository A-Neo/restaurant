@extends('layouts.layout')
@section('title', $categories->meta_title)
@section('description', $categories->meta_description)
@section('keywords', $categories->meta_keywords)
@section('content')
    <section id="banner">
        <div class="banner-images">
            <div class="banner-overlay" style="background: rgba(0, 0, 0, {{ $setting->overlay }})"></div>
            <img src="{{ $categories->getImage() }}" alt="{{ $categories->title_ru }}">
        </div>
        <div class="banner-text">
            <div class="grid">
                <h1>{{ $categories->__('title') }}</h1>
                <p>{{ $categories->__('subtitle') }}</p>
            </div>
        </div>
    </section>
    <section id="menu">
        <div class="food-sort">
            <div class="grid">
                <ul class="menu-list">
                    @if(!$menus->isEmpty())
                        @foreach($menus as $k => $v)
                            <li class="category-click category-child-item" data-sort="{{ $v->order ?? 999 }}"><a href="{{ $v->id }}">{{ $v->__('title') }}</a></li>
                        @endforeach
                        <li class="food-sort__child">
                            <span class="food-sort__down"><img src="{{ asset('assets/front/img/food-down.svg') }}" alt="Down"></span>
                            <ul class="menu-children">
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
    <section id="food">
        <div class="grid">
            <input type="hidden" name="token" value="{{ csrf_token() }}">
            <div class="f-wrap">
                <x-food id="{{ $categories->id }}"/>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        let token = $("input[name='token']").attr("value");

        let qnt = $('.menu-list li').length;

        if (qnt >= 6) {
            $('.food-sort__child').show();
            let li = $('.menu-list li:eq(6)').nextUntil(".food-sort__child").detach();
            $('.menu-children').append(li);
        }


        $('.menu-list').on('click', '.category-click', function (event) {
            event.preventDefault();

            let item = $(this).find('a');
            let category = item.attr('href');

            console.log(item);
            console.log(category);
            console.log({{ $categories->slug }});
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: '{{ route('food.update', ['slug' => $categories->slug])  }}',
                data: {
                    category: category,
                    id: "{{ $categories->id }}"
                },
                beforeSend: function(){
                    item.addClass('item-category-active');
                },
                success: function (data) {
                    $('.f-wrap .food-wrap').animate({"opacity":"0"}, 300);
                    setTimeout(function(){
                        $('.f-wrap').html(data);
                        $('.f-wrap .food-wrap').css("opacity", "0");
                        $('.f-wrap .food-wrap').animate({"opacity":"1"}, 700);
                        item.removeClass('item-category-active');
                    }, 700);
                },
                error: function(result){
                    console.log(result);
                    item.removeClass('item-category-active');
                }
            });

        });
    </script>
@endpush
