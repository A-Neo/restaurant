<div class="learn-form sms-form">
    <div class="learn-form__wrap sms-form__wrap">
        <div class="learn-form__head sms-form__head modal-head">
            <h4>Давайте знакомиться</h4>
            <span class="close-form"><img src="{{ asset('assets/front/img/close.svg') }}" alt="Img"></span>
        </div>
        <div class="modal-tabs">
            <form id="formsms" class="form-sms-group form-sms-phone active" method="post">
                @csrf
                <label for="code" class="label-code">Узнаем, если вы у нас уже были или создадим профиль.</label>
                <div class="sms-phone__group sms-input-phone">
                    <input type="tel" id="phone" name="phone" placeholder="+7 " required="required" minlength="11">
                </div>
                <input type="submit" id="sendCode" class="sms-btn-group btn-sms" value="Получить код">
{{-- <label for="phone">* Узнаем, если вы у нас уже были или создадим профиль, чтобы сделать первый заказ.</label>--}}
{{-- onclick="ym(93100421,'reachGoal','get-code'); return true;" --}}
            </form>
            <form id="formcode" class="form-sms-group form-sms-code" method="post">
                @csrf
                <label for="code" class="label-code">На ваш номер поступит звонок, введите 4 цифры которые Вам продиктует робот.</label>
                <div class="fieldset sms-phone__group">
                    <label class="box"><input class="field" type="text" placeholder="•" inputmode="numeric" pattern="[0-9]*" maxlength="1" autocomplete="one-time-code" required="required"/></label>
                    <label class="box"><input class="field" type="text" placeholder="•" inputmode="numeric" pattern="[0-9]*" maxlength="1" autocomplete="one-time-code" required="required"/></label>
                    <label class="box"><input class="field" type="text" placeholder="•" inputmode="numeric" pattern="[0-9]*" maxlength="1" autocomplete="one-time-code" required="required"/></label>
                    <label class="box"><input class="field" type="text" placeholder="•" inputmode="numeric" pattern="[0-9]*" maxlength="1" autocomplete="one-time-code" required="required"/></label>
                </div>
                <input type="submit" id="verifyCode" class="sms-btn-group btn-code" value="Подтвердить код">
                {{-- onclick="ym(93100421,'reachGoal','confirm-code'); return true;" --}}
            </form>
            <p>Нажимая на кнопку, я даю <a href='/personal'>Согласие на обработку персональных данных</a>, также выражаю согласие с <a href='/policy'>Политикой обработки и защиты персональных данных</a></p>
        </div>
    </div>
</div>
