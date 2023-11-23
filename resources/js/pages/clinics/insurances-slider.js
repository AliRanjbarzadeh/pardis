import {Swiper} from 'swiper';
import {Pagination} from 'swiper/modules';
import $ from 'jquery';

$(document).ready(function () {
	new Swiper('.insurances-swiper', {
		modules: [Pagination],
		spaceBetween: 15,
		slidesPerView: 8,
		// loop: true,
		pagination: {
			el: '.insurances-swiper-pagination',
			type: 'bullets',
			clickable: true
		},
	})
})
