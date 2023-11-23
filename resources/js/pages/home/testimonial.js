import $ from 'jquery';
import {Swiper} from 'swiper';
import {Pagination} from 'swiper/modules';

$(document).ready(function () {
	const testimonialContent = document.getElementById('testimonial-content');
	new Swiper('.videos-swiper', {
		modules: [Pagination],
		slidersPerView: 1,
		pagination: {
			el: '.videos-swiper-pagination',
			type: 'bullets',
			clickable: true
		},
		on: {
			slideChangeTransitionStart: () => {
				testimonialContent.classList.add('fade-out');
			},
			slideChangeTransitionEnd: ({realIndex}) => {
				setTestimonialData(testimonials[realIndex]);
				testimonialContent.classList.remove('fade-out');
			}
		},
	});
});

function setTestimonialData(testimonial) {
	document.getElementById('testimonial-content').innerText = testimonial.description;
}
