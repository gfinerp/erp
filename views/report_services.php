<h1>Relatório de Serviços</h1>
<form method="GET" onsubmit="return openPopup(this)">
</br>
<table border="1" width="100%">
	
	<tr>
		 <td width="50%">

        <div class="campo" style="width: 100%">
    <label for="client_name" ><strong> Nome do Cliente</strong></label></br>
  <input type="hidden" name="client_id" />
  <input type="text"  placeholder="Cliente" name="client_name" style="width: 100%" id="client_name" data-type="search_clients"/><br/><br/>
</td>
<td width="50%">
<div class="campo" style="width: 100%">
<label for="salesman_name"><strong>Nome do Funcionário</strong></label></br>
  <input type="hidden" name="salesman_id" id="salesman_id"  />
  <input  placeholder="Vendedor " type="text" name="salesman_name" style="width: 100%" id="salesman_name" data-type="search_salesman"/><br/><br/>
</div>
      </br>
      </td>

</tr>
<tr>
	<td>
			Período:</br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

			<input type="date" name="period1" />
			até
			<input type="date" name="period2" /></br></br>
</td>
<td>
			Status do Serviço:<br/>
			<select name="status">
				<option value="">Todos os Status</option>
				<?php foreach ($statuses as $statuskey => $statusValue):?> 
					
					<option value="<?php echo $statuskey; ?>"><?php echo $statusValue; ?></option>
				<?php endforeach; ?>
			</select></br></br>
</td>

</tr>
</table>
<table border="1" width="100%" style="margin-top: -10px" >
<tr>
	<td>
Ordenação:<br/>
			<select name="order">
				<option value="date_desc">Mais Recente</option>
				<option value="date_asc">Mais Antigo</option>
				<option value="status">Status do Serviço</option>						
			</select></br></br>

			</td>
 </tr>
</table>
<div style="text-align:center">
</br>
<input type="submit" value="Gerar Relatório"/>
</div>
	</form>



<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_services.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_services_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_desc_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>