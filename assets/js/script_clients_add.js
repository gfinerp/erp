$('input[name=adress_zipcode]').on('blur', function(){
	var cep = $(this).val();

	$.ajax({
			url:'http://api.postmon.com.br/v1/cep/'+cep,
			type:'GET',
			dataType:'json',
			success:function(json){
					if(typeof json.logradouro != 'undefined'){
						$('input[name=adress]').val(json.logradouro);
						$('input[name=adress_neighb]').val(json.bairro);
						$('input[name=adress_city]').val(json.cidade);
						$('input[name=adress_state]').val(json.estado);
						$('input[name=adress_country]').val("Brasil");
						$('input[name=adress_number]').focus();

					}
			}
	});

});


function changeState(obj) {
	var state = $(obj).val();

	$.ajax({
		url:BASE_URL+'/ajax/get_city_list',
		type:'GET',
		data:{state:state},
		dataType:'json',
		success:function(json) {
			var html = '';
			for(var i in json.cities) {
				html += '<option value="'+json.cities[i].CodigoMunicipio+'">'+json.cities[i].Nome+'</option>';
			}
			$('select[name=adress_city]').html(html);
		}
	});

}
