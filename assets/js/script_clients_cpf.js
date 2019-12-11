
$(function(){


	$('input[name=cpf]').mask('000.000.000-00', {reverse:false,placeholder:"000.000.000-00"});
	$('input[name=cnpj]').mask('00.000.000/0000-00', {reverse:false,placeholder:"00.000.000/0000-00"});
	$('input[name=phone]').mask('(00) 00000-0000', {reverse:false,placeholder:"(00) 00000-0000"});
	$('input[name=value]').mask('000.000.000.000.000,00', {reverse:true,placeholder:"0,00"});
	$('input[name=adress_zipcode]').mask('00000-000', {reverse:false,placeholder:"00000-000"});

});
