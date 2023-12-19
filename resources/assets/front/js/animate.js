jQuery(document).ready(function ($) {

	if ($(window).width() > 1300) {
		setTimeout(function () {
			$('header').stop(true, true).delay(100).animate({ opacity: '1', top: '0px' }, 500);
		}, 300);

		setTimeout(function () {
			$('.main-block').stop(true, true).delay(100).animate({ opacity: '1', left: '0px' }, 800);
		}, 800);



		setTimeout(function () {
			$('.block-img img').stop(true, true).delay(100).animate({ left: '-125px' }, 1500);
		}, 1200);
	}



});