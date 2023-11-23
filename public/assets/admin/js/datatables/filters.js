"use strict";

let mTimeOut, preventInputs = false;

function addFiltersToData(params) {
	for (const filter of getFilters()) {
		params[filter.getAttribute('data-field')] = filter.value;
	}
}

window.addEventListener('DOMContentLoaded', function () {
	//filters
	for (const filter of getFilters()) {
		switch (filter.getAttribute('data-type')) {
			case 'text':
				filter.addEventListener('input', handleTextInput);
				break;

			case 'date':
				filter.addEventListener('change', handleDate);
				break;

			case 'status':
			case 'category':
				$(filter).on('change', handleSelect)
				break;
		}
	}

	//buttons
	for (const button of getButtons()) {
		button.addEventListener('click', handleButtonClick);
	}
});

function getFilters() {
	return document.querySelectorAll('[id^="filterInput"]');
}

function getButtons() {
	return document.querySelectorAll('[id^="filterButton"]');
}

function handleTextInput() {
	if (preventInputs) {
		return;
	}
	if (mTimeOut !== null) {
		clearTimeout(mTimeOut);
	}
	mTimeOut = setTimeout(() => {
		redrawDatatable(true);
	}, 500);
}

function handleDate(event) {
	if (preventInputs) {
		return;
	}
	redrawDatatable(true);
}

function handleSelect() {
	if (preventInputs) {
		return;
	}
	redrawDatatable(true);
}

function handleButtonClick(event) {
	let button = event.target;
	let action = button.getAttribute('data-action');

	preventInputs = isShouldPreventInputs(action);

	let isShouldDrawTable = false;
	switch (action) {
		case "delete-filters":
			isShouldDrawTable = clearInputs();
			break;

		case "update-priority":
			if (typeof updatePriority === 'function') {
				updatePriority(button);
			}
			break;
	}

	if (isShouldDrawTable) {
		redrawDatatable('full');
	}
	preventInputs = false;
}

function clearInputs() {
	let isHasFilledInputs = false;
	for (const filter of getFilters()) {
		if (filter.value) {
			isHasFilledInputs = true;
		}

		switch (filter.tagName.toLowerCase()) {
			case 'select':
				filter.selectedIndex = -1;
				filter.dispatchEvent(new Event('change'));
				break;

			default:
				filter.value = "";
		}
	}

	return isHasFilledInputs;
}

function getDataTable() {
	return Object.values(LaravelDataTables).pop();
}

function isShouldPreventInputs(action) {
	switch (action) {
		case "delete-filters":
			return true;

		default:
			return false;
	}
}