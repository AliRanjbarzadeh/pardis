import $ from 'jquery';

$(document).ready(function () {
	var currentUrl = window.location.pathname;
	// Add active class to the active menu item based on the current URL
	$('.menu-item a').each(function () {
		var menuUrl = $(this).attr('href');
		if (menuUrl === currentUrl) {
			$(this).addClass('active');
		}
	});

	const toggleMenuIcon = () => {
		const menuButton = $('#mobile-menu-button');
		menuButton.find('.menu-ii').toggleClass('hidden');
		menuButton.find('.close-ii').toggleClass('hidden');
	}
	$('#mobile-menu-button').click(function () {
		toggleMenuIcon();
		$('.menu-sidebar').toggleClass('open');
	});

	$('#mobile-side-menu').click(function () {
		toggleMenuIcon();
		$('.menu-sidebar').removeClass('open');
	});
});