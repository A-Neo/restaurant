<script>
document.addEventListener('DOMContentLoaded', function() {
    let token = $("input[name='token']").attr("value");
    let qnt = $('.menu-list li').length;

    function widthBtn() {
        if ($(window).width() < 480) {
            $('.cart-active').animate({ width: '70px' }, 500)
        } else {
            $('.cart-active').animate({ width: '100px' }, 500)
        }
    }
    function clickBtnCart(item) {
        let token = $("input[name='token']").attr("value");
        let id = item.attr('href');

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: "{{ route('addCart')  }}",
            data: {
                id: id,
            },
            success: function (data) {
                if ($(window).width() < 480) {
                    item.closest('.delivery-item__btn').animate({ width: '70px' }, 500)
                } else {
                    item.closest('.delivery-item__btn').animate({ width: '100px' }, 500)
                }
                $('.header-cart').removeClass('d-none');
                countCart();
                item.html(data);
                item.removeClass('.cart-none');
                item.closest('.delivery-item__btn').addClass('cart-active');
                console.log(data);
            },
            error: function(result){
                console.log(result);
            }
        });

    }
    function removerBtnCart(item) {
        let id = item.attr('href');
        item.closest('.delivery-item__btn').animate({ width: '40px' }, 500);
        item.closest('.delivery-item__btn').find('.cart-basket').addClass('cart-none');
        item.closest('.delivery-item__btn').removeClass('cart-active');
        item.closest('.delivery-item__btn').find('.cart-basket').html('<img src="{{ asset('assets/front/img/delivery-cart.svg') }}" alt="Img">');
    }
    function countCart() {
        let token = $("input[name='token']").attr("value");
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: "{{ route('countCart') }}",
            data: {},
            success: function (data) {
                if (data === '0') {
                    $('.header-cart').addClass('d-none');
                    if ($('.cart-popup').is(':visible')) {
                        $('.cart-popup').animate({ right: '-100vw' }, 500);
                        $('.cart-popup').css('left', '100vw');
                        $('.cart-popup').css('display', 'none');
                        $('.overlay').css('display', 'none');

                        $('.delivery-item__btn').animate({ width: '40px' }, 500);
                        $('.delivery-item__btn').find('.cart-basket').addClass('cart-none');
                        $('.delivery-item__btn').removeClass('cart-active');
                        $('.delivery-item__btn').find('.cart-basket').html('<img src="{{ asset('assets/front/img/delivery-cart.svg') }}" alt="Img">');
                    }
                } else {
                    $('.h-cart-count').text(data);
                }

            },
            error: function(result){
                console.log(result);
            }
        });
    }

    widthBtn();

    $(window).resize(function () {
        if ($(window).width() < 480) {
            $('.cart-active').css( 'width', '70px')
        } else {
            $('.cart-active').css('width', '100px')
        }
        console.log(666);
    });

    if (qnt >= 6) {
        $('.food-sort__child').show();
        let li = $('.menu-list li:eq(5)').nextUntil(".food-sort__child").detach();
        $('.menu-children').append(li);
    } else { $('.menu-list li').eq(-2).css('border-right', '1px solid #dbdbdb');}


    const menuListLinks = document.querySelectorAll('.menu-list a');
    let currentPage = 1;
    const lastPage = {{ $products->lastPage() }}; // Получаем последнюю страницу из объекта пагинаций

    window.onscroll = function() {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            currentPage++;
            if (currentPage <= lastPage) {
                loadMoreProducts(currentPage);
            }
        }
    };

    function loadMoreProducts(page) {
        $.ajax({
            url: '/delivery/products?page=' + page,
            type: 'get',
            success: function(response) {
                // Предполагаем, что response содержит HTML новых продуктов
                document.querySelector('#products-container').insertAdjacentHTML('beforeend', response.productsHTML);
            },
            error: function(error) {
                console.error('Подгрузка блюд не удалась:', error);
            }
        });
    }

    menuListLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Предотвратить стандартное поведение перехода по ссылке
            const slug = this.getAttribute('href').substring(1);
            window.history.pushState({}, '', '/delivery#' + slug);
            // Тут добавьте код для прокрутки страницы до нужной категории
        });
    });

    // Обработка загрузки страницы с якорем в URL
    const categorySlug = window.location.hash.substring(1);
    if (categorySlug) {
        // Тут добавьте код для прокрутки страницы до нужной категории
    }

    // ... остальной код ...


    $('.menu-list').on('click', '.category-click', function(event) {
        event.preventDefault();

        var item = $(this);
        var id = item.data('id');
        var slug = item.data('slug');

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: "{{ route('delivery.update') }}",
            data: {
                id: id,
                slug: slug,
            },
            beforeSend: function() {
                item.addClass('item-category-active');
            },
            success: function(response) {
                $('.delivery-wrapper .delivery-wrap').animate({"opacity": "0"}, 300, function() {
                    $('.delivery-wrapper').html(response.view).css("opacity", "0").animate({"opacity": "1"}, 700);
                    item.removeClass('item-category-active');
                });
            },
            error: function(response) {
                console.error(response);
                item.removeClass('item-category-active');
            }
        });
    });

    $('#delivery').on('click', '.cart-basket', function (e) {
        e.preventDefault();
    });
    $('#delivery').on('click', '.cart-none', function (e) {
        e.preventDefault();
        if($.cookie('phone')) {
            clickBtnCart($(this));
        } else {
            $('.learn-form').css('display', 'flex');
            $('.overlay').css('display', 'block');
        }
    });
    $('#delivery').on('click', '.cart-plus', function (e) {
        e.preventDefault();
        let item = $(this);
        let token = $("input[name='token']").attr("value");
        let id = $(this).attr('href');

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: "{{ route('plusCart')  }}",
            data: {
                id: id,
            },
            success: function (data) {
                countCart();
                item.parent('.delivery-item__btn').find('.cart-basket').html(data);
            },
            error: function(result){
                console.log(result);
            }
        });
    });
    $('#delivery').on('click', '.cart-minus', function (e) {
        e.preventDefault();
        let item = $(this);
        let token = $("input[name='token']").attr("value");
        let id = $(this).attr('href');

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: "{{ route('minusCart')  }}",
            data: {
                id: id,
            },
            success: function (data) {
                if(data === '555') {
                    removerBtnCart(item);
                } else if(data === '666') {
                    removerBtnCart(item);
                    $('.header-cart').addClass('d-none');
                } else {
                    item.parent('.delivery-item__btn').find('.cart-basket').html(data);
                }
                countCart();

            },
            error: function(result){
                console.log(result);
            }
        });
    });
    $('.close-form').click(function () {
        $('.learn-form').css('display', 'none');
        $('.overlay').css('display', 'none');
    });
    $('.product-popup').on('click', '.popup_cart-none', function (e) {
        e.preventDefault();

        let item = $(this);

        let token = $("input[name='token']").attr("value");
        let id = item.attr('href');

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: "{{ route('addCart')  }}",
            data: {
                id: id,
            },
            success: function (data) {
                item.removeClass('popup_cart-none');
                $('.header-cart').removeClass('d-none');
                countCart();

                item.html(data + ' в корзине');
                item.closest('.product-popup__btn').removeClass('product-popup-none');

                item.replaceWith("<span class='popup-cart-btn'><div class='popup-product-qnt'>1</div> <div>в корзине</div></span>");

                let btnAll = $("a.cart-basket[href^=" + id + "]");

                if ($(window).width() < 480) {
                    btnAll.closest('.delivery-item__btn').animate({ width: '70px' }, 500)
                } else {
                    btnAll.closest('.delivery-item__btn').animate({ width: '100px' }, 500)
                }

                $('.header-cart').removeClass('d-none');
                countCart();
                btnAll.html(data);
                btnAll.removeClass('.cart-none');
                btnAll.closest('.delivery-item__btn').addClass('cart-active');
            },
            error: function(result){
                console.log(result);
            }
        });
    });
    $('.product-popup').on('click', '.popup-cart__plus', function (e) {
        e.preventDefault();
        let item = $(this);
        let token = $("input[name='token']").attr("value");
        let id = $(this).attr('href');

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: "{{ route('plusCart')  }}",
            data: {
                id: id,
            },
            success: function (data) {
                countCart();
                item.parent('.product-popup__btn').find('.popup-product-qnt').html(data);
                $("a.cart-basket[href^=" + id + "]").html(data);
            },
            error: function(result){
                console.log(result);
            }
        });
    });
    $('.product-popup').on('click', '.popup-cart__minus', function (e) {
        e.preventDefault();
        let item = $(this);
        let token = $("input[name='token']").attr("value");
        let id = $(this).attr('href');

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: "{{ route('minusCart')  }}",
            data: {
                id: id,
            },
            success: function (data) {
                countCart();
                item.parent('.product-popup__btn').find('.popup-product-qnt').html(data);
                let btnAll = $("a.cart-basket[href^=" + id + "]");
                btnAll.html(data);

                if (data === '555' || data === '666') {
                    let blockParent = item.closest('.product-popup__btn');
                    blockParent.addClass('product-popup-none');
                    blockParent.find('.popup-cart-btn').replaceWith("<a href=" + id + " class='popup-cart-btn popup_cart-none'><div class='popup-product-qnt'><img src='{{ asset('assets/front/img/delivery-cart.svg') }}' alt='Img'></div></a>");
                    $('.header-cart').removeClass('d-none');

                    let allBlockCart = btnAll.closest('.delivery-item__btn');
                    allBlockCart.animate({ width: '40px' }, 500);
                    allBlockCart.find('.cart-basket').addClass('cart-none');
                    allBlockCart.removeClass('cart-active');
                    allBlockCart.find('.cart-basket').html('<img src="{{ asset('assets/front/img/delivery-cart.svg') }}" alt="Img">');
                }


            },
            error: function(result){
                console.log(result);
            }
        });
    });
});
</script>




