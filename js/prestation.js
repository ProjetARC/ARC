$(document).ready(function() {

	var position = 0;
	var span = '<span class="plus">+</span>';

	$('.prestation').append(span);
	$('.prestation').next('div').hide();

	$('.prestation').click(function() {

		classe = $(this).attr("class");
		position = classe.indexOf("click");
		
		if (position < 0)
		{	
			$(this).find("span").text('-');
			$(this).addClass('click');
			$(this).next('div').show();
		}
		else
		{
			$(this).find("span").text('+');
			$(this).removeClass('click');
			$(this).next('div').hide();
		}
	});
});