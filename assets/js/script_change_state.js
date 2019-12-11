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