{{--<script>--}}
{{--    $('.delivery-wrapper').on('click', '.delivery-overlay', function (event) {--}}
{{--        event.preventDefault();--}}

{{--        let phone = '+79168889911';--}}
{{--        if(phone) {--}}
{{--            let item = $(this).find('a');--}}
{{--            let id = item.attr('href');--}}
{{--            let block = $('.product-popup');--}}

{{--            $.ajax({--}}
{{--                type: 'POST',--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': token--}}
{{--                },--}}
{{--                url: "{{ route('product.update')  }}",--}}
{{--                data: {--}}
{{--                    id: id,--}}
{{--                },--}}
{{--                success: function (data) {--}}
{{--                    block.empty().html(data);--}}
{{--                    block.css('display', 'flex');--}}
{{--                    $('.overlay').css('display', 'block');--}}

{{--                    $('.product-popup__images').slick({--}}
{{--                        slidesToShow: 1,--}}
{{--                        slidesToScroll: 1,--}}
{{--                        arrows: false,--}}
{{--                        dots: false,--}}
{{--                    });--}}

{{--                    var tab = $('#tabs-popup .tabs-items > div');--}}
{{--                    tab.hide().filter(':first').show();--}}
{{--                },--}}
{{--                error: function(result){--}}
{{--                    console.log(result);--}}
{{--                }--}}
{{--            });--}}
{{--        } else {--}}
{{--            $('.learn-form').css('display', 'flex');--}}
{{--            $('.overlay').css('display', 'block');--}}
{{--        }--}}

{{--    });--}}
{{--</script>--}}
