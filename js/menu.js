$(document).ready(function() {

	var clique = 0;
	$('#conteneur_header').append('<a class="lien" href="#">Menu</a>');
	$('#menu1').hide();
	$('#conteneur_menu').hide();

	$('.lien').click(function(){
		if(clique == 0){

			clique = 1;
			$('#conteneur_menu').fadeIn(300);
			$('#conteneur_menu').css('z-index', '11');
			$('#conteneur-sepia').addClass('sepia');
			$('#conteneur-sepia').addClass('opacity');
			$('#header').addClass('sepia');
		}
		else
		{
			clique = 0;
			$('#conteneur_menu').fadeOut(300);
			$('#conteneur-sepia').removeClass('sepia');
			$('#conteneur-sepia').removeClass('opacity');
			$('#header').removeClass('sepia');
		}

	});
});