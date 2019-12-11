<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">
th {text-align: left; }
</style>

<div align="right"><img  src="./assets/images/logo.png"  width="250px" height="130px" /> </div>

<h1>Relatório de Contas</h1>
<fieldset>
<?php

if(isset($filters['period1']) && !empty($filters['period2'])){
	echo "No Período: ".date('d/m/Y', 
		strtotime($filters['period1']))." a ".date('d/m/Y',strtotime($filters['period2']))."<br/>";
}

if($filters['pay'] != ''){
	echo "Filtrado com Pagamento: ".$payses[$filters['pay']];
}
?>

</fieldset>
<table border="1" width="100%">
			<tr 	style="background-color: #9C9C9C";>
>
					<th>Data Vencimento</th>
					<th>Nome</th>
					<th>Numero Conta</th>
					<th>Valor</th>
					<th>Telefone</th>
					<th>Paga</th>
			</tr>
			
			    	<?php 
			    			$valorTotal = 0;
			    	foreach ($accounts_list as $c): ?>
			    	<tr>
						<td width="70"><?php  echo date('d/m/Y', strtotime($c['datev'])); ?></td>
			    		<td width="50"><?php echo $c['name']; ?></td>
			    		<td width="60"><?php echo $c['num']; ?></td>
						<td width="150">R$: <?php echo number_format ($c['value'], 2, ',', '.' ); ?></td>
			    		<td width="150"><?php echo $c['phone']; ?></td>
			    	    <td width="50"><?php echo $payses[$c['pay']]; ?></td>		
			    	
		    		</tr>
						 <?php $valorTotal += (float)$c['value'];?>

		

		<?php endforeach; ?>
	</table>

<table border="1" width="100%" >
<tr>
			<td style="text-align:center;"><b>Total: R$: <?php echo number_format($valorTotal, 2,',','.');?></b></td>

	
</tr>
</table>

