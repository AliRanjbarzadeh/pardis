"use strict";

let deleteModal, approveModal, rejectModal;

window.addEventListener('DOMContentLoaded', function () {
	let deleteModalElement = document.getElementById('deleteModal');
	if (deleteModalElement) {
		deleteModal = new bootstrap.Modal(deleteModalElement);
		const btnDelete = document.getElementById('btnDeleteModal');
		btnDelete.addEventListener('click', function () {
			let url = this.getAttribute('data-url');
			axios.delete(url).then((response) => {
				if (typeof rowActionDone === 'function') {
					rowActionDone(true, response.data.message);
				}
				deleteModal.hide();
			}).catch((error) => {
				if (typeof rowActionDone === 'function') {
					if (error.response) {
						rowActionDone(false, error.response.data.message);
					} else {
						rowActionDone(false, lang('admin/global.errors.delete'));
					}
				}
			});
		});
		deleteModalElement.addEventListener('hide.bs.modal', function () {
			btnDelete.removeAttribute('data-url')
		});
	}

	let approveModalElement = document.getElementById('approveModal');
	if (approveModalElement) {
		approveModal = new bootstrap.Modal(approveModalElement);
		const btnApprove = document.getElementById('btnApproveModal');
		btnApprove.addEventListener('click', function () {
			let url = this.getAttribute('data-url');
			axios.patch(url).then((response) => {
				if (typeof rowActionDone === 'function') {
					rowActionDone(true, response.data.message);
				}
				approveModal.hide();
			}).catch((error) => {
				if (typeof rowActionDone === 'function') {
					if (error.response) {
						rowActionDone(false, error.response.data.message);
					} else {
						rowActionDone(false, lang('admin/global.errors.approve'));
					}
				}
			});
		});

		approveModalElement.addEventListener('hide.bs.modal', function () {
			btnApprove.removeAttribute('data-url')
		});
	}

	let rejectModalElement = document.getElementById('rejectModal');
	if (rejectModalElement) {
		rejectModal = new bootstrap.Modal(rejectModalElement);
		const btnReject = document.getElementById('btnRejectModal');
		btnReject.addEventListener('click', function () {
			let url = this.getAttribute('data-url');
			axios.patch(url).then((response) => {
				if (typeof rowActionDone === 'function') {
					rowActionDone(true, response.data.message);
				}
				rejectModal.hide();
			}).catch((error) => {
				if (typeof rowActionDone === 'function') {
					if (error.response) {
						rowActionDone(false, error.response.data.message);
					} else {
						rowActionDone(false, __('admin/global.errors.reject'));
					}
				}
			});
		});
		rejectModalElement.addEventListener('hide.bs.modal', function () {
			btnReject.removeAttribute('data-url')
		});
	}
});

function deleteItem(element) {
	let url = element.getAttribute('data-url');
	if (url === undefined || url === null || url === '') {
		return;
	}
	document.getElementById('btnDeleteModal').setAttribute('data-url', url);
	deleteModal.show();
}

function approveItem(element) {
	let url = element.getAttribute('data-url');
	if (url === undefined || url === null || url === '') {
		return;
	}
	document.getElementById('btnApproveModal').setAttribute('data-url', url);
	approveModal.show();
}

function rejectItem(element) {
	let url = element.getAttribute('data-url');
	if (url === undefined || url === null || url === '') {
		return;
	}
	document.getElementById('btnRejectModal').setAttribute('data-url', url);
	rejectModal.show();
}

function showItem(element) {
	let currentItem = getDataTable().row(element.parentElement.parentElement.parentElement).data();
	document.getElementById('showBody').innerHTML = nl2br(currentItem.decline_reason);

	let showModalElement = document.getElementById('showModal');
	const showModal = new bootstrap.Modal(showModalElement);
	showModal.show();
}


function changeStatusItem(element) {
	let url = element.getAttribute('data-url');
	let status = element.getAttribute('data-status');
	if (url === undefined || url === null || url === '' || status === undefined || status === null || status === '') {
		return;
	}

	axios.patch(url, {status: status}).then((response) => {
		if (typeof rowActionDone === 'function') {
			rowActionDone(true, response.data.message);
		}
	}).catch((error) => {
		if (typeof rowActionDone === 'function') {
			if (error.response) {
				rowActionDone(false, error.response.data.message);
			} else {
				rowActionDone(false, __('admin/global.errors.reject'));
			}
		}
	});
}