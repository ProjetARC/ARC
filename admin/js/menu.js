$(document).ready(function() {

	detectMenuHeight();

	function detectMenuHeight()
	{
		var hauteurBody = jQuery(document).height();
		var hauteurHeight = $('#header_contenu').height() +8;
		var hauteur = hauteurBody - hauteurHeight;

		$('#menu').css('height', hauteur + 'px');
	}

	$(window).resize(function() {
		detectMenuHeight();
	});
});