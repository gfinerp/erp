<h1>Funcionários</h1>
<div style="clear:both"></div>
<div style="text-align:center">
<?php if($edit_permission): ?>
	<div class="button"><a href="<?php echo BASE_URL;?>/salesman/add">Adicionar Funcionário</a></div>
<?php endif; ?>
</div>

</br>

		<table border="1" width="100%">
			<tr>
					<th>Nome</th>
					<th>Ações</th>
			</tr>
			    	<?php foreach ($salesman_list as $c): ?>
			    	<tr>
			    		<td><?php echo $c['name_vendedor']; ?></td>
			    		
		    			<td width="200" style="text-align:center">
		    				
		    						<div class="button button_small" style="background-color:#1E90FF"><a href="<?php echo BASE_URL; ?>/salesman/edit/<?php echo $c['id']; ?>">Editar</a></div>
		    						<div class="button button_small" style="background-color:#EE3B3B"><a href="<?php echo BASE_URL; ?>/salesman/delete/<?php echo $c['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div></td>

		    		
		    		

		    			</td>
		    		</tr>
		    	<?php endforeach; ?>

			</table>

         <div class="pagination" >
		<?php for($q=1; $q<=$p_count;$q++): ?>
		<div class="pag_item <?php echo($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/salesman?p=<?php echo $q; ?>"><?php echo $q; ?></a></div>


	<?php endfor; ?>

	<div style="clear:both"></div>
</div>

