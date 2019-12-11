<h1>Contas - <small>Adicionar</small></h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
	<!-- TABELA DADOS DA CONTA-->

<fieldset>
<legend><h4>Dados da Conta</h4></legend>
<table border="1" width="100%">
	<tr>
		<td>
	<label form="datev">Data Vencimento</label><br/>
	<input type="date" name="datev" required/><br/><br/>
</td>
<td>
	<label form="name">Nome</label><br/>
	<input type="text" name="name" required/><br/><br/>
</td>
</tr>
<tr>
	<td>
	<label form="num">Numero Duplicata</label><br/>
	<input type="text" name="num" required/><br/><br/>
</td>
<td>
	<label form="value">Valor</label><br/>
	<input type="text" name="value" required/><br/><br/>
</td>
</tr>
<tr>
	<td>
	<label form="phone">Telefone</label><br/>
	<input type="text" name="phone" /><br/><br/>
</td>
<td>
	<label form="pay">Paga</label><br/>
	<select name="pay" id="paga" >

	<option value="0">NÃO</option>
	<option value="1">SIM</option>
	
	</select><br/><br/>
</td>
</tr>
</table>	
	</br>

	<input type="submit" value="Adicionar"/>
</fieldset>
</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>