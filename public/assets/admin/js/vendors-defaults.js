"use strict";
window.addEventListener('DOMContentLoaded', function () {
	$('[data-toggle="select2"]').select2({
		theme: 'bootstrap-5'
	});

	jalaliDatepicker.startWatch({
		hasSecond: false
	});
});

function toastSuccess(message) {
	toastr.success(message);
}

function toastError(message) {
	toastr.error(message);
}