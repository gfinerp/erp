<h1>Usuários - <small>Adicionar</small></h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">

	<label form="email">E-mail</label><br/>
	<input type="email" name="email" required/><br/><br/>

    <label form="password">Senha</label><br/>
	<input type="password" name="password" required/><br/><br/>

	<label for="group">Grupo de permissões</label><br/>
	<select name="group" id="group" required>
		<?php foreach($group_list as $g): ?>
		<option value="<?php echo $g['id']; ?>"><?php echo $g['name']; ?></option>
	 <?php endforeach; ?>
	</select>
	<br/><br/>
		 

	<input type="submit" value="Adicionar"/>

</form>