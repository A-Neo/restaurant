jQuery(document).ready(function ($) {
	$('.main-list').slick({
		dots: true
	});

	$('.menu-child').click(function (event) {
		event.preventDefault();

		let ul = $(this).siblings('ul');
		let arrow = $(this).find('.arrow');

		if (ul.is(':hidden')) {
			ul.css('display', 'block');
			arrow.css('transform', 'rotate(-45deg)');
			arrow.css('margin-top', '5px');
			console.log('1');
		} else {
			ul.css('display', 'none');
			arrow.css('transform', 'rotate(135deg)');
			arrow.css('margin-top', '-5px');
			console.log('2');
		}
	});

	$('.food-sort__child').click(function () {
		let child = $(this).find('.menu-children');
		let arrow = $(this).find('span img');
		arrow.css('transform', 'rotate(180deg)');

		if (child.is(':hidden')) {
			child.css('display', 'block');
			arrow.css('transform', 'rotate(180deg)');
		} else {
			child.css('display', 'none');
			arrow.css('transform', 'rotate(0deg)');
		}
	});

	$(document).mouseup(function (e) {
		let child = $('.menu-child');
		let span = child.find('span');
		let ul = child.siblings('ul');
		let arrow = child.find('.arrow');

		let mChild = $('#menu .food-sort').find('.menu-children');
		let mArrow = $('#menu .food-sort').find('span img');
		let mSpan = $('.food-sort__child');

		let learnForm = $('.learn-form');
		let learFormWrap = $('.learn-form__wrap');

		let popupProduct = $('.product-popup');
		let popupProductWrap = $('.product-popup__wrap');

		let cartProduct = $('.cart-popup');
		let cartProductWrap = $('.cart-popup__wrap');

		let streetPopup = $('.street-popup');
		let streetPopupWrap = $('.street-popup__wrap');

		let overlay = $('.overlay');

		if (streetPopup.is(':visible')) {
			if (!streetPopupWrap.is(e.target) && streetPopupWrap.has(e.target).length === 0) {
				streetPopup.css('display', 'none');
				overlay.css('display', 'none');
			}
		}


		if (ul.is(':visible')) {
			if (!child.is(e.target) && !span.is(e.target) && !ul.is(e.target) && ul.has(e.target).length === 0) {
				ul.css('display', 'none');
				arrow.css('transform', 'rotate(135deg)');
				arrow.css('margin-top', '-5px');
			}
		}

		if (mChild.is(':visible')) {
			if (!mSpan.is(e.target) && !mArrow.is(e.target) && !mChild.is(e.target) && mChild.has(e.target).length === 0) {
				mChild.css('display', 'none');
				mArrow.css('transform', 'rotate(0deg)');
			}
		}

		if (learnForm.is(':visible')) {
			if (!learFormWrap.is(e.target) && learFormWrap.has(e.target).length === 0) {
				learnForm.css('display', 'none');
				overlay.css('display', 'none');
			}
		}

		if (popupProduct.is(':visible')) {
			if (!popupProductWrap.is(e.target) && popupProductWrap.has(e.target).length === 0) {
				popupProduct.css('display', 'none');
				overlay.css('display', 'none');
			}
		}

		if (cartProduct.is(':visible')) {
			if (!cartProductWrap.is(e.target) && cartProductWrap.has(e.target).length === 0) {
				cartProduct.animate({ right: '-100vw' }, 500);
				cartProduct.css('left', '100vw');
				cartProduct.css('display', 'none');
				overlay.css('display', 'none');
			}
		}

	});

	// Меню бургер
	$('.menu-toggle').on('click', function () {
		if ($('.menu-toggle').hasClass('active')) {
			$('header .header-wrap .header-center').stop(true, true).delay(100).animate({ right: '1200px', left: '-300px' }, 500);

			setTimeout(function () {
				$('header .header-wrap .header-center').css('display', 'none');
			}, 500);


			$('html, body').css({
				overflow: 'auto',
				height: 'auto'
			});

		} else {
			$('header .header-wrap .header-center').stop(true, true).delay(100).animate({ right: '0px', left: '0px' }, 500);
			$('header .header-wrap .header-center').css('display', 'block');

			$('html, body').css({
				overflow: 'hidden',
				height: '100%'
			});
		}

		$('.menu-toggle').toggleClass('active');
	});

	$('#form-black-qnt').simpleselect();
	$('#form-black-date').simpleselect();
	$('#form-black-time').simpleselect();

	$('#order-date-one').simpleselect();
	$('#order-time-one').simpleselect();


    // var option = document.getElementsByTagName("option")[0];
    //
    // console.log(option.dataset.rc)
    // console.log(option.dataset.clnc)
	$('#order-date-two').simpleselect();
	$('#order-time-two').simpleselect();
	$('#order-street-two').simpleselect();

	$('.review-list').slick({
		slidesToShow: 2,
		slidesToScroll: 1,
		dots: true,
		arrows: false,
		responsive: [
			{
				breakpoint: 1060,
				settings: {
					slidesToShow: 2,
				}
			},
			{
				breakpoint: 950,
				settings: {
					slidesToShow: 1,
				}
			}
		],
	});

	// Review - Всыплывающий отзыв

	if ($(window).width() > 950) {
		$("#m-review .review-list .review-item").on({
			mouseenter: function (e) {
				$("#m-review .review-list .review-item").css('opacity', '0.75');
				let clone = $(this).clone();
				$("#m-review .review-list").append(clone.addClass('review-hover').css('opacity', '1'));
			},
			mouseleave: function (e) {
				if ($("#m-review .review-list .review-hover:hover").length == 0) {
					$("#m-review .review-list .review-hover").remove();
					$("#m-review .review-list .review-item").css('opacity', '1');
				}
			}
		});



		$('#m-review .review-list').on('mouseover', '.review-hover', function () {
			$(this).on('mouseleave', function () { //notice that I move your mouseleave inside.
				$("#m-review .review-list .review-hover").remove();
				$("#m-review .review-list .review-item").css('opacity', '1');
			});
		});
	}

	$('.lenta-images').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: false,
		dots: false,
		responsive: [
			{
				breakpoint: 1060,
				settings: {
					slidesToShow: 3,
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 2,
				}
			}
		],
	});

	$('.lenta-slider .slide-next').click(function () {
		$('.lenta-images').slick('slickNext');
	});

	$('.lenta-slider .slide-prev').click(function () {
		$('.lenta-images').slick('slickPrev');
	});

	$('.banquet-images').slick({
		slidesToShow: 3,
		slidesToScroll: 2,
		arrows: false,
		dots: false,
		responsive: [
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 2,
				}
			},
		],
	});

	$('.banquet-slide-next').click(function () {
		$('.banquet-images').slick('slickNext');
	});

	$('.banquet-slide-prev').click(function () {
		$('.banquet-images').slick('slickPrev');
	});



	let allMenu = (widthLi, widthDown) => {
		$('#menu .food-sort > .grid > ul > li:nth-last-child(2)').insertAfter('#menu .food-sort ul.menu-children li:first-child');
		$('#menu .food-sort > .grid > ul > li:nth-last-child(2)').insertAfter('#menu .food-sort ul.menu-children li:first-child');

		$('#menu .food-sort > .grid > ul > li').css('width', widthLi);
		$('#menu .food-sort > .grid > ul li.food-sort__child').css('width', widthDown);

		$('#menu .food-sort ul.menu-children > li').css('width', '100%');
	}

	$(window).resize(function () {
		if ($(window).width() < 1060) {
			if ($('#menu .food-sort > .grid > ul > li').length > 5) {
				allMenu('23.5%', '6%');
			}

		}

		if ($(window).width() < 820) {
			if ($('#menu .food-sort > .grid > ul > li').length > 3) {
				allMenu('45%', '10%');
			}

		}
	});

	if ($(window).width() < 1060) {
		allMenu('23.5%', '6%');
	}

	if ($(window).width() < 820) {
		allMenu('45%', '10%');
	}

	let clickBtnCart = (item) => {
		if ($(window).width() < 480) {
			item.animate({ width: '70px' }, 500)
		} else {
			item.animate({ width: '100px' }, 500)
		}

		item.find('.cart-basket').html('1');
		item.addClass('cart-active');
	}

	// $('#delivery .delivery-wrap .delivery-list .delivery-item:not(:first) .delivery-item__btn ').click(function (e) {
	// 	e.preventDefault();
	// 	clickBtnCart($(this));
	// })
    //
	// $('#delivery .delivery-wrap .delivery-list .delivery-item:first-child .delivery-item__btn').click(function (e) {
	// 	e.preventDefault();
	// 	$('.learn-form').css('display', 'flex');
	// 	$('.overlay').css('display', 'block');
	// });

	$('.close-form').click(function () {
		$('.learn-form').css('display', 'none');
		$('.overlay').css('display', 'none');
	});

	$('.street-btn').click(function (e) {
		e.preventDefault();
		$('.street-popup').css('display', 'flex');
		$('.overlay').css('display', 'block');
	})

	$('.close-street').click(function () {
		$('.street-popup').css('display', 'none');
		$('.overlay').css('display', 'none');
	});


	var tab = $('#tabs-popup .tabs-items > div');
	tab.hide().filter(':first').show();

	// Клики по вкладкам.
	$('#tabs-popup .tabs-nav a').click(function () {
		tab.hide();
		tab.filter(this.hash).show();
		$('#tabs-popup .tabs-nav a').removeClass('active');
		$(this).addClass('active');
		return false;
	}).filter(':first').click();

	$('.product-popup__tabs-head').click(function () {
		let popup = $(this).siblings('.tabs-popup');
		let arrow = $(this).find('.down-popup img');
		console.log('1');
		if (popup.is(':visible')) {
			popup.css('display', 'none');
			arrow.css('transform', 'rotate(0deg)');
		} else {
			popup.css('display', 'block');
			arrow.css('transform', 'rotate(180deg)');
		}

	});

	$('.delivery-overlay').click(function () {
		$('.product-popup').css('display', 'flex');
		$('.overlay').css('display', 'block');

		$('.product-popup__images').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
		});

	});

	$('.close-popup').click(function () {
		$('.product-popup').css('display', 'none');
		$('.overlay').css('display', 'none');
	});

	$('.close-cart').click(function () {
		$('.cart-popup').animate({ right: '-100vw' }, 500);
		$('.cart-popup').css('left', '100vw');
		$('.cart-popup').css('display', 'none');
		$('.overlay').css('display', 'none');
	});


	$('.product-popup__arrow-right').click(function () {
		$('.product-popup__images').slick('slickNext');
	});

	$('.product-popup__arrow-left').click(function () {
		$('.product-popup__images').slick('slickPrev');
	});

	$('.header-cart').click(function () {
		$('.cart-popup').css('left', '0px');
		$('.cart-popup').animate({ right: '0px' }, 500);
		$('.cart-popup').css('display', 'flex');

		$('.overlay').css('display', 'block');
	})

	var orderTab = $('#order-tabs .tabs-items > div');
	orderTab.hide().filter(':first').show();

	// Клики по вкладкам.
	$('#order-tabs .tabs-nav a').click(function () {
		orderTab.hide();
		orderTab.filter(this.hash).show();
		$('#order-tabs .tabs-nav a').removeClass('active');
		$(this).addClass('active');
		return false;
	}).filter(':first').click();


	let orderChange = (textOne, textTwo) => {
		$('.order-change h4').text(textOne);
		$('.order-change span').text(textTwo);
	}

	$('.click-delivery').click(function () {
		orderChange('Стоимость доставки:', '500 ₽');
	})

	$('.click-pickup').click(function () {
		orderChange('Скидка:', '460 ₽');
	})
});
