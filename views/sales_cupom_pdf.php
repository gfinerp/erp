<?php 
include "QRCodeGenerator.class.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="">

<style type="text/css" media="all">
            body { color: #000; }
            #wrapper { max-width: 480px; margin: 0 auto; padding-top: 20px; }
            .btn { border-radius: 0; margin-bottom: 5px; }
            .table { border-radius: 3px; }
            .table th { color: #E0FFFF; background: #696969; }
            .table th, 
            .table td { vertical-align: middle !important; }
            h3 { margin: 5px 0; }

            @media print {
                .no-print { display: none; }
                #wrapper { text-align: center; max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }
            }        
</style>
</head>
<body>

<div id="wrapper" align="center">
<img src="<?php echo BASE_URL; ?>/assets/images/logo.png" width="150" height="100" border="0" />
<h6 align="center">NOME EMPRESA<br>
OUTRA LINHA<br>
ENDERECO <br>
NUMERO E CEP<br> 
CIDADE ESTADO<br>
CNPJ<br>
Cupom - Sem Valor Fiscal </h6>
<h6 align="center"> Descrição dos Produtos </h6>
<table class="table table-striped table-condensed" align="center"> 
 <thead>
<tr>
   

                        <th class="text-center">Codigo</th>
                        <th class="text-center">Produto</th>
                        <th class="text-center">Quant</th>
                        <th class="text-center">P.Un</th>
                        <th class="text-center">Total</th>
</tr>

<?php foreach($sales_info['products'] as $productitem): ?>
   
<tr>
    <td align="center"><?php echo $productitem['code']; ?></td>
    <td align="center"><?php echo $productitem['name']; ?></td>
    <td align="center"><?php echo $productitem['quant']; ?></td>
    <td align="center"><?php echo number_format($productitem['sale_price'], 2, ',', '.'); ?></td>
    <td align="center"><?php echo number_format($productitem['sale_price'] * $productitem['quant'], 2, ',', '.'); ?></td>

</tr>
</thead>
<?php endforeach; ?>
</table>
<h6 align="center"> Descrição da Venda </h6>
 <table class="table table-striped table-condensed" align="center">
                <thead>
                    <tr>
                        <th class="text-center">Data</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Func</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">F.pag</th>
                        <th class="text-center">acr</th>
                        <th class="text-center">desc</th>
                        <th class="text-center">Total</th>
                    </tr>
                    <tr>

    <td width="30"><?php echo date('d/m/Y', strtotime($sales_info['info']['date_sale'])); ?></td>
    <td width="20"><?php echo $sales_info['info']['client_name'];  ?></td>
    <td width="30"><?php echo $sales_info['info']['salesman_name_vendedor']; ?></td>
    <td width="30"><?php echo $statuses[$sales_info['info']['status']]; ?></td>
    <td width="30"><?php echo $formases[$sales_info['info']['forma']]; ?></td>
    <td width="30"><?php echo number_format($sales_info['info']['acrescimo'], 2, ',', '.'); ?></td>
    <td width="30"><?php echo number_format($sales_info['info']['desconto'], 2, ',', '.'); ?></td>
    <td width="30"><?php echo number_format($sales_info['info']['total_price'] + $sales_info['info']['acrescimo'] - $sales_info['info']['desconto'], 2, ',', '.'); ?></td>
    
</tr>
</thead>
    
</table>
=================
<div style="clear:both;"></div>
<?php 

 $ex1 = new QRCodeGenerator('http://www.nfe.fazenda.gov.br/portal/consulta.aspx?tipoConsulta=completa&tipoConteudo=XbSeqxE8pl8=MtsDub');
                echo "<img src=".$ex1->generate().">";
 ?>
</div>
<h6 align="center">Obrigado e Volte Sempre!<br>
Procon 151<br>
Av. José Vieira Primo, nº 04, Centro<br>
Luziania GO<br></h6>
</body>
</html>