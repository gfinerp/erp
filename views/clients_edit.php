<h1>Clientes - Editar</h1>
</br>
<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
<table border="1" width="100%">
	<tr>
		<td>
	<label form="name">Nome</label><br/>
	<input type="text" name="name" value="<?php echo $client_info['name'];?>"required/><br/><br/>
	</td>
		<td>
	<label form="email">E-mail</label><br/>
	<input type="email" name="email" value="<?php echo $client_info['email'];?>" /><br/><br/>
</td>
</tr>
<tr>
		<td>
	<label form="cpf">CPF</label><br/>
	<input type="cpf" name="cpf" value="<?php echo $client_info['cpf'];?>" /><br/><br/>
	</td>
		<td>
	<label form="cnpj">CNPJ</label><br/>
	<input type="cnpj" name="cnpj" value="<?php echo $client_info['cnpj'];?>" /><br/><br/>
</td>
</tr>
<tr>
		<td>
	<label form="phone">Telefone</label><br/>
	<input type="text" name="phone" value="<?php echo $client_info['phone'];?>"/><br/><br/>
</td>
<td>
	<label form="stars">Estrelas</label><br/>
	<select name="stars" id="stars">
	<option value="1" <?php echo($client_info['stars']=='1')?'selected="selected"':'';?>>1 Estrela</option>
	<option value="2" <?php echo($client_info['stars']=='2')?'selected="selected"':'';?>>2 Estrela</option>
	<option value="3" <?php echo($client_info['stars']=='3')?'selected="selected"':'';?>>3 Estrela</option>
	<option value="4" <?php echo($client_info['stars']=='4')?'selected="selected"':'';?>>4 Estrela</option>
	<option value="5" <?php echo($client_info['stars']=='5')?'selected="selected"':'';?>>5 Estrela</option>
	</select><br/><br/>
</td>
</tr>
<tr>
		<td>

	<label form="adress_country">País</label><br/>
	<input type="text" name="adress_country" value="<?php echo $client_info['adress_country'];?>" /><br/><br/>

</td>
<td>

	<label form="adress_zipcode">CEP</label><br/>
	<input type="text" name="adress_zipcode" value="<?php echo $client_info['adress_zipcode'];?>" /><br/><br/>
</td>
</tr>
<tr>
		<td>

	<label form="adress">Rua</label><br/>
	<input type="text" name="adress" value="<?php echo $client_info['adress'];?>" /><br/><br/>
</td>
<td>

	<label form="adress_number">Número</label><br/>
	<input type="text" name="adress_number" value="<?php echo $client_info['adress_number'];?>" /><br/><br/>
</td>
</tr>
<tr>
		<td>

	<label form="adress2">Complemento</label><br/>
	<input type="text" name="adress2" value="<?php echo $client_info['adress2'];?>"/><br/><br/>
</td>
<td>
	<label form="adress_neighb">Bairro</label><br/>
	<input type="text" name="adress_neighb" value="<?php echo $client_info['adress_neighb'];?>" /><br/><br/>
</td>
</tr>
<tr>
		<td>
	<label for="adress_state">Estado</label><br/>
	<select name="adress_state" onchange="changeState(this)">
		<?php foreach($states as $state): ?>
		<option value="<?php echo $state['Uf']; ?>" <?php echo ($state['Uf']==$client_info['adress_state'])?'selected="selected"':''; ?>><?php echo $state['Uf']; ?></option>
		<?php endforeach; ?>
	</select><br/><br/>
</td>
<td>
	<label for="adress_city">Cidade</label><br/>
	<select name="adress_city">
		<?php foreach($cities as $city): ?>
		<option value="<?php echo $city['CodigoMunicipio']; ?>" <?php echo ($city['CodigoMunicipio']==$client_info['adress_citycode'])?'selected="selected"':''; ?>><?php echo $city['Nome']; ?></option>
		<?php endforeach; ?>
	</select><br/><br/>
</td>
</tr>
<tr>
		<td>
	<label for="internal_obs">Observações Internas</label><br/>
	<textarea name="internal_obs" id="internal_obs"><?php echo $client_info['internal_obs'];?></textarea><br/><br/>

</td>
<td>



	<input type="submit" value="Salvar"/>
</td>
</tr>
</table>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>