<h1>Produtos - Adicionar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
	<!-- TABELA DO PRODUTO-->

<fieldset>
<legend><h4>Dados do Produto</h4></legend>
<table border="1" width="100%">
	<tr>
		<td>
	<label form="code">Código</label><br/>
	<input type="number" name="code" required/><br/><br/>
</td>
<td>
	<label form="name">Nome</label><br/>
	<input type="text" name="name" required/><br/><br/>
</td>
</tr>
<tr>
	<td>
    <label form="quant">Quantidade Em Estoque</label><br/>
	<input type="number" name="quant" required/><br/><br/>
</td>
<td>
    <label form="min_quant">Quantidade Minima em Estoque</label><br/>
	<input type="number" name="min_quant" required/><br/><br/>	
</td>
</tr>
<tr>
	<td>
	<label form="category">Categoria</label><br/>
	<select name="category" id="category" >

	<option value="0">Vendas Diretas</option>
	<option value="1">Serviços</option>

	</select><br/><br/>
</td>
	<td>
    <label form="price">Preço</label><br/>
	<input type="text" name="price" required/><br/><br/>
</td>
</tr>
</table>
</fieldset>

</br></br>
<fieldset>
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
krsort($aContent,SORT_STRING);
?>
<table class="imps" border="1" width="100%">
	<?php foreach ($aContent as $sModified=>$sDirectory): ?> 
	<tr>
		<td>
	<label form="NCM">NCM *</label> <a href="<?php echo BASE_URL; ?>/<?php echo $sDirectory; ?>" target="_blank">Lista 2018</a><br/>
	<input type="number" placeholder="COPIE DA NOTA FISCAL DE COMPRA OU DA LISTA 2018"   name="NCM" value="87141000" required/><br/><br/>
		</td>
		<td>
	<label form="CFOP">CFOP *</label><br/>
	<input type="number" value="5101" name="CFOP" required/><br/><br/>	
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
	<option value="PECA">PEÇA</option>
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
	<input type="number" name="cEANTrib" placeholder="codigo de barras 'PRODUTO'" /><br/><br/>	
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
	<option value="PECA">PEÇA</option>
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
	<input type="text" name="pCOFINS" value="0.00" required/><br/><br/>	

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
	<input type="text" name="pPIS" value="0.00" required/><br/><br/>	
</td>

	<td>
		<label form="csosn">csosn *</label><br/>
	<input type="number" name="csosn" value="102" required/><br/><br/>	
</td>
</tr>

<tr>
<td>
		<label form="pICMS">pICMS *</label><br/>
	<input type="text" name="pICMS" value="0.00" required/><br/><br/>	
</td>

	<td>
		<label form="orig">orig *</label><br/>
	<input type="number" name="orig" value="0" required/><br/><br/>	
</td>
</tr>

<tr>
<td>
		<label form="modBC">modBC *</label><br/>
	<input type="text" name="modBC" value="0" required/><br/><br/>	
</td>

	<td>
		<label form="vICMSDeson">vICMSDeson *</label><br/>
	<input type="text" name="vICMSDeson" value="0.00" required/><br/><br/>	
</td>
</tr>

<?php endforeach; ?>
</table>
</fieldset>
<div style="text-align:center ">
</br></br>
<input style="background-color: green; width: 500" type="submit" value="Adicionar Produto"/>
</div>


</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_inventory_add.js"></script>