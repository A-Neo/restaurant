
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
