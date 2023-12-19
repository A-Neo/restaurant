@if($products)
<div class="cart-popup__body">
    @foreach($products as $k => $v)
    <div class="cart-popup__item">
        <div class="cart-popup__img"><img src="{{ $v['img'] }}" alt="{{ $v['title_ru'] }}"></div>
        <div class="art-popup__text">
            @if(session()->has('locale') && session()->get('locale') == 'en')
                <h4>{{ $v['title_en'] }}</h4>
                <p>@if(mb_strlen($v['describe_en']) < 50){!! $v['describe_en'] !!} @else {!! mb_substr($v['describe_en'], 0, 50) . "..." !!} @endif</p>
            @else
                <h4>{{ $v['title_ru'] }}</h4>
                <p>@if(mb_strlen($v['describe_ru']) < 50){!! $v['describe_ru'] !!} @else {!! mb_substr($v['describe_ru'], 0, 50) . "..." !!} @endif</p>
            @endif
            <div class="art-popup__qnt">
                <a href="{{ $k }}" class="cart-minus"><img src="{{ asset('assets/front/img/minus.svg') }}" alt="Minus"></a>
                <span class="cart-qnt">{{ $v['qnt'] }}</span>
                <a href="{{ $k }}" class="cart-plus"><img src="{{ asset('assets/front/img/plus.svg') }}" alt="Plus"></a>
            </div>
        </div>
        <div class="art-popup__right">
            <div class="art-popup__delete"><a href="{{ $k }}"><img src="{{ asset('assets/front/img/delete.svg') }}" alt="Delete"></a></div>
            <div class="art-popup__price">
                <span class="cart-item-price">{{ $v['price'] }}</span> ₽ х <span class="cart-item-qnt">{{ $v['qnt'] }}</span>
                <span class="cart-sum-item"><div class="cart-sum-price" style="display: inline">{{ $v['price'] * $v['qnt'] }}</div> ₽</span>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="cart-popup__price">
    <div class="cart-popup__price-all">@lang('cart.total'): <span class="cart-popup-price-all">0</span> ₽</div>
    <div class="cart-popup__price-btn"><a href="{{ route('order') }}" onclick="ym(93100421,'reachGoal','go-order'); return true;">@lang('cart.btn')</a></div>
</div>
@endif
