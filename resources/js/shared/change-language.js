import $ from 'jquery';

$(document).ready(function () {
	let currentLanguage = $('html').attr('dir') === 'rtl' ? 'fa' : 'en';

	const toggleLanguage = () => {
		currentLanguage = currentLanguage === 'en' ? 'fa' : 'en';
		$('html').attr('lang', currentLanguage);
		$('html').attr('dir', currentLanguage === 'en' ? 'ltr' : 'rtl');
	};

	const initializePage = () => {
		$('.language-toggle').on("click", toggleLanguage);
	};

	initializePage();
});
