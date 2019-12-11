<h1>Clientes - Visualizar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
	
	<label form="name">Nome</label><br/>
	<?php echo $client_info['name'];?><br/><br/>

	<label form="email">E-mail</label><br/>
	<?php echo $client_info['email'];?><br/><br/>

	<label form="phone">Telefone</label><br/>
	<?php echo $client_info['phone'];?><br/><br/>

	<label form="cpf">CPF</label><br/>
	<?php echo $client_info['cpf'];?><br/><br/>

	<label form="cnpj">CNPJ</label><br/>
	<?php echo $client_info['cnpj'];?><br/><br/>

	<label form="stars">Estrelas</label><br/>

	<?php echo $client_info['stars'];?><br/><br/>

	<label for="internal_obs">Observações Internas</label><br/>
	<?php echo $client_info['internal_obs'];?><br/><br/>


	<label form="adress_zipcode">CEP</label><br/>
	<?php echo $client_info['adress_zipcode'];?> <br/><br/>


	<label form="adress">Rua</label><br/>
	<?php echo $client_info['adress'];?> <br/><br/>


	<label form="adress_number">Número</label><br/>
	<?php echo $client_info['adress_number'];?><br/><br/>


	<label form="adress2">Complemento</label><br/>
	<?php echo $client_info['adress2'];?><br/><br/>

	<label form="adress_neighb">Bairro</label><br/>
	<?php echo $client_info['adress_neighb'];?><br/><br/>

	<label form="adress_city">Cidade</label><br/>
	<?php echo $client_info['adress_city'];?><br/><br/>

	<label form="adress_state">Estado</label><br/>
	<?php echo $client_info['adress_state'];?><br/><br/>

	<label form="adress_country">País</label><br/>
	<?php echo $client_info['adress_country'];?> <br/><br/>


</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_add.js"></script>