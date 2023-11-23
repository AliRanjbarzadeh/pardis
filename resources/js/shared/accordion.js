import $ from 'jquery';

$(document).ready(function () {
	$('.accordion-item .accordion-info').click(function () {
		const $accordionItem = $(this).parent();
		const isOpen = $accordionItem.hasClass('show');
		$accordionItem
			.closest('.custom-container')
			.find('.accordion-item')
			.removeClass('show');
		$accordionItem
			.closest('.custom-container')
			.find('.accordion-info .icon')
			.removeClass('rotate-180');
		$accordionItem
			.closest('.custom-container')
			.find('.accordion-content')
			.addClass('h-0');
		if (!isOpen) {
			$accordionItem.addClass('show')
			$(this).find('.icon').addClass('rotate-180')
			$accordionItem.find('.accordion-content').removeClass('h-0');
		}
	})
	$('.custom-container').each(function () {
		$(this).find('.accordion-item:first .accordion-info').click();
	});
})
