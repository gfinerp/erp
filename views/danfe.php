<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>

	<?php 
$datepast=date("Ym");
$files = glob("nfe/files/nfe/producao/pdf/{$datepast}/*");

usort( $files , function ( $a , $B ) {
   return filemtime ( $a ) < filemtime ( $B );
} );
foreach($files as $sDirectory)
{
 $sModified=date("d/m/Y H:i:s",filectime($sDirectory));
 $aContent[$sModified]=$sDirectory;
}
krsort($aContent,SORT_STRING);?>

	<table border="1" width="100%">
		<tr>
					<th>Data da Danfe</th>
					<th>Nome do Arquivo</th>
					<th>Ações</th>
		</tr>

			 <?php foreach ($aContent as $sModified=>$sDirectory): ?> 
			    <tr>
			    	<td width="200"><?php echo utf8_decode($sModified); ?> </td>
			    	<td width="200"><?php echo utf8_decode(substr($sDirectory, 26)); ?> </td>
			    	<td width="200">

			    	<div class="button button_small"><a href="<?php echo BASE_URL; ?>/<?php echo $sDirectory; ?>">Ver</a></div>

			    </tr>
			    	
			    
			<?php endforeach; ?>



</table>
</body>
</html>
