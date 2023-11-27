import {Swiper} from "swiper";
import {Autoplay, EffectFade, Pagination} from 'swiper/modules';

window.addEventListener('DOMContentLoaded', function () {
	const slides = JSON.parse(document.getElementById('slides').innerText);
	const sliderContent = document.getElementById('slider-content');
	setSliderData(slides[0]);

	new Swiper('.images-swiper', {
		modules: [EffectFade, Autoplay, Pagination],
		fadeEffect: {crossFade: true},
		autoplay: {
			delay: 3000
		},
		slidersPerView: 1,
		effect: 'fade',
		loop: true,
		speed: 1000,
		on: {
			slideChangeTransitionStart: () => {
				sliderContent.classList.add('fade-out');
			},
			slideChangeTransitionEnd: ({realIndex}) => {
				setSliderData(slides[realIndex]);
				sliderContent.classList.remove('fade-out');
			}
		},
		pagination: {
			el: '.images-swiper-pagination',
			type: 'bullets',
			clickable: true
		},
	});
});

function setSliderData(slider) {
	document.getElementById('slider-title').innerText = slider.title;
	document.getElementById('slider-description').innerText = slider.description;
	document.getElementById('slider-url').setAttribute('href', slider.url);
}