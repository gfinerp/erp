<h1 style="font-family:Lato; color:black; font-size:60">Serviços - <small>Adicionar</small></h1>
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

 
<div class="conteudo" style="width: 1000px">

<div class="table-responsive">

<table border="1" width="100%"  id="service_products">
  <tr>
      <td>

        <div class="campo">
    <label for="client_name"><strong>Cliente</strong></label></br>
  <input type="hidden" name="client_id" />
  <input type="text"  placeholder="Cliente" name="client_name"  id="client_name" data-type="search_clients"/><br/><br/><br/>
</div>
<div class="campo">
<label for="salesman_name"><strong>Funcionário</strong></label></br>
  <input type="hidden" name="salesman_id" id="salesman_id"  />
  <input  placeholder="Vendedor " type="text" name="salesman_name" id="salesman_name" data-type="search_salesman" required /><br/><br/><br/>
</div>
      </br>
      </td>
      <td>
        <div class="campo">
        <label form="veiculo"><strong>Veículo</strong></label><br/>
  <input type="text" name="veiculo" id="veiculo" ><br/><br/>
</div>
<div class="campo">
       <label form="placa"><strong>Placa</strong></label><br/>
  <input type="text" name="placa" id="placa" /><br/><br/>
</div>
<br/>
      </td>
    </tr>
<tr>
   <td>
         <div class="campo">

  <label form="odometro"><strong>Odômetro</strong></label><br/>
  <input type="text" name="odometro" /><br/><br/>
  </div>
         <div class="campo">
  <label form="odometro2"><strong>Próxima Troca</strong></label><br/>
  <input type="text" name="odometro2" /><br/><br/>
  </div>
    </td>
   <td>
    <label for="status"><strong>Status do serviço</strong></label></br>
<select name="status" id="status">
<option value="0">Aguard. pag.</option>
<option value="1" selected="selected">Pago</option>
<option value="2">Orçamento</option>
<option value="3">Cancelado</option>
</select></br></br>

   </td>
  </tr>
   <tr>
   <td>
 <div class="control-group span3">
               <label form="servico"><strong>Serviço executado</strong></label></br>
  <textarea name="servico" id="internal_obs" style="height: 150px"></textarea><br/><br/>
   </td>
   <td>
     <div class="control-group span3">
                <label form="obs"><strong>Observações</strong></label></br>
  <textarea name="obs" id="internal_obs" style="height: 150px"></textarea><br/><br/>
   </td>
  </tr>
 

 </table>


</div>
</div>

</div>


</br></br></br>
  <div style="text-align:center; margin-top: 400px">
    
  <div>
    <button class="button" style="background-color:#EE3B3B;"><a href="<?php echo BASE_URL;?>/services">Cancelar</button>
    <input id="add" onclick="this.value='Aguarde...'" class="button" style="margin-left:70px; background-color:#1E90FF;" type="submit" name="Submit" value="Adicionar"/></div>
</div>

</div>
</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_services_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_desc_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>