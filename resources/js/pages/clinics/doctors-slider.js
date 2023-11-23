import {Swiper} from 'swiper';
import {Pagination} from 'swiper/modules';
import $ from 'jquery';

$(document).ready(function () {
	new Swiper('.doctors-swiper', {
		modules: [Pagination],
		slidesPerView: 4,
		pagination: {
			el: '.doctors-swiper-pagination',
			type: 'bullets',
			clickable: true
		},
		breakpoints: {
			320: {
				spaceBetween: 15,
				slidesPerView: 1,
			},
			480: {
				spaceBetween: 15,
				slidesPerView: 2,
			},
			640: {
				spaceBetween: 18,
				slidesPerView: 3,
			},
			1024: {
				spaceBetween: 18,
				slidesPerView: 4,
			}
		}
	})
})
