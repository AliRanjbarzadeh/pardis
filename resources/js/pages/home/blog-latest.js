import {Swiper} from 'swiper'
import {Pagination} from 'swiper/modules'

window.addEventListener('DOMContentLoaded', function () {
	new Swiper('.blog-swiper', {
		modules: [Pagination],
		pagination: {
			el: '.blog-swiper-pagination',
			type: 'bullets',
			clickable: true
		},
		breakpoints: {
			320: {
				spaceBetween: 15,
				slidesPerView: 1.5,
			},
			480: {
				spaceBetween: 15,
				slidesPerView: 2.2,
			},
			1024: {
				spaceBetween: 18,
				slidesPerView: 3.5,
			}
		}
	});
});
