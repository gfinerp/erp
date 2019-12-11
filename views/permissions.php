<h1>Permissoes</h1>

<div class="tabarea">
	<div class="tabitem activetab">Grupo de permissoes</div>
	<div class="tabitem">Permissoes</div>

	</div>

	<div class="tabcontent">

		<div class="tabbody" style="display:block">
			
			<div style="clear:both"></div>
<div style="text-align:center">
		<div class="button"><a href="<?php echo BASE_URL;?>/permissions/add_group">Adicionar Grupo Permissões</a></div>
</div>


		<table border="1" width="100%">
			<tr>
					<th>Nome da Grupo de permissões</th>
					<th >Ações</th>
			</tr>
			<?php foreach($permissions_groups_list as $p): ?>
			<tr>
				<td><?php echo $p['name']; ?></td>

				<td width="200" style="text-align: center;">

					<div class="button button_small" style="background-color:#1E90FF"><a href="<?php echo BASE_URL; ?>
					/permissions/edit_group/<?php echo $p['id']; ?>">Editar</a></div>

				<div class="button button_small" style="background-color:#EE3B3B"><a href="<?php echo BASE_URL; ?>
					/permissions/delete_group/<?php echo $p['id']; ?>"
					 onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div></td>

					</td>

				</tr>
			<?php endforeach; ?>
			</table>



		</div>

	<div class="tabbody" >
			<div style="clear:both"></div>
<div style="text-align:center">
		<div class="button"><a href="<?php echo BASE_URL;?>/permissions/add">Adicionar Permissão</a></div>
</div>


		<table border="0" width="100%">
			<tr>
					<th>Nome da Permissão</th>
					<th >Ações</th>
			</tr>
			<?php foreach($permissions_list as $p): ?>
			<tr>
				<td><?php echo $p['name']; ?></td>
				<td width="50"><div class="button button_small"><a href="<?php echo BASE_URL; ?>/permissions/delete/<?php echo $p['id']; ?>"
				 onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div></td>

				</tr>
			<?php endforeach; ?>
			</table>
		</div>

	</div>