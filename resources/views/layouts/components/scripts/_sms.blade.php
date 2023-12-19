@include('layouts.components.scripts.sms_code')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        let token = $("input[name='token']").attr("value");
        // Проверка номера телефона
        $('#formsms').on('submit', function(e) {
            e.preventDefault();
            var phone = $('#phone').val(); // Получение номера телефона из поля ввода
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ route('send.phone') }}", // URL для отправки запроса
                data: { phone: phone },
                success: function(response) {
                    console.log(response);
                    $('#formsms').removeClass('active');
                    $('#formcode').addClass('active');
                },
                error: function(error) {
                    // Обработка ошибок запроса
                    console.log('Ошибка при отправке номера телефона:', error);
                }
            });
        });
        $('#formcode').find('.field').on('input', function(e) {
            var code = '';

            $('#formcode').find('.field').each(function() {
                code += $(this).val();
            });

            if (code.length === 4) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data: {code: code},
                    url: "{{ route('verify.code') }}", // URL для проверки кода
                    success: function(response) {
                        if (response) {
                            input_success();
                        } else {
                            input_failure();
                        }

                        setTimeout(() => {
                            $('#formsms').addClass('active');
                            $('#formcode').removeClass('active');
                            input_reset();
                            $('.learn-form').css('display', 'none');
                            $('.overlay').css('display', 'none');
                        }, 3000);
                    },
                    error: function(error) {
                        // Обработка ошибок запроса
                        console.log('Ошибка при проверке кода:', error);
                    }
                });
            }
        });
    });
</script>
