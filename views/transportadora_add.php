<h1 style="font-family:Lato; color:black; font-size:60">Transportadora 
 - <small>Adicionar</small></h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST" id="myform">

	<!-- TABELA DADOS DO CLIENTE-->

<fieldset>
<legend><h4>Informações da Transportadora</h4></legend>
<table border="1" width="100%">
<tr>
	<td>
	<label form="xNome">Nome ou Razão Social</label><br/>
	<input type="text" name="xNome" required/><br/><br/>
</td>
<td>
	<label form="IE">Inscrição Estadual</label><br/>
	<input type="text" name="IE" /><br/><br/>
</td>
</tr>
<tr>
	<td>
	<label form="cpf">CPF</label><br/>
	<input type="cpf" id="cpf" name="cpf" /><br/><br/>
</td>
<td>
	<label form="cnpj">CNPJ</label><br/>
	<input type="cnpj" id="cnpj" name="cnpj" /><br/><br/>
</td>
</tr>
<tr>
	<td>
	<label form="xEnder">Endereço Logradouro / Rua</label><br/>
	<input type="text" name="xEnder" /><br/><br/>
	</td>
	<td>
	<label form="xMun">Cidade</label><br/>
	<input type="text" name="xMun" /><br/><br/>
</td>
</tr>
<tr>
	<td colspan="2">

			<label form="UF">Sigla-UF</label><br/>
	<input type="text" name="UF" /><br/><br/>
	
</td>

</tr>
</table>
</br></br>
  <div style="text-align:center">
	<input class="button" id="add" onclick="this.value='Aguarde...'" type="submit" value="Adicionar"/>
</div>
</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>