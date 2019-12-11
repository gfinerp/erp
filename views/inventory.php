<h1>Estoque</h1>


<div style="text-align:center">
<?php if($add_permission): ?>
	<div class="button">
		<a href="<?php echo BASE_URL;?>/inventory/add">Adicionar Novo Produto</a></br></div>

 <?php endif; ?>
 </div>
<input type="text" id="busca2" data-type="search_inventory"/>


</br>
</br>
<table border="1" width="100%">
			<tr>
					<th>Código</th>
					<th>Nome</th>
					<th>Categoria</th>
					<th>Preço</th>
					<th>Quant.</th>
					<th>Quant. Min.</th>
					<th>Ações</th>
			</tr>

			<?php foreach ($inventory_list as $product):  ?>
			<tr>
						<td><?php echo $product['code']; ?></td>
						<td><?php echo $product['name']; ?></td>		
						<td><?php echo $categoriases[$product['category']]; ?></td>		
						<td width="130" >R$: <?php echo number_format ($product['price'], 2, ',', '.' ); ?></td>	
						<td width="80" style="text-align:center"><?php echo $product['quant']; ?></td>	
					    <td width="130" style="text-align:center"><?php
					    if($product['min_quant'] > $product['quant']){
					    		echo '<span style="color:red">'.($product['min_quant']).'</span>';
					    }else{
					     echo $product['min_quant']; 
					     }
					     ?></td>

						<td width="180">
								<div class="button button_small" style="background-color:#1E90FF"><a href="<?php echo BASE_URL; ?>/inventory/edit/<?php echo $product['id']; ?>">Editar</a></div>
		    						<div class="button button_small" style="background-color:#EE3B3B"><a href="<?php echo BASE_URL; ?>/inventory/delete/<?php echo $product['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div></td>


						</td>				
			</tr>

 <?php endforeach; ?>
</table>

 <div class="pagination">
		<?php for($q=1; $q<=$p_count;$q++): ?>
		<div class="pag_item <?php echo($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/inventory?p=<?php echo $q; ?>"><?php echo $q; ?></a></div>


	<?php endfor; ?>

	<div style="clear:both"></div>
</div>

