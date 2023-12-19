<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ $setting->getImageLogo() }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/front/css/flex-gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fancybox.css') }}">
    @stack('style')
    @stack('scripts')
</head>
<body>
@yield('content')
</body>

</html>
