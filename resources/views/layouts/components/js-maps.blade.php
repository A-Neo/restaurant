<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=a900ee7c-6986-43be-8145-2d6a517d1673&suggest_apikey=fbfc38d7-155d-4854-af29-bdedb52200b1" type="text/javascript"></script>
<script type="text/javascript">
    // Функция ymaps.ready() будет вызвана, когда
    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
    ymaps.ready(init);
    function init(){
        // Создание карты.
        var myMap = new ymaps.Map("map", {
            center: [55.692480, 37.561509],
            zoom: 18
        });

        // var suggestView1 = new ymaps.SuggestView('suggest');

        myMap.geoObjects.add(new ymaps.Placemark([55.692480, 37.561509], {
            balloonContent: 'цвет <strong>воды пляжа бонди</strong>'
        }));
    }
</script>
