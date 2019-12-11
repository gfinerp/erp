<script type="text/javascript">
function Atualizar() {
window.location.reload();
}
</script>
<body onload="setTimeout('Atualizar()', 20000)">
	
<h1 style="font-family:Lato; color:black; font-size:60">Vendas</h1>

<div style="text-align:center">
	<div class="button"><a href="<?php echo BASE_URL;?>/sales/add">Adicionar Venda</a></div>
</div>
</br>
   
<table border="1" width="100%" >

	<tr>
			<th>Data/Hora</th>
			<th>Cliente</th>
			<th>Vendedor</th>
			<th>Pagamento</th>
			<th>Valor</th>
			<th>Status</th>
			<th>Ações</th>

	</tr>

		<?php foreach($sales_list as $sale_item): ?>
			
	<tr>
		<td width="180px"><?php  echo date('d/m/Y - H:i', strtotime($sale_item['date_sale'])); ?></td>
		<td width="150px"><?php  echo $sale_item['name']; ?></td>
		<td width="110px"><?php  echo $sale_item['name_vendedor'];?></td>
		<td width="180px"><?php echo $formases[$sale_item['forma']]; ?></td>
		<td width="120px">R$: <?php echo number_format(($sale_item['total_price'] + $sale_item['acrescimo'] - $sale_item['desconto']), 2,',','.'); ?></td>
		<td width="120px"><?php echo $statuses[$sale_item['status']]; ?></td>
		<td width="350px" style="text-align: center;">
			
			
    
<div class="button button_small"  style="background-color:#1E90FF"><a href="<?php echo BASE_URL; ?>/sales/edit/<?php echo $sale_item['id']; ?>">Editar</a></div>
			
			<div class="button button_small" style="background-color:#FFA500" ><a target="_blank" href="<?php echo BASE_URL; ?>/sales/cupom/<?php echo $sale_item['id']; ?>">Cupom</a></div>

			<?php if(!empty($sale_item['nfe_key'])): ?>

			<div class="button button_small" style="background-color:#32CD32"><a target="_blank" href="<?php echo BASE_URL; ?>/sales/view_nfe/<?php echo $sale_item['nfe_key']; ?>">Ver NFC</a></div>

			<!-- <div class="button button_small" style="background-color:#EE3B3B"><a target="_blank" href="<?php echo BASE_URL; ?>/sales/cancela_nfe/<?php echo $sale_item['nfe_key']; ?>">Cancelar </a></div>

			<div class="button button_small" style="background-color:#CC33CC"><a target="_blank" href="<?php echo BASE_URL; ?>/sales/view_nfe_cancelada/<?php echo $sale_item['nfe_key']; ?>">NFC Cancelada</a></div> -->
		<?php else: ?>

					<div class="button button_small" style="background-color:#EE3B3B" ><a target="_blank" href="<?php echo BASE_URL; ?>/sales/generate_nfe/<?php echo $sale_item['id']; ?>">Emitir NFC</a></div>

	<?php endif; ?>
	
		</td>

	</tr>
		

		<?php endforeach; ?>
	</table>


	


 <div class="pagination">
		<?php for($q=1; $q<=$p_count;$q++): ?>

		<div class="pag_item <?php echo($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/sales?p=<?php echo $q; ?>"><?php echo $q; ?></a></div>


	<?php endfor; ?>

	<div style="clear:both"></div>
</div>

</body>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_sales_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_desc_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients_cpf.js"></script>
