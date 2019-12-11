<h1>Funcionário - <small>Adicionar</small></h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">

	<label form="name">Nome</label><br/>
	<input type="text" name="name" required/><br/><br/>

	
	<input type="submit" value="Adicionar"/>

</form>

