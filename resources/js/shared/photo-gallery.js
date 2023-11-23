import {Fancybox} from '@fancyapps/ui/dist/fancybox/fancybox.umd';
import {Swiper} from 'swiper';
import {Pagination} from 'swiper/modules';
import $ from 'jquery';

Fancybox.bind('[data-fancybox="gallery"]', {});

$(document).ready(function () {
	new Swiper('.photo-gallery-swiper', {
		modules: [Pagination],
		slidesPerView: 4,
		pagination: {
			el: '.photo-gallery-swiper-pagination',
			type: 'bullets',
			clickable: true
		},
		breakpoints: {
			320: {
				spaceBetween: 15,
				slidesPerView: 2.2,
			},
			480: {
				spaceBetween: 15,
				slidesPerView: 3.2,
			},
			640: {
				spaceBetween: 18,
				slidesPerView: 4.2,
			},
			1024: {
				spaceBetween: 18,
				slidesPerView: 5.2,
			}
		}
	});
})
