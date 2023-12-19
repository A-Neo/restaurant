<script>
    let funcDistance = (to) => {
        let homeCoordinate = [55.692480, 37.561509];

        let arr = to.split(', ');
        let toCoordinate = arr.map(function (x) {
            return parseFloat(x);
        });

        ymaps.ready(function(){
            let distance = parseInt(ymaps.coordSystem.geo.getDistance(homeCoordinate, toCoordinate).toFixed());

            let products = 0;

            $('.price-product').each(function(index, element) {
                products += parseInt($(this).text());
            });

            let distSet = parseInt("{{ $setting->max_distance }}");

            if(distance > distSet) {
                $('.order-btn button').prop("disabled", true);
                $('.order-btn button').text("Доставка недоступна");
                $('.order-btn button').addClass('order-btn-error');
            } else {
                $('.order-btn button').prop("disabled", false);
                $('.order-btn button').text("@lang('order.payment_order')");
                $('.order-btn button').removeClass('order-btn-error');
            }


            let y1 =    "{{ $algoritm->y1 }}";
            let y2 =    "{{ $algoritm->y2 }}";
            let y3 =    "{{ $algoritm->y3 }}";
            let x1 =    "{{ $algoritm->x1 }}";
            let x2 =    "{{ $algoritm->x2 }}";
            let z1 =    "{{ $algoritm->z1 }}";
            let z2 =    "{{ $algoritm->z2 }}";
            let z3 =    "{{ $algoritm->z3 }}";
            let z4 =    "{{ $algoritm->z4 }}";
            let z5 =    "{{ $algoritm->z5 }}";
            let z6 =    "{{ $algoritm->z6 }}";
            let z7 =    "{{ $algoritm->z7 }}";
            let z8 =    "{{ $algoritm->z8 }}";
            let z9 =    "{{ $algoritm->z9 }}";
            let z10 =   "{{ $algoritm->z10 }}";
            let z11 =   "{{ $algoritm->z11 }}";

            if(products > x1 && distance < y1) {
                $('.price-delivery').text(z1);
            } else if(products < x1 && distance < y1) {
                $('.price-delivery').text(z2);
            } else if(products < x1 && distance < y2) {
                $('.price-delivery').text(z3);
            } else if(products > x1 && products < x2 && distance < y2) {
                $('.price-delivery').text(z4);
            } else if(products > x2 && distance < y2) {
                $('.price-delivery').text(z5);
            } else if(products < x1 && distance < y3) {
                $('.price-delivery').text(z6);
            } else if(products > x1 && products < x2 && distance < y3) {
                $('.price-delivery').text(z7);
            } else if(products > x2 && distance < y3) {
                $('.price-delivery').text(z8);
            } else if(products < x1 && distance > y3) {
                $('.price-delivery').text(z9);
            } else if(products > x1 && products < x2 && distance > y3) {
                $('.price-delivery').text(z10);
            } else if(products > x2 && distance > y3) {
                $('.price-delivery').text(z11);
            }

            if(distance > 20000) {
                $('.price-delivery').text(0);
            }

            allOrderPrice();
        });
    };
</script>
