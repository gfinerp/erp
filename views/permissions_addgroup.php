<h1>Permissões - <small>Adicionar Grupo</small></h1>
<form method="POST">

	<label form="name">Nome do grupo de permissões</label><br/>
	<input type="text" name="name"/><br/><br/>

	<label>Permissões</label></br></br>

	<?php foreach ($permissions_list as $p):?> 
	<div class="p_item">
		<input type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>" id="p_<?php echo $p['id']; ?>"/>
		<label for="p_<?php echo $p['id']; ?>"><?php echo $p['name']; ?></label>
	</div>
	<?php endforeach; ?>
	</br></br>

	<input type="submit" value="Adicionar"/>

</form>