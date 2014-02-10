jQuery(document).ready(function($){
	
	$('#header').css('position', 'fixed');
	$('#conteneur').css('padding-top','60px');

	var detectViewPort = function(){
		var taille = $('body').width();
		$('#header-border').css('width', taille);
	};

	 $(window).scroll(
        function() {
            if ($(window).scrollTop() >= 1) {
                // fixed
                $('#header').addClass("floatable");
            } else {
                // relative
                $('#header').removeClass("floatable");
            }
        }
    );
		
	$(window).resize(function() {
		detectViewPort();
	});
	
	detectViewPort();
});