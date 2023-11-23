import $ from 'jquery';
import './sidebar.js';


window.addEventListener('DOMContentLoaded', function () {
	let isShowPopover = false
	const $popoverElement = $('#filters-popover')
	const $togglePopoverElement = $('#toggle-filters-popover')

	function showPopover () {
		$popoverElement
			.removeClass('invisible opacity-0 -translate-y-2')
			.addClass('opacity-100 translate-y-0')
	}

	function hidePopover () {
		$popoverElement
			.removeClass('opacity-100 translate-y-0')
			.addClass('invisible opacity-0 -translate-y-2')
	}

	$('#filters-popover .radio-container').on('click', function () {
		isShowPopover = false
		hidePopover()
	});

	$togglePopoverElement.on('click', function () {
		isShowPopover = !isShowPopover
		isShowPopover ? showPopover() : hidePopover()
	});
});