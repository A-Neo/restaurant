<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>Тестирование</title>
    <link rel="icon" href="{{ $setting->getImageLogo() }}" type="image/x-icon">
    <script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/lazysizes.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/front/css/flex-gallery.css') }}">
    <script src="{{ asset('assets/front/js/fancybox.umd.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
</head>
<body>
<section id="gallery" class="gallery" itemscope itemtype="http://schema.org/ImageGallery">
    <div class="gallery-list">
        @foreach ($page->sliders as $index => $image)
            <a href="{{ $image->image_url }}" class="gallery-item g{{ $index + 1 }}" data-src="{{ $image->image_url }}" data-fancybox="gallery" itemprop="contentUrl">
                <img src="{{ $image->thumbnail_url }}" class="lazyload blur" itemprop="thumbnail" alt="Фото №{{ $image->id }}">
            </a>
        @endforeach
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        Fancybox.bind('[data-fancybox="gallery"]', {
            // Делаем изображение на весь экран
            Image: {
                fit: 'cover' // 'contain' для полного отображения без обрезки или 'cover' для заполнения всего доступного пространства
            },
            // Настраиваем элементы управления
            Toolbar: {
                display: {
                    left: [],
                    middle: [],
                    right: ['close'] // Оставляем только кнопку закрытия
                }
            },
            // Включаем бесконечную прокрутку
            Carousel: {
                infinite: true // включаем бесконечную прокрутку
            },
            // По умолчанию, выключаем все остальные элементы управления
            Thumbs: false, // отключаем миниатюры
            Slideshow: false, // отключаем слайд-шоу
            Fullscreen: false, // отключаем кнопку полноэкранного режима
            Zoom: false // отключаем функцию зума
        });
    });
</script>
</body>

</html>
