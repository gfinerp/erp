<?php
class Services extends controller{
    public function getList($offset, $id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM services WHERE id_company = :id_company LIMIT $offset, 10");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }

public function getInfo($id, $id_company){
    $array = array();

    $sql = $this->db->prepare("SELECT * FROM services WHERE id = :id AND id_company = :id_company ");
    $sql->bindValue(":id", $id);
    $sql->bindValue(":id_company", $id_company);
    $sql->execute();

    if($sql->rowCount() > 0){
    $array = $sql->fetch();
        }

    return $array;
}

public function getCount($id_company){
    $r = 0;

    $sql = $this->db->prepare("SELECT COUNT(*) as c FROM services WHERE id_company = :id_company");
    $sql->bindValue(":id_company" , $id_company);
    $sql->execute();


    $row = $sql->fetch();
        $r = $row['c'];

    return $r;

}


public function add($id_company, $id_client,  $id_salesman, $veiculo, $placa, $odometro, $odometro2, $status, $servico, $obs){
$sql = $this->db->prepare("INSERT INTO services SET id_company = :id_company, id_client = :id_client, id_salesman = :id_salesman,  veiculo = :veiculo, placa = :placa, odometro = :odometro, odometro2 = :odometro2,status = :status, servico = :servico, obs = :obs, date_service = NOW()");

$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":id_client", $id_client);
$sql->bindValue(":id_salesman", $id_salesman);
$sql->bindValue(":veiculo", $veiculo);
$sql->bindValue(":placa", $placa);
$sql->bindValue(":odometro", $odometro);
$sql->bindValue(":odometro2", $odometro2);
$sql->bindValue(":status", $status);
$sql->bindValue(":servico", $servico);
$sql->bindValue(":obs", $obs);
$sql->execute();

    return $this->db->lastInsertId();

    }


public function edit($id, $id_company, $status){
$sql = $this->db->prepare("UPDATE services SET id_company = :id_company, status = :status WHERE id = :id AND id_company = :id_company2");
$sql->bindValue(":id_company2", $id_company);
$sql->bindValue(":id", $id);
$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":status", $status);
$sql->execute();


    }

public function view($id, $id_company, $id_client,  $id_salesman, $veiculo, $placa, $odometro, $odometro2, $status, $servico, $obs){
$sql = $this->db->prepare("UPDATE services SET id_company = :id_company, id_client = :id_client, id_salesman = :id_salesman,  veiculo = :veiculo, placa = :placa, odometro = :odometro, odometro2 = :odometro2,status = :status, servico = :servico, obs = :obs WHERE id = :id AND id_company = :id_company2");
$sql->bindValue(":id_company2", $id_company);
$sql->bindValue(":id", $id);
$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":id_client", $id_client);
$sql->bindValue(":id_salesman", $id_salesman);
$sql->bindValue(":veiculo", $veiculo);
$sql->bindValue(":placa", $placa);
$sql->bindValue(":odometro", $odometro);
$sql->bindValue(":odometro2", $odometro2);
$sql->bindValue(":status", $status);
$sql->bindValue(":servico", $servico);
$sql->bindValue(":obs", $obs);
$sql->execute();


}

public function searchClientsByName($name, $id_company){
    $array = array();

    $sql = $this->db->prepare("SELECT name, id FROM clients WHERE name LIKE :name LIMIT 10");
    $sql->bindValue(':name', '%'.$name.'%');
    $sql->execute();

    if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

    return $array;
}

 public function getInfoNames($id, $id_company){
        $array = array();

        $sql = $this->db->prepare("
        SELECT
         *,
         ( select clients.name from clients where clients.id = services.id_client ) as client_name,
         ( select salesman.name_vendedor from salesman where salesman.id = services.id_salesman ) as salesman_name_vendedor
         FROM services
         WHERE
         id = :id AND
          id_company = :id_company");

        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0){
    $array = $sql->fetch();
        }

    return $array;
    }

     public function getServicesFiltered($client_name, $salesman_name_vendedor, $period1, $period2, $status, $order, $id_company){
         
                $array = array();
                $sql = "SELECT 
                clients.name,
                salesman.name_vendedor,
                services.date_service,
                services.status,
                services.veiculo,
                services.placa,
                services.odometro,
                services.odometro2,
                services.servico,
                services.obs
                FROM services
                 LEFT JOIN clients ON clients.id = services.id_client  LEFT JOIN salesman ON salesman.id = services.id_salesman
                 WHERE ";

                $where = array();
                $where[] = "services.id_company = :id_company";


                if(!empty($client_name)){
                    $where[] = "clients.name LIKE '%".$client_name."%'";
                }

                if(!empty($salesman_name_vendedor)){
                    $where[] = "salesman.name_vendedor LIKE '%".$salesman_name_vendedor."%'";
                }

                if(!empty($period1) && !empty($period2)){
                    $where[] = "services.date_service BETWEEN :period1 AND :period2";
                }

                if($status != ''){
                    $where[] = "services.status = :status";
                }

              

                $sql .= implode(' AND ', $where);


                switch ($order) {
                    case 'date_desc':
                    default:
                        $sql .=" ORDER BY services.date_service DESC";
                        break;

                    case 'date_asc':
                        $sql .=" ORDER BY services.date_service ASC";
                        break;

                    case 'status':
                        $sql .=" ORDER BY services.status";
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

        
                
              
                
                $sql->execute();

                if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }

        return $array;
    }
}