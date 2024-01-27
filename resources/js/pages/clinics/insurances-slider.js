import {Swiper} from 'swiper';
import {Pagination} from 'swiper/modules';
import $ from 'jquery';

$(document).ready(function () {
	new Swiper('.insurances-swiper', {
		modules: [Pagination],
		breakpoints: {
			320: {
				spaceBetween: 15,
				slidesPerView: 3.5,
			},
			480: {
				spaceBetween: 15,
				slidesPerView: 4,
			},
			640: {
				spaceBetween: 18,
				slidesPerView: 6,
			},
			1024: {
				spaceBetween: 18,
				slidesPerView: 8,
			}
		},
		// loop: true,
		pagination: {
			el: '.insurances-swiper-pagination',
			type: 'bullets',
			clickable: true
		},
	});
})
