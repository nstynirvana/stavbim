$(document).ready(function(){

	$('._del-filter').on('click', function(){

		var _link = $(this).find('._target-filter').data('link');

		$(this).fadeOut('fast', function(){
			if(_link != undefined)
				window.location.href = _link;
		});
	});
	
});

console.log('ghfghfghfg');