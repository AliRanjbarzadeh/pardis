import {Swiper} from 'swiper'
import {Pagination} from 'swiper/modules'

window.addEventListener('DOMContentLoaded', function () {
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
				slidesPerView: 2.2,
			},
			480: {
				spaceBetween: 15,
				slidesPerView: 2.2,
			},
			640: {
				spaceBetween: 18,
				slidesPerView: 3.2,
			},
			1024: {
				spaceBetween: 18,
				slidesPerView: 4.2,
			}
		}
	});
});
