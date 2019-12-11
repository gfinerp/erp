<h1>Relatório de Contas</h1>
<form method="GET" onsubmit="return openPopup(this)">
</br>
	<table border="1" width="100%">
	<tr>
		<td width="50%">


			Período:</br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="period1" />
			até
			<input type="date" name="period2" /></br></br>

</td>
		<td width="50%">

			Status da Conta:<br/>
			<select name="pay">
				<option  value="">Todas as Categorias</option>
				<?php foreach ($payses as $categoriakey => $categoriaValue):?> 
					
					<option value="<?php echo $categoriakey; ?>"><?php echo $categoriaValue; ?></option>
				<?php endforeach; ?>
			</select></br></br>
</td>
</tr>
</table>

<div style="clear:both"></div>
<div style="text-align:center">
	</br>
<input type="submit" value="Gerar Relatório"/>

	</form>
</div>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_accounts.js"></script>