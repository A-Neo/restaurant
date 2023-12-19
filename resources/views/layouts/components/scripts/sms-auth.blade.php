<script>
    {{--document.addEventListener('DOMContentLoaded', function() {--}}
    {{--    let path = window.location.pathname;--}}
    {{--    let page = path.replace('/', '');--}}
    {{--    function formatPhoneNumber(value) {--}}
    {{--        var numbers = value.replace(/\D/g, '');--}}
    {{--        if (!numbers.startsWith('7')) numbers = '7' + numbers;--}}
    {{--        numbers = numbers.substring(0, 11);--}}

    {{--        var formatted = '+7';--}}

    {{--        if (numbers.length > 1) formatted += ' (' + numbers.substring(1, 4);--}}
    {{--        if (numbers.length > 4) formatted += ') ' + numbers.substring(4, 7);--}}
    {{--        if (numbers.length > 7) formatted += '-' + numbers.substring(7, 9);--}}
    {{--        if (numbers.length > 9) formatted += '-' + numbers.substring(9);--}}

    {{--        return formatted;--}}
    {{--    }--}}
    {{--    document.getElementById('phone').addEventListener('input', function(e) {--}}
    {{--        e.target.value = formatPhoneNumber(e.target.value);--}}
    {{--    });--}}
    {{--    var form = $('.learn-form__sms');--}}
    {{--    form.validate();--}}
    {{--    form.submit(function(e){--}}
    {{--        e.preventDefault();--}}
    {{--        if (form.valid()) {--}}
    {{--            let token = $("input[name='token']").attr("value");--}}
    {{--            let phone = $('.learn-form__sms #phone').val();--}}

    {{--            $.ajax({--}}
    {{--                type: 'POST',--}}
    {{--                headers: {--}}
    {{--                    'X-CSRF-TOKEN': token--}}
    {{--                },--}}
    {{--                url: "{{ route('sms') }}",--}}
    {{--                data: {--}}
    {{--                    phone: phone,--}}
    {{--                },--}}
    {{--                success: function (data) {--}}
    {{--                    $('.learn-form .learn-form__sms').css('display', 'none');--}}
    {{--                    $('.learn-form .learn-form__code').css('display', 'flex');--}}
    {{--                },--}}
    {{--                error: function(result){--}}
    {{--                    console.log(result);--}}
    {{--                }--}}
    {{--            });--}}


    {{--        }--}}
    {{--        return;--}}
    {{--    });--}}
    {{--    $('.btn-code').click(function (e) {--}}
    {{--        e.preventDefault();--}}
    {{--        let code = $('.learn-form__sms #code').val();--}}
    {{--        $.ajax({--}}
    {{--            type: 'POST',--}}
    {{--            headers: {--}}
    {{--                'X-CSRF-TOKEN': token--}}
    {{--            },--}}
    {{--            url: "{{ route('code') }}",--}}
    {{--            data: {--}}
    {{--                code: code,--}}
    {{--            },--}}
    {{--            success: function (data) {--}}
    {{--                $.cookie('phone', data, { expires: 30 });--}}

    {{--                $('.learn-form .learn-form__code .btn-code').text('Все верно!');--}}
    {{--                setTimeout(function() {--}}
    {{--                    $('.learn-form .learn-form__sms').css('display', 'flex');--}}
    {{--                    $('.learn-form .learn-form__code').css('display', 'none');--}}
    {{--                    $('.learn-form').css('display', 'none');--}}
    {{--                    $('.overlay').css('display', 'none');--}}
    {{--                }, 1000);--}}

    {{--            },--}}
    {{--            error: function(result){--}}
    {{--                $('.learn-form .learn-form__code .btn-code').text('Ошибка! Попробуйте позже!');--}}
    {{--                setTimeout(function() {--}}
    {{--                    $('.learn-form .learn-form__sms').css('display', 'flex');--}}
    {{--                    $('.learn-form .learn-form__code').css('display', 'none');--}}
    {{--                    $('.learn-form').css('display', 'none');--}}
    {{--                    $('.overlay').css('display', 'none');--}}
    {{--                }, 1000);--}}
    {{--            }--}}
    {{--        });--}}
    {{--    });--}}
    {{--});--}}
</script>
