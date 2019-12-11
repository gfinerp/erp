$("#myform").submit(function() {
    //desabilita o botão
    $("#add").prop("disabled", true);
});


//calculo venda
        $(document).ready(function(){
            //Quando o valor do campo mudar...
            $('.calc').keyup(function(){
                var sub_total = parseFloat($('#sub_total').val().replace(".", "").replace(",", ".")) || 0.00;
                var acrescimo = parseFloat($('#acrescimo').val().replace(".", "").replace(",", ".")) || 0.00;
                var desconto = parseFloat($('#desconto').val().replace(".", "").replace(",", ".")) || 0.00;
                var recebido = parseFloat($('#recebido').val().replace(".", "").replace(",", ".")) || 0.00;

                //O total 
                var total = sub_total + acrescimo - desconto;
                var saldo = total - recebido;

                $('#total_price').val(number_format(total,2, ',', '.'));
                $('#troco').val(number_format(saldo,2, ',', '.'));

            });
        });
//formt number
    function number_format( number, decimals, dec_point, thousands_sep ) {
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");}
     
     //desabilitar-campo-se-outro-estiver-preenchido   
var cpf = document.getElementById("cpf");
var cnpj = document.getElementById("cnpj");

cpf.addEventListener('keyup', function() {
  cnpj.disabled = cpf.value.trim().length > 0;
});

//agora uma função para keyup muito semelhante para o cnpj
cnpj.addEventListener('keyup', function() {
  cpf.disabled = cnpj.value.trim().length > 0;
});



function selectClient(obj){
var id = $(obj).attr('data-id');
var name = $(obj).html();

$('.searchresults').hide();
$('#client_name').val(name);
$('input[name=client_id').val(id);

}
function selectTrans(obj){
var id = $(obj).attr('data-id');
var xNome = $(obj).html();

$('.searchresults').hide();
$('#trans_name').val(xNome);
$('input[name=trans_id').val(id);

}

function selectSalesman(obj){
var id = $(obj).attr('data-id');
var code = $(obj).html();
var name = $(obj).html();

$('.searchresults').hide();
$('#salesman_id').val(code);
$('#salesman_name').val(name);
$('input[name=salesman_id').val(id);
}


function updateSubtotal(obj){

var quant = $(obj).val();
if(quant <= 0){
$(obj).val(1);
quant =1;
}
var price = $(obj).attr('data-price');
var subtotal = price * quant;

$(obj).closest('tr').find(".subtotal").html('R$: '+subtotal);
updateTotal();

}

function excluirProd(obj){
$(obj).closest('tr').remove();
updateTotal();

}



function updateTotal(obj){

var total = 0;
for( var q=0;q<$('.p_quant').length;q++){
var quant = $('.p_quant').eq(q);

var price = quant.attr('data-price');
var subtotal = price * parseInt(quant.val());

total += subtotal;

}

$('input[name=total_price],[name=sub_total]').val(number_format(total,2, ',', '.'));

}

function add_prod(obj) {
$('#add_prod').val('');
var id = $(obj).attr('data-id');
var code = $(obj).attr('data-code');
var name = $(obj).attr('data-name');
var price = $(obj).attr('data-price');
$('.searchresult').hide();
if( $('input[name="quant['+id+']"]').length ==0 ){

var tr =
'<tr>'+
'<td>'+code+'</td>'+
'<td>'+name+'</td>'+
'<td>'+
//'<a href="javascript:;"><img src="'+BASE_URL+'/assets/images/less.png'+'" border="0" width="20" /></a>'+
'<input type="number" name="quant['+id+']" class="p_quant" value="1" onchange="updateSubtotal(this)" data-price="'+price+'"/>'+
//'<a href="javascript:;"><img src="'+BASE_URL+'/assets/images/more.png'+'" border="0" width="20" /></a>'+
'</td>'+
'<td>R$: '+price+'</td>'+
'<td class="subtotal">R$: '+price+'</td>'+
'<td><a href="javascript:;" onclick="excluirProd(this)">Excluir</a></td>'+
'</tr>'; 

$('.searchresults').hide();
$('#products_table').append(tr);
$('#products_table').css("height", "400px");
$('#products_table').css("display", "inline-block");
$('#products_table').css("width", "100%");
$('#products_table').css("overflow", "auto");


}
updateTotal();
}


function troca_prod(obj) {
$('#troca_prod').val('');
var id = $(obj).attr('data-id');
var code = $(obj).attr('data-code');
var name = $(obj).attr('data-name');
var price = $(obj).attr('data-price');
$('.searchresult').hide();
if( $('input[name="quant['+id+']"]').length ==0 ){

var tr =
'<tr>'+
'<td>'+code+'</td>'+
'<td>'+name+'</td>'+
'<td>'+
//'<a href="javascript:;"><img src="'+BASE_URL+'/assets/images/less.png'+'" border="0" width="20" /></a>'+
'<input type="number" name="quant['+id+']" class="p_quant" value="1" onchange="updateSubtotal(this)" data-price="'+price+'"/>'+
//'<a href="javascript:;"><img src="'+BASE_URL+'/assets/images/more.png'+'" border="0" width="20" /></a>'+
'</td>'+
'<td>R$: '+price+'</td>'+
'<td class="subtotal">R$: '+price+'</td>'+
'<td><a href="javascript:;" onclick="excluirProd(this)">Excluir</a></td>'+
'</tr>'; 

$('.searchresults').hide();
$('#products_table_troca').append(tr);

}
updateTotal();
}

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


$(function(){

$('input[name=total_price]').mask('000.000.000.000.000,00', {reverse:true,placeholder:"0,00"});
$('input[name=recebido]').mask('000.000.000.000.000,00', {reverse:true,placeholder:"0,00"});
$('input[name=troco]').mask('000.000.000.000.000,00', {reverse:true,placeholder:"0,00"});


$('.client_add_button').on('click', function(e){
e.preventDefault();

var name = $('#client_name').val();

if(name != '' && name.length >= 4){

if(confirm('Você deseja adicionar este cliente ?')){
$.ajax({
url:BASE_URL+'/ajax/add_client',
type:'POST',
data:{name:name},
dataType:'json',
success:function(json){
$('.searchresults').hide();
$('input[name=client_id').val(json.id);
}
}); 

return false;
}

}
});




$("#client_name").on('keyup', function(){
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
$('#client_name').after('<div class="searchresults"></div>');

}

$('.searchresults').css('left', $('#client_name').offset().left+'px');
  $('.searchresults').css('top', $('#client_name').offset().top+$('#client_name').height()+20+'px');
var html = '';

for(var i in json){
html +='<div class="si"><a href="javascript:;" onclick="selectClient(this)" data-id="'+json[i].id+'">'+json[i].name+'</a></div>';
}

$('.searchresults').html(html);
  $('.searchresults').show();

}

});
}

});


