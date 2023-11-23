
window.addEventListener('DOMContentLoaded', function () {
	document.body.addEventListener('change', function (e) {
		const target = e.target;
		if (target.name === 'category') {
			if (target.value === 'all') {
				window.location.href = route('doctors.index');
			} else {
				window.location.href = route('doctors.category', {speciality: target.getAttribute('data-id'), seoLink: target.value});
			}
		}
	});
});