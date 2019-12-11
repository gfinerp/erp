<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">
th {text-align: left; }
</style>

<div align="right"><img  src="./assets/images/logo.png"  width="250px" height="130px" /> </div>

<h1>Relatório de Serviços</h1>
<fieldset>
<?php
if(isset($filters['client_name']) && !empty($filters['client_name'])){
	echo "Filtrado pelo Cliente: ".$filters['client_name']."<br/>";
}

if(isset($filters['salesman_name_vendedor']) && !empty($filters['salesman_name_vendedor'])){
	echo "Filtrado pelo Vendedor: ".$filters['salesman_name_vendedor']."<br/>";
}

if(isset($filters['period1']) && !empty($filters['period2'])){
	echo "No Período: ".date('d/m/Y', 
		strtotime($filters['period1']))." a ".date('d/m/Y',strtotime($filters['period2']))."<br/>";
}

if($filters['status'] != ''){
	echo "Filtrado com status: ".$statuses[$filters['status']];
}


?>

</fieldset>
<table border="1" width="100%">

<tr 	style="background-color: #9C9C9C";>
			<th>Cliente</th>
			<th>Func.</th>
			<th>Data</th>
			<th>Status</th>
			<th>Veiculo</th>
			<th>Placa</th>
			<th>Odometro</th>
			<th>P.Troca</th>
			<th>Serviço</th>
			<th>Obs</th>
			

	</tr>
		

		<?php 
			$valorTotal = 0;
		foreach($services_list as $service_item): ?>
			
	<tr>
		<td width="120"><?php  echo $service_item['name']; ?></td>
		<td width="120"><?php  echo $service_item['name_vendedor']; $service_item ?></td>
		<td width="80"><?php  echo date('d/m/Y', strtotime($service_item['date_service'])); ?></td>
		<td width="80"><?php echo $statuses[$service_item['status']]; ?></td>
		<td width="80"><?php echo $service_item['veiculo']; ?></td>
		<td width="80"><?php echo $service_item['placa']; ?></td>
		<td width="80"><?php echo $service_item['odometro']; ?></td>
		<td width="80"><?php echo $service_item['odometro2']; ?></td>
		<td width="150"><?php echo $service_item['servico']; ?></td>
		<td width="150"><?php echo $service_item['obs']; ?></td>

		
	</tr>


		<?php endforeach; ?>
	</table>
	<div style="clear:both"></div>
	<div style="float: left; color:  #4f4f4f">
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cliente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Funcionário</p></br>
		------------------------------------&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;------------------------------------
	 </div>
	