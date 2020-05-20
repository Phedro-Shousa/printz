function htMcsTab() {
	var	$htMcsTabNav = $('.ht-mcs-tab-nav');
	$htMcsTabNav.on('click', 'a', function(e){
		e.preventDefault();
		var $this = $(this),
			$target = $this.attr('href');
		$this.addClass('active').closest('li').siblings().find('a').removeClass('active');
		$('.ht-mcs-tab-pane'+$target).addClass('active').siblings().removeClass('active');
	});
}
jQuery( document ).ready(function( $ ) {

	htMcsTab();
	$( "#gn_currency_list" ).sortable({
		handle: ".btn-handle"
	});
});