$('.client_add_button').on('click', function(e){
e.preventDefault();

var name = $('#client_name').val();

if(name != '' && name.length >= 4){

if(confirm('Você deseja adicionar este cliente ?')){
$.ajax({
url:BASE_URL+'/ajax/add_client',
type:'POST',
data:{name:name},
dataType:'json',
success:function(json){
$('.searchresults').hide();
$('input[name=trans_id').val(json.id);
}
}); 

return false;
}

}
});




$("#trans_name").on('keyup', function(){
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
$('#trans_name').after('<div class="searchresults"></div>');

}

$('.searchresults').css('left', $('#trans_name').offset().left+'px');
  $('.searchresults').css('top', $('#trans_name').offset().top+$('#trans_name').height()+20+'px');
var html = '';

for(var i in json){
html +='<div class="si"><a href="javascript:;" onclick="selectTrans(this)" data-id="'+json[i].id+'">'+json[i].xNome+'</a></div>';
}

$('.searchresults').html(html);
  $('.searchresults').show();

}

});
}

});



$("#salesman_name").on('keyup', function(){
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
$('#salesman_name').after('<div class="searchresults"></div>');

}

$('.searchresults').css('left', $('#salesman_name').offset().left+'px');
  $('.searchresults').css('top', $('#salesman_name').offset().top+$('#salesman_name').height()+20+'px');
var html = '';

for(var i in json){
html +='<div class="si"><a href="javascript:;" onclick="selectSalesman(this)" data-id="'+json[i].id+'">'+json[i].name_vendedor+'</a></div>';
}

$('.searchresults').html(html);
  $('.searchresults').show();

}

});
}

});




$("#add_prod").on('keyup', function(){
var datatype = $(this).attr('data-type');
var q = $(this).val();
if(datatype != ''){
$.ajax({
url:BASE_URL+'/ajax/'+datatype,
type:'GET',
data:{q:q},
dataType:'json',
success:function(json){
if( $('.searchresult').length == 0){
$('#add_prod').after('<div class="searchresult"></div>');

}

$('.searchresult').css('left', $('#add_prod').offset().left+'px');
  $('.searchresult').css('top', $('#add_prod').offset().top+$('#add_prod').height()+7+'px');
var html = '';

for(var i in json){
html +='<div class="si"><a href="javascript:;" onclick="add_prod(this)" data-id="'+json[i].id+'" data-price="'+json[i].price+'" " data-code="'+json[i].code+'" " data-name="'+json[i].name+'">'+json[i].code+' - '+json[i].name+' - R$'+json[i].price+'</a></div>';
}

$('.searchresult').html(html);
  $('.searchresult').show();

}

});
}

});




$("#troca_prod").on('keyup', function(){
var datatype = $(this).attr('data-type');
var q = $(this).val();
if(datatype != ''){
$.ajax({
url:BASE_URL+'/ajax/'+datatype,
type:'GET',
data:{q:q},
dataType:'json',
success:function(json){
if( $('.searchresult').length == 0){
$('#troca_prod').after('<div class="searchresult"></div>');

}

$('.searchresult').css('left', $('#troca_prod').offset().left+'px');
  $('.searchresult').css('top', $('#troca_prod').offset().top+$('#troca_prod').height()+7+'px');
var html = '';

for(var i in json){
html +='<div class="si"><a href="javascript:;" onclick="troca_prod(this)" data-id="'+json[i].id+'" data-price="'+json[i].price+'" " data-code="'+json[i].code+'" " data-name="'+json[i].name+'">'+json[i].code+' - '+json[i].name+' - R$'+json[i].price+'</a></div>';
}

$('.searchresult').html(html);
  $('.searchresult').show();

}

});
}

});


});
