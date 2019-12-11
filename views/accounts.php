<h1>Contas</h1>

<div style="clear:both"></div>
<div style="text-align:center">
<?php if($edit_permission): ?>
	<div class="button"><a href="<?php echo BASE_URL;?>/accounts/add">Adicionar Nova Duplicata</a></div>
<?php endif; ?>

</div>
<input type="text" id="busca3" data-type="search_accounts" />


</br></br>
		<table border="1" width="100%">
			<tr>
					<th>Data Vencimento</th>
					<th>Nome</th>
					<th>Numero Conta</th>
					<th>Valor</th>
					<th>Telefone</th>
					<th>Paga</th>
					<th>Açoes</th>
			</tr>
			    	<?php foreach ($accounts_list as $c): ?>
			    	<tr>
						<td width="70"><?php  echo date('d/m/Y', strtotime($c['datev'])); ?></td>
			    		<td width="50"><?php echo $c['name']; ?></td>
			    		<td width="60"><?php echo $c['num']; ?></td>
						<td width="150">R$: <?php echo number_format ($c['value'], 2, ',', '.' ); ?></td>
			    		<td width="150"><?php echo $c['phone']; ?></td>
			    	    <td width="50"><?php echo $payses[$c['pay']]; ?></td>		
			    		<td style="text-align: center;">
		    				<?php if($edit_permission): ?>
		    						<div class="button button_small" style="background-color:#1E90FF";><a href="<?php echo BASE_URL; ?>/accounts/edit/<?php echo $c['id']; ?>">Editar</a></div>

		    			<?php endif; ?>
		    		

		    			</td>
		    		</tr>
		    	<?php endforeach; ?>

			</table>

         <div class="pagination" >
		<?php for($q=1; $q<=$p_count;$q++): ?>
		<div class="pag_item <?php echo($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/accounts?p=<?php echo $q; ?>"><?php echo $q; ?></a></div>


	<?php endfor; ?>

	<div style="clear:both"></div>
</div>

