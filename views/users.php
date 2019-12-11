<h1>Usuários</h1>

<div style="clear:both"></div>
<div style="text-align:center">
	<div class="button"><a href="<?php echo BASE_URL;?>/users/add">Adicionar Usuário</a></div>

</div>
</br>
		<table border="1" width="100%">
			<tr>
					<th>E-mail</th>
					<th>Grupo de Permissões</th>
					<th >Ações</th>
			</tr>

			    <?php foreach ($users_list as $us): ?> 
			    <tr>
			    	<td><?php echo $us['email']; ?> </td>
			    	<td width="200"><?php echo $us['name']; ?> </td>
			    	<td width="200" style="text-align: center;">

			    	<div class="button button_small" style="background-color:#1E90FF"><a href="<?php echo BASE_URL; ?>
					/users/edit/<?php echo $us['id']; ?>">Editar</a></div>

				<div class="button button_small" style="background-color:#EE3B3B"><a href="<?php echo BASE_URL; ?>
					/users/delete/<?php echo $us['id']; ?>"
					 onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div></td>


			    </tr>
			    	
			    
			<?php endforeach; ?>
			</table>
