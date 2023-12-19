<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=a900ee7c-6986-43be-8145-2d6a517d1673&suggest_apikey=fbfc38d7-155d-4854-af29-bdedb52200b1" type="text/javascript"></script>
<script>
    var activePolygon = null;
    var currentPolygon = null;
    var dataPolygon = null;
    var token = $("input[name='token']").attr("value");

    $('#order-street-one').simpleselect().bind("change.simpleselect", function(){
        const currentOption = document.querySelector("option[data-id='" + $(this).val() + "']");
        let delivery_id = currentOption.dataset.delivery;

        for (var i = 0; i < deliveryZones.length; i++) {
            if (deliveryZones[i].id == delivery_id ) {
                console.log(polygons[i]);
                setHtmlData(polygons[i]);
            }
        }
    });

    function funcStreet() {
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: '{{ route('street.update') }}',
            success: function (data) {
                $('.street-wrap').html(data);
                $('#order-street-one').simpleselect().bind("change.simpleselect", function(){
                    const currentOption = document.querySelector("option[data-id='" + $(this).val() + "']");
                    let delivery_id = currentOption.dataset.delivery;

                    for (var i = 0; i < deliveryZones.length; i++) {
                        if (deliveryZones[i].id == delivery_id ) {
                            // Возвращает данные полигона, если координаты попадают внутрь него
                            console.log(polygons[i]);
                            setHtmlData(polygons[i]);
                            // return polygons[i];
                        }
                    }
                });
            },
            error: function(result){
                console.log(result);
            }
        });
    }
    function getPriceAll(totalSum = 0) {
        let elements = document.querySelectorAll('.order-item .order-item__price .price-product');
        // Проходим по каждому элементу и добавляем его значение к общей сумме
        elements.forEach(function(element) {
            // Удаляем нечисловые символы и преобразуем в число
            var price = parseFloat(element.innerText.replace(/[^0-9.,]/g, '').replace(',', '.'));
            totalSum += price;
        });

        return totalSum.toFixed(2);
    }
    function initTotal() {
        document.getElementById('amount_price_total').innerHTML = parseInt(getPriceAll());
    }
    function paymentTotal(delivery, payments) {
        document.getElementById('amount_price_total').innerHTML = parseInt(delivery) + parseInt(payments);
    }
    function setHtmlData(data, type = false) {
        let array = type ? data : data.properties._data;
        let products = getPriceAll();
        let price_delivery = products > parseInt(array.free_delivery) ? 0 : parseInt(array.price);
        document.getElementById('amount_price_delivery').innerHTML = parseInt(array.free_delivery);
        document.getElementById('price_delivery').innerHTML = price_delivery;
        document.getElementById('time_full_delivery').innerHTML = array.min_time + ' - ' + array.max_time;
        paymentTotal(price_delivery, payments = products);
    }
    function checkPolygonContains(coordinates) {
        // Предполагается, что polygons - это массив ваших полигонов
        var isInside = polygons.some(function(polygon) {
            return polygon.geometry.contains(coordinates);
        });

        return isInside;
    }
    function checkDeliveryZone(coords) {
        for (var i = 0; i < polygons.length; i++) {
            if (polygons[i].geometry.contains(coords)) {
                // Возвращает данные полигона, если координаты попадают внутрь него
                setHtmlData(polygons[i]);
                return polygons[i];
            }
        }
        return null; // Возвращает null, если координаты вне всех полигонов
    }
    function saveAddress(data) {
        $.ajax({
            url: '{{ route('address.save') }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                address_line: data.address_line,
                delivery_zone_id: data.delivery_zone_id,
                zip_code: data.zip_code,
                street: data.street,
                house: data.house,
                coordinates: data.coordinates,
            },
            success: function(response) {
                $('#suggest').val(response.address_line);
                setHtmlData(activePolygon);
                funcStreet();
                // setSelectData(response.address.address_line, response.address.id);
                setTimeout(() => {
                    $('.street-popup').css('display', 'none');
                    $('.overlay').css('display', 'none');
                }, 1800);

                alert(response.success);
            },
            error: function(error) {
                // Обработка ошибок
                console.error(error);
            }
        });
    }
    // Change select -> map

    var coords = [55.692803, 37.561263];
    let style_bg_opacity = 0.5;
    let style_stroke_opacity = 1;
    let style_bg_color = '#fdc25c40';
    let style_bg_color_active = '#fdc25c99';
    let style_stroke_color = '#5a5a5a';

    var styles = [
        {strokeColor: style_stroke_color, strokeOpacity: style_stroke_opacity, strokeWidth: 2, fillColor: style_bg_color, fillOpacity: style_bg_opacity},
        {strokeColor: style_stroke_color, strokeOpacity: style_stroke_opacity, strokeWidth: 2, fillColor: style_bg_color, fillOpacity: style_bg_opacity},
        {strokeColor: style_stroke_color, strokeOpacity: style_stroke_opacity, strokeWidth: 2, fillColor: style_bg_color, fillOpacity: style_bg_opacity},
        {strokeColor: style_stroke_color, strokeOpacity: style_stroke_opacity, strokeWidth: 2, fillColor: style_bg_color, fillOpacity: style_bg_opacity},
        {strokeColor: style_stroke_color, strokeOpacity: style_stroke_opacity, strokeWidth: 2, fillColor: style_bg_color, fillOpacity: style_bg_opacity},
    ];
    var deliveryZones = @json($deliveries); // Убедитесь, что $deliveries - это правильный JSON
    var currentPlacemark;
    var polygons = [];

    let date = new Date();
    let current_date = date.toLocaleDateString().replace(/[\.\/]/g,'-'); // Текущая дата и время
    let current_hour = parseInt(date.getHours());
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

        let delivery_price = $('#price-delivery').text();
        let total = $('#amount_price_total').text();

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

    initTotal();
    document.getElementById('suggest').addEventListener('input', function(e) {
        const prefix = "Москва, ";
        const input = e.target;
        // Проверяем, начинается ли текущее значение в поле с префикса.
        // Если нет, добавляем префикс к текущему значению поля.
        if (!input.value.startsWith(prefix)) {
            input.value = prefix + input.value.slice(input.value.indexOf('Москва, ') + prefix.length);
        }
    });
    document.getElementById('formstreet').addEventListener('submit', function(event) {
        event.preventDefault();
        var fullAddress = document.getElementById('suggest').value;
        // Отправляем полный адрес в геокодер Яндекс API
        ymaps.geocode(fullAddress, { results: 1 }).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
            var flat = document.getElementById('flat').value;
            var floor = document.getElementById('floor').value;
            var entrance = document.getElementById('entrance').value;
            var intercom = document.getElementById('intercom').value;
            var coords = firstGeoObject.geometry.getCoordinates();
            var dataApi = firstGeoObject.properties.getAll().metaDataProperty.GeocoderMetaData.Address;
            var dataStreet = '';
            var dataHouse = '';
            for (var i = 0; i < dataApi.Components.length; i++) {
                if (dataApi.Components[i].kind == 'street') {
                    // Возвращает данные полигона, если координаты попадают внутрь него
                    dataStreet = dataApi.Components[i].name;
                    dataHouse = dataApi.Components[i + 1].name;
                }
            }
            activePolygon = checkDeliveryZone(coords);
            dataPolygon = activePolygon.properties._data;
            var dataMaps = {
                address_line: dataApi.formatted,
                delivery_zone_id: dataPolygon.id,
                zip_code: dataApi.postal_code,
                street: dataStreet,
                house: dataHouse,
                coordinates: coords,
                flat: flat,
                floor: floor,
                entrance: entrance,
                intercom: intercom,
            }
            saveAddress(dataMaps);
        }, function (err) {
            alert('Ошибка при определении местоположения');
        });
    });

    ymaps.ready(init);
    function init() {
        var map = new ymaps.Map("map", {
            center: [55.692803, 37.561263], // Центр карты
            zoom: 11,
        });
        var suggestView = new ymaps.SuggestView('suggest');

        currentPlacemark = new ymaps.Placemark(coords);
        map.geoObjects.add(currentPlacemark);
        deliveryZones.forEach(function (zone, index) {
            var jsonString = zone.coordinates;
            var jsonData = JSON.parse(jsonString);
            var coordinates = jsonData.map(function(point) {
                return [point.latitude, point.longitude];
            });

            var polygon = new ymaps.Polygon([coordinates], {
                // Данные для подсказки
                id: zone.id, // Наименование зоны
                hintContent: zone.name, // Наименование зоны
                title: zone.title,
                price: zone.price,
                min_time : zone.min_time,
                max_time : zone.max_time,
                free_delivery : zone.free_delivery,
                balloonContent: 'Доставка: ' + zone.title + '<br>' +
                    'Минимальная сумма заказа: ' + zone.free_delivery + ' ₽ ' + '<br>' +
                    'Время доставки: ' + zone.min_time + ' - ' + zone.max_time + ' мин '
            }, styles[index % styles.length]);

            polygon.events.add('click', function () {
                if (currentPolygon) {
                    currentPolygon.options.set('fillColor', style_bg_color); // Сбрасываем стиль активного полигона
                }
                polygon.options.set('fillColor', style_bg_color_active); // Непрозрачный фон для текущего полигона
                currentPolygon = polygon;
            });

            polygons.push(polygon);
            map.geoObjects.add(polygon);
        });
    }
</script>
