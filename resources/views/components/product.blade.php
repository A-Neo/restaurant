<div class="product-popup__wrap">
    <div class="product-popup__left">
        <span class="product-popup__arrow-left"><img src="{{ asset('assets/front/img/left.svg') }}" alt="Left"></span>
        <span class="product-popup__arrow-right"><img src="{{ asset('assets/front/img/right.svg') }}" alt="Right"></span>
        <div class="product-popup__images">
            <div class="product-popup__img">
                <img src="{{ $product->getImage() }}" alt="{{ $product->__('title') }}">
            </div>
            @foreach($product->images as $image)
            <div class="product-popup__img">
                <img src="{{ $image->getImage() }}" alt="{{ $product->__('title') }}">
            </div>
            @endforeach
        </div>
    </div>
    <div class="product-popup__right">
        <div class="product-popup__text">
            <div class="product-popup__head">
                <h3>{{ $product->__('title') }}</h3>
                <span class="close-popup"><img src="{{ asset('assets/front/img/close.svg') }}" alt="Img"></span>
            </div>
            <p>{{ $product->__('describe') }}</p>
        </div>
        <div class="product-popup__tabs">
            <div class="product-popup__tabs-head">
                <h4>О продукте</h4>
                <span class="down-popup"><img src="{{ asset('assets/front/img/popup-down.svg') }}" alt="Img"></span>
            </div>
            <div id="tabs-popup" class="tabs-popup">
                <!-- Кнопки -->
                <ul class="tabs-nav">
                    <li><a href="#tab-1">Пищевая ценность</a></li>
                    <li><a href="#tab-2">Состав и аллергены</a></li>
                </ul>
                <div class="tabs-items">
                    <div class="tabs-item" id="tab-1">
                        <ul>
                            @foreach($product->attributes as $attr)
                                <li><span>{{ $attr->__('title') }}:</span><span>{{ $attr->pivot->value }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tabs-item" id="tab-2">
                        <p>{{ $product->__('description') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-popup__btns">
            <div class="product-popup__price">
                {{ $product->price }} ₽ <span>/ {{ $product->weight }} г</span>
            </div>
            <div class="product-popup__btn @if(!session()->has("cart.$product->id")) product-popup-none @endif">
                @if(session()->has("cart.$product->id"))
                    <a href="{{ $product->id }}" class="popup-cart__minus"><img src="{{ asset('assets/front/img/minus.svg') }}" alt="Img"></a>
                    <span class="popup-cart-btn"><div class="popup-product-qnt">{{ session()->get("cart.$product->id.qnt") }}</div> <div>в корзине</div></span>
                    <a href="{{ $product->id }}" class="popup-cart__plus"><img src="{{ asset('assets/front/img/plus.svg') }}" alt="Img"></a>
                @else
                    <a href="{{ $product->id }}" class="popup-cart__minus"><img src="{{ asset('assets/front/img/minus.svg') }}" alt="Img"></a>
                    <a href="{{ $product->id }}" class="popup-cart-btn popup_cart-none"><div class="popup-product-qnt"><img src="{{ asset('assets/front/img/delivery-cart.svg') }}" alt="Img"></div></a>
                    <a href="{{ $product->id }}" class="popup-cart__plus"><img src="{{ asset('assets/front/img/plus.svg') }}" alt="Img"></a>
                @endif

            </div>
        </div>
    </div>
</div>
