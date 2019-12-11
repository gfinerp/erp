<h1>Relatório de Estoque</h1>
<form method="GET" onsubmit="return openPopup(this)">
</br>
	<table border="1" width="100%">

<tr>
	<td>

			Categoria:<br/>
			<select name="category">
				<option value="">Todas as Categorias</option>
				<?php foreach ($categoriases as $categoriakey => $categoriaValue):?> 
					
					<option value="<?php echo $categoriakey; ?>"><?php echo $categoriaValue; ?></option>
				<?php endforeach; ?>
			</select></br></br>

		</td>
	</tr>
</table>	

<div style="clear:both"></div>
<div style="text-align:center">
</br>
<input type="submit" value="Gerar Relatório"/>
</div>
	</form>




<script type="text/javascript" src ="<?php echo BASE_URL; ?>/assets/js/report_inventory.js"></script>