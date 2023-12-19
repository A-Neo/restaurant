<div class="cart-popup">
    <div class="cart-popup__wrap">
        <div class="cart-popup__head">
            <h3>@lang('cart.cart')</h3>
            <span class="close-cart"><img src="{{ asset('assets/front/img/close.svg') }}" alt="Img"></span>
        </div>
        <div class="cart-popup__wrap-body">
            <x-cart/>
        </div>
    </div>
</div>
<div class="product-popup"></div>
@include('layouts.components.popup.phone')
@include('layouts.components.popup.street')
<div class="forms-popup">
    <div class="forms-popup__wrap">
        <div class="forms-group">
            <p>Благодарим за бронирование! Мы свяжемся с Вами в ближайшее время</p>
        </div>
    </div>
</div>
