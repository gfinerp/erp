<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/table.css">
</head>
<body>
<div class="tudo">	
<?php
$code = $_SESSION['code'];
$name = $_SESSION['name'];
$price = $_SESSION['price'];
$quant = $_SESSION['quant'];
?>
<div class="conteudo">
<?php
error_reporting(E_WARNING);
include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
include('src/BarcodeGeneratorSVG.php');
include('src/BarcodeGeneratorJPG.php');
include('src/BarcodeGeneratorHTML.php');
 $q = $quant;
	for ($i = 0; $i < $q; $i++){
$img ='<img src="./assets/images/logomoto.png"
  width="170px" height="60px" /> 
'."</br>" ;
$nome ="$name</br>";
$price = number_format("$price",2);
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$barra = '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($code, $generator::TYPE_CODE_93, 2, 50)) . '"></br>';
$codigo =  "$code</br></br>";
echo "<table> <tbody>";
echo "<tr>";
echo "<td>".$img."</td>\n";
echo "</tr>";
echo "<tr>";
echo "<td>".$nome."</td>\n";
echo "</tr>";
echo "<tr>";
echo "<td>".'R$:'.$price."</td>\n";
echo "</tr>";
echo "<tr>";
echo "<td>".$barra."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$codigo."</td>";
echo "</tr>";
echo "</tbody>";
echo "</table>"; 

}
?>
</div>
</div>
</body>
</html>

