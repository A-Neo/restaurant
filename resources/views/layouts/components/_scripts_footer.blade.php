<script>
    document.addEventListener('DOMContentLoaded', function() {
        let path = window.location.pathname;
        let page = path.replace('/', '');

        function formatPhoneNumber(value) {
            var numbers = value.replace(/\D/g, '');
            if (!numbers.startsWith('7')) numbers = '7' + numbers;
            numbers = numbers.substring(0, 11);

            var formatted = '+7';

            if (numbers.length > 1) formatted += ' (' + numbers.substring(1, 4);
            if (numbers.length > 4) formatted += ') ' + numbers.substring(4, 7);
            if (numbers.length > 7) formatted += '-' + numbers.substring(7, 9);
            if (numbers.length > 9) formatted += '-' + numbers.substring(9);

            return formatted;
        }
        document.getElementById('phone').addEventListener('input', function(e) {
            e.target.value = formatPhoneNumber(e.target.value);
        });

        function validateForm(arr) {
            const name = arr.name.trim();
            const phone = arr.phone.trim();
            const email = arr.email.toLowerCase().trim();
            const honeypot = arr.honeypot;

            // console.log(honeypot);
            const errors = {
                name: !/^[а-яА-ЯёЁ\s]+$/.test(name),
                phone: !/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/.test(phone),
                email: !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email),
                honeypot: honeypot ? true : false,
            };

            // console.log(errors.honeypot);

            let errorMessage = '';
            if (errors.name) errorMessage += "Введите корректное русское имя.\n";
            if (errors.phone) errorMessage += "Введите номер телефона в формате +7 (XXX) XXX-XX-XX.\n";
            if (errors.email) errorMessage += "Введите корректный адрес электронной почты.\n";
            if (errors.honeypot) errorMessage += "Спам, Ваши действия напоминают робота - Обновите страницу и попробуйте снова!";

            return errorMessage;
        }

        let block = $('.form-black');
        $('.form-black').on('submit', function(e) {
            e.preventDefault();

            let dates = new Date();
            let current_date = dates.toLocaleDateString().replace(/[\.\/]/g,'-'); // Текущая дата и время
            let current_hour = parseInt(dates.getHours());
            let current_minutes = parseInt(dates.getMinutes());

            let token = $("input[name='token']").attr("value");

            let link = block.attr('action');

            let name = block.find("input[name='name']").val();
            let phone = block.find("input[name='phone']").val();
            let email = block.find("input[name='email']").val();
            let theme = block.find("input[name='theme']").val();
            let message = block.find("input[name='message']").val();
            let qnt = block.find("select[name='qnt'] option:selected").val();
            let date = block.find("select[name='date'] option:selected").val();
            let time =  block.find("select[name='time'] option:selected").val();

            let honeypot = document.getElementById('honeypot').value;

            var formMessage = document.getElementById('form-message');

            const errorMessage = validateForm({name: name, phone: phone, email: email, honeypot: honeypot});

            if (errorMessage) {
                formMessage.innerHTML = errorMessage;
                return;
            }

            formMessage.innerHTML = null;

            let minutes = 0;

            if(time) {
                minutes = parseInt(time.toString().slice(-2));
            }

            if (date === '0') {
                $('#simpleselect_form-black-date .placeholder').css('border-bottom', '1px solid red');
                return false;
            }
            if (time === '0') {
                $('#simpleselect_form-black-date .placeholder').css('border-bottom', '1px solid #fff');
                $('#simpleselect_form-black-time .placeholder').css('border-bottom', '1px solid red');
                return false;
            }

            if (current_date === date && current_hour >= parseInt(time)) {
                if (current_hour === parseInt(time) && minutes === 30) {
                    if (30 - current_minutes > 5) {
                        $('#simpleselect_form-black-time .placeholder').css('border-bottom', '1px solid #fff');
                    } else {
                        $('#simpleselect_form-black-time .placeholder').css('border-bottom', '1px solid red');
                        return false;
                    }
                } else {
                    $('#simpleselect_form-black-time .placeholder').css('border-bottom', '1px solid red');
                    return false;
                }
            } else {
                $('#simpleselect_form-black-time .placeholder').css('border-bottom', '1px solid #fff');
            }

            let text = block.attr('data-id') == '3' ? 'Ваше сообщение отправлено.<br>Спасибо за обратную связь!' : 'Благодарим за бронирование! Мы свяжемся с Вами в ближайшее время';


            // Отправка формы
            fetch(link, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token // CSRF токен Laravel
                },
                body: JSON.stringify({name: name, phone: phone, email: email, theme: theme, message: message, page: page, qnt: qnt, date: date, time: time, honeypot: honeypot})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(data.route);
                        //return data.route;
                        window.location.replace(data.route);

                        $('.forms-popup .forms-group p').html(text);
                        $('.forms-popup').css('display', 'flex');
                        $('.overlay').css('display', 'block');

                        block.find("input[name='phone']").css('border-bottom', '1px solid #fff');
                        block.find("input[name='email']").css('border-bottom', '1px solid #fff');

                        block.find("input[name='name']").val('');
                        block.find("input[name='phone']").val('');
                        block.find("input[name='email']").val('');
                        block.find("input[name='theme']").val('');
                        block.find("input[name='message']").val('');

                        {{--setTimeout(function() {--}}
                        {{--    window.location.replace("{{ route('success') }}");--}}
                        {{--}, 1800);--}}
                    } else {
                        formMessage.innerHTML = 'Ошибка: ' + data.error;
                    }

                    setTimeout(function() {
                        $('.forms-popup').css('display', 'none');
                        $('.overlay').css('display', 'none');
                    }, 2000);

                })
                .catch(error => {
                    formMessage.innerHTML = 'Ошибка отправки формы.';
                });
        });
        let countCart = () => {
            let token = $("input[name='token']").attr("value");
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ route('countCart') }}",
                data: {
                },
                success: function (data) {
                    if (data === '0') {
                        $('.header-cart').addClass('d-none');

                        if ($('.cart-popup').is(':visible')) {
                            $('.cart-popup').animate({ right: '-100vw' }, 500);
                            $('.cart-popup').css('left', '100vw');
                            $('.cart-popup').css('display', 'none');
                            $('.overlay').css('display', 'none');

                            $('.delivery-item__btn').animate({ width: '40px' }, 500);
                            $('.delivery-item__btn').find('.cart-basket').addClass('cart-none');
                            $('.delivery-item__btn').removeClass('cart-active');
                            $('.delivery-item__btn').find('.cart-basket').html('<img src="{{ asset('assets/front/img/delivery-cart.svg') }}" alt="Img">');
                        }
                    } else {
                        $('.h-cart-count').text(data);
                    }

                },
                error: function(result){
                    console.log(result);
                }
            });
        };
        countCart();

        var form = $('.learn-form__sms');
        form.validate();

        {{--form.submit(function(e){--}}
        {{--    e.preventDefault();--}}
        {{--    if (form.valid()) {--}}
        {{--        let token = $("input[name='token']").attr("value");--}}
        {{--        let phone = $('input#phone').val();--}}
        {{--        console.log('Go: ' + phone);--}}

        {{--        $.ajax({--}}
        {{--            type: 'POST',--}}
        {{--            headers: {--}}
        {{--                'X-CSRF-TOKEN': token--}}
        {{--            },--}}
        {{--            url: '/',                   --}}{{-- {{ route('sms') }} --}}
        {{--            data: {--}}
        {{--                phone: phone,--}}
        {{--            },--}}
        {{--            success: function (data) {--}}
        {{--                $('.learn-form .learn-form__sms').css('display', 'none');--}}
        {{--                $('.learn-form .learn-form__code').css('display', 'flex');--}}
        {{--            },--}}
        {{--            error: function(result){--}}
        {{--                console.log(result);--}}
        {{--            }--}}
        {{--        });--}}


        {{--    }--}}
        {{--    return;--}}
        {{--});--}}
        {{--$('.btn-code').click(function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    let code = $('.learn-form__sms #code').val();--}}
        {{--    $.ajax({--}}
        {{--        type: 'POST',--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': token--}}
        {{--        },--}}
        {{--        url: '/',                   --}}{{-- {{ route('code') }}", --}}
        {{--        data: {--}}
        {{--            code: code,--}}
        {{--        },--}}
        {{--        success: function (data) {--}}
        {{--            $.cookie('phone', data, { expires: 30 });--}}

        {{--            $('.learn-form .learn-form__code .btn-code').text('Все верно!');--}}
        {{--            setTimeout(function() {--}}
        {{--                $('.learn-form .learn-form__sms').css('display', 'flex');--}}
        {{--                $('.learn-form .learn-form__code').css('display', 'none');--}}
        {{--                $('.learn-form').css('display', 'none');--}}
        {{--                $('.overlay').css('display', 'none');--}}
        {{--            }, 1000);--}}

        {{--        },--}}
        {{--        error: function(result){--}}
        {{--            $('.learn-form .learn-form__code .btn-code').text('Ошибка! Попробуйте позже!');--}}
        {{--            setTimeout(function() {--}}
        {{--                $('.learn-form .learn-form__sms').css('display', 'flex');--}}
        {{--                $('.learn-form .learn-form__code').css('display', 'none');--}}
        {{--                $('.learn-form').css('display', 'none');--}}
        {{--                $('.overlay').css('display', 'none');--}}
        {{--            }, 1000);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        $('.cart-popup').on('click', '.art-popup__delete a', function (event) {
            event.preventDefault();
            let item = $(this).closest('.art-popup__delete');
            let token = $("input[name='token']").attr("value");
            let id = $(this).attr('href');
            let block = item.closest('.cart-popup__item');
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ route('deleteCart')  }}",
                data: {
                    id: id,
                },
                success: function (data) {
                    block.remove();
                    countCart();
                    updatePrice(block);
                    allPrice();
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
        let allPrice = () => {
            let sum = $('.cart-sum-price');
            let price = 0;

            sum.each(function (index, element) {
                price += parseInt($(element).text());
            });

            $('.cart-popup-price-all').text(price)
        };
        $('.header-right').on('click', '.header-cart', function (event) {
            event.preventDefault();

            let token = $("input[name='token']").attr("value");

            $('.cart-popup').css('left', '0px');
            $('.cart-popup').animate({ right: '0px' }, 500);
            $('.cart-popup').css('display', 'flex');

            $('.overlay').css('display', 'block');

            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ route('cart.update')  }}",
                success: function (data) {
                    $('.cart-popup__wrap-body').html(data);
                    allPrice();
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
        let updatePrice = (block) => {
            let price = block.find('.cart-item-price').text();
            let qnt = block.find('.cart-item-qnt').text();

            let sum = parseInt(price) * parseInt(qnt);

            block.find('.cart-sum-price').text(sum);
        };
        $('.cart-popup').on('click', '.cart-plus', function (e) {
            e.preventDefault();
            let item = $(this);
            let token = $("input[name='token']").attr("value");
            let id = $(this).attr('href');

            let block = item.closest('.cart-popup__item');

            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ route('plusCart')  }}",
                data: {
                    id: id,
                },
                success: function (data) {
                    countCart();
                    item.parent('.art-popup__qnt').find('.cart-qnt').html(data);
                    $("a.cart-basket[href^=" + id + "]").html(data);

                    block.find('.cart-item-qnt').html(data);

                    updatePrice(block);

                    allPrice();
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
        let removerBtnCartPopUp = (block) => {
            let id = block.attr('href');
            let item = $("a.cart-basket[href^=" + id + "]");
            item.closest('.delivery-item__btn').animate({ width: '40px' }, 500);
            item.closest('.delivery-item__btn').find('.cart-basket').addClass('cart-none');
            item.closest('.delivery-item__btn').removeClass('cart-active');
            item.closest('.delivery-item__btn').find('.cart-basket').html('<img src="{{ asset('assets/front/img/delivery-cart.svg') }}" alt="Img">');
        };
        $('.cart-popup').on('click', '.cart-minus', function (e) {
            e.preventDefault();
            let item = $(this);
            let token = $("input[name='token']").attr("value");
            let id = $(this).attr('href');

            let block = item.closest('.cart-popup__item');

            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ route('minusCart')  }}",
                data: {
                    id: id,
                },
                success: function (data) {
                    if(data === '555') {
                        item.closest('.cart-popup__item').remove();
                        removerBtnCartPopUp(item);
                    } else if(data === '666') {
                        $('.cart-popup').hide();
                        $('.overlay').hide();
                        removerBtnCartPopUp(item);
                        $('.header-cart').addClass('d-none');
                    } else {
                        item.parent('.art-popup__qnt').find('.cart-qnt').html(data);
                        item.closest('.cart-popup__item').find('.cart-item-qnt').html(data);
                        $("a.cart-basket[href^=" + id + "]").html(data);
                    }

                    countCart();

                    updatePrice(block);

                    allPrice();
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
    });
</script>
