<?php
class Salesman extends controller{
	public function getList($offset, $id_company){
		$array = array();
		$sql = $this->db->prepare("SELECT * FROM salesman WHERE id_company = :id_company LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}
		return $array;
	}

public function getInfo($id, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT * FROM salesman WHERE id = :id AND id_company = :id_company ");
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

	$sql = $this->db->prepare("SELECT COUNT(*) as c FROM salesman WHERE id_company = :id_company");
	$sql->bindValue(":id_company" , $id_company);
	$sql->execute();


	$row = $sql->fetch();
		$r = $row['c'];

	return $r;

}

	public function add($id_company, $name_vendedor){
$sql = $this->db->prepare("INSERT INTO salesman SET id_company = :id_company, name_vendedor = :name_vendedor");

$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":name_vendedor", $name_vendedor);

$sql->execute();

	

	}


public function edit($id, $id_company, $name_vendedor){
$sql = $this->db->prepare("UPDATE salesman SET id_company = :id_company, name_vendedor = :name_vendedor WHERE id = :id AND id_company = :id_company2");
$sql->bindValue(":id_company2", $id_company);
$sql->bindValue(":id", $id);
$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":name_vendedor", $name_vendedor);

$sql->execute();


	}

	public function delete($id, $id_company){
			$sql = $this->db->prepare("DELETE FROM salesman WHERE id = :id AND id_company = :id_company");
			$sql->bindValue(":id", $id);
			$sql->bindValue("id_company", $id_company);
			$sql->execute();

		}


	
public function searchSalesmanByName($name_vendedor, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT name_vendedor, id FROM salesman WHERE name_vendedor LIKE :name_vendedor LIMIT 10");
	$sql->bindValue(':name_vendedor', '%'.$name_vendedor.'%');
	$sql->execute();

	if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

	return $array;
}
}