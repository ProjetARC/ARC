$(document).ready(function() {

	detectFormHeight();

	function detectFormHeight()
	{
		var hauteurBody = jQuery(document).height();
		var hauteurHeight = $('.form_admin').height();

		var hauteur = (hauteurBody/3) - (hauteurHeight/3);

		$('.form_admin').css('margin-top', hauteur + 'px');
	}

	$(window).resize(function() {
		detectFormHeight();
	});
});