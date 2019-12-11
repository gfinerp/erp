<h1 style="font-family:Lato; color:black; font-size:60">Vendas - <small>Adicionar</small></h1>
</br></br>

    <form method="POST" id="myform">


    <!-- ADICIONAR VENDAS -->
<style rel="stylesheet" type="text/css">

tr:nth-child(even) {background: #fcf7fd}
tr:nth-child(odd) {background: #f8f3f9}

input[type=text],
input[type=email],
input[type=password],
input[type=number],
select, 
textarea{
  height: 30px;
  font-size: 16px;
  outline: 0;
  border-radius: 5px;
  padding-left: 5px;
  padding-right: 5px;
  width: 100%;
  margin-top: 5px;

}

table{
  margin-top: 10px;

}

 
table th{
  width: 200px;
  height: 15px;
  background-color: #d2f2c1;
  font-size: 18px;
  line-height: 20px;
  text-align: left;
  padding-left: 5px;
  padding-right: 5px;

}
table td{
  font-size: 18px;
  height: 15px;
  line-height: 20px;
  text-align: left;
  padding-left: 5px;
  padding-right: 5px;

}

</style>

<!-- HTML -->
<div class="tudo">

<div class="menu">

  <legend><h4>Adicionar Produto</h4></legend>
  <div class="divv">

<input style="width:100%; margin-top: -2px;" type="text" id="add_prod" data-type="search_product"  autofocus placeholder="Código de Barras ou Nome do Produto..." /></br>
  <div class="table-responsive">

<table border="1" width="100%"  id="products_table">

  <tr style="background-color: #e3f1dd">
    <th>Código</th>
    <th>Descrição</th>
    <th>QTD</th>
    <th>Preço Unitário</th>
    <th>Sub-Total</th>
    <th>Excluir</th>

  </tr>
</table>
</div>
</div>
</div>

<div class="conteudo">


  <legend><h4>Informações da Venda</h4></legend>
<div class="table-responsive">

<table border="1" width="100%"  id="sale_products">
  <tr>
      <td>

        <div class="campo">
    <label for="client_name"><strong>Cliente</strong></label></br>
  <input type="hidden" name="client_id" />
  <input type="text"  placeholder="Cliente" name="client_name"  id="client_name" data-type="search_clients"/><br/><br/><br/>
</div>
<div class="campo">
<label for="salesman_name"><strong>Vendedor *</strong></label></br>
  <input type="hidden" name="salesman_id" id="salesman_id"  />
  <input  placeholder="Vendedor " type="text" name="salesman_name" id="salesman_name" data-type="search_salesman" required /><br/><br/><br/>
</div>
      </br>
      </td>
      <td>
        <div class="campo">
        <label form="cpf"><strong>CPF</strong></label><br/>
  <input type="text" name="cpf" id="cpf" placeholder="CPF na Nota?"/><br/><br/>
</div>
<div class="campo">
       <label form="cnpj"><strong>CNPJ</strong></label><br/>
  <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ na Nota?"/><br/><br/>
</div>
<br/>
      </td>
    </tr>
<tr>
   <td>
         <div class="campo">

  <label for="forma"><strong>Pagamento</strong></label></br>
  <select name="forma" id="forma"  onchange="optionCheck()">
  <option value="01">Dinheiro</option>
  <option value="02">Cheque</option>
  <option value="03">Cartão de Crédito</option>
  <option value="04">Cartão de Débito</option>
  <option value="05">Crédito Loja</option>
  <option value="10">Vale Alimentação</option>
  <option value="11">Vale Refeição</option>
  <option value="12">Vale Presente</option>
  <option value="13">Vale Combustível</option>
  <option value="15">Boleto Bancário</option>
  <option value="90">Sem pagamento</option>  
  <option value="99">Outros</option>
    </select></br></br>
  </div>
         <div class="campo">
  <label for="band"><strong>Bandeira</strong></label></br>
  <select name="band" id="band"  onchange="optionCheck()">
  <option value="01">Visa</option>
  <option value="02">MasterCard</option>
  <option value="03">American Express</option>
  <option value="04">Sorocred</option>
  <option value="05">Diners Club</option>
  <option value="06">Elo</option>
  <option value="07">Hipercard</option>
  <option value="08">Aura</option>
  <option value="09">Cabal</option>
  <option value="99" selected="selected">Outros</option>
    </select></br></br>
  </div>
    </td>
   <td>
    <label for="status"><strong>Status da Venda</strong></label></br>
<select name="status" id="status">
<option value="0">Aguard. pag.</option>
<option value="1" selected="selected">Pago</option>
<option value="2">Cancelado</option>
</select></br></br>

   </td>
  </tr>
   <tr>
   <td>
 <div class="control-group span3">
                <label class="control span4" for="acrescimo"><strong>Acréscimo</strong></label></br>
                <input class="input-medium focused span6 calc" name="acrescimo" id="acrescimo" style="font-weight: bold;" type="text" value="0,00"/>
            </div></br>
   </td>
   <td>
     <div class="control-group span3">
                <label class="control span4" for="desconto"><strong>Desconto</strong></label>
                <input class="input-medium focused span6 calc" name="desconto" id="desconto" style="font-weight: bold;" type="text" value="0,00"/>
            </div></br>
   </td>
  </tr>
  <tr>
   <td>
<div class="control-group span3">
<label class="control span4" for="sub_total"><strong>Sub. Total</strong></label></br>
<input  style="background-color: #ebeffa;font-size: 20px" class="input-medium focused span6 calc" name="sub_total" id="sub_total" style="font-weight: bold;" readonly="readonly" type="text" />
            </div></br>
   </td>
   <td>
 <div class="control-group span3">
                <label class="control span4" for="total_price"><strong>Total</strong></label></br>
                <input style="background-color: #fe8e7c; font-size: 20px" type="text" id="total_price" style="font-weight: bold;" name="total_price" class="input-medium focused span6 result" readonly="readonly" />
            </div></br>
   </td>
  </tr>
  <tr>
    <td >
 <div class="control-group span3">
                    <div class="control span4" for="recebido"><strong>Recebido *</strong></div>
                    <input style="background-color: #ebeffa;font-size: 20px" class="input-medium focused span6 calc" style="font-weight: bold;" name="recebido" id="recebido"  type="text" required/>
                </div></br>
    </td>
    <td>
  <div class="control-group span3">
                    <div class="control span4" for="troco"><strong>Troco:</strong></div>
                    <input  style="background-color: #ebeffa;font-size: 20px" class="input-medium focused span6 calc" style="font-weight: bold;" name="troco" id="troco"  type="text" />
                </div></br>
    </td>
  </tr>

 </table>


</div>
</div>

</div>


<script type="text/javascript">
function Mudarestado(el) {
  var display = document.getElementById(el).style.display;
  if (display == "none")
    document.getElementById(el).style.display = 'block';
  else
    document.getElementById(el).style.display = 'none';
}

function Mudarestado2(el) {
  var display = document.getElementById(el).style.display;
  if (display == "none")
    document.getElementById(el).style.display = 'block';
  else
    document.getElementById(el).style.display = 'none';
}

</script>
<input type="checkbox" onclick="Mudarestado('minhaDiv')"/><b>Informações da Nota Fiscal</b>
<div id="minhaDiv" style="display: none">
<table border="1" width="100%" >
  <tr>
<td>
  <label form="modelo">Modelo de Nota</label><br/>
  <select name="modelo">
  <option value="55">55 - DANFE NFE Normal </option>
  <option value="65" selected="selected">65 - DANFE NFC-e Consumidor </option>
  </select><br/><br/>
</td>
<td>
  <label form="tpImp">Impressão</label><br/>
  <select name="tpImp">
  <option value="0">0 - Sem geração de DANFE</option>
  <option value="1">1 - DANFE Normal - Retrato</option>
  <option value="2">2 - DANFE Normal - Paisagem</option>
  <option value="3">3 - DANFE Simplificada</option>
  <option value="4"  selected="selected" >4 -  DANFE NFC-e Consumidor</option>
  <option value="5">5 - DANFE NFC-e em mensagem eletrônica</option>
  </select><br/><br/>
</td>
</tr>
<tr>
<td>
  <label form="tpNF">Tipo</label><br/>
  <select name="tpNF">
  <option value="0">0 - Entrada</option>
  <option value="1" selected="selected">1 - Saida</option>
  </select><br/><br/>
</td>

<td>
  <label form="tpAmb">Ambiente</label><br/>
  <select name="tpAmb">
  <option value="1" selected="selected">1 - Producao</option>
  <option value="2">2 - Homologação</option>
  </select></br></br>
</td>
</tr>
<tr>
  <td>
  <label form="indPres">Presença</label><br/>
  <select name="indPres">
  <option value="0">0 - Nao se aplica</option>
  <option value="1" selected="selected">1 - Operação Presencial</option>
  <option value="2">2 - Operação não presencial, pela Internet</option>
  <option value="3">3 - Operação não presencial, Teleatendimento</option>
  <option value="4">4 - NFC-e em operação com entrega a domicílio</option>
  <option value="5">5 - Operação presencial, fora do estabelecimento</option>
  <option value="9">9 - Operação não presencial, outros.</option>
  </select></br></br>
  </td>
  <td>
  <label form="indFinal">indFinalidade</label><br/>
  <select name="indFinal">
  <option value="0">0 - Normal</option>
  <option value="1" selected="selected">1 - Consumidor Final</option>
  </select></br></br>
  </td>
  </tr>
<tr>
<td>
<label for="idDest">Destinatario</label><br/>
  <select name="idDest">
  <option value="1" selected="selected">1 - Estadual</option>
  <option value="2">2 - Interestadual</option>

  </select></br></br>

<td>
  <label form="finNFe">Finalidade</label><br/>
  <select name="finNFe">
  <option value="1" selected="selected">1 - Nfe Normal</option>
  <option value="2">2 - Nfe Complementar</option>
  <option value="3">3 - Nfe Ajuste</option>
  <option value="4">4 - Nfe Devolucao</option>
  </select></br></br>
</td>
</tr>
<tr>
  <td colspan="2">
<label for="infCpl">Informaçoes Adicionais</label><br/>
<textarea  name="infCpl">Tributos Aprox: Federais:13.45% Estaduais:17.00% Municipais:0.00% - Empresa Optante do Simples Nacional!</textarea><br/><br/> 
</td>
</tr>

</table>

<input type="checkbox" onclick="Mudarestado2('minhaDiv2')"/><b>Informações do Frete</b>
<div id="minhaDiv2" style="display: none">

</br></br><b>Dados Da Transportadora</b></br>
<table border="1" width="100%" >
  <tr>
<td>
  <label form="modFrete">Modelo de Frete</label><br/>
  <select name="modFrete">

  <option value="0">0 - Contratação do Frete por conta do Remetente (CIF)</option>
  <option value="1">1 - Contratação do Frete por conta do Destinatário (FOB)</option>
  <option value="2">2 - Contratação do Frete por conta de Terceiros</option>
  <option value="3">3 - Transporte Próprio por conta do Remetente</option>
  <option value="4">4 - Transporte Próprio por conta do Destinatário</option>
  <option value="9" selected="selected">9 - Sem Ocorrência de Transporte</option>
  </select><br/><br/>
</td>
<td>
  <label for="trans_name">Nome da Transportadora</label></br>
  <input type="hidden" name="trans_id" />
  <input type="text"  placeholder="Nome da Transportadora..." name="trans_name"  id="trans_name" data-type="search_trans"/><br/>
</td>
</tr>
<tr>
<td>
  <label form="item">Item</label><br/>
  <input type="text" name="item"  placeholder="Quantidade de Volumes"/><br/><br/>
</td>

<td>
  <label form="qVol">Quant de Volumes</label><br/>
  <input type="text" name="qVol"  placeholder="Quantidade de Volumes"/><br/><br/>
</td>
</tr>
<tr>
  <td>
   <label form="esp">Especie</label><br/>
  <input type="esp" name="esp"  placeholder="Ex: Caixa"/><br/><br/>
  </td>
  <td>
 <label form="marca">Marca</label><br/>
  <input type="text" name="marca"  placeholder="Ex: Mizuno"/><br/><br/>
  </td>
  </tr>
<tr>
<td>
 <label form="nVol">Numeração dos volumes </label><br/>
  <input type="text" name="nVol" /><br/><br/>
<td>
<label form="pesoL">Peso Liquido</label><br/>
  <input type="text" name="pesoL"  placeholder="Peso Liquido"/><br/><br/>
</td>
</tr>
<tr>
  <td>
<label form="pesoB">Peso Bruto</label><br/>
  <input type="text" name="pesoB"  placeholder="Peso Bruto"/><br/><br/>
</td>
 <td>
<label form="placa">Placa do Veiculo</label><br/>
  <input type="text" name="placa"  placeholder="Placa do Veiculo da Transportadora"/><br/><br/>
</td>
</tr>
<tr>
  <td>
<label form="UF">UF da Placa</label><br/>
  <input type="text" name="UF"  placeholder="Sigla UF da Placa Ex: GO"/><br/><br/>
</td>
 <td>
<label form="RNTC">Registro ANTT</label><br/>
  <input type="text" name="RNTC"  placeholder="Registro Nacional de Transportador de Carga (ANTT) "/><br/><br/>
</td>
</tr>
</table>
</div>

</div>
</br></br></br>
  <div style="text-align:center">
    
  <div>
    <button class="button" style="background-color:#EE3B3B;"><a href="<?php echo BASE_URL;?>/sales">Cancelar</button>
    <input id="add" onclick="this.value='Aguarde...'" class="button" style="margin-left:70px; background-color:#1E90FF;" type="submit" name="Submit" value="Adicionar"/></div>
</div>

</div>
</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_sales_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_desc_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>