<?php 

class Accounts extends model{

	public function getList($offset, $id_company){
		$array = array();

			$sql = $this->db->prepare("SELECT * FROM accounts WHERE  id_company = :id_company LIMIT $offset, 10");
			$sql->bindValue(":id_company", $id_company);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}



		return $array;

	}

	public function getInfo($id, $id_company){
		$array = array();
		$sql = $this->db->prepare("SELECT * FROM accounts WHERE id = :id AND id_company = :id_company");
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

	$sql = $this->db->prepare("SELECT COUNT(*) as i FROM accounts WHERE id_company = :id_company");
	$sql->bindValue(":id_company" , $id_company);
	$sql->execute();


	$row = $sql->fetch();
		$r = $row['i'];

	return $r;

}

		
	public function add($id_company, $datev, $name, $phone, $value, $pay, $num){

			$sql = $this->db->prepare("SELECT COUNT(*) as i FROM accounts WHERE num = :num");
    $sql->bindValue(":num", $num);
    $sql->execute();
    $row = $sql->fetch();

    if($row['i'] == '0'){

$sql = $this->db->prepare("INSERT INTO accounts SET id_company = :id_company, datev = :datev , name = :name, phone = :phone, value = :value, pay = :pay, num =:num");

$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":datev", $datev);
$sql->bindValue(":name", $name);
$sql->bindValue(":phone", $phone);
$sql->bindValue(":value", $value);
$sql->bindValue(":pay", $pay);
$sql->bindValue(":num", $num);

$sql->execute();

    return'1';
    }else{
        return '0';

    }


	return $this->db->lastInsertId();


	}


	 public function edit($id, $datev, $name, $phone, $value, $pay, $num, $id_company){

			$sql = $this->db->prepare("UPDATE accounts SET datev = :datev, name = :name, phone = :phone, value = :value, pay = :pay, num = :num WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":datev", $datev);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":phone", $phone);
		$sql->bindValue(":value", $value);
		$sql->bindValue(":pay", $pay);
		$sql->bindValue(":num", $num);
		
			$sql->execute();

		}


	
public function searchAccountsByNum($num, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT name, num, id FROM accounts WHERE num LIKE :num LIMIT 10");
	$sql->bindValue(':num', '%'.$num.'%');

	$sql->execute();

	if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

	return $array;
}


public function searchAccountsByName($name, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT name, num, id FROM accounts WHERE name LIKE :name LIMIT 10");
	$sql->bindValue(':name', '%'.$name.'%');

	$sql->execute();

	if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

	return $array;
}





    public function getAccountsFiltered($period1, $period2, $pay, $id_company){
        $array = array();
                $sql = "SELECT 
                accounts.datev,
                accounts.pay,
                accounts.name,
                accounts.num,
                accounts.value,
                accounts.phone
              
                FROM accounts
                 WHERE ";

                $where = array();
                $where[] = "accounts.id_company = :id_company";

               

                if(!empty($period1) && !empty($period2)){
                    $where[] = "accounts.datev BETWEEN :period1 AND :period2";
                }

                if($pay != ''){
                    $where[] = "accounts.pay = :pay";
                }

                $sql .= implode(' AND ', $where);

                    

                switch ($pay) {
                    case 'date_desc':
                    default:
                        $sql .=" ORDER BY accounts.datev DESC";
                        break;

                    case 'date_asc':
                        $sql .=" ORDER BY accounts.datev ASC";
                        break;

                    case 'pay':
                        $sql .=" ORDER BY accounts.pay";
                        break;

                }

                    
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id_company", $id_company);


                if(!empty($period1) && !empty($period2)){
                    $sql->bindValue(":period1", $period1);
                    $sql->bindValue(":period2", $period2);
                }

                if($pay != ''){
                    $sql->bindValue(":pay", $pay);
                }

             
                
                $sql->execute();

                if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }

        return $array;
    }


}