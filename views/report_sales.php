<h1>Relatório de Vendas</h1>
<form method="GET" onsubmit="return openPopup(this)">
</br>
<table border="1" width="100%">
	<tr>
		<td width="50%">
			Nome do Cliente:</br>
			<input type="text" name="client_name" /></br></br>
	</td>
	<td  width="50%">
			Nome do Vendedor:<br/>
			<input type="text" name="salesman_name_vendedor" /></br></br>
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
			Status da Venda:<br/>
			<select name="status">
				<option value="">Todos os Status</option>
				<?php foreach ($statuses as $statuskey => $statusValue):?> 
					
					<option value="<?php echo $statuskey; ?>"><?php echo $statusValue; ?></option>
				<?php endforeach; ?>
			</select></br></br>
</td>
</tr>
<tr>
	<td>

			Forma de Pagamento:<br/>
			<select name="forma">
				<option value="">Todas os Formas de Pagamento</option>
				<?php foreach ($formases as $statuskey => $statusValue):?> 
					
					<option value="<?php echo $statuskey; ?>"><?php echo $statusValue; ?></option>
				<?php endforeach; ?>
			</select></br></br>
</td>
<td>

			Ordenação:<br/>
			<select name="order">
				<option value="date_desc">Mais Recente</option>
				<option value="date_asc">Mais Antigo</option>
				<option value="status">Status da Venda</option>		
				<option value="forma">Forma de Pagamento</option>					
			</select></br></br>
</td>
</tr>
</table>
<div style="clear:both"></div>
<div style="text-align:center">
</br>
<input type="submit" value="Gerar Relatório"/>
</div>
	</form>


	</div>



<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_sales.js"></script>