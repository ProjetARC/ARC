$(document).ready(function() {
	// carrousel
	var $window = $(window);
	var reference = $(".diapo li:first-child");
	var nbElement = $(".diapo li").length - 1;
	var height = reference.height();
	var pause = 0;
	var navVisible = 0;
	var tabLi = new Array();
	var iSelect = 0;
	var cpt = 0;
	var id = 0;
	var carScroll = 0;
	$(".diapo").css("height", (reference.height() * nbElement));


	/******** slide automatique *********/
	lire();


	/******** navigation *********/
	$('.carrousel-selecteur-languette').click(function() {
	    if (navVisible == 0)
	    {
	    	affNavigation('165px');

	    	navVisible = 1;
	    	$('.carrousel-selecteur-languette').text(':');
	    }
	    else
	    {
	    	affNavigation('0');
	    	navVisible = 0;
	    	$('.carrousel-selecteur-languette').text('"');
	    }
	});

	$('.carrousel-conteneur').on('mouseenter', function() {
		if (navVisible == 0)
		{
			$('.carrousel-selecteur-languette').text('"');
		}
	}).on('mouseleave', function(){
		if (navVisible == 0) {
			$('.carrousel-selecteur-languette').text('');
		}
	});

	for (var i = 1; i <= nbElement + 1; i++)
	{
		if(i == 1)
		{
			$('.carrousel-selecteur').append('<div id='+i+'><img src="images/carrousel/img'+i+'.jpg"></div>');
		}
		else
		{
			$('.carrousel-selecteur').append('<div id='+i+' class="carrousel-selecteur-noirEtBlanc"><img src="images/carrousel/img'+i+'.jpg"></div>');
		}
	}



	/******** navigation au click *********/
	$('.carrousel-selecteur div').click(function() 
	{	
		id = $(this).attr("id");
		diapoAct = $('.diapo li').attr("id").substring(5,6);
		cpt = 0;

		while (id != diapoAct)
		{
			if (diapoAct == (nbElement + 1))
			{
				diapoAct = 0;
			}
			cpt++;
			diapoAct++;
		}

		clearInterval(interval);

		$('.diapo').animate({marginTop:- (height * cpt)},1000, function() {
			marginTop = $(this).css('margin-top');

			longueurChaine = marginTop.length;
			marginTop = marginTop.substring(1,longueurChaine);
			marginTop = marginTop.substring(0, longueurChaine - 3);

			while (marginTop > 0)
			{
				marginTop = marginTop - height;
				$(this).css({marginTop:marginTop}).find("li:last").after($(this).find("li:first"));
			}


		});
		
		if (pause == 0)
		{
			lire();
		}
	});



	/******** Bouton play/pause *********/
	affBoutonLecture();

	$('.bouton-lecture').click(function () {
		if (pause == 0) 
		{
			clearInterval(interval);
			$('.bouton-lecture').text('1');
			pause = 1;
		}
		else
		{
			lire();
			$('.bouton-lecture').text('2');
			pause = 0;
		}
	});

	$('.carrousel-conteneur').on('mouseenter', function() {
	    affBoutonLecture();
	}).on('mouseleave', function(){
		if (pause == 0) {
			delBoutonLecture();
		}
	});



	function lire() {
		interval = setInterval(function(){

			$('.diapo').animate({marginTop:- (height)},1000, function() {
				$(this).css({marginTop:0}).find("li:last").after($(this).find("li:first"));
			});

		}, 5500);
	}

	function affBoutonLecture() {
		$('.carrousel-lecture').addClass('bouton-lecture');
		if (pause == 0)
		{
			$('.bouton-lecture').text('2');
		}
		else
		{
			$('.bouton-lecture').text('1');
		}
	}

	function delBoutonLecture() {
		$('.carrousel-lecture').removeClass('bouton-lecture');
	}

	function affNavigation(pixel)
	{
		$('.carrousel-selecteur').animate({left:pixel},1000);
		$('.carrousel-selecteur-languette').animate({left:pixel},1000);
	}
});