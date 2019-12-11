<h1 style="font-family:Lato; color:black; font-size:60">Transportadoras</h1>

<div style="clear:both"></div>
<div style="text-align:center">
<?php if($edit_permission): ?>

	
	<div class="button"  ><a href="<?php echo BASE_URL;?>/transportadora/add">Adicionar Transportadora</a></div>
<?php endif; ?>
</div>

</br></br>

		<table border="1" width="100%">
			<tr>
					<th>Nome</th>
					<th>Ações</th>
			</tr>
			    	<?php foreach ($transportadora_list as $c): ?>
			    	<tr>
			    		<td><?php echo $c['xNome']; ?></td>
			
		    			<td width="160" style="text-align:center">
		    						<div class="button button_small" style="background-color:#1E90FF"><a href="<?php echo BASE_URL; ?>/transportadora/edit/<?php echo $c['id']; ?>">Editar</a></div>	

		    			</td>
		    		</tr>
		    	<?php endforeach; ?>

			</table>

         <div class="pagination" >
		<?php for($q=1; $q<=$p_count;$q++): ?>
		<div class="pag_item <?php echo($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/transportadora?p=<?php echo $q; ?>"><?php echo $q; ?></a></div>


	<?php endfor; ?>

	<div style="clear:both"></div>
</div>

