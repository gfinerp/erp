<?php

use NFePHP\NFe\Make;
use NFePHP\DA\NFe\Danfce;
use NFePHP\DA\NFe\Danfe;
use NFePHP\DA\NFe\Dacce;
use NFePHP\DA\Legacy\FilesFolders;
use NFePHP\NFe\Complements;
use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Common\Standardize;
use NFePHP\Mail\Mail;
use NFePHP\Ibpt\Ibpt;

class Nfe extends model {

public function emitirNFE($cNF, $destinatario, $prods, $fatinfo, $fattroco, $id_sale, $informacoes, $empresa, $infCpl, $transportadora, $volume) {

          $nfe = new Make();

       $nomecertificado = $empresa['nomecertificado'];
       $senhacertificado = $empresa['senhacertificado'];
       $company = $empresa['CNPJ'];
       $nomelogo = $empresa['nomelogo'];

    /** InfNFe **/

          $stdInNFe = new stdClass();
          $stdInNFe->versao = '4.00'; //versão do layout
          $cha = $stdInNFe->Id = null;//se o Id de 44 digitos não for passado será gerado automaticamente
          $stdInNFe->pk_nItem = '' ; //deixe essa variavel sempre como 0.00

          $infNFe = $nfe->taginfNFe($stdInNFe);

     /** IDE **/      
          $stdIde = new stdClass();
          $stdIde->cUF = $empresa['cUF'];
          $stdIde->cNF = $cha;
          $stdIde->natOp = 'VENDA';
          $stdIde->mod = $informacoes['modelo']; // Modelo da Nota 55 NFe ou 65 NFc
          $stdIde->serie = 1;
          $stdIde->nNF = $cNF;
          $stdIde->dhEmi = date("Y-m-d\TH:i:sP");
          $stdIde->dhSaiEnt = date("Y-m-d\TH:i:sP");
          $stdIde->tpNF = $informacoes['tpNF'];  //0=Entrada ou  1=Saída
          $stdIde->idDest = $informacoes['idDest']; // 1 dentro ou 2 fora do estado
          $stdIde->cMunFG = $empresa['cMun']; // codigo do municipio
          $stdIde->tpImp = $informacoes['tpImp']; //0=Sem geração de DANFE; 1=DANFE normal, Retrato; 2=DANFE normal, Paisagem; 3=DANFE Simplificado; 4=DANFE NFC-e; 5=DANFE NFC-e em mensagem eletrônica
          $stdIde->tpEmis = 1; // Contingencia ou normal etc..
          $stdIde->cDV = substr($cha, -1); // digito verificador
          $stdIde->tpAmb = $informacoes['tpAmb']; // tipo de ambiente 1 producao 2 producao
          $stdIde->finNFe = $informacoes['finNFe']; //1 nfe normal 2 nfe complementar 3 nfe ajuste 4 devolucao de mercadoria
          $stdIde->indFinal = $informacoes['indFinal']; //0=Normal; 1=Consumidor final;
          $stdIde->indPres = $informacoes['indPres'];//0=Não se aplica (por exemplo, Nota Fiscal complementar ou de ajuste);1=Operação presencial;2=Operação não presencial, pela Internet;3=Operação não presencial, Teleatendimento;4=NFC-e em operação com entrega a domicílio;9=Operação não presencial, outros.
          $stdIde->procEmi = 0;//0 - emissão de NF-e com aplicativo do contribuinte; 1 - emissão de NF-e avulsa pelo Fisco; 2 - emissão de NF-e avulsa,pelo contribuinte com seu certificado digital, através do site do Fisco;3- emissão NF-e pelocontribuinte com aplicativofornecido pelo Fisco. 
          $stdIde->verProc = '4.0.0';
          $tagide = $nfe->tagide($stdIde);

        if ( $stdIde->finNFe == 4) {
          $stdref = new stdClass();
          $stdref->refNFe = $informacoes['refNFe'];;
          $tagref = $nfe->tagrefNFe($stdref);
        }

            
    /** EMITENTE **/ 
          $stdEmit = new stdClass();
          $stdEmit->xNome = $empresa['xNome'];
          $stdEmit->xFant = $empresa['xFant'];
          $stdEmit->IE = $empresa['IE'] ;
          $stdEmit->CRT = $empresa['CRT'];
          $stdEmit->CNPJ = $empresa['CNPJ']; //indicar apenas um CNPJ ou CPF
          $emit = $nfe->tagemit($stdEmit);

    /**  ENDEREÇO DO EMITENTE **/ 
          $stdEndEmit = new stdClass();
          $stdEndEmit->xLgr = $empresa['xLgr'];
          $stdEndEmit->nro = $empresa['nro'];
          $stdEndEmit->xBairro = $empresa['xBairro'];
          $stdEndEmit->cMun = $empresa['cMun'];
          $stdEndEmit->xMun = $empresa['xMun'];
          $stdEndEmit->UF = $empresa['UF'];
          $stdEndEmit->CEP = $empresa['CEP'];
          $stdEndEmit->cPais = $empresa['cPais'];
          $stdEndEmit->xPais = $empresa['xPais'];
          $stdEndEmit->fone = $empresa['fone'];
          $enderEmit = $nfe->tagenderEmit($stdEndEmit);

    /**DESTINATARIO**/ 
        if(isset($destinatario)){
          $stdDEST = new \stdClass();
          $stdDEST->xNome =  $destinatario['nome'];
          $stdDEST->indIEDest = '9'; 
          $stdDEST->IE =  $destinatario['ie'];
          $stdDEST->ISUF = '';
          $stdDEST->IM = $destinatario['im']; // Insc. Municipal
          $stdDEST->email = $destinatario['email'];
          $stdDEST->CNPJ = $destinatario['cnpj'];
          $stdDEST->CPF = $destinatario['cpf'];
          $stdDEST->idEstrangeiro = $destinatario['idestrangeiro'];
          $DEST = $nfe->tagdest($stdDEST);
        }

     /**ENDERECO DESTINATARIO**/
        if(isset($destinatario['end'])){
          $stdEnderDest = new \stdClass();
          $stdEnderDest->xLgr = $destinatario['end']['logradouro'];
          $stdEnderDest->nro = $destinatario['end']['numero'];
          $stdEnderDest->xCpl = $destinatario['end']['complemento'];
          $stdEnderDest->xBairro = $destinatario['end']['bairro'];
          $stdEnderDest->cMun = $destinatario['end']['cmu']; // Código do Municipio
          $stdEnderDest->xMun = $destinatario['end']['mu'];
          $stdEnderDest->UF = $destinatario['end']['uf'];
          $stdEnderDest->CEP = $destinatario['end']['cep'];
          $stdEnderDest->cPais = $destinatario['end']['cpais']; // Código do País
          $stdEnderDest->xPais = $destinatario['end']['pais'];
          $stdEnderDest->fone = $destinatario['end']['fone'];
          $EnderDest = $nfe->tagenderDest($stdEnderDest);
    }

      /**  PRODUTOS **/ 
          foreach($prods as $pchave => $prod) {
          $stdProd = new stdClass();
          $stdProd->item = $pchave+1; //item da NFe
          $stdProd->cProd = $prod['cProd'];
          $stdProd->cEAN = "SEM GTIN";
          $stdProd->xProd = $prod['xProd'];
          $stdProd->NCM = $prod['NCM'];
          $stdProd->cBenef = "";
          $stdProd->EXTIPI = $prod['EXTIPI'];
          $stdProd->CFOP = $prod['CFOP'];
          $stdProd->uCom = $prod['uCom'];
          $stdProd->qCom = $prod['qCom'];
          $stdProd->vUnCom = $prod['vUnCom'];
          $stdProd->vProd = $prod['vProd'];
          $stdProd->cEANTrib = "SEM GTIN";
          $stdProd->uTrib = $prod['uTrib'];
          $stdProd->qTrib = $prod['qTrib'];
          $stdProd->vUnTrib = $prod['vUnTrib'];
          $stdProd->vFrete = $prod['vFrete'];
          $stdProd->vSeg = $prod['vSeg'];
          $stdProd->vDesc = $prod['vDesc'];
          $stdProd->vOutro = $prod['vOutro'];
          $stdProd->indTot = $prod['indTot'];
          $stdProd->xPed = $prod['xPed'];
          $stdProd->nItemPed = $prod['nItemPed'];
          $stdProd->nFCI = $prod['nFCI'];
          $tprod = $nfe->tagprod($stdProd);

      /**  IMPOSTOS **/ 

          //Consulta Impostos Nacional, Estadual Municipal e Importado de acordo com a tabela IBPT;
          $token = $empresa['token'];//"SE NÃO CADASTRAR O TOKEN no site (www.deolhonoimposto.com) O IMPOSTO VAI COMO 0,00" ex: RoC99tI6R8GocyG2-452W8-N80XBj6cMFW3I-WFvE-_ALeRGH7nCKttK1QgUFr1c
          $cnpj =  $stdEmit->CNPJ;
          $ncm = $stdProd->NCM; //coloque o NCM do produto
          $uf =  $stdEndEmit->UF; //coloque o estado que deseja saber os dados
          $extarif = 0; //indique o numero da exceção tarifaria, se existir ou deixe como zero
          $codigoInterno = '';
          $descricao = $stdProd->xProd;
          $unidadeMedida =  $stdProd->uCom;
          $valor = $stdProd->vProd;
          $gtin = 'SEM GTIN';
          
          $ibpt = new Ibpt($cnpj, $token);
          $resp = $ibpt->productTaxes(
          $uf,
          $ncm,
          $extarif,
          $descricao,
          $unidadeMedida,
          $valor,
          $gtin,
          $codigoInterno
          );

          $stdImposto = new stdClass();
          $stdImposto->item = ($pchave+1); //item da NFe
          $Nacional = $resp->Nacional; $Estadual = $resp->Estadual; $Importado = $resp->Importado; $Municipal = $resp->Municipal; // DADOS DE ACORDO COM A TABELA IBPT
          //calculo do imposto
          $stdImposto->vTotTrib = number_format($stdProd->vProd-$stdProd->vProd/100*$Nacional-$stdProd->vProd/100*$Estadual-$stdProd->vProd/100*$Importado-$stdProd->vProd/100*$Municipal,2,'.','');
          $stdImposto->vTotTrib = number_format($stdProd->vProd-$stdImposto->vTotTrib,2,'.','');
        
          $imposto = $nfe->tagimposto($stdImposto);
          

      if ($stdEmit->CRT == 3) {

          /** ICMS REGIME NORMAL**/ 
          $stdICMS = new stdClass();
          $stdICMS->item = ($pchave+1); //item da NFe
          $stdICMS->orig = 0;
          $stdICMS->CST = "10";
          $stdICMS->vBC = $stdProd->vProd;
          $stdICMS->modBC = "0";
          $stdICMS->pICMS = $informacoes['pICMS']; //porcentagem icms resime normal
          $stdICMS->vICMS = number_format($stdICMS->vBC * ($stdICMS->pICMS / 100),2);   
          $stdICMS->pFCP  = "1";
          $stdICMS->vFCP = "0.00";
          $stdICMS->vBCFCP = "0.00";
          $stdICMS->modBCST = "0";
          $stdICMS->pMVAST = "0.00";
          $stdICMS->pRedBCST = "0.00";
          $stdICMS->vBCST = "0";
          $stdICMS->pICMSST = "0";
          $stdICMS->vICMSST = "0";
          $stdICMS->vBCFCPST = "0";
          $stdICMS->pFCPST = "1.00";
          $stdICMS->vFCPST = "0";
          $stdICMS->vICMSDeson = "0";
          $stdICMS->motDesICMS = "0";
          $stdICMS->pRedBC = "0";
          $stdICMS->vICMSOp = "0";
          $stdICMS->pDif = "0";
          $stdICMS->vICMSDif = "0";
          $stdICMS->vBCSTRet = "0";
          $stdICMS->pST = "0";
          $stdICMS->vICMSSTRet = "";
          $stdICMS->vBCFCPSTRet = "";
          $stdICMS->pFCPSTRet = "";
          $stdICMS->vFCPSTRet = "";
          $stdICMS->pRedBCEfet = "";
          $stdICMS->vBCEfet = "";
          $stdICMS->pICMSEfet = "";
          $stdICMS->vICMSEfet = "";
          
          $ICMS = $nfe->tagICMS($stdICMS);
                       
          }
          
  if ($stdEmit->CRT == 1) {

      /** ICMS REGIME NORMAL CONFIGURACOES SIMMPLES NACIONAL**/ 
          $stdICMS = new stdClass();
          $stdICMS->item = ($pchave+1); //item da NFe
          $stdICMS->orig = 0;
          $stdICMS->CST = "07";
          $ICMS = $nfe->tagICMS($stdICMS);


      /** ICMS  SIMPLES NACIONAL**/ 
          $stdICMSSN = new stdClass();
          $stdICMSSN->item = ($pchave+1); //item da NFe
          $stdICMSSN->orig = 0;
          $stdICMSSN->CSOSN = '102';
          $stdICMSSN->pCredSN = "";
          $stdICMSSN->vCredICMSSN = "";
          $stdICMSSN->modBCST = "";
          $stdICMSSN->pMVAST = "";
          $stdICMSSN->pRedBCST = "";
          $stdICMSSN->vBCST = "";
          $stdICMSSN->pICMSST = "";
          $stdICMSSN->vICMSST = "";
          $stdICMSSN->vBCFCPST = ""; //incluso no layout 4.00
          $stdICMSSN->pFCPST = ""; //incluso no layout 4.00
          $stdICMSSN->vFCPST = ""; //incluso no layout 4.00
          $stdICMSSN->vBCSTRet = "";
          $stdICMSSN->pST = "";
          $stdICMSSN->vICMSSTRet = "";
          $stdICMSSN->vBCFCPSTRet = ""; //incluso no layout 4.00
          $stdICMSSN->pFCPSTRet = ""; //incluso no layout 4.00
          $stdICMSSN->vFCPSTRet = ""; //incluso no layout 4.00
          $stdICMSSN->modBC = "";
          $stdICMSSN->vBC = "";
          $stdICMSSN->pRedBC = "";
          $stdICMSSN->pICMS = "";
          $stdICMSSN->vICMS = "";
          $stdICMSSN->pRedBCEfet = "";
          $stdICMSSN->vBCEfet = "";
          $stdICMSSN->pICMSEfet = "";
          $stdICMSSN->vICMSEfet = "";
          $ICMSSN = $nfe->tagICMSSN($stdICMSSN);
}
      /**PIS**/ 
          $stdPIS = new stdClass();
          $stdPIS->item = ($pchave+1); //item da NFe
          $stdPIS->CST = '07'; 
          $stdPIS->vBC = "";
          $stdPIS->pPIS = "";
          $stdPIS->vPIS = "";
          $stdPIS->qBCProd = "";
          $stdPIS->vAliqProd = "";
          $PIS = $nfe->tagPIS($stdPIS);

      /**COFINS**/ 
          $stdCOFINS = new stdClass();
          $stdCOFINS->item = ($pchave+1);  //item da NFe
          $stdCOFINS->CST = '07';
          $stdCOFINS->vBC = "";
          $stdCOFINS->pCOFINS = "";
          $stdCOFINS->vCOFINS = "";
          $stdCOFINS->qBCProd = "";
          $stdCOFINS->vAliqProd = "";
          $COFINS = $nfe->tagCOFINS($stdCOFINS);
    }
      /**TOTAIS**/ 
          $stdICMSTot = new stdClass();
          $stdICMSTot->vBC = "0.00";
          $stdICMSTot->vICMS = "0.00";
          $stdICMSTot->vICMSDeson = "";
          $stdICMSTot->vFCP = ""; //incluso no layout 4.00
          $stdICMSTot->vBCST = "";
          $stdICMSTot->vST = "";
          $stdICMSTot->vFCPST = ""; //incluso no layout 4.00
          $stdICMSTot->vFCPSTRet = ""; //incluso no layout 4.00
          $stdICMSTot->vProd = "";
          $stdICMSTot->vFrete = "";
          $stdICMSTot->vSeg = "";
          $stdICMSTot->vDesc = "";
          $stdICMSTot->vII = "";
          $stdICMSTot->vIPI = "";
          $stdICMSTot->vIPIDevol = ""; //incluso no layout 4.00
          $stdICMSTot->vPIS = "";
          $stdICMSTot->vCOFINS = "";
          $stdICMSTot->vOutro = "";
          $stdICMSTot->vNF ="" ;
          $stdICMSTot->vTotTrib ="";
          $ICMSTot = $nfe->tagICMSTot($stdICMSTot);

    /**TRANSPORTADORA**/ 
          $stdFrete = new stdClass();
          $stdFrete->modFrete = $informacoes['modFrete'];//0=Contratação do Frete por conta do Remetente (CIF); 1=Contratação do Frete por conta do Destinatário (FOB); 2=Contratação do Frete por conta de Terceiros; 3=Transporte Próprio por conta do Remetente; 4=Transporte Próprio por conta do Destinatário; 9=Sem Ocorrência de Transporte. 
          $Frete = $nfe->tagtransp($stdFrete);
  
  if ($stdFrete->modFrete != 9) {

          $stdTransp = new stdClass();
          $stdTransp->xNome =  $transportadora['xNome'];
          $stdTransp->IE =  $transportadora['IE'];
          $stdTransp->xEnder =  $transportadora['xEnder'];
          $stdTransp->xMun =  $transportadora['xMun'];
          $stdTransp->UF =  $transportadora['UF'];
          $stdTransp->CNPJ =  $transportadora['CNPJ'];//só pode haver um ou CNPJ ou CPF, se um deles é especificado o outro deverá ser null
          $stdTransp->CPF =  $transportadora['CPF'];
          $Transp = $nfe->tagtransporta($stdTransp);
}
          if(isset($veiculo)){
          $stdVeic = new stdClass();
          $stdVeic->placa = $veiculo['placa'];
          $stdVeic->UF = $veiculo['UF'];
          $stdVeic->RNTC = $veiculo['RNTC'];
          $Veic = $nfe->tagveicTransp($stdVeic);
}
          $stdVol = new stdClass();
          $stdVol->item = $volume['item']; //indicativo do numero do volume
          $stdVol->qVol = $volume['qVol'];
          $stdVol->esp =  $volume['esp'];
          $stdVol->marca = $volume['marca'];
          $stdVol->nVol = $volume['nVol'];
          $stdVol->pesoL = $volume['pesoL'];
          $stdVol->pesoB = $volume['pesoB'];
          $Vol = $nfe->tagvol($stdVol);

          /**TROCO PAGAMENTO PARA NFC**/ 
          $stdTROCO = new stdClass();
          $stdTROCO->vTroco = $fattroco['vTroco']; //incluso no layout 4.00, obrigatório informar para NFCe (65)
          $TROCO = $nfe->tagpag($stdTROCO);

      /**INFORMAÇOES PAGAMENTO**/ 
          $stdPAG = new stdClass();
          $stdPAG->tPag = $fatinfo['tpag'];
          $stdPAG->vPag = $fatinfo['vorig']; //Obs: deve ser informado o valor pago pelo cliente
          $stdPAG->CNPJ = $fatinfo['cnpj'];
          $stdPAG->tBand = $fatinfo['tBand'];
          $stdPAG->cAut = $fatinfo['cAut'];
          $stdPAG->tpIntegra = $fatinfo['tpIntegra']; //incluso na NT 2015/002
          $stdPAG->indPag = $fatinfo['indPag']; //0= Pagamento à Vista 1= Pagamento à Prazo
          $PAG = $nfe->tagdetPag($stdPAG);


      /**INFORMAÇOES ADICIONAIS**/ 

          $stdADIC = new stdClass();
          $stdADIC->infAdFisco = $infCpl['infAdFisco'];
          $stdADIC->infCpl = $infCpl['infCpl'];
          $InfAdic = $nfe->taginfAdic($stdADIC);

          $result = $nfe->montaNFe();
          $chave = $nfe->getChave();



         if ($stdIde->tpAmb == 1) {
              $ambiente = 'producao';
         }else{
              $ambiente = 'homologacao';
         }

          if($result === true) {
          $xml = $nfe->getXML();
          $Ym = strftime("%m-%Y");
          $config  = [
          "atualizacao"=>date('Y-m-d h:i:s'),
         "tpAmb"=> (int)$stdIde->tpAmb,
          "razaosocial" => $empresa['xNome'] ,
          "cnpj" => $empresa['CNPJ'], // PRECISA SER VÁLIDO
          "ie" => $empresa['IE'], // PRECISA SER VÁLIDO
          "siglaUF" =>  $empresa['UF'],
          "schemes" => "PL_009_V4",
          "versao" => "4.00",
          "tokenIBPT" => "AAAAAAA",
          "CSC" => $empresa['CSC'], //csc homologacao f6b3b1f21e559c0d
          "CSCid" => $empresa['CSCid'],//homologacao 000003
          "aProxyConf" => [
              "proxyIp" => "",
              "proxyPort" => "",
              "proxyUser" => "",
              "proxyPass" => ""
          ]

      ];
        $nomecertificado = $empresa['nomecertificado'];
          $senhacertificado = $empresa['senhacertificado'];
          $nomelogo ="";
          $company = $empresa['CNPJ'];

          $configJson = json_encode($config);
          $certificadoDigital = file_get_contents('./nfe/cert/'.$nomecertificado);
          $tools = new NFePHP\NFe\Tools($configJson, NFePHP\Common\Certificate::readPfx($certificadoDigital, $senhacertificado));
          $tools->model($informacoes['modelo']);

  /**ASSINA XML**/ 
        try {

          $xmlAssinado = $tools->signNFe($xml); // O conteúdo do XML assinado fica armazenado na variável $xmlAssinado
          } catch (\Exception $e) {
          //aqui você trata possíveis exceptions da assinatura
          exit($e->getMessage());
          }
          @mkdir("nfe/files/nfe/{$ambiente}/assinadas/{$Ym}/", 0777, true);
          $filename = "nfe/files/nfe/{$ambiente}/assinadas/{$Ym}/{$chave}-nfe.xml"; // Ambiente Windows
          @file_put_contents($filename, $xmlAssinado);
          @chmod($filename, 0777);

  /**ENVIA LOTE**/ 

           try {
          $xmls = array();
          $idLote = substr(str_replace(',', '', number_format(microtime(true)*1000000, 0)), 0, 15);
          $resp = $tools->sefazEnviaLote(array($xmlAssinado), $idLote, 1, false, $xmls);
  /**AUTORIZA XML E SALVA ARQUIVOS DE RESPOSTA**/ 
          $st = new NFePHP\NFe\Common\Standardize();
          $std = $st->toStd($resp);
          @mkdir("nfe/files/nfe/{$ambiente}/resposta/{$Ym}/", 0777, true);
          $filename = "nfe/files/nfe/{$ambiente}/resposta/{$Ym}/{$idLote}-retEnviNFe.xml"; // Ambiente Windows
          @file_put_contents($filename, $resp);
          @chmod($filename, 0777);

  //      $recibo = $std->infRec->nRec; // Vamos usar a variável $recibo para consultar o status da nota
          } catch (\Exception $e) {
          //aqui você trata possiveis exceptions do envio
          exit($e->getMessage());
          }

  /**ADICIONA PROTOCOLO AO XML ASSINADO**/ 
          $request = "nfe/files/nfe/{$ambiente}/assinadas/{$Ym}/{$chave}-nfe.xml";
          $response = file_get_contents($request);
          $xml_protocolado = Complements::toAuthorize($response, $resp);
          @mkdir("nfe/files/nfe/{$ambiente}/enviadas/aprovadas/{$Ym}/", 0777, true);
          $filename = "nfe/files/nfe/{$ambiente}/enviadas/aprovadas/{$Ym}/{$chave}-protNFe.xml"; // Ambiente Windows
          @file_put_contents($filename, $xml_protocolado);
          @chmod($filename, 0777);

    /**GERA DANFE**/ 
          $danf = "nfe/files/nfe/{$ambiente}/enviadas/aprovadas/{$Ym}/{$chave}-protNFe.xml";
          $pathLogo ="./assets/images/".$nomelogo;

          if(file_exists($danf)){
            if ($stdIde->mod == 55) {

          $docxml = FilesFolders::readFile($danf);
          $danfe = new Danfe($docxml, 'P', 'A4', './assets/images/'.$nomelogo, 'I', '');
          $id = $danfe->montaDANFE();
          $pdf = $danfe->render();
          @mkdir("nfe/files/nfe/{$ambiente}/pdf/{$Ym}/", 0777, true);
          $filename = "nfe/files/nfe/{$ambiente}/pdf/{$Ym}/{$chave}-danfe.pdf";
          @file_put_contents($filename, $pdf);
          @chmod($filename, 0777);
          header("Location: ".BASE_URL."/sales");      
          }else{
          $docxml = FilesFolders::readFile($danf);
          $danfce = new Danfce($docxml, $pathLogo, 0);
          $id = $danfce->monta();
          $pdf = $danfce->render();
          @mkdir("nfe/files/nfe/{$ambiente}/pdf/{$Ym}/", 0777, true);
          $filename = "nfe/files/nfe/{$ambiente}/pdf/{$Ym}/{$chave}-danfe.pdf";
          @file_put_contents($filename, $pdf);
          @chmod($filename, 0777);
          header("Location: ".BASE_URL."/sales");
          }
  /**ADICIONA CHAVE NO BANCO DE DADOS**/ 

          $sql = $this->db->prepare("UPDATE sales SET nfe_key = :nfe_key WHERE id = :id ");
          $sql->bindValue(":nfe_key", $chave);
          $sql->bindValue(":id", $id_sale);
          $sql->execute();

          $sql = $this->db->prepare("UPDATE devolucao SET nfe_key = :nfe_key WHERE id = :id ");
          $sql->bindValue(":nfe_key", $chave);
          $sql->bindValue(":id", $id_sale);
          $sql->execute();
            /**ADICIONA PROTOCOLO NO BANCO DE DADOS**/ 

          $protocolo = $std->protNFe->infProt->nProt;
          $sql = $this->db->prepare("UPDATE sales SET nprot = :nprot WHERE id = :id ");
          $sql->bindValue(":nprot", $protocolo);
          $sql->bindValue(":id", $id_sale);
          $sql->execute();
       
          // $sql = $this->db->prepare("UPDATE devolucao SET nprot = :nprot WHERE id = :id ");
          // $sql->bindValue(":nprot", $protocolo);
          // $sql->bindValue(":id", $id_sale);
          // $sql->execute();
            
          }else{
              echo "XML nao encontrado!";
          }
}
        }

        public function cancela($nfe_key, $empresa, $informacoes, $empresacert){
     
       $nomecertificado = $empresacert['nomecertificado'];
       $senhacertificado = $empresa['senhacertificado'];
       $company = $empresa['CNPJ'];


       if ($informacoes['tpAmb'] == 1) {
          $ambiente = 'producao';
     }else{
          $ambiente = 'homologacao';
          }

           $Ym = strftime("%m-%Y");

        $config  = [
          "atualizacao"=>date('Y-m-d h:i:s'),
          "tpAmb"=> (int)$informacoes['tpAmb'],
          "razaosocial" => $empresa['xNome'] ,
          "cnpj" => $empresa['CNPJ'], // PRECISA SER VÁLIDO
          "ie" => $empresa['IE'], // PRECISA SER VÁLIDO
          "siglaUF" =>  $empresa['UF'],
          "schemes" => "PL_009_V4",
          "versao" => "4.00",
          "tokenIBPT" => "AAAAAAA",
          "CSC" => $empresa['CSC'], //csc homologacao f6b3b1f21e559c0d
          "CSCid" => $empresa['CSCid'],//homologacao 000003
          "aProxyConf" => [
              "proxyIp" => "",
              "proxyPort" => "",
              "proxyUser" => "",
              "proxyPass" => ""
          ]
      ];
   
          $configJson = json_encode($config);

          $certificadoDigital = file_get_contents('./nfe/cert/'.$nomecertificado);

  
try {
   
          $tools = new NFePHP\NFe\Tools($configJson, NFePHP\Common\Certificate::readPfx($certificadoDigital, $senhacertificado));
          $tools->model($informacoes['modelo']);
          $numprot = array();

          $sql = $this->db->prepare("SELECT * FROM sales WHERE  nfe_key = :nfe_key ");
          $sql->bindValue(":nfe_key", $nfe_key);
          $sql->execute();


          if($sql->rowCount() > 0){
              $numprot = $sql->fetch();
          }

          $chave = $nfe_key;
          $xJust = 'Erro de digitação nos dados dos produtos';
          $nProt = $numprot['nprot'];
          $response = $tools->sefazCancela($chave, $xJust, $nProt);

          //você pode padronizar os dados de retorno atraves da classe abaixo
          //de forma a facilitar a extração dos dados do XML
          //NOTA: mas lembre-se que esse XML muitas vezes será necessário, 
          //      quando houver a necessidade de protocolos
          $stdCl = new NFePHP\NFe\Common\Standardize($response);
          //nesse caso $std irá conter uma representação em stdClass do XML
          $std = $stdCl->toStd();
          //nesse caso o $arr irá conter uma representação em array do XML
          $arr = $stdCl->toArray();
          //nesse caso o $json irá conter uma representação em JSON do XML
          $json = $stdCl->toJson();

       
    
          $xmlcancelado = Complements::toAuthorize($tools->lastRequest, $response);
    
          $cStat = $std->retEvento->infEvento->cStat;
          $sql = $this->db->prepare("UPDATE sales SET cStat = :cStat WHERE nfe_key = :nfe_key ");
          $sql->bindValue(":cStat", $cStat);
          $sql->bindValue(":nfe_key", $nfe_key);
          $sql->execute();


          @mkdir("nfe/files/nfe/{$ambiente}/canceladas/{$Ym}/", 0777, true);
          $filename = "nfe/files/nfe/{$ambiente}/canceladas/{$Ym}/{$nfe_key}-protCancNFe.xml"; // Ambiente Windows
          @file_put_contents($filename, $xmlcancelado);
          @chmod($filename, 0777);          
   

          $nfecancel = "nfe/files/nfe/{$ambiente}/enviadas/aprovadas/{$Ym}/{$nfe_key}-protNFe.xml";
          $cancelamento = "nfe/files/nfe/{$ambiente}/canceladas/{$Ym}/{$nfe_key}-protCancNFe.xml";
          $resp = file_get_contents($nfecancel);
          $respcancel = file_get_contents($cancelamento);

        try {
          $xml = Complements::cancelRegister($resp, $respcancel);
          @mkdir("nfe/files/nfe/{$ambiente}/canceladas_vinculadas/{$Ym}/", 0777, true);
          $filename = "nfe/files/nfe/{$ambiente}/canceladas_vinculadas/{$Ym}/{$nfe_key}-protCancNFe.xml"; // Ambiente Windows  
          @file_put_contents($filename, $xml);
          @chmod($filename, 0777);          

          $danf = "nfe/files/nfe/{$ambiente}/canceladas_vinculadas/{$Ym}/{$nfe_key}-protCancNFe.xml";

          $pathLogo ="./assets/images/".$nomelogo;

          if ($informacoes['modelo'] == 55) {

          $docxml = FilesFolders::readFile($danf);
          $danfe = new Danfe($docxml, 'P', 'A4', './assets/images/'.$nomelogo, 'I', '');
          $id = $danfe->montaDANFE();
          $pdf = $danfe->render();
          @mkdir("nfe/files/nfe/{$ambiente}/pdf_cancelado/{$Ym}/", 0777, true);
          $filename = "nfe/files/nfe/{$ambiente}/pdf_cancelado/{$Ym}/{$nfe_key}-Cancdanfe.pdf";
          @file_put_contents($filename, $pdf);
          @chmod($filename, 0777);
          header("Location: ".BASE_URL."/sales");
          }else{
          $docxml = FilesFolders::readFile($danf);
          $danfce = new Danfce($docxml, $pathLogo, 0);
          $id = $danfce->monta();
          $pdf = $danfce->render();
          @mkdir("nfe/files/nfe{$ambiente}/pdf_cancelado/{$Ym}/", 0777, true);
          $filename = "nfe/files/nfe/{$ambiente}/pdf_cancelado/{$Ym}/{$nfe_key}-Cancdanfe.pdf";
          @file_put_contents($filename, $pdf);
          @chmod($filename, 0777);
          header("Location: ".BASE_URL."/sales");
          
}
        } catch (\Exception $e) {
        echo "Erro: " . $e->getMessage();
        }

} catch (\Exception $e) {
    echo $e->getMessage();
}

        

}
      }