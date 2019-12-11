<h1>Funcionário - Editar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">

	<label form="name_vendedor">Nome</label><br/>
	<input type="text" name="name_vendedor" value="<?php echo $salesman_info['name_vendedor'];?>"required/><br/><br/>

	
	<input type="submit" value="Salvar"/>

</form>

