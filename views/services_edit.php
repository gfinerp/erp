<h1> Serviço - Editar </h1>
</br>
<table border="1" width="100%">
<tr>
	<td>
<strong>Nome do Cliente: </strong></br>
<?php echo $services_info_names['client_name']; ?></br>
</td>
<td>
<strong>Nome do Vendedor: </strong></br>
<?php echo $services_info_names['salesman_name_vendedor']; ?></br>
</td>
</tr>
<tr>
<td>
<strong> Data do Serviço: </strong></br>
<?php echo date('d/m/Y', strtotime($services_info_names['date_service'])); ?></br>
	</td>
	<td>
<strong>Veículo</strong></br>
	<?php echo $services_info_names['veiculo']; ?>
</br>
</td>
</tr>
<tr>
	<td>
<strong> Placa: </strong></br>
<?php echo $services_info_names['placa']; ?></br>
	</td>
	<td>
<strong>Odômetro</strong></br>
	<?php echo $services_info_names['odometro']; ?>
</br>
</td>
</tr>
<tr>
	<td>
<strong> Próxima Troca: </strong></br>
<?php echo $services_info_names['odometro2']; ?></br>
	</td>
	<td>
<strong> Status do Serviço = "<?php echo $statuses[$services_info_names['status']]; ?>"</strong></br>
<form method="POST">
	<select name="status">
		<?php foreach ($statuses as $statusKey => $statusValue): ?> 
		<option value="<?php echo $statusKey; ?>"><?php echo $statusValue; ?></option>
		<?php endforeach; ?>
	</select></br>
</td>
</tr>
<tr>
	<td >
<strong>serviço executado </strong></br>
	<?php echo $services_info_names['servico']; ?>
</br>
</td>
	<td>
<strong>Observações</strong></br>
	<?php echo $services_info_names['obs']; ?>
</br>
</td>
</tr>
</table>
  <div style="text-align:center; margin-left: -150px; margin-top: 50px">
    
  <div>
    <button class="button" style="background-color:#EE3B3B;"><a href="<?php echo BASE_URL;?>/services">Cancelar</button>
    <input class="button" style="margin-left:70px; background-color:#1E90FF;" type="submit" name="Submit" value="Salvar"/></div>
</div>


