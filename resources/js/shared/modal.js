import $ from 'jquery';

$(document).ready(function () {
	const isBanner = document.getElementById('isBanner');
	if (isBanner) {
		toggleModal(isBanner.innerText === 'true');
	}
})

$('.open-modal').on('click', function () {
	toggleModal();
})
$('.open-banner-modal').on('click', function () {
	toggleModal(true);
})

$('.close-modal').on('click', function () {
	toggleModal(false, false);
})
$('.close-banner-modal').on('click', function () {
	toggleModal(true, false);
});

$('#popup-overlay').on('click', function () {
	var isBanner = $(".modal.open-modal").hasClass("banner-modal");
	toggleModal(isBanner, false);
});

function toggleModal(isBanner = false, open = true) {
	const modal = isBanner ? $('#banner-popup') : $('#popup');
	const overlay = $('#popup-overlay');

	if (open) {
		modal.add(overlay).addClass('open-modal');
	} else {
		modal.add(overlay).removeClass('open-modal');
	}
}