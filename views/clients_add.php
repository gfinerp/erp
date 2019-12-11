<h1>Clientes - <small>Adicionar</small></h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">

	<!-- TABELA DADOS DO CLIENTE-->

<fieldset>
<legend><h4>Todos Os Dados do Cliente São Obrigatórios</h4></legend>
<table border="1" width="100%">
<tr>
	<td>
	<label form="name">Nome</label><br/>
	<input type="text" name="name" required/><br/><br/>
</td>
<td>
	<label form="email">E-mail</label><br/>
	<input type="email" name="email" /><br/><br/>
</td>
</tr>
<tr>
	<td>
	<label form="cpf">CPF</label><br/>
	<input type="cpf" name="cpf" /><br/><br/>
</td>
<td>
	<label form="cnpj">CNPJ</label><br/>
	<input type="cnpj" name="cnpj" /><br/><br/>
</td>
</tr>
<tr>
	<td>
	<label form="phone">Telefone</label><br/>
	<input type="text" name="phone" /><br/><br/>
</td>
<td>
	<label form="stars">Estrelas</label><br/>
	<select name="stars" id="stars">
	<option value="1">1 Estrela</option>
	<option value="2">2 Estrela</option>
	<option value="3" selected="selected">3 Estrela</option>
	<option value="4">4 Estrela</option>
	<option value="5">5 Estrela</option>
	</select><br/><br/>
</td>
</tr>
<tr>
	<td>

			<label form="adress_country">País</label><br/>
	<input type="text" name="adress_country" value="Brasil" /><br/><br/>
	
</td>
<td>

	<label form="adress_zipcode">CEP</label><br/>
	<input type="text" name="adress_zipcode" /><br/><br/>
</td>
</tr>
<tr>
	<td>

	<label form="adress">Rua</label><br/>
	<input type="text" name="adress" /><br/><br/>
</td>
<td>

	<label form="adress_number">Número</label><br/>
	<input type="text" name="adress_number" /><br/><br/>
</td>
</tr>
<tr>
	<td>

	<label form="adress2">Complemento</label><br/>
	<input type="text" name="adress2" /><br/><br/>
</td>
<td>
	<label form="adress_neighb">Bairro</label><br/>
	<input type="text" name="adress_neighb" /><br/><br/>
</td>
</tr>
<tr>
	<td>
<label for="adress_state">Estado</label><br/>
	<select name="adress_state" onchange="changeState(this)">
		<?php foreach($states as $state): ?>
		<option value="<?php echo $state['Uf']; ?>"><?php echo $state['Uf']; ?></option>
		<?php endforeach; ?>
	</select><br/><br/>
</td>
<td>
	<label for="adress_city">Cidade</label><br/>
	<select name="adress_city">

	</select><br/><br/>
</td>
</tr>
<tr>
	<td>
<label for="internal_obs">Observações Internas</label><br/>
	<textarea name="internal_obs" id="internal_obs"></textarea><br/><br/>

</td>
<td>
	<input type="submit" value="Adicionar"/>
</td>
</tr>
</table>
</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>