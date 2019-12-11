<?php

class salesController extends controller{


     public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false){
            header("Location: ".BASE_URL."/login");
            exit;
            
        }
    }


    public function index(){

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

          $data['formases'] = array(
                '01'=>'Dinheiro',
                '02'=>'Cheque',
                '03'=>'Cartão de Crédito',
                '04'=>'Cartão de Débito',
                '05'=>'Crédito Loja',
                '10'=>'Vale Alimentação',
                '11'=>'Vale Refeição',
                '12'=>'Vale Presente',
                '13'=>'Vale Combustível',
                '15'=>'Boleto Bancário',
                '90'=>'Sem Pagamento',
                '99'=>'Outros'
                 );
           
     $data['statuses'] = array(
                '0'=>'Aguard. pag.',
                '1'=>'Pago',
                '2'=>'Cancelado',
                '3'=>'Troca',
                '4'=>'Orcamento'
            );


            if($u->hasPermission('sales_view')){
               $s = new Sales();
                
                $offset = 0;
                $data['p'] = 1;
                if(isset($_GET['p']) && !empty($_GET['p'])){
                    $data['p'] = intval($_GET['p']);
                    if($data['p'] == 0){
                        $data['p'] = 1;
                    }
                }

                $offset = ( 10 * ($data['p']-1));
                $data['sales_count'] = $s->getCount($u->getCompany());
                $data['p_count'] = ceil($data['sales_count'] / 10);
                $data['sales_list'] = $s->getList($offset, $u->getCompany());

                $this->loadTemplate('sales', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

    }

public function generate_nfe($id_sale) {
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        if($u->hasPermission('emitir_nfe')){

        $s = new Sales();
        $c = new Clients();
        $t = new Transportadora();

        $companyinfo  = $company->getCompanyInfo($u->getCompany());
        $cNF = $company->getNextNFE();
        $salesinfo = $s->getAllInfo($id_sale, $u->getCompany());
        $clientinfo = $c->getInfo($salesinfo['info']['id_client'], $u->getCompany());
        $transinfo  = $t->getInfo($salesinfo['info']['trans_id'], $u->getCompany());

          $data['formases'] = array(
                '01'=>'Dinheiro',
                '02'=>'Cheque',
                '03'=>'Cartão de Crédito',
                '04'=>'Cartão de Débito',
                '05'=>'Crédito Loja',
                '10'=>'Vale Alimentação',
                '11'=>'Vale Refeição',
                '12'=>'Vale Presente',
                '13'=>'Vale Combustível',
                '15'=>'Boleto Bancário',
                '90'=>'Sem Pagamento',
                '99'=>'Outros'
                 );

//array informaçoes de pagamento

        $fatinfo = array(
            'nfat' => $id_sale,
            'vorig' => number_format($salesinfo['info']['recebido'], 2),
            'tpag' =>$salesinfo['info']['forma'],
            'cnpj' => '',
            'tBand' =>$salesinfo['info']['band'],
            'cAut' => '',
            'tpIntegra' => '2',
            'indPag' =>'0'
        );


        $fattroco = array(
            'vTroco' => number_format($salesinfo['info']['troco'], 2)
        );

//array informaçoes da nota
        $informacoes = array(
          'tpImp' => $salesinfo['info']['tpImp'], //tipo de danf
          'modelo' => $salesinfo['info']['modelo'], //modelo da nota 55 ou 65
          'tpNF' => $salesinfo['info']['tpNF'], // 0 = Entrada ou  1 = saida
          'tpAmb' => $salesinfo['info']['tpAmb'], // 1 = Producao ou 2 = Homologacao
          'finNFe' => $salesinfo['info']['finNFe'],
          'indFinal' => $salesinfo['info']['indFinal'],
          'indPres' => $salesinfo['info']['indPres'],
          'idDest' => $salesinfo['info']['idDest'],
          'modFrete' => $salesinfo['info']['modFrete']

         );

   // array empresa

        $empresa = array(
          'xNome' => $companyinfo['xNome'], 
          'xFant' => $companyinfo['name'], 
          'IE' => $companyinfo['IE'], 
          'CRT' => $companyinfo['CRT'], 
          'CNPJ' => $companyinfo['CNPJ'],
          'xLgr' => $companyinfo['xLgr'],
          'nro' => $companyinfo['nro'],
          'xBairro' => $companyinfo['xBairro'],
          'cMun' => $companyinfo['cMun'],
          'cUF' => $companyinfo['cUF'],
          'xMun' => $companyinfo['xMun'],
          'UF' => $companyinfo['UF'],
          'CEP' => $companyinfo['CEP'],
          'cPais' => $companyinfo['cPais'],
          'xPais' => $companyinfo['xPais'],
          'fone' => $companyinfo['fone'],
          'CSC' => $companyinfo['CSC'],
          'CSCid' => $companyinfo['CSCid'],
          'senhacertificado' => $companyinfo['senhacertificado'],
          'id' => $companyinfo['id'],
          'nomelogo' => $companyinfo['nomelogo'],
          'nomecertificado' => $companyinfo['nomecertificado'],
          'token' => $companyinfo['token']
         );

  //array trasportadora
      if(isset($transinfo) && !empty($transinfo)){
 
        $transportadora = array(
          'xNome' => $transinfo['xNome'], 
          'IE' => $transinfo['IE'], 
          'xEnder' => $transinfo['xEnder'], 
          'xMun' => $transinfo['xMun'],
          'UF' => $transinfo['UF'],
          'CNPJ' => $transinfo['CNPJ'],
          'CPF' => $transinfo['CPF']
        );
}

      if(isset($salesinfo) && !empty($salesinfo)){

//array de volume
        $volume = array(
          'item' => $salesinfo['info']['item'], 
          'qVol' => $salesinfo['info']['qVol'], 
          'esp' => $salesinfo['info']['esp'], 
          'marca' => $salesinfo['info']['marca'],
          'nVol' => $salesinfo['info']['nVol'],
          'pesoL' => $salesinfo['info']['pesoL'],
          'pesoB' => $salesinfo['info']['pesoB'],
          'placa' => $salesinfo['info']['placa'],
          'UF' => $salesinfo['info']['UF'],
          'RNTC' => $salesinfo['info']['RNTC']

        );
}
//array de informaçoes complementares
        $infCpl = array(
          'infAdFisco' => '',
          'infCpl' => $salesinfo['info']['infCpl']  
         );

//array cpf na nota cliente
if(isset($salesinfo['info']['cpf']) && !empty($salesinfo['info']['cpf'])){

        $destinatario = array(
        'cpf' => $salesinfo['info']['cpf'],
         'cnpj' => '',
            'idestrangeiro' => '',
            'nome' => '',
            'email' => '',
            'iedest' => '',
            'ie' => '',
            'isuf' => '',
            'im' => ''
        );
}


//array cnpj na nota cliente

if(isset($salesinfo['info']['cnpj']) && !empty($salesinfo['info']['cnpj'])){

        $destinatario = array(
        'cpf' => '',
         'cnpj' => $salesinfo['info']['cnpj'],
            'idestrangeiro' => '',
            'nome' => '',
            'email' => '',
            'iedest' => '',
            'ie' => '',
            'isuf' => '',
            'im' => ''
        );
}

//array destinatario ou cliente
if(isset($clientinfo) && !empty($clientinfo)){

        $destinatario = array(
            'cpf' => $clientinfo['cpf'],
            'cnpj' => $clientinfo['cnpj'],
            'idestrangeiro' => $clientinfo['foreignid'],
            'nome' => $clientinfo['name'],
            'email' => $clientinfo['email'],
            'iedest' => $clientinfo['iedest'],
            'ie' => $clientinfo['ie'],
            'isuf' => $clientinfo['isuf'],
            'im' => $clientinfo['im'],
            'end' => array(
                'logradouro' => $clientinfo['adress'],
                'numero' => $clientinfo['adress_number'],
                'complemento' => $clientinfo['adress2'],
                'bairro' => $clientinfo['adress_neighb'],
                'mu' => $clientinfo['adress_city'],
                'uf' => $clientinfo['adress_state'],
                'cep' => $clientinfo['adress_zipcode'],
                'pais' => $clientinfo['adress_country'],
                'cmu' => $clientinfo['adress_citycode'],
                'cpais' => $clientinfo['adress_countrycode'],
                'fone' => $clientinfo['phone']

            )
        );
}

        $prods = array();

        foreach($salesinfo['products'] as $prod) { 

       $sale_price = number_format($prod['sale_price'], 2);
            
    if(isset($prod['desconto']) && !empty($prod['desconto'])){

       $desconto = number_format($prod['desconto'], 2);
                                    }
            $prods[] = array(
                'cProd' => $prod['c']['code'],
                'cEAN' => $prod['c']['cEAN'],
                'xProd' => $prod['c']['name'],
                'NCM' => $prod['c']['NCM'],
                'EXTIPI' => $prod['c']['EXTIPI'],
                'CFOP' => $prod['c']['CFOP'],
                'uCom' => $prod['c']['uCom'],
                'vUnCom' => $sale_price,
                'cEANTrib' => $prod['c']['cEANTrib'],
                'uTrib' => $prod['c']['uTrib'],
                'vUnTrib' => $sale_price,
                'vFrete' => $prod['c']['vFrete'],
                'vSeg' => $prod['c']['vSeg'],
                'vDesc' => $desconto,
                'vOutro' => $prod['c']['vOutro'],
                'indTot' => $prod['c']['indTot'],
                'xPed' => $prod['c']['xPed'],
                'nItemPed' => $prod['c']['nItemPed'],
                'nFCI' => $prod['c']['nFCI'],
                'cst' => $prod['c']['cst'],
                'pPIS' => number_format($prod['c']['pPIS'], 2),
                'pCOFINS' => number_format($prod['c']['pCOFINS'], 2),
                'csosn' => $prod['c']['csosn'],
                'pICMS' => $prod['c']['pICMS'], // 18
                'orig' => $prod['c']['orig'],
                'modBC' => $prod['c']['modBC'],
                'vICMSDeson' => $prod['c']['vICMSDeson'],
                'pRedBC' => $prod['c']['pRedBC'],
                'modBCST' => $prod['c']['modBCST'],
                'pMVAST' => $prod['c']['pMVAST'],
                'pRedBCST' => $prod['c']['pRedBCST'],
                'vBCSTRet' => $prod['c']['vBCSTRet'],
                'vICMSSTRet' => $prod['c']['vICMSSTRet'],
                'qBCProd' => $prod['c']['qBCProd'],
                'vAliqProd' => $prod['c']['vAliqProd'],
                'qCom' => $prod['quant'],
                'vProd' => ($prod['quant'] * $sale_price),
                'vBC' => ($prod['quant'] * $sale_price),
                'qTrib' => $prod['quant']
            );
 
       
        }

        $nfe = new Nfe();
        $nfe->emitirNFE($cNF, $destinatario, $prods, $fatinfo, $fattroco, $id_sale, $informacoes, $empresa, $infCpl, $transportadora, $volume);

            $company->setNFE($cNF, $u->getCompany());

    }else{
    echo "Você Não Tem Permissão Para Emitir Nota Fiscal.";
}
}

    public function view_nfe($nfe_key) {
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $conf = new Sales();
        $configuracoes_info = $conf->getNfe($nfe_key, $u->getCompany());
        if ($configuracoes_info['tpAmb'] == 1) {
              $ambiente = 'producao';
         }else{
              $ambiente = 'homologacao';
         }

       $Ym = strftime("%m-%Y");

        header("Content-Type: application/pdf");
        readfile("nfe/files/nfe/".$ambiente."/pdf/{$Ym}/".$nfe_key."-danfe.pdf");
    }

 public function cancela_nfe($nfe_key){

    $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());

        $s = new Sales();
        $c = new Clients();
        $t = new Transportadora();

        $companyinfo  = $company->getCompanyInfo($u->getCompany());
        $companyinfologo = $company->getCompanyInfo($u->getCompany());
        $companyinfocert = $company->getCompanyInfo($u->getCompany());

        $cNF = $company->getNextNFE();
        $salesinfo = $s->getNfe($nfe_key, $u->getCompany());
        $clientinfo = $c->getInfo($salesinfo['id_client'], $u->getCompany());
        $transinfo  = $t->getInfo($salesinfo['trans_id'], $u->getCompany());



       $informacoes = array(
          'tpImp' => $salesinfo['tpImp'], //tipo de danf
          'modelo' => $salesinfo['modelo'], //modelo da nota 55 ou 65
          'tpNF' => $salesinfo['tpNF'], // 0 = Entrada ou  1 = saida
          'tpAmb' => $salesinfo['tpAmb'], // 1 = Producao ou 2 = Homologacao
          'finNFe' => $salesinfo['finNFe'],
          'indFinal' => $salesinfo['indFinal'],
          'indPres' => $salesinfo['indPres'],
          'idDest' => $salesinfo['idDest']
         );

        $empresa = array(
          'xNome' => $companyinfo['xNome'], 
          'xFant' => $companyinfo['name'], 
          'IE' => $companyinfo['IE'], 
          'CRT' => $companyinfo['CRT'], 
          'CNPJ' => $companyinfo['CNPJ'],
          'xLgr' => $companyinfo['xLgr'],
          'nro' => $companyinfo['nro'],
          'xBairro' => $companyinfo['xBairro'],
          'cMun' => $companyinfo['cMun'],
          'xMun' => $companyinfo['xMun'],
          'UF' => $companyinfo['UF'],
          'CEP' => $companyinfo['CEP'],
          'cPais' => $companyinfo['cPais'],
          'xPais' => $companyinfo['xPais'],
          'fone' => $companyinfo['fone'],
          'CSC' => $companyinfo['CSC'],
          'CSCid' => $companyinfo['CSCid'],
          'senhacertificado' => $companyinfo['senhacertificado'],
          'id' => $companyinfo['id']
         );

         $empresacert = array(
          'nomecertificado' => $companyinfocert['nomecertificado']
         );


        $nfe = new Nfe();
        $nfe_key = $nfe->cancela($nfe_key, $empresa, $informacoes, $empresacert);
                

    }

    public function view_nfe_cancelada($nfe_key) {
         $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $conf = new Sales();
        $configuracoes_info = $conf->getNfe($nfe_key, $u->getCompany());
        if ($configuracoes_info['tpAmb'] == 1) {
              $ambiente = 'producao';
         }else{
              $ambiente = 'homologacao';
         }

        $Ym = strftime("%m-%Y");
        header("Content-Type: application/pdf");
        readfile("nfe/files/nfe/".$ambiente."/pdf_cancelado/{$Ym}/".$nfe_key."-Cancdanfe.pdf");

        
 }

    public function add(){

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

            if($u->hasPermission('sales_view')){
               $s = new Sales();
        $ci = new Cidade();


               if(isset($_POST['salesman_id']) && !empty($_POST['salesman_id'])){
                $salesman_id = addslashes($_POST['salesman_id']);
                $client_id = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                $forma = addslashes($_POST['forma']);
                $band = addslashes($_POST['band']);
                $desconto = addslashes($_POST['desconto']);
                $desconto = str_replace('.', '', $desconto);
                $desconto = str_replace(',', '.', $desconto);
                $recebido = addslashes($_POST['recebido']);
                $recebido = str_replace('.', '', $recebido);
                $recebido = str_replace(',', '.', $recebido);
                $troco = addslashes($_POST['troco']);
                $troco = str_replace('.', '', $troco);
                $troco = str_replace(',', '.', $troco);
                $troco = str_replace('-', '', $troco);
                $cpf = addslashes($_POST['cpf']);
                $cpf = str_replace('.', '', $cpf);
                $cpf = str_replace(',', '.', $cpf);
                $cpf = str_replace('-', '', $cpf);               
                $cnpj = addslashes($_POST['cnpj']);
                $cnpj = str_replace('.', '', $cnpj);
                $cnpj = str_replace(',', '', $cnpj);
                $cnpj = str_replace('-', '', $cnpj);
                $cnpj = str_replace('/', '', $cnpj);
                $sub_total = addslashes($_POST['sub_total']);
                $sub_total = str_replace('.', '', $sub_total);
                $sub_total = str_replace(',', '.', $sub_total);
                $acrescimo = addslashes($_POST['acrescimo']);
                $acrescimo = str_replace('.', '', $acrescimo);
                $acrescimo = str_replace(',', '.', $acrescimo);
                $modelo = addslashes($_POST['modelo']);
                $tpImp = addslashes($_POST['tpImp']);
                $infCpl = addslashes($_POST['infCpl']);
                $tpNF = addslashes($_POST['tpNF']);
                $tpAmb = addslashes($_POST['tpAmb']);
                $finNFe = addslashes($_POST['finNFe']);
                $indPres = addslashes($_POST['indPres']);
                $indFinal = addslashes($_POST['indFinal']);
                $idDest = addslashes($_POST['idDest']);
                $modFrete = addslashes($_POST['modFrete']);
                $item = addslashes($_POST['item']);
                $qVol = addslashes($_POST['qVol']);
                $esp = addslashes($_POST['esp']);
                $marca = addslashes($_POST['marca']);
                $nVol = addslashes($_POST['nVol']);
                $pesoL = addslashes($_POST['pesoL']);
                $pesoB = addslashes($_POST['pesoB']);
                $placa = addslashes($_POST['placa']);
                $UF = addslashes($_POST['UF']);
                $RNTC = addslashes($_POST['RNTC']);
                $quant = $_POST['quant'];
                $trans_id = addslashes($_POST['trans_id']);
                
                $s->addSale($u->getCompany(), $salesman_id, $client_id,  $u->getId(), $quant, $status,
                 $forma, $band, $desconto,$recebido, $troco, $cpf, $cnpj, $sub_total, $acrescimo,$modelo,
                  $tpImp, $infCpl,$tpNF, $tpAmb, $finNFe, $indPres, $indFinal, $idDest, $modFrete, $item,
                  $qVol, $esp, $marca, $nVol, $pesoL, $pesoB,$placa, $UF, $RNTC, $trans_id);
                header("Location: ".BASE_URL."/sales");
               }
              
                $data['states'] = $ci->getStates();

                $this->loadTemplate('sales_add', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

    }

    public function add2(){

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

            if($u->hasPermission('sales_view')){
               $s = new Sales();
        $ci = new Cidade();


               if(isset($_POST['salesman_id']) && !empty($_POST['salesman_id'])){
                $salesman_id = addslashes($_POST['salesman_id']);
                $client_id = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                $forma = addslashes($_POST['forma']);
                $band = addslashes($_POST['band']);
                $desconto = addslashes($_POST['desconto']);
                $desconto = str_replace('.', '', $desconto);
                $desconto = str_replace(',', '.', $desconto);
                $recebido = addslashes($_POST['recebido']);
                $recebido = str_replace('.', '', $recebido);
                $recebido = str_replace(',', '.', $recebido);
                $troco = addslashes($_POST['troco']);
                $troco = str_replace('.', '', $troco);
                $troco = str_replace(',', '.', $troco);
                $troco = str_replace('-', '', $troco);
                $cpf = addslashes($_POST['cpf']);
                $cpf = str_replace('.', '', $cpf);
                $cpf = str_replace(',', '.', $cpf);
                $cpf = str_replace('-', '', $cpf);               
                $cnpj = addslashes($_POST['cnpj']);
                $cnpj = str_replace('.', '', $cnpj);
                $cnpj = str_replace(',', '', $cnpj);
                $cnpj = str_replace('-', '', $cnpj);
                $cnpj = str_replace('/', '', $cnpj);
                $sub_total = addslashes($_POST['sub_total']);
                $sub_total = str_replace('.', '', $sub_total);
                $sub_total = str_replace(',', '.', $sub_total);
                $acrescimo = addslashes($_POST['acrescimo']);
                $acrescimo = str_replace('.', '', $acrescimo);
                $acrescimo = str_replace(',', '.', $acrescimo);
                $modelo = addslashes($_POST['modelo']);
                $tpImp = addslashes($_POST['tpImp']);
                $infCpl = addslashes($_POST['infCpl']);
                $tpNF = addslashes($_POST['tpNF']);
                $tpAmb = addslashes($_POST['tpAmb']);
                $finNFe = addslashes($_POST['finNFe']);
                $indPres = addslashes($_POST['indPres']);
                $indFinal = addslashes($_POST['indFinal']);
                $idDest = addslashes($_POST['idDest']);
                $modFrete = addslashes($_POST['modFrete']);
                $item = addslashes($_POST['item']);
                $qVol = addslashes($_POST['qVol']);
                $esp = addslashes($_POST['esp']);
                $marca = addslashes($_POST['marca']);
                $nVol = addslashes($_POST['nVol']);
                $pesoL = addslashes($_POST['pesoL']);
                $pesoB = addslashes($_POST['pesoB']);
                $placa = addslashes($_POST['placa']);
                $UF = addslashes($_POST['UF']);
                $RNTC = addslashes($_POST['RNTC']);
                $quant = $_POST['quant'];
                $trans_id = addslashes($_POST['trans_id']);  

                $s->addSale($u->getCompany(), $salesman_id, $client_id,  $u->getId(), $quant, $status, $forma, $band, $desconto,$recebido, $troco, $cpf, $cnpj, $sub_total, $acrescimo, $modelo,
                  $tpImp, $infCpl,$tpNF, $tpAmb, $finNFe, $indPres, $indFinal, $idDest, $modFrete, $item,
                  $qVol, $esp, $marca, $nVol, $pesoL, $pesoB,$placa, $UF, $RNTC, $trans_id);
                header("Location: ".BASE_URL."/sales");
               }
              
                $data['states'] = $ci->getStates();

                $this->loadTemplate('sales_troca2', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

    }


 public function troca(){

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

            if($u->hasPermission('sales_view')){
               $s = new Sales();
        $ci = new Cidade();


               if(isset($_POST['quant']) && !empty($_POST['quant'])){

                $quant = $_POST['quant'];
                $s->trocaSale($u->getCompany(), $quant, $u->getId());
                header("Location: ".BASE_URL."/sales/add2");
               }
              
                $data['states'] = $ci->getStates();

                $this->loadTemplate('sales_troca', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

    }


     public function cupom($id){

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

           $data['formases'] = array(
                '01'=>'Dinheiro',
                '02'=>'Cheque',
                '03'=>'Cartão de Crédito',
                '04'=>'Cartão de Débito',
                '05'=>'Crédito Loja',
                '10'=>'Vale Alimentação',
                '11'=>'Vale Refeição',
                '12'=>'Vale Presente',
                '13'=>'Vale Combustível',
                '15'=>'Boleto Bancário',
                '90'=>'Sem Pagamento',
                '99'=>'Outros'
                 );
 
            $data['bandcard'] = array(
                '01'=>'Visa',
                '02'=>'MasterCard',
                '03'=>'American Express',
                '04'=>'Sorocred',
                '05'=>'Diners Club',
                '06'=>'Elo',
                '07'=>'Hipercard',
                '08'=>'Aura',
                '09'=>'Cabal',
                '99'=>'Outros'
                 );
    
        $data['statuses'] = array(
                '0'=>'Aguard. pag.',
                '1'=>'Pago',
                '2'=>'Cancelado',
                '3'=>'Troca',
                '4'=>'Orcamento'
            );


            if($u->hasPermission('sales_view')){
               $s = new Sales();
              
               }

                $data['sales_info'] = $s->getInfo($id, $u->getCompany());
                $data['permission_edit'] = $u->hasPermission('sales_edit');
                    

                    $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("sales_cupom_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF('utf-8', [80, 500]);
            $mpdf->WriteHTML($html);
            $mpdf->Output();


            header("Location: ".BASE_URL);

        } 

    public function edit($id){

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

         $data['formases'] = array(
                '01'=>'Dinheiro',
                '02'=>'Cheque',
                '03'=>'Cartão de Crédito',
                '04'=>'Cartão de Débito',
                '05'=>'Crédito Loja',
                '10'=>'Vale Alimentação',
                '11'=>'Vale Refeição',
                '12'=>'Vale Presente',
                '13'=>'Vale Combustível',
                '15'=>'Boleto Bancário',
                '90'=>'Sem Pagamento',
                '99'=>'Outros'
                 );

            $data['bandcard'] = array(
                '01'=>'Visa',
                '02'=>'MasterCard',
                '03'=>'American Express',
                '04'=>'Sorocred',
                '05'=>'Diners Club',
                '06'=>'Elo',
                '07'=>'Hipercard',
                '08'=>'Aura',
                '09'=>'Cabal',
                '99'=>'Outros'
                 );


       
           $data['statuses'] = array(
                '0'=>'Aguard. pag.',
                '1'=>'Pago',
                '2'=>'Cancelado',
                '3'=>'Troca',
                '4'=>'Orcamento'
            );



            if($u->hasPermission('sales_view')){
               $s = new Sales();
                $data['permission_edit'] = $u->hasPermission('sales_edit');

               if(isset($_POST['status']) && $data['permission_edit']){
                $status =addslashes($_POST['status']);
                $forma =addslashes($_POST['forma']);
                $band =addslashes($_POST['band']);
                $client_id =addslashes($_POST['client_id']);
                $cpf = addslashes($_POST['cpf']);
                $cpf = str_replace('.', '', $cpf);
                $cpf = str_replace(',', '.', $cpf);
                $cpf = str_replace('-', '', $cpf);               
                $cnpj = addslashes($_POST['cnpj']);
                $cnpj = str_replace('.', '', $cnpj);
                $cnpj = str_replace(',', '', $cnpj);
                $cnpj = str_replace('-', '', $cnpj);
                $cnpj = str_replace('/', '', $cnpj);


                 $s->changeSales($status, $forma, $band, $client_id, $cpf, $cnpj, $id, $u->getCompany());
                header("Location: ".BASE_URL."/sales");


                    
           }
                $data['sales_info'] = $s->getInfo($id, $u->getCompany());
                $data['permission_edit'] = $u->hasPermission('sales_edit');
                $this->loadTemplate('sales_edit', $data);
       


        }else{
            header("Location: ".BASE_URL);

        } 

    }


  
}