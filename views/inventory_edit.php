<h1>Produtos - Editar</h1>
</br>
<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
<table border="1" width="100%">
	<tr>
		<td>
	<label form="code">Código</label><br/>
	<input type="number" name="code" value="<?php echo $inventory_info['code']; ?>" required/><br/><br/>
</td>
<td>
	<label form="name">Nome</label><br/>
	<input type="text" name="name" value="<?php echo $inventory_info['name']; ?>" required/><br/><br/>
</td>
</tr>
<tr>
	<td>
<label form="category">Categoria</label><br/>
	<select name="category" id="category">

<option value="0"<?php echo($inventory_info['category']=='0')?'selected="selected"':'';?>>Vendas Diretas</option>
<option value="1"<?php echo($inventory_info['category']=='1')?'selected="selected"':'';?>>Serviços</option>

	</select><br/><br/>
</td>
<td>

    <label form="price">Preço</label><br/>
	<input type="text" name="price" value="<?php echo number_format($inventory_info['price'],2); ?>"  required/><br/><br/>
</td>
</tr>
<tr>
	<td>
    <label form="quant">Quantidade Em Estoque</label><br/>
	<input type="number" name="quant" value="<?php echo $inventory_info['quant']; ?>"  required/><br/><br/>
</td>
<td>
    <label form="min_quant">Quantidade Minima em Estoque</label><br/>
	<input type="number" name="min_quant" value="<?php echo $inventory_info['min_quant']; ?>"  required/><br/><br/>	
</td>
</tr>
</table>
<?php 
	$code = $inventory_info['code'];
	$quant = $inventory_info['quant'];
	$name = $inventory_info['name'];
	$price = $inventory_info['price'];

	$_SESSION['code'] =  $code;
	$_SESSION['quant'] =  $quant;
	$_SESSION['name'] =  $name;
	$_SESSION['price'] =  $price;
 ?>

 <script>
 	function openWin() {
 		window.open("<?php echo BASE_URL;?>/inventory/barras/pdf");
 	}
 </script>
 </br>
 <input style="background-color: yellow; width: 200" type="button" value=" Gerar codigo de barras" onclick="openWin()">

</br></br>
<legend><h4>Impostos do Produto</h4></legend>
<?php
$files = glob("docs/*");
usort( $files , function ( $a , $B ) {
   return filemtime ( $a ) < filemtime ( $B );
} );
foreach($files as $sDirectory)
{
 $sModified=date("d/m/Y H:i:s",filectime($sDirectory));
 $aContent[$sModified]=$sDirectory;
}
krsort($aContent,SORT_STRING);?>
  ?>

<table class="imps" border="1" width="100%">
	<?php foreach ($aContent as $sModified=>$sDirectory): ?> 
	<tr>
		<td>
	<label form="NCM">NCM *</label>
	<input type="number" name="NCM" value="<?php echo $inventory_info['NCM']; ?>" required/><br/><br/>
		</td>	
		<td>
	<label form="CFOP">CFOP *</label><br/>
	<input type="number" name="CFOP" value="<?php echo $inventory_info['CFOP']; ?>"  required/><br/><br/>
		</td>
		</tr>
	<tr>
		<td>
	<label form="uCom">uCom *</label><br/>
	<select name="uCom" id="uCom" required >

	<option value="AMPOLA">AMPOLA</option>
	<option value="BALDE">BALDE</option>
	<option value="BANDEJ">BANDEJA</option>
	<option value="BARRA">BARRA</option>
	<option value="AMPOLA">AMPOLA</option>
	<option value="BISNAG">BISNAGA</option>
	<option value="BLOCO">BLOCO</option>
	<option value="BOBINA">BOBINA</option>
	<option value="BOMB">BOMBONA</option>
	<option value="CAPS">CAPSULA</option>
	<option value="CART">CARTELA</option>
	<option value="CENTO">CENTO</option>
	<option value="CJ">CONJUNTO</option>
	<option value="CM">CENTIMETRO</option>
	<option value="CM2">CENTIMETRO QUADRADO</option>
	<option value="CX">CAIXA</option>
	<option value="CX2">CAIXA COM 2 UNIDADES</option>
	<option value="CX3">CAIXA COM 3 UNIDADES</option>
	<option value="CX5">CAIXA COM 5 UNIDADES</option>
	<option value="CX10">CAIXA COM 10 UNIDADES</option>
	<option value="CX15">CAIXA COM 15 UNIDADES</option>
	<option value="CX20">CAIXA COM 20 UNIDADES</option>
	<option value="CX25">CAIXA COM 25 UNIDADES</option>
	<option value="CX50">CAIXA COM 50 UNIDADES</option>
	<option value="CX100">CAIXA COM 100 UNIDADES</option>
	<option value="DISP">DISPLAY</option>
	<option value="DUZIA">DUZIA</option>
	<option value="EMBAL">EMBALAGEM</option>
	<option value="FARDO">FARDO</option>
	<option value="FOLHA">FOLHA</option>
	<option value="FRASCO">FRASCO</option>
	<option value="GALAO">GALÃO</option>
	<option value="GF">GARRAFA</option>
	<option value="GRAMAS">GRAMAS</option>
	<option value="JOGO">JOGO</option>
	<option value="KG">QUILOGRAMA</option>
	<option value="KIT">KIT</option>
	<option value="LATA">LATA</option>
	<option value="LITRO">LITRO</option>
	<option value="M">METRO</option>
	<option value="M2">METRO QUADRADO</option>
	<option value="M3">METRO CÚBICO</option>
	<option value="MILHEI">MILHEIRO</option>
	<option value="ML">MILILITRO</option>
	<option value="MWH">MEGAWATT HORA</option>
	<option value="PACOTE">PACOTE</option>
	<option value="PALETE">PALETE</option>
	<option value="PARES">PARES</option>
	<option value="PC">PEÇA</option>
	<option value="POTE">POTE</option>
	<option value="K">QUILATE</option>
	<option value="RESMA">RESMA</option>
	<option value="ROLO">ROLO</option>
	<option value="SACO">SACO</option>
	<option value="SACOLA">SACOLA</option>
	<option value="TAMBOR">TAMBOR</option>
	<option value="TANQUE">TANQUE</option>
	<option value="TON">TONELADA</option>
	<option value="TUBO">TUBO</option>
	<option value="UNID">UNIDADE</option>
	<option value="VASIL">VASILHAME</option>
	<option value="VIDRO">VIDRO</option>
	</select><br/><br/>

		</td>
		<td>
	<label form="cEANTrib">cEANTrib</label><br/>
	<input type="number" name="cEANTrib" value="<?php echo $inventory_info['cEANTrib']; ?>" /><br/><br/>
	</td>
	</tr>
	<tr>
	<td>
	<label form="uTrib">uTrib *</label><br/>
	<select name="uTrib" id="uTrib" required >

	<option value="AMPOLA">AMPOLA</option>
	<option value="BALDE">BALDE</option>
	<option value="BANDEJ">BANDEJA</option>
	<option value="BARRA">BARRA</option>
	<option value="AMPOLA">AMPOLA</option>
	<option value="BISNAG">BISNAGA</option>
	<option value="BLOCO">BLOCO</option>
	<option value="BOBINA">BOBINA</option>
	<option value="BOMB">BOMBONA</option>
	<option value="CAPS">CAPSULA</option>
	<option value="CART">CARTELA</option>
	<option value="CENTO">CENTO</option>
	<option value="CJ">CONJUNTO</option>
	<option value="CM">CENTIMETRO</option>
	<option value="CM2">CENTIMETRO QUADRADO</option>
	<option value="CX">CAIXA</option>
	<option value="CX2">CAIXA COM 2 UNIDADES</option>
	<option value="CX3">CAIXA COM 3 UNIDADES</option>
	<option value="CX5">CAIXA COM 5 UNIDADES</option>
	<option value="CX10">CAIXA COM 10 UNIDADES</option>
	<option value="CX15">CAIXA COM 15 UNIDADES</option>
	<option value="CX20">CAIXA COM 20 UNIDADES</option>
	<option value="CX25">CAIXA COM 25 UNIDADES</option>
	<option value="CX50">CAIXA COM 50 UNIDADES</option>
	<option value="CX100">CAIXA COM 100 UNIDADES</option>
	<option value="DISP">DISPLAY</option>
	<option value="DUZIA">DUZIA</option>
	<option value="EMBAL">EMBALAGEM</option>
	<option value="FARDO">FARDO</option>
	<option value="FOLHA">FOLHA</option>
	<option value="FRASCO">FRASCO</option>
	<option value="GALAO">GALÃO</option>
	<option value="GF">GARRAFA</option>
	<option value="GRAMAS">GRAMAS</option>
	<option value="JOGO">JOGO</option>
	<option value="KG">QUILOGRAMA</option>
	<option value="KIT">KIT</option>
	<option value="LATA">LATA</option>
	<option value="LITRO">LITRO</option>
	<option value="M">METRO</option>
	<option value="M2">METRO QUADRADO</option>
	<option value="M3">METRO CÚBICO</option>
	<option value="MILHEI">MILHEIRO</option>
	<option value="ML">MILILITRO</option>
	<option value="MWH">MEGAWATT HORA</option>
	<option value="PACOTE">PACOTE</option>
	<option value="PALETE">PALETE</option>
	<option value="PARES">PARES</option>
	<option value="PC">PEÇA</option>
	<option value="POTE">POTE</option>
	<option value="K">QUILATE</option>
	<option value="RESMA">RESMA</option>
	<option value="ROLO">ROLO</option>
	<option value="SACO">SACO</option>
	<option value="SACOLA">SACOLA</option>
	<option value="TAMBOR">TAMBOR</option>
	<option value="TANQUE">TANQUE</option>
	<option value="TON">TONELADA</option>
	<option value="TUBO">TUBO</option>
	<option value="UNID">UNIDADE</option>
	<option value="VASIL">VASILHAME</option>
	<option value="VIDRO">VIDRO</option>
	</select><br/><br/>
	
	</td>
