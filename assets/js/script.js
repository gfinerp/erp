$(function(){

$('.tabitem').on('click', function(){

	$('.activetab').removeClass('activetab');
	$(this).addClass('activetab');

	var item = $('.activetab').index();
	$('.tabbody').hide();
	$('.tabbody').eq(item).show();

});
	


	$('#busca').on('focus', function(){
		$(this).animate({
			width:'250px'
		},'fast');
	});



	$('#busca').on('blur', function(){

		if($(this).val() == ''){	
		$(this).animate({
			width:'100px'
			},'fast');
		}
			setTimeout(function(){
				$('.searchresults').hide();
			}, 500);
	});


	//BUSCA CLIENTE

		$("#busca").on('keyup', function(){
			var datatype = $(this).attr('data-type');
			var q = $(this).val();
			if(datatype != ''){
				$.ajax({
				url:BASE_URL+'/ajax/'+datatype,
				type:'GET',
				data:{q:q},
				dataType:'json',
				success:function(json){
					 if( $('.searchresults').length == 0){
					 	$('#busca').after('<div class="searchresults"></div>');

					 }

					 $('.searchresults').css('left', $('#busca').offset().left+'px');
					  $('.searchresults').css('top', $('#busca').offset().top+$('#busca').height()+3+'px');
						
						var html = '';

						for(var i in json){
							html +='<div class="si"><a href="'+json[i].link+'">'+json[i].name+'</a></div>';
						}

						$('.searchresults').html(html);
					  	$('.searchresults').show();

				}

				});
			}

		});

// BUSCA CONTAS

	$('#busca3').on('focus', function(){
		$(this).animate({
			width:'250px'
		},'fast');
	});



	$('#busca3').on('blur', function(){

		if($(this).val() == ''){	
		$(this).animate({
			width:'100px'
			},'fast');
		}
			setTimeout(function(){
				$('.searchresults').hide();
			}, 500);
	});

		$("#busca3").on('keyup', function(){
			var datatype = $(this).attr('data-type');
			var q = $(this).val();
			if(datatype != ''){
				$.ajax({
				url:BASE_URL+'/ajax/'+datatype,
				type:'GET',
				data:{q:q},
				dataType:'json',
				success:function(json){
					 if( $('.searchresults').length == 0){
					 	$('#busca3').after('<div class="searchresults"></div>');

					 }

					 $('.searchresults').css('left', $('#busca3').offset().left+'px');
					  $('.searchresults').css('top', $('#busca3').offset().top+$('#busca3').height()+3+'px');
						
						var html = '';

						for(var i in json){
							html +='<div class="si"><a href="'+json[i].link+'">'+json[i].num+' - '+json[i].name+'</a></div>';
						}

						$('.searchresults').html(html);
					  	$('.searchresults').show();

				}

				});
			}

		});


//});

//BUSCA ESTOQUE

	$('#busca2').on('focus', function(){
		$(this).animate({
			width:'250px'
		},'fast');
	});



	$('#busca2').on('blur', function(){

		if($(this).val() == ''){	
		$(this).animate({
			width:'100px'
			},'fast');
		}
			setTimeout(function(){
				$('.searchresults').hide();
			}, 500);
	});

		$("#busca2").on('keyup', function(){
			var datatype = $(this).attr('data-type');
			var q = $(this).val();
			if(datatype != ''){
				$.ajax({
				url:BASE_URL+'/ajax/'+datatype,
				type:'GET',
				data:{q:q},
				dataType:'json',
				success:function(json){
					 if( $('.searchresults').length == 0){
					 	$('#busca2').after('<div class="searchresults"></div>');

					 }

					 $('.searchresults').css('left', $('#busca2').offset().left+'px');
					  $('.searchresults').css('top', $('#busca2').offset().top+$('#busca2').height()+3+'px');
						
						var html = '';

						for(var i in json){
							html +='<div class="si"><a href="'+json[i].link+'">'+json[i].code+' - '+json[i].name+'</a></div>';
						}

						$('.searchresults').html(html);
					  	$('.searchresults').show();

				}

				});
			}

		});



});



			
