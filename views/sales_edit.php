<h1> Vendas - Editar </h1>
</br>
<table border="1" width="100%">
<tr>
	<td>
<strong>Nome do Cliente: </strong></br>
<?php echo $sales_info['info']['client_name']; ?></br>
</td>
<td>
<strong>Nome do Vendedor: </strong></br>
<?php echo $sales_info['info']['salesman_name_vendedor']; ?></br>
</td>
</tr>
<tr>
	<td>
<strong> Data da Venda: </strong></br>
<?php echo date('d/m/Y', strtotime($sales_info['info']['date_sale'])); ?></br>
	</td>
	<td>
<strong>Desconto: </strong></br>
	R$: <?php echo $sales_info['info']['desconto']; ?>
</br>
</td>
</tr>
<tr>
	<td>
<strong> Total da Venda</strong></br>
R$: <?php echo number_format($sales_info['info']['total_price'], 2, ',', '.'); ?> </br>
</td>
<td>
<strong>Forma de Pagamento: </strong></br>
<form method="POST">
	<select name="forma">
		<?php foreach ($formases as $formaKey => $formaValue): ?> 
		<option value="<?php echo $formaKey; ?>"><?php echo $formaValue; ?></option>
		<?php endforeach; ?>
	</select></br>

</td>
</tr>
<tr>
	<td>
<strong> Status da venda </strong></br>
<?php if($permission_edit): ?>
<form method="POST">
	<select name="status">
		<?php foreach ($statuses as $statusKey => $statusValue): ?> 
		<option value="<?php echo $statusKey; ?>"><?php echo $statusValue; ?></option>
		<?php endforeach; ?>
	</select></br>
</td>
<td>
	<input type="submit" value="Salvar" />
</td>
</tr>
</table>
<?php else: ?>
<?php echo $statuses[$sales_info['info']['status']]; ?></br></br>
<?php endif; ?>
</br>
<hr/>

<table border="1" width="100%"> 
<tr>
	<th>Cod</th>
	<th>Nome do Produto</th>
	<th>Quantidade</th>
	<th>Preço Unitário</th>
	<th>Preço Total</th>
</tr>

<?php foreach($sales_info['products'] as $productitem): ?>
<tr>
	<td><?php echo $productitem['code']; ?></td>
	<td><?php echo $productitem['name']; ?></td>
	<td><?php echo $productitem['quant']; ?></td>
	<td>R$: <?php echo number_format($productitem['sale_price'], 2, ',', '.'); ?></td>
	<td>R$: <?php echo number_format($productitem['sale_price'] * $productitem['quant'], 2, ',', '.'); ?></td>

</tr>
<?php endforeach; ?>

</table>