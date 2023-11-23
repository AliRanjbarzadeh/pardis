import $ from 'jquery';

$(document).ready(function () {
	$('.limit-paragraph').each(function () {
		let section = $(this);
		let text = section.find('.text-overflow');
		let btn = section.find('.btn-overflow');
		let h = text.height();
		let bg = section.find('.absolute');

		let limit = 0;
		if (h > 200) {
			limit = 200;
			bg.addClass('!flex');
			btn.addClass('less');
			text.css('height', '200px');
		} else {
			limit = h;
		}

		btn.click(function (e) {
			e.stopPropagation();
			if (btn.hasClass('less')) {
				btn.removeClass('less');
				btn.addClass('more');
				btn.text('بستن');

				text.animate({height: h});
				bg.removeClass('absolute');
				bg.addClass('bg-transparent');
			} else {
				btn.addClass('less');
				btn.removeClass('more');
				btn.text('بیشتر بخوانید');
				bg.addClass('absolute');
				bg.removeClass('bg-transparent');
				text.animate({height: limit + 'px'});
			}
		});
	});
});
  