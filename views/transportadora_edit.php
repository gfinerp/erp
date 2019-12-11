<h1 style="font-family:Lato; color:black; font-size:60">Transportadora - <small>Editar</small></h1>

</br>
<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
<table border="1" width="100%">
	<tr>
		<td>
	<label form="xNome">Nome</label><br/>
	<input type="text" name="xNome" value="<?php echo $transportadora_info['xNome'];?>"required/><br/><br/>
	</td>
		<td>
	<label form="IE">Inscrição Estadual</label><br/>
	<input type="email" name="IE" value="<?php echo $transportadora_info['IE'];?>" /><br/><br/>
</td>
</tr>
<tr>
		<td>
	<label form="cpf">CPF</label><br/>
	<input type="cpf" name="cpf" id="cpf" value="<?php echo $transportadora_info['cpf'];?>" /><br/><br/>
	</td>
		<td>
	<label form="cnpj">CNPJ</label><br/>
	<input type="cnpj" name="cnpj" id="cnpj" value="<?php echo $transportadora_info['cnpj'];?>" /><br/><br/>
</td>
</tr>
<tr>
		<td>
	<label form="xEnder">Endereço</label><br/>
	<input type="text" name="xEnder" value="<?php echo $transportadora_info['xEnder'];?>"/><br/><br/>
</td>
<td>
<label form="xMun">Cidade</label><br/>
	<input type="text" name="xMun" value="<?php echo $transportadora_info['xMun'];?>" /><br/><br/>
</td>
</tr>
<tr>
		<td colspan="2">

	<label form="UF">Sigla-UF</label><br/>
	<input type="text" name="UF" value="<?php echo $transportadora_info['UF'];?>" /><br/><br/>

</td>

</tr>
</table>
</br></br>
  <div style="text-align:center">

	<input class="button" type="submit" value="Salvar"/>

</div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>