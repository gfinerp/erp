<?php 

class Sales extends model{


    public function getNfe($nfe_key, $id_company){
        $array = array();


            $sql = $this->db->prepare("SELECT * FROM sales WHERE  id_company = :id_company AND nfe_key = :nfe_key ");
            $sql->bindValue(":id_company", $id_company);
            $sql->bindValue(":nfe_key", $nfe_key);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetch();
            }
             return $array;
    }
    public function getList($offset, $id_company){
        $array = array();


            $sql = $this->db->prepare("SELECT * FROM sales WHERE  id_company = :id_company LIMIT $offset, 10");
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }


        $sql = $this->db->prepare("
            SELECT 
                sales.id, 
                sales.date_sale,
                sales.desconto,
                sales.acrescimo,
                sales.modelo,
                sales.infCpl,
                sales.tpImp,
                sales.tpNF,
                sales.tpAmb,
                sales.finNFe,
                sales.indPres,
                sales.indFinal,
                sales.idDest,
                sales.modFrete,
                sales.item,
                sales.qVol,
                sales.esp,
                sales.marca,
                sales.nVol,
                sales.pesoL,
                sales.pesoB,
                sales.placa,
                sales.UF,
                sales.RNTC,
                sales.troco,
                sales.total_price,
                sales.sub_total,
                sales.status,
                sales.forma,
                sales.band,
                sales.nfe_key,
                sales.nprot,
                transportadora.xNome,
                transportadora.IE,
                transportadora.xEnder,
                transportadora.xMun,
                transportadora.UF,
                transportadora.CNPJ,
                transportadora.CPF,
                clients.name,
                clients.cpf,
                clients.cnpj,
                clients.adress_zipcode,
                clients.adress,
                clients.adress_number,
                clients.adress_neighb,
                clients.adress_state,
                clients.adress_city,
                salesman.name_vendedor
            FROM sales
            LEFT JOIN transportadora ON transportadora.id = sales.trans_id
            LEFT JOIN clients ON clients.id = sales.id_client
            LEFT JOIN salesman ON salesman.id = sales.id_salesman  
            WHERE 
                sales.id_company = :id_company
            ORDER BY  sales.date_sale DESC
            LIMIT $offset, 10");


     $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }   



public function getCount($id_company){
    $r = 0;

    $sql = $this->db->prepare("SELECT COUNT(*) as s FROM sales WHERE id_company = :id_company");
    $sql->bindValue(":id_company" , $id_company);
    $sql->execute();


    $row = $sql->fetch();
        $r = $row['s'];

    return $r;

}


public function getAllInfo($id_sale, $id_company){
        $array = array();

            $sql = "SELECT * FROM sales WHERE id = :id";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_sale);
            $sql->execute();

             if($sql->rowCount() > 0){
            $array['info'] = $sql->fetch();
         

        }

        $sql = "SELECT * FROM sales_products WHERE id_sale = :id_sale";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id_sale", $id_sale);
    $sql->execute();


       
     
            if($sql->rowCount() > 0){
            $array['products'] = $sql->fetchAll();
                    $i = new Inventory();

            foreach ($array['products'] as $pkey => $pval) {
                    $array['products'][$pkey]['c'] = $i->getInfo($pval['id_product'], $id_company);


            }

        }

        return $array;

}

public function setNFEKey($chave, $id_sale){

    $sql = $this->db->prepare("UPDATE sales SET nfe_key = :nfe_key WHERE id = :id ");
    $sql->bindValue(":nfe_key", $chave);
    $sql->bindValue(":id", $id_sale);
    $sql->execute();
}

