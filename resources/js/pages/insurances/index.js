import $ from 'jquery';

window.addEventListener('DOMContentLoaded', function () {


	$('#insurance').on('select2:select', function (e) {
		let item = e.params.data;

		const selectedInsurance = insurances.find((insurance) => parseInt(insurance.id) === parseInt(item.id));

		document.getElementById('insuranceName').innerText = selectedInsurance.name;

		resetCategories();

		selectedInsurance.categories.forEach((category) => {
			document.querySelector(`[data-has="${category.id}"]`).classList.remove('hidden');
			document.querySelector(`[data-has-not="${category.id}"]`).classList.add('hidden');
		});
	});
});

function resetCategories() {
	const categoriesHas = document.querySelectorAll('[data-has]');
	const categoriesHasNot = document.querySelectorAll('[data-has-not]');

	categoriesHas.forEach((element) => {
		if (!element.classList.contains('hidden')) {
			element.classList.add('hidden');
		}
	});

	categoriesHasNot.forEach((element) => {
		if (element.classList.contains('hidden')) {
			element.classList.remove('hidden');
		}
	});
}