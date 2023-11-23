import $ from 'jquery';

$(document).ready(function () {
	$(".tabs").each(function () {
		var section = $(this);
		var tabLinks = section.find(".tab-link");
		var tabContents = section.find(".tab-content");

		tabLinks.click(function () {
			var targetTab = $(this).data("tab");
			tabContents.hide();
			tabLinks.removeClass("!bg-primary-950 text-white");
			section.find(".tab-content[data-tab='" + targetTab + "']").show();
			$(this).addClass("!bg-primary-950 text-white");
		});
		tabContents.first().show();
		// tabLinks.first().addClass("!bg-primary-950 text-white");
	});
});