import $ from 'jquery';
import select2 from 'select2';

select2();
window.addEventListener('DOMContentLoaded', function () {
	$('.select2').select2({
		width: 'element',
	});
});