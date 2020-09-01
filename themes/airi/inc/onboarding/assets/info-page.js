
;(function($) {

	$('.airi-tab-nav a').on('click',function (e) {
		e.preventDefault();
		$(this).addClass('active').siblings().removeClass('active');
	});

	$('.airi-tab-nav .begin').on('click',function (e) {		
		$('.airi-tab-wrapper .begin').addClass('show').siblings().removeClass('show');
	});	
	$('.airi-tab-nav .actions, .airi-tab .actions').on('click',function (e) {		
		e.preventDefault();
		$('.airi-tab-wrapper .actions').addClass('show').siblings().removeClass('show');

		$('.airi-tab-nav a.actions').addClass('active').siblings().removeClass('active');

	});	
	$('.airi-tab-nav .support').on('click',function (e) {		
		$('.airi-tab-wrapper .support').addClass('show').siblings().removeClass('show');
	});	
	$('.airi-tab-nav .table').on('click',function (e) {		
		$('.airi-tab-wrapper .table').addClass('show').siblings().removeClass('show');
	});	

})(jQuery);
