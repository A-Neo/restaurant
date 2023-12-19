<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<title>@yield('title')</title>
<meta name="description" content="@yield('description')">
<meta name="keywords" content="@yield('keywords')">
<link rel="icon" href="{{ $setting->getImageLogo() }}" type="image/x-icon">
<script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.simpleselect.min.js') }}"></script>
<script src="{{ asset('assets/front/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/front/js/slick-min.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.cookie.js') }}"></script>
<script src="{{ asset('assets/front/js/lazysizes.min.js') }}"></script>
<script src="{{ asset('assets/front/js/ls.blur-up.min.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/front/js/jquery.inputmask.min.js') }}"></script>
@stack('headStyle')
<link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/children.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/update.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="{{ asset('assets/front/js/fancybox.umd.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
@stack('style')
@if(config('app.env') === 'production')
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(93100421, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true, ecommerce:"dataLayer" });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/93100421" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
@endif
