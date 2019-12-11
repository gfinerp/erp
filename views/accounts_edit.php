<h1>Contas - Editar</h1>
</br>
<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
<table border="1" width="100%">
	<tr>
		<td>
	<label form="datev">Data Vencimento</label><br/>
	<input type="date" name="datev" value="<?php echo $accounts_info['datev'];?>"/><br/><br/>
	</td>
		<td>
	<label form="name">Nome</label><br/>
	<input type="text" name="name" value="<?php echo $accounts_info['name'];?>" /><br/><br/>
</td>
</tr>
<tr>
	<td>
	<label form="num">Numero Duplicata</label><br/>
	<input type="text" name="num" value="<?php echo $accounts_info['num'];?>" /><br/><br/>
	</td>
	<td>
	<label form="value">Valor</label><br/>
	<input type="text" name="value" value="<?php echo $accounts_info['value'];?>" /><br/><br/>
	</td>
</tr>
<tr>
	<td>
	<label form="phone">Telefone</label><br/>
	<input type="text" name="phone" value="<?php echo $accounts_info['phone'];?>"/><br/><br/>
</td>
<td>
	<label form="pay">Paga</label><br/>
	<select name="pay" id="paga">

<option value="0"<?php echo($accounts_info['pay']=='0')?'selected="selected"':'';?>>NÃO</option>
<option value="1"<?php echo($accounts_info['pay']=='1')?'selected="selected"':'';?>>SIM</option>

	</select><br/><br/>
</td>
</tr>
</table>

<div style="clear:both"></div>
<div style="text-align:center">
</br>
	<input type="submit" value="Salvar"/>
</div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>