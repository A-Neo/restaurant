<!DOCTYPE html>
<html lang="ru">
<head>
@stack('noindex')
@include('layouts.components.head')
</head>
<body>
@include('layouts.components.header')
@yield('content')
<input type="hidden" name="token" value="{{ csrf_token() }}">
<footer>
    <div class="grid">
        <p>@lang('footer.footer_up')</p>
        <h3>@lang('footer.footer_text')</h3>
    </div>
    <div class="footer-line"></div>
    <div class="grid">
        <div class="footer-signature">©️ {{ date ('Y') }} ДЭДИ. All rights reserve.</div>
    </div>
</footer>
@include('layouts.components.forms')
<div class="overlay"></div>
@include('layouts.components.scripts_footer')
<script src="{{ asset('assets/front/js/main.js') }}"></script>
<script src="{{ asset('assets/front/js/animate.js') }}"></script>
@stack('scripts')
</body>

</html>