public function getCaixa($id, $id_company){

            $array = array();

        $sql = $this->db->prepare("
        SELECT
         *,
         ( select clients.name from clients where clients.id = sales.id_client ) as client_name,
         ( select salesman.name_vendedor from salesman where salesman.id = sales.id_salesman ) as salesman_name_vendedor
        FROM sales 
        WHERE
         id = :id AND
          id_company = :id_company");

 $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

          if($sql->rowCount() > 0){
            $array['info'] = $sql->fetch();

        }

        $sql = $this->db->prepare("
            SELECT
               sales_products.quant,
               sales_products.sale_price,
               inventory.name,
               inventory.code
               FROM sales_products
               LEFT JOIN inventory
                ON inventory.id = sales_products.id_product
               WHERE
                 sales_products.id_sale = :id_sale AND
                 sales_products.id_company = :id_company");
        $sql->bindValue(":id_sale", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
           


          if($sql->rowCount() > 0){
            $array['products'] = $sql->fetchAll();

        }
   


        return $array;
    }




 public function addSale($id_company, $id_salesman, $id_client = '',  $user_id, $quant, 
    $status, $forma,$band, $desconto = '', $recebido = '', $troco = '',$cpf = '',$cnpj = '', $sub_total,
     $acrescimo = '',$modelo, $tpImp, $infCpl, $tpNF, $tpAmb, $finNFe, $indPres, $idDest, $indFinal,
     $modFrete, $item = '', $qVol = '', $esp = '', $marca = '', $nVol = '', $pesoL = '', $pesoB = '',
      $placa = '', $UF = '', $RNTC = '', $trans_id = ''){
        $i = new Inventory();

        //inserindo a venda
        $sql = $this->db->prepare("INSERT INTO sales SET id_company = :id_company,
            id_salesman = :id_salesman, id_client = :id_client, cpf = :cpf, cnpj = :cnpj,
            id_user = :id_user, date_sale = NOW(), total_price = :total_price,
            sub_total=:sub_total, desconto = :desconto, acrescimo = :acrescimo, modelo = :modelo,
            tpImp = :tpImp, infCpl = :infCpl, tpNF = :tpNF, tpAmb = :tpAmb,
            finNFe = :finNFe, indPres = :indPres, indFinal = :indFinal,
            idDest = :idDest, modFrete = :modFrete, item = :item, qVol = :qVol,
            esp = :esp, marca = :marca, nVol = :nVol, pesoL = :pesoL, pesoB = :pesoB,
            placa = :placa, UF = :UF, RNTC = :RNTC, trans_id = :trans_id,
            recebido = :recebido, troco = :troco,
            status = :status, forma = :forma, band = :band");
 
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_salesman", $id_salesman);
        $sql->bindValue(":id_client", $id_client);
        $sql->bindValue(":id_user", $user_id);
        $sql->bindValue(":total_price",  '0');
        $sql->bindValue(":desconto", $desconto);
        $sql->bindValue(":recebido", $recebido);
        $sql->bindValue(":troco", $troco);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":acrescimo", $acrescimo);
        $sql->bindValue(":sub_total", $sub_total);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":forma", $forma);
        $sql->bindValue(":band", $band);
        $sql->bindValue(":modelo", $modelo);
        $sql->bindValue(":tpImp", $tpImp);
        $sql->bindValue(":infCpl", $infCpl);
        $sql->bindValue(":tpNF", $tpNF);
        $sql->bindValue(":tpAmb", $tpAmb);
        $sql->bindValue(":finNFe", $finNFe);
        $sql->bindValue(":indPres", $indPres);
        $sql->bindValue(":indFinal", $indFinal);
        $sql->bindValue(":idDest", $idDest);
        $sql->bindValue(":modFrete", $modFrete);
        $sql->bindValue(":item", $item);
        $sql->bindValue(":qVol", $qVol);
        $sql->bindValue(":esp", $esp);
        $sql->bindValue(":marca", $marca);
        $sql->bindValue(":nVol", $nVol);
        $sql->bindValue(":pesoL", $pesoL);
        $sql->bindValue(":pesoB", $pesoB);
        $sql->bindValue(":placa", $placa);
        $sql->bindValue(":UF", $UF);
        $sql->bindValue(":RNTC", $RNTC);
        $sql->bindValue(":trans_id", $trans_id);

        $sql->execute();

        $id_sale = $this->db->lastInsertId();

//inserido produtos
       $total_price = 0;
        

        foreach ($quant as $id_prod => $quant_prod) {
            $sql = $this->db->prepare("SELECT price FROM inventory WHERE id = :id AND
            id_company = :id_company");

        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id", $id_prod);
        $sql->execute();


        $descont=$desconto;//passa desconto para variavel $descont
        $result=count($quant);//obtem o numero de produtos na venda
        $valor_quebrado=round(($descont/$result),2); //divide o desconto pelo numero de produtos e insere na tabela
        $valor_quebrado_total=round($desconto-($valor_quebrado*$result),2); //pega o resto da divisao e armazena na variavel


        if($sql->rowCount() > 0){
            $row = $sql->fetch();
            $price = $row['price'];
            $sqlp = $this->db->prepare("INSERT INTO sales_products SET id_company = :id_company, id_sale = :id_sale,
             id_product = :id_product, quant = :quant, desconto = :desconto, sale_price = :sale_price, acrescimo = :acrescimo");
            $sqlp->bindValue(":id_company", $id_company);
            $sqlp->bindValue(":id_sale", $id_sale);
            $sqlp->bindValue(":id_product", $id_prod);
            $sqlp->bindValue(":sale_price", $price);
            $sqlp->bindValue(":quant", $quant_prod);
            $sqlp->bindValue (":desconto", $valor_quebrado);
            $sqlp->bindValue (":acrescimo", $acrescimo);
            $sqlp->execute();

     
//update desconto
        $sqld = $this->db->prepare("UPDATE sales_products SET desconto = :desconto WHERE id = $id");
        $sqld->bindValue(":desconto", $valor_quebrado+$valor_quebrado_total);
        $sqld->execute();
        $id = $this->db->lastInsertId();

//removendo produto do estoque
            $i->downInventory($id_prod, $id_company, $quant_prod, $user_id );
            $total_price += $price * $quant_prod;
             }

        }

//atualiza o preço final da venda
        $sql = $this->db->prepare("UPDATE sales SET total_price = :total_price WHERE id = :id");
        $sql->bindValue(":total_price", $total_price-$desconto);
        $sql->bindValue(":id", $id_sale);
        $sql->execute();
    }



 public function trocaSale($id_company, $quant, $user_id){
        $i = new Inventory();
         
        foreach ($quant as $id_prod => $quant_prod) {
            $sql = $this->db->prepare("SELECT price FROM inventory WHERE id = :id AND
            id_company = :id_company");

        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id", $id_prod);
        $sql->execute();

//removendo produto do estoque
            $i->upInventory($id_prod, $id_company, $quant_prod, $user_id );

            $total_price += $price * $quant_prod;
             }

        
    }






    public function getInfo($id, $id_company){
        $array = array();

        $sql = $this->db->prepare("
        SELECT
         *,
         ( select clients.name from clients where clients.id = sales.id_client ) as client_name,
         ( select salesman.name_vendedor from salesman where salesman.id = sales.id_salesman ) as salesman_name_vendedor,
         ( select transportadora.xNome from transportadora where transportadora.id = sales.trans_id ) as xNome_trans
        FROM sales 
        WHERE
         id = :id AND
          id_company = :id_company");

 $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

          if($sql->rowCount() > 0){
            $array['info'] = $sql->fetch();

        }




        $sql = $this->db->prepare("
            SELECT
               sales_products.quant,
               sales_products.sale_price,
               sales_products.acrescimo,
               sales_products.desconto,
               inventory.name,
               inventory.code
               FROM sales_products
               LEFT JOIN inventory
                ON inventory.id = sales_products.id_product
               WHERE
                 sales_products.id_sale = :id_sale AND
                 sales_products.id_company = :id_company");
        $sql->bindValue(":id_sale", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
           


          if($sql->rowCount() > 0){
            $array['products'] = $sql->fetchAll();

        }
   


        return $array;
    }

    public function changeSales($status, $forma, $band, $id_client,  $cpf, $cnpj, $id, $id_company){
        $sql = $this->db->prepare("UPDATE sales SET status = :status, forma = :forma, band = :band, id_client = :id_client, cpf = :cpf, cnpj = :cnpj WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":status", $status);
        $sql->bindValue(":forma", $forma);
        $sql->bindValue(":band", $band);
        $sql->bindValue(":id_client", $id_client);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

    }



    public function getSalesFiltered($client_name, $salesman_name_vendedor, $period1, $period2, $status, $forma, $order, $id_company){
         
                $array = array();
                $sql = "SELECT 
                clients.name,
                salesman.name_vendedor,
                sales.date_sale,
                sales.status,
                sales.forma,
                sales.nfe_key,
                sales.total_price
                FROM sales
                 LEFT JOIN clients ON clients.id = sales.id_client  LEFT JOIN salesman ON salesman.id = sales.id_salesman
                 WHERE ";

                $where = array();
                $where[] = "sales.id_company = :id_company";


                if(!empty($client_name)){
                    $where[] = "clients.name LIKE '%".$client_name."%'";
                }

                if(!empty($salesman_name_vendedor)){
                    $where[] = "salesman.name_vendedor LIKE '%".$salesman_name_vendedor."%'";
                }

                if(!empty($period1) && !empty($period2)){
                    $where[] = "sales.date_sale BETWEEN :period1 AND :period2";
                }

                if($status != ''){
                    $where[] = "sales.status = :status";
                }

                 if($forma != ''){
                    $where[] = "sales.forma = :forma";
                }

           

                 if(!empty($nfe_key)){
                    $where[] = "sales.nfe_key = nfe_key";
                }
              

                $sql .= implode(' AND ', $where);


                switch ($order) {
                    case 'date_desc':
                    default:
                        $sql .=" ORDER BY sales.date_sale DESC";
                        break;

                    case 'date_asc':
                        $sql .=" ORDER BY sales.date_sale ASC";
                        break;

                    case 'status':
                        $sql .=" ORDER BY sales.status";
                        break;

                    case 'forma':
                        $sql .=" ORDER BY sales.forma";
                        break;


                    case 'nfe_key':
                        $sql .=" ORDER BY sales.nfe_key";
                        break;
                }

                    
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id_company", $id_company);


                if(!empty($period1) && !empty($period2)){
                    $sql->bindValue(":period1", $period1);
                    $sql->bindValue(":period2", $period2);
                }

                if($status != ''){
                    $sql->bindValue(":status", $status);
                }

                 if($forma != ''){
                    $sql->bindValue(":forma", $forma);
                }

        
                
              
                
                $sql->execute();

                if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }

        return $array;
    }


    public function getTotalRevenue($period1, $period2, $id_company){
        $float = 0;
         $period1 = date('Y-m').'-1';
        $period2 = date('Y-m').'-31';
        $sql = "SELECT SUM(total_price) as total FROM sales WHERE id_company =
         :id_company AND date_sale BETWEEN :period1 AND :period2";
        
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);

        $sql->execute();
     

         $n = $sql->fetch();
        $float = $n['total'];                                                                                              

        return $float;
    }


public function getTotalExpenses($period1, $period2, $id_company){
        $float = 0;
         $period1 = date('Y-m').'-1';
        $period2 = date('Y-m').'-31';
        $sql = "SELECT SUM(value) as total FROM accounts WHERE id_company = :id_company 
        AND datev BETWEEN :period1 AND :period2";
        
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company' , $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);

        $sql->execute();
        
        $n = $sql->fetch();
        $float = $n['total'];

        return $float;
    }



public function getSoldProducts($period1, $period2, $id_company){
       $int = 0;
        $period1 = date('Y-m').'-01';
        $period2 = date('Y-m').'-31';
        $sql = "SELECT id FROM sales WHERE id_company = :id_company 
        AND date_sale BETWEEN :period1 AND :period2";
        //die(var_dump($sql));
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company' , $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if($sql->rowCount() >0){
            $p = array();
            foreach ($sql->fetchAll() as $sale_item) {
                $p[] = $sale_item['id'];
                
                }
                $sql = "SELECT SUM(quant) as total FROM sales_products WHERE id_sale IN (".implode(',', $p).")";
                //die(var_dump($sql));
                $sql = $this->db->query($sql);

                $n = $sql->fetch();
               $int = $n['total'];


        }


       return $int;
    }
 
 public function getRevenueList($period1, $period2, $id_company) {
        $array = array();
        $currentDay = $period1 = date('Y-m').'-01';
        while($period2 != $currentDay) {
            $array[$currentDay] = 0;
            $currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
        }

        $sql = "SELECT DATE_FORMAT(date_sale, '%Y-%m-%d') as date_sale, SUM(total_price) as total FROM sales 
        WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(date_sale, '%Y-%m-%d')";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach($rows as $sale_item) {
                $array[$sale_item['date_sale']] = $sale_item['total'];
            }
        }


        return $array;
    }

public function getExpensesList($period1, $period2, $id_company) {
        $array = array();
        $currentDay = $period1 = date('Y-m').'-01';
        while($period2 != $currentDay) {
            $array[$currentDay] = 0;
            $currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
        }

        $sql = "SELECT DATE_FORMAT(datev, '%Y-%m-%d') as datev, SUM(value) as total FROM accounts WHERE id_company = :id_company AND datev BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(datev, '%Y-%m-%d')";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach($rows as $sale_item) {
                $array[$sale_item['datev']] = $sale_item['total'];
            }
        }


        return $array;
    }

    public function getFormaStatusList($period1, $period2, $id_company) {

      $array = array('01'=>0, '02'=>0, '03'=>0, '04'=>0, '05'=>0, '10'=>0, '11'=>0, '12'=>0, '13'=>0, '15'=>0,'90'=>0, '99'=>0);
        $period1 = date('Y-m').'-01';
        $period2 = date('Y-m').'-31';

        $sql = "SELECT COUNT(id) as total, forma FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP BY forma ORDER BY forma ASC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach($rows as $sale_item) {
                $array[$sale_item['forma']] = $sale_item['total'];
            }
        }

        return $array;
    }

}