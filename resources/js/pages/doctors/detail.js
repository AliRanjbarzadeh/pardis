import $ from 'jquery';

import '../home/blog-latest.js';
import '../home/clinics-slider.js';
import '@sharedJs/insurances-slider.js';
import '@sharedJs/photo-gallery.js';

$(document).ready(function () {
	// Smooth scroll to section on click
	document.querySelectorAll('[href^="#section"]').forEach((element) => {
		element.addEventListener('click', function (event) {
			event.preventDefault();
			var target = $(this).attr('href');
			if (target) {
				var targetOffset = $(target).offset().top - 118;
				$('html, body').animate({
					scrollTop: targetOffset
				}, 500);
			}
		});
	});

	// Activate menu item on scroll
	$(window).on('scroll', function () {
		$('.section').each(function () {
			if ($(window).scrollTop() >= $(this).offset().top - 120) {
				var sectionId = $(this).attr('id');
				$('.menu-item').removeClass('active');
				$(".menu-item[href='#" + sectionId + "']").addClass('active');
			}
		});
	});
});
