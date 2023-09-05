window.onload = function () {
	$(document).ready(function () {

		$('body').on('click', "._del-filter", function () {
			let _link = $(this).find('._target-filter').data('link');
			var itemId = $(this).find("a").data("itemid");

			$("input#"+itemId).trigger("click");

			return false;
		});

	});
};
