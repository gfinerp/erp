<?php 

class Inventory extends model{

	public function getList($offset, $id_company){
		$array = array();

			$sql = $this->db->prepare("SELECT * FROM inventory WHERE  id_company = :id_company ORDER BY name LIMIT $offset, 10");
			$sql->bindValue(":id_company", $id_company);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}


		return $array;

	}

	public function getInfo($id, $id_company){
		$array = array();
		$sql = $this->db->prepare("SELECT * FROM inventory WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetch();
			}


		return $array;


	}
		public function setLog($id_product, $id_company, $id_user, $action){

			$sql = $this->db->prepare("INSERT INTO inventory_history SET id_product = :id_product, id_user = :id_user, action = :action, date_action = NOW(), id_company = :id_company");
			$sql->bindValue(":id_product", $id_product);
			$sql->bindValue(":id_user", $id_user);
			$sql->bindValue(":action", $action);
			$sql->bindValue(":id_company", $id_company);
			$sql->execute();


		}

public function getCount($id_company){
	$r = 0;

	$sql = $this->db->prepare("SELECT COUNT(*) as i FROM inventory WHERE id_company = :id_company");
	$sql->bindValue(":id_company" , $id_company);
	$sql->execute();


	$row = $sql->fetch();
		$r = $row['i'];

	return $r;

}

		public function add($code, $name, $category, $price, $quant, $min_quant, $id_company, $id_user,
		 $NCM, $CFOP, $uCom,  $uTrib,  $indTot, $cst, $pPIS, $pCOFINS, $csosn, $pICMS, $orig, $modBC, 
         $vICMSDeson){
	$sql = $this->db->prepare("SELECT COUNT(*) as i FROM inventory WHERE code = :code");
    $sql->bindValue(":code", $code);
    $sql->execute();
    $row = $sql->fetch();

    if($row['i'] == '0'){

			$sql = $this->db->prepare("INSERT INTO inventory SET code = :code, name = :name, category = :category, price = :price,
			 quant = :quant, min_quant = :min_quant, id_company = :id_company, ncm = :ncm,
			 cfop = :cfop, ucom = :ucom,  utrib = :utrib, indtot = :indtot, cst = :cst, ppis = :ppis,
			 pcofins = :pcofins, csosn = :csosn, picms = :picms, orig = :orig, modbc = :modbc, vicmsdeson = :vicmsdeson ");
			$sql->bindValue(":code", $code);
			$sql->bindValue(":name",$name);
			$sql->bindValue(":category",$category);
			$sql->bindValue(":price", $price);
			$sql->bindValue(":quant", $quant);
			$sql->bindValue(":min_quant", $min_quant);
			$sql->bindValue(":id_company", $id_company);
			//$sql->bindValue("cean", null);
			$sql->bindValue(":ncm",$NCM);
			//$sql->bindValue(":extipi",null);
			$sql->bindValue(":cfop",$CFOP);
			$sql->bindValue(":ucom",$uCom);
			//$sql->bindValue(":ceantrib",null);
			$sql->bindValue(":utrib",$uTrib);
			//$sql->bindValue(":vfrete",null);
			//$sql->bindValue(":vseg",null);
			//$sql->bindValue(":vdesc",null);
			//$sql->bindValue(":voutro",null);
			$sql->bindValue(":indtot",$indTot);
			//$sql->bindValue(":xped",null);
			//$sql->bindValue(":nitemped",null);
			//$sql->bindValue(":nfci",null);
			$sql->bindValue(":cst",$cst);
			$sql->bindValue(":ppis",$pPIS);
			$sql->bindValue(":pcofins",$pCOFINS);
			$sql->bindValue(":csosn",$csosn);
			$sql->bindValue(":picms",$pICMS);
			$sql->bindValue(":orig",$orig);
			$sql->bindValue(":modbc",$modBC);
			$sql->bindValue(":vicmsdeson",$vICMSDeson);
			//$sql->bindValue(":predbc",null);
			//$sql->bindValue(":modbcst",null);
			//$sql->bindValue(":pmvast",null);
			//$sql->bindValue(":predbcst",null);
			//$sql->bindValue(":vbcstret",null);
			//$sql->bindValue(":vicmsstret",null);
			//$sql->bindValue(":qbcprod",null);
			//$sql->bindValue(":valiqprod",null);

			$sql->execute();

			        return'1';
    }else{
        return '0';

    }

			$id_product = $this->db->lastInsertId();
			$this->setLog($id_product, $id_company, $id_user, 'add');

			
		}

	

					public function edit($id, $code, $name, $category, $price, $quant, $min_quant, $id_company, $id_user){

			$sql = $this->db->prepare("UPDATE inventory SET code = :code, name = :name, category = :category, price = :price, quant = :quant, min_quant = :min_quant
			  WHERE id = :id AND id_company = :id_company");
			$sql->bindValue(":code", $code);
			$sql->bindValue(":id", $id );
			$sql->bindValue(":name",$name);
			$sql->bindValue(":category",$category);
			$sql->bindValue(":price", $price);
			$sql->bindValue(":quant", $quant);
			$sql->bindValue(":min_quant", $min_quant);
			$sql->bindValue(":id_company", $id_company);
			$sql->execute();

            $this->setLog($id, $id_company, $id_user, 'edt');

		}



		public function delete($id, $id_company, $id_user){
			$sql = $this->db->prepare("DELETE FROM inventory WHERE id = :id AND id_company = :id_company");
			$sql->bindValue(":id", $id);
			$sql->bindValue("id_company", $id_company);
			$sql->execute();


			$this->setLog($id, $id_company, $id_user, 'del');

		}

public function searchInventoryByCode($code, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT * FROM inventory WHERE code LIKE :code LIMIT 10");
	$sql->bindValue(':code', '%'.$code.'%');

	$sql->execute();



	if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

	return $array;
}

public function searchInventoryByName($name, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT * FROM inventory WHERE name LIKE :name LIMIT 10");
	$sql->bindValue(':name', '%'.$name.'%');

	$sql->execute();



	if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

	return $array;
}



public function searchProductsByCode($code, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT * FROM inventory WHERE code LIKE :code AND id_company = :id_company LIMIT 10");
	$sql->bindValue(':code', '%'.$code.'%');
	$sql->bindValue(":id_company",$id_company);

	$sql->execute();

	if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

	return $array;
}



public function searchProductsByName($name, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT * FROM inventory WHERE name LIKE :name AND id_company = :id_company LIMIT 10");
	$sql->bindValue(':name', '%'.$name.'%');
	$sql->bindValue(":id_company",$id_company);

	$sql->execute();

	if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

	return $array;
}



public function downInventory($id_prod, $id_company, $quant_prod, $user_id ){
	$sql = $this->db->prepare("UPDATE inventory SET quant = quant - $quant_prod WHERE id = :id AND id_company = :id_company");
	$sql->bindValue(":id", $id_prod);
	$sql->bindValue(":id_company", $id_company);
	$sql->execute();

	$this->setLog($id_prod, $id_company, $user_id, 'dwn');

	
}

	 public function getInventoryFiltered($category, $id_company){
        $array = array();
                $sql = "SELECT 

                inventory.code,
                inventory.name,
                inventory.category,
                inventory.quant,
                inventory.min_quant,
                inventory.price
                FROM inventory
                 WHERE ";

                $where = array();
                $where[] = "inventory.id_company = :id_company";



                if($category != ''){
                    $where[] = "inventory.category = :category";
                }


                $sql .= implode(' AND ', $where);

                    

                switch ($category) {
                   

                    case 'category':
                        $sql .=" ORDER BY inventory.category";
                        break;
                }

                    
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id_company", $id_company);


               

                 if($category != ''){
                    $sql->bindValue(":category", $category);
                }
                
                $sql->execute();

                if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }

        return $array;
    }
}