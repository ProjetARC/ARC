jQuery(document).ready(function($){
	
	detectViewHeight();

	function detectViewHeight()
	{
		var ecranHeight = jQuery(document).height();
		var bodyHeight = $('body').height();
		var footerHeight = $('#footer').height() + $('#pre-footer-orange').height() + 9;
		var headerHeight = $('#header').height() + 8;
		var carrouselHeight = $('.carrousel-conteneur').height()
		var total = 0;
		
		//if (ecranHeight > bodyHeight)
		//{
			if (carrouselHeight != null)
			{
				total = ecranHeight - footerHeight - headerHeight - carrouselHeight - 88;
			}
			else
			{
				total = ecranHeight - footerHeight - headerHeight - 80;
			}
			$('#contenu').css('height', total + 'px');
		//}
	}

	$(window).resize(function() {
		detectViewHeight();
	});
});