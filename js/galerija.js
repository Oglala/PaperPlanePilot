$(document).ready(function(){

	$('#galerija DIV:first').addClass('aktivno');
	function menjac(){
		var $element=$('#galerija DIV.aktivno');
		var $sledeci=$element.next().length ? $element.next() : $('#galerija DIV:first');
		$sledeci.css({opacity:0.0});
		$element.addClass('poslednje_aktivno');
		$sledeci.addClass('aktivno');
		$sledeci.animate({opacity:1.0},1000,function(){
												$element.removeClass('aktivno poslednje_aktivno');
											});
		
	}
	setInterval(menjac,4000);
});