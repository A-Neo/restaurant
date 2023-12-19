<form action="#" method="POST">
    <h3>@lang('order.order')</h3>
    @if($products)
        <div class="order-list">
            @foreach($products as $product)
                <div class="order-item">
                    <div class="order-item__head">
                        @if(session()->has('locale') && session()->get('locale') == 'en')
                            <h4>{{ $product['title_en'] }}</h4>
                        @else
                            <h4>{{ $product['title_ru'] }}</h4>
                        @endif
                        <p>@lang('cart.quantity'): {{ $product['qnt'] }}</p>
                    </div>
                    <div class="order-item__price"><span class="price-product">{{ $product['price'] * $product['qnt'] }}</span> ₽</div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="order-help-block">
        <div class="order-help-item">
            <h4>Бесплатная доставка от:</h4>
            <p><span id="amount_price_delivery">0</span><span style="display: inline" class="price-current">₽</span></p>
        </div>
        <div class="order-help-item">
            <h4>Время доставки:</h4>
            <p><span id="time_full_delivery">от 60</span><span style="display: inline" class="price-current">м</span></p>
        </div>
        <div class="order-help-item">
            <h4>Стоимость доставки:</h4>
            <p><span id="price_delivery">0</span><span style="display: inline" class="price-current">₽</span></p>
        </div>
    </div>
    <div class="order-block">
        <h4>Итого:</h4>
        <div class="order-price-group">
            <span class="price-total" id="amount_price_total">0</span>
            <span class="price-current">₽</span>
        </div>
    </div>
    <div class="order-payment">
        <h4>@lang('order.value_payment'):</h4>
        <div class="order-payment__list">
            <div class="payment-group">
                <input type="radio" name="payment" value="0" checked>
                <label for="payment">@lang('order.payment_restaurant')</label>
            </div>
        </div>
    </div>
    <div class="order-btn">
        <button onclick="ym(93100421,'reachGoal','confirm-order'); return true;">@lang('order.payment_order')</button>
        <span>@lang('order.order_politic')</span>
    </div>
</form>
