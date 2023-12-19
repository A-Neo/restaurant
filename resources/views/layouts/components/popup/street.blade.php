<div class="street-popup">
    <div class="street-popup__wrap">
        <div class="form_wrapper">
            <div class="street-popup__head">
                <h4>@lang('order.new_address')</h4>
                <span class="close-street"><img src="{{ asset('assets/front/img/close.svg') }}" alt="Img"></span>
            </div>
            <form action="#" method="POST" id="formstreet">
                @csrf
                <div class="form_street">
                    <div class="form_street__group form_street__input">
                        <input type="text" class="street" id="suggest" value="Москва, " placeholder="Введите адрес доставки" name="street" data-coor="#">
                    </div>
                    <div class="form_street__group form_street__sumbit" id="form_submit_input">
                        <input type="submit" value="Сохранить" >
                    </div>
                </div>
                <div class="form_text"></div>
                <div class="form_street_down">
                    <input type="text" placeholder="Квартира" name="flat" id="flat">
                    <input type="text" placeholder="Этаж" name="floor" id="floor">
                    <input type="text" placeholder="Подъезд" name="entrance" id="entrance">
                    <input type="text" placeholder="Домофон" name="intercom" id="intercom">
                </div>
            </form>
            <div class="street-btn">
                <span>@lang('order.adrress_politic')</span>
            </div>
            <div class="form_maps"><div id="map"></div></div>
        </div>
    </div>
</div>
