<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">
th {text-align: left; }
</style>

<div align="right"><img  src="./assets/images/logo.png"  width="250px" height="130px" /> </div>

<h1>Relatório de Estoque</h1>
<fieldset>
<?php

if($filters['category'] != ''){
	echo "Filtrado Por Categoria: ".$categoriases[$filters['category']];
}

?>

</fieldset>
<table border="1" width="100%">
			<tr 	style="background-color: #9C9C9C";>
					<th>Código</th>
					<th>Nome</th>
					<th>Categoria</th>
					<th>Preço</th>
					<th>Quant.</th>
					<th>Quant. Min.</th>
					
			</tr>

			<?php foreach ($inventory_list as $product):  ?>
			<tr>
						<td width="120"><?php echo $product['code']; ?></td>
						<td width="170"><?php echo $product['name']; ?></td>		
						<td width="120"><?php echo $categoriases[$product['category']]; ?></td>		
						<td width="120">R$: <?php echo number_format ($product['price'], 2, ',', '.' ); ?></td>	
						<td width="60"><?php echo $product['quant']; ?></td>	
					    <td width="120"><?php
					    if($product['min_quant'] > $product['quant']){
					    		echo '<span style="color:red">'.($product['min_quant']).'</span>';
					    }else{
					     echo $product['min_quant']; 
					     }
					     ?></td>

						
			</tr>

 <?php endforeach; ?>
</table>

<b>Total:</b></br>
				R$: <?php echo number_format($product['quant']+$product['price'], 2,',','.'); ?>

