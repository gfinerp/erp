$(function(){


	$('input[name=desconto]').mask('000.000.000.000.000,00', {reverse:true,placeholder:"0,00"});
	$('input[name=acrescimo]').mask('000.000.000.000.000,00', {reverse:true,placeholder:"0,00"});

	$('input[name=total_price]').mask('000.000.000.000.000,00', {reverse:true,placeholder:"0,00"});

});