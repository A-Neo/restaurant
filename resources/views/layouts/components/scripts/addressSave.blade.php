<script>
    $(document).ready(function() {
        let token = $("input[name='token']").attr("value");
        {{--$('#formstreet1').on('submit', function(e) {--}}
        {{--    e.preventDefault();--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ route('address.save') }}',--}}
        {{--        type: 'POST',--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': token--}}
        {{--        },--}}
        {{--        data: {--}}
        {{--            street: $('#suggest').val()--}}
        {{--        },--}}
        {{--        success: function(response) {--}}
        {{--            $('#suggest').val(response.address_line);--}}
        {{--            // let ad_html = "<div class='option'>" + response.address.address_line + "</div>";--}}
        {{--            // $('.simpleselect .options').html()--}}
        {{--            // $('#order-street-one').html()--}}
        {{--            if(response.success) {--}}
        {{--                setTimeout(() => {--}}
        {{--                    $('.street-popup').css('display', 'none');--}}
        {{--                    $('.overlay').css('display', 'none');--}}
        {{--                }, 1800);--}}

        {{--                console.log(response);--}}
        {{--                alert(response.success);--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function(error) {--}}
        {{--            // Обработка ошибок--}}
        {{--            console.error(error);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        // $('#suggest1').on('change', function() {
        //     $('#formstreet').submit(); // Запуск события submit у ближайшей формы
        // });

    });
</script>
