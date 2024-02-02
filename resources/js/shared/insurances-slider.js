import {Swiper} from 'swiper'
import {Autoplay, Pagination} from 'swiper/modules'

window.addEventListener('DOMContentLoaded', function () {
	new Swiper('.insurances-swiper', {
		modules: [Pagination, Autoplay],
		autoplay: {
			delay: 2000
		},
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
