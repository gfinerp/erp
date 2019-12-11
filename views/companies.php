<h1>Empresas</h1>

<div style="clear:both"></div>
<div style="text-align:center">
<?php if($edit_permission): ?>
	<div class="button"><a href="<?php echo BASE_URL;?>/companies/add">Adicionar Empresa</a></div>
<?php endif; ?>

<input type="text" id="busca" data-type="search_clients" />
</div>


		<table border="1" width="100%">
			<tr>
					<th>Nome</th>
					<th>Telefone</th>
					<th>Cidade</th>
					<th>Estrelas</th>
					<th>Ações</th>
			</tr>
			    	<?php foreach ($as $c): ?>
			    	<tr>
			    		<td><?php echo $c['name']; ?></td>
			    		<td width="170"><?php echo $c['phone']; ?></td>
				    	<td width="290"><?php echo $c['adress_city']; ?></td>
			    		<td width="70" style="text-align:center"><?php echo $c['stars']; ?></td>
		    			<td width="160" style="text-align:center">
		    				<?php if($edit_permission): ?>
		    						<div class="button button_small"><a href="<?php echo BASE_URL; ?>/companies/edit/<?php echo $c['id']; ?>">Editar</a></div>

		    			<?php else: ?>

		    					     <div class="button button_small"><a href="<?php echo BASE_URL; ?>/companies/view/<?php echo $c['id']; ?>">Vizualizar</a></div>


		    		<?php endif; ?>
		    		

		    			</td>
		    		</tr>
		    	<?php endforeach; ?>

			</table>

         <div class="pagination" >
		<?php for($q=1; $q<=$p_count;$q++): ?>
		<div class="pag_item <?php echo($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/companies?p=<?php echo $q; ?>"><?php echo $q; ?></a></div>


	<?php endfor; ?>

	<div style="clear:both"></div>
</div>