<td>
	<label form="indTot">indTot *</label><br/>
	<input type="number" name="indTot" value="1" required/><br/><br/>	
</td>
</tr>
	<tr>
<td>
		<label form="pCOFINS">pCOFINS *</label><br/>
	<input type="text" name="pCOFINS" value="<?php echo $inventory_info['pCOFINS']; ?>" required/><br/><br/>	
</td>
<td>
		<label form="cst">cst *</label><br/>

    <select name="cst" id="cst" required >

	<option value="01">Operação Tributável com Alíquota Básica</option>
	<option value="02">Operação Tributável com Alíquota Diferenciada</option>
	<option value="03">Operação Tributável com Alíquota por Unidade de Medida de Produto</option>
	<option value="04">Operação Tributável Monofásica - Revenda a Alíquota Zero</option>
	<option value="05">Operação Tributável por Substituição Tributária</option>
	<option value="06">Operação Tributável a Alíquota Zero</option>
	<option value="07">Operação Isenta da Contribuição</option>
	<option value="08">Operação sem Incidência da Contribuição</option>
	<option value="09">Operação com Suspensão da Contribuição</option>
	<option value="49">Outras Operações de Saída</option>
	<option value="50">Operação com Direito a Crédito - Vinculada Exclusivamente a Receita Tributada no Mercado Interno</option>
	<option value="51">Operação com Direito a Crédito – Vinculada Exclusivamente a Receita Não Tributada no Mercado Interno</option>
	<option value="52">Operação com Direito a Crédito - Vinculada Exclusivamente a Receita de Exportação</option>
	<option value="53">Operação com Direito a Crédito - Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno</option>
	<option value="54">Operação com Direito a Crédito - Vinculada a Receitas Tributadas no Mercado Interno e de Exportação</option>
	<option value="55">Operação com Direito a Crédito - Vinculada a Receitas Não-Tributadas no Mercado Interno e de Exportação</option>
	<option value="56">Operação com Direito a Crédito - Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno, e de Exportação</option>
	<option value="60">Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita Tributada no Mercado Interno</option>
	<option value="61">Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno</option>
	<option value="62">Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita de Exportação</option>
	<option value="63">Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno</option>
	<option value="64">Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas no Mercado Interno e de Exportação</option>
	<option value="65">Crédito Presumido - Operação de Aquisição Vinculada a Receitas Não-Tributadas no Mercado Interno e de Exportação</option>
	<option value="66">Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno, e de Exportação</option>
	<option value="67">Crédito Presumido - Outras Operações</option>
	<option value="70">Operação de Aquisição sem Direito a Crédito</option>
	<option value="71">Operação de Aquisição com Isenção</option>
	<option value="72">Operação de Aquisição com Suspensão</option>
	<option value="73">Operação de Aquisição a Alíquota Zero</option>
	<option value="74">Operação de Aquisição sem Incidência da Contribuição</option>
	<option value="75">Operação de Aquisição por Substituição Tributária</option>
	<option value="98">Outras Operações de Entrada</option>
	<option value="99">Outras Operações</option>
	</select><br/><br/>

</td>
</tr>
	<tr>
	<td>
		<label form="pPIS">pPIS *</label><br/>
	<input type="text" name="pPIS" value="<?php echo $inventory_info['pPIS']; ?>" required/><br/><br/>	
</td>
	<td>
		<label form="csosn">csosn *</label><br/>
	<input type="number" name="csosn" value="102" required/><br/><br/>	
</td>
</tr>
	<tr>
<td>
		<label form="pICMS">pICMS *</label><br/>
	<input type="text" name="pICMS" value="<?php echo $inventory_info['pICMS']; ?>" required/><br/><br/>	
</td>
	<td>
		<label form="orig">orig *</label><br/>
	<input type="number" name="orig" value="<?php echo $inventory_info['orig']; ?>" required/><br/><br/>
</td>
</tr>
	<tr>
<td>
		<label form="modBC">modBC *</label><br/>
	<input type="text" name="modBC" value="<?php echo $inventory_info['modBC']; ?>" required/><br/><br/>	
</td>
	<td>
		<label form="vICMSDeson">vICMSDeson *</label><br/>
	<input type="text" name="vICMSDeson" value="<?php echo $inventory_info['vICMSDeson']; ?>"  required/><br/><br/>	
</td>
</tr>
<?php endforeach; ?>
</table>

<div style="text-align:center ">
</br></br>
<input style="background-color: green; width: 500" type="submit" value="Salvar Produto"/>
</div>
</form>
	
</div>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_inventory_add.js"></script>
