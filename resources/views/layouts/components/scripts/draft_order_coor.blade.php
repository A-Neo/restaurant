<script>
    function initializeTabs() {
        var orderTab = $("#order-tabs .tabs-items > div");
        orderTab.hide().filter(":first").show();

        $("#order-tabs .tabs-nav a").click(function() {
            orderTab.hide();
            var activeTab = $(this).attr('href');
            $(activeTab).show();

            $("#order-tabs .tabs-nav a").removeClass("active");
            $(this).addClass("active");
            return false;
        }).filter(":first").click();
    }
    initializeTabs();
    let orderChange = (textOne, textTwo) => {
        $('.order-change h4').text(textOne);
        $('.order-change .price-delivery').text(textTwo);
        allOrderPrice();
    };
    let orderBlocks = $('.order-change').clone();
    let discount = parseInt("{{ $discount->discount }}");
    function updatePriceAndDelivery(isDelivery) {
        var selectedOption = $("#order-street-one option:selected").attr("data-coor");
        $(".price-current").text(isDelivery ? "₽" : "%");
        orderChange("@lang('order." + (isDelivery ? "shipping_cost" : "discount") + "')", isDelivery ? "500" : "{{ $discount->discount }}");
        if (isDelivery) {
            $(".order-list").after(orderBlocks);
            funcDistance(selectedOption);
        } else {
            $(".order-change").remove();
            allOrderPrice();
        }
        $(".order-btn button").prop("disabled", false).removeClass("order-btn-error").text("@lang('order.payment_order')");
    }
    $(".click-delivery").click(function() {updatePriceAndDelivery(true);});
    $(".click-pickup").click(function() {updatePriceAndDelivery(false);});
    function calculateTotalPrice() {
        let productTotal = $(".price-product").toArray().reduce((sum, element) => sum + parseInt($(element).text()), 0);
        let deliveryPrice = parseInt($(".price-delivery").text());
        let isActiveTabDelivery = parseInt($(".tabs-nav li a.active").attr("data-id")) === 0;
        let totalPrice = isActiveTabDelivery ? productTotal + deliveryPrice : productTotal;

        $(".price-total").text(totalPrice);
    }
    // Используйте функцию в соответствующих местах вашего кода.
    calculateTotalPrice();
    function createPolygonsFromZones(zones) {
        return zones.map(zone => {
            let coordinates = JSON.parse(zone.coordinates).map(coord => [coord.latitude, coord.longitude]);
            console.log(zone);
            console.log(coordinates);
            //return new ymaps.Polygon([coordinates]);
        });
    }

    let funcDistance = (toCoordinate) => {
        ymaps.ready(function() {
            let polygons = createPolygonsFromZones(deliveryZones);
            let queryResult = ymaps.geoQuery(toCoordinate).searchInside(polygons);

            if (queryResult.getLength() === 0) {
                console.error('Delivery zone not found for coordinates:', toCoordinate);
                return;
            }

            let selectedZone = queryResult.get(0);
            // Теперь selectedZone содержит полигон, в котором находится точка
            // Дополнительная логика для обработки выбранной зоны
        });
    };







    // setTimeout(function() {
    //     funcDistance($('#order-street-one option:selected').attr('data-coor'));
    // }, 1000);

    $('.street-wrap').on('change', 'select', function (e) {
        funcDistance($('#order-street-one option:selected').attr('data-coor'));
    });

    {{--let funcStreet = () => {--}}
    {{--    let token = $("input[name='token']").attr("value");--}}
    {{--    let block = $('.street-wrap');--}}
    {{--    let phone = $.cookie('phone');--}}

    {{--    $.ajax({--}}
    {{--        type: 'POST',--}}
    {{--        headers: {--}}
    {{--            'X-CSRF-TOKEN': token--}}
    {{--        },--}}
    {{--        url: '{{ route('street.update')  }}',--}}
    {{--        data: {--}}
    {{--            phone: phone--}}
    {{--        },--}}
    {{--        success: function (data) {--}}
    {{--            block.html(data);--}}
    {{--            $('#order-street-one').simpleselect();--}}
    {{--            funcDistance($('#order-street-one option:selected').attr('data-coor'));--}}
    {{--        },--}}
    {{--        error: function(result){--}}
    {{--            console.log(result);--}}
    {{--        }--}}
    {{--    });--}}
    {{--};--}}

    {{--funcStreet();--}}

    $('.street-popup').on('click', '.street-btn button', function (e) {
        e.preventDefault();

        let form = $('.street-popup form');

        let city = 'Москва';
        let street = $('.street').val();
        let home = $('.home').val();
        let flat = $('.flat').val();
        let entrance = $('.entrance').val();
        let intercom = $('.intercom').val();
        let floor = $('.floor').val();

        let token = $("input[name='token']").attr("value");

        let phone = $.cookie('phone');

        var geocoder = ymaps.geocode(city + ', ' + street + ', ' + home);

        geocoder.then(
            function (res) {
                let coordinates = res.geoObjects.get(0).geometry.getCoordinates();

                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    url: "{{ route('street') }}",
                    data: {
                        city: city,
                        street: street,
                        home: home,
                        flat: flat,
                        entrance: entrance,
                        intercom: intercom,
                        floor: floor,
                        coordinates: coordinates,
                        phone: phone
                    },
                    success: function (data) {
                        funcStreet();
                        $('.street').val('');
                        $('.home').val('');
                        $('.flat').val('');
                        $('.entrance').val('');
                        $('.intercom').val('');
                        $('.floor').val('');
                        $('.street-popup').css('display', 'none');
                        $('.overlay').css('display', 'none');
                    },
                    error: function(result){
                        console.log(result);
                    }
                });
            }
        );


    });

    let date = new Date();
    let current_date = date.toLocaleDateString().replace(/[\.\/]/g,'-'); // Текущая дата и время
    let current_hour = parseInt(date.getHours());

    $('.street-btn').click(function (e) {
        e.preventDefault();
        $('.street-popup').css('display', 'flex');
        $('.overlay').css('display', 'block');

    });

    $("input[name='phone']").val($.cookie('phone'));

    $('.order-btn').on('click', 'button', function (e) {
        e.preventDefault();

        let token = $("input[name='token']").attr("value");

        let delivery = parseInt($('.tabs-nav li a.active').attr('data-id')); // Доставка или самовывоз

        let block = $(".tabs-item[style='']");

        let date                = block.find("select[name='date'] option:selected").val(); // Дата
        let time                = block.find("select[name='time'] option:selected").val(); // Время
        let street_id           = block.find("select[name='street'] option:selected").val(); // ID - адрес
        let name                = block.find("input[name='name']").val(); // Имя
        let phone               = block.find("input[name='phone']").val(); // Номер телефона
        let email               = block.find("input[name='email']").val(); // Почта
        let text                = block.find("input[name='order-text']").val(); // Пожелание к заказу
        let instrumentation     = block.find("input[name='instrumentation']").prop('checked'); // ID - адрес

        let delivery_price = $('.price-delivery').text();
        let total = $('.price-total').text();

        let payment_type = $("input[type='radio']:checked").val(); // 0 - Оплатить в ресторане : 1 - Оплатить картой онлайн : 2 - SberPay

        if (name.length < 1) {
            $("input[name='name']").css('border-bottom', '1px solid red');
            return false;
        } else {
            $("input[name='name']").css('border-bottom', '1px solid #222222');
        }

        if (email.length < 1) {
            $("input[name='email']").css('border-bottom', '1px solid red');
            return false;
        } else {
            $("input[name='email']").css('border-bottom', '1px solid #222222');
        }

        if(delivery === 0) {
            if (current_date === date && parseInt(time) <= current_hour && parseInt(time) !== 0) {
                $('#simpleselect_order-time-one .placeholder').css('border-bottom', '1px solid red');
                return false;
            } else {
                $('#simpleselect_order-time-one .placeholder').css('border-bottom', '1px solid #222222');
            }
        } else {
            if (current_date === date && parseInt(time) <= current_hour && parseInt(time) !== 0) {
                $('#simpleselect_order-time-two .placeholder').css('border-bottom', '1px solid red');
                return false;
            } else {
                $('#simpleselect_order-time-two .placeholder').css('border-bottom', '1px solid #222222');
            }
        }

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: "{{ route('createOrder') }}",
            data: {
                delivery: delivery,
                date: date,
                time: time,
                street_id: street_id,
                name: name,
                email: email,
                text: text,
                phone: phone,
                instrumentation: instrumentation,
                delivery_price: delivery_price,
                total: total,
                payment_type: payment_type,
            },
            success: function (data) {
                $('.forms-popup .forms-group p').html("Благодарим за заказ!<br>Мы свяжемся с Вами в ближайшее время.");
                $('.forms-popup').css('display', 'flex');
                $('.overlay').css('display', 'block');

                setTimeout(function() {
                    $('.forms-popup').css('display', 'none');
                    $('.overlay').css('display', 'none');
                    window.location.href = '/';
                }, 2000);

            },
            error: function(result){
                console.log(result);
            }
        });

    });

    if (current_hour < 12 || current_hour >= 22) {
        $('option:contains("Как можно скорее")').remove();
    }
</script>
