jQuery(document).ready(function($){
	
	detectViewHeight();

	function detectViewHeight()
	{
		var ecranHeight = jQuery(document).height();
		var bodyHeight = $('body').height();
		var footerHeight = $('#footer').height() + $('#pre-footer-orange').height();
		var headerHeight = $('#header').height();
		var carrouselHeight = $('.carrousel-conteneur').height()
		var total = 0;
		
		if (ecranHeight > bodyHeight)
		{
			if (carrouselHeight != null)
			{
				total = ecranHeight - footerHeight*2 - headerHeight - 12 - carrouselHeight - 10;
			}
			else
			{
				total = ecranHeight - footerHeight*2 - headerHeight - 12;
			}
			$('#contenu').css('height', total + 'px');
		}
	}

	$(window).resize(function() {
		detectViewHeight();
	});
});