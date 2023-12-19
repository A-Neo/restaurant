<div class="learn-form sms-form">
    <div class="learn-form__wrap sms-form__wrap">
        <div class="learn-form__head sms-form__head modal-head">
            <h4>Давайте знакомиться</h4>
            <span class="close-form"><img src="{{ asset('assets/front/img/close.svg') }}" alt="Img"></span>
        </div>
        <div class="modal-tabs">
            <form id="smsphone" class="sms-form" method="post">
                @csrf
                <div class="learn-form__groups learn-form__sms active">
                    <input name="phone" type="text" placeholder="Номер телефона" id="phone" class="sms-phone">
                    <div class="sms-form__btns sms-form__send-btn">
                        <button id="sendCode" type="submit" class="btn-sms" onclick="ym(93100421,'reachGoal','get-code'); return true;">Получить код</button>
                        <p>Нажимая на кнопку «Получить код», я даю <a href='/personal'>Согласие на обработку персональных данных</a>, также выражаю согласие с <a href='/policy'>Политикой обработки и защиты персональных данных</a></p>
                    </div>
                </div>
                <div class="learn-form__groups learn-form__code">
                    <input type="text" name="code" id="code" placeholder="Введите последние 4 цифры входящего номера">
                    <label for="code">Узнаем, если вы у нас уже были или создадим профиль, чтобы сделать первый заказ.</label>
                    <button id="verifyCode" type="submit" class="btn-code" onclick="ym(93100421,'reachGoal','confirm-code'); return true;">Подтвердить код</button>
                </div>
            </form>
        </div>
    </div>
</div>
