import $ from 'jquery';

$(document).ready(function () {
	$('.accordion-item .accordion-info').click(function () {
		const $accordionItem = $(this).parent();
		const isOpen = $accordionItem.hasClass('show');
		const $accordionContent = $accordionItem.find('.accordion-content');

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
			.removeAttr('style');

		if (!isOpen) {
			$accordionItem.addClass('show');
			$(this).find('.icon').addClass('rotate-180');
			$accordionContent.css({height: $accordionContent[0].scrollHeight + 'px'});
		}
	});

	$('.custom-container').each(function () {
		$(this).find('.accordion-item:first .accordion-info').click();
	});
})
