<?php
class Transportadora extends controller{
	public function getList($offset, $id_company){
		$array = array();
		$sql = $this->db->prepare("SELECT * FROM transportadora WHERE id_company = :id_company LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}
		return $array;
	}

public function getInfo($id, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT * FROM transportadora WHERE id = :id AND id_company = :id_company ");
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

	$sql = $this->db->prepare("SELECT COUNT(*) as c FROM transportadora WHERE id_company = :id_company");
	$sql->bindValue(":id_company" , $id_company);
	$sql->execute();


	$row = $sql->fetch();
		$r = $row['c'];

	return $r;

}

	public function add($id_company, $xNome, $ie, $xEnder, $xMun, $uf, $cnpj, $cpf){


		$sql = $this->db->prepare("INSERT INTO transportadora SET id_company = :id_company, xNome = :xNome, IE = :IE,  xEnder = :xEnder, xMun = :xMun, UF = :UF, CNPJ = :CNPJ, CPF = :CPF");

		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":xNome", $xNome);
		$sql->bindValue(":IE", $ie);
		$sql->bindValue(":xEnder", $xEnder);
		$sql->bindValue(":xMun", $xMun);
		$sql->bindValue(":UF", $uf);
		$sql->bindValue(":CNPJ", $cnpj);
		$sql->bindValue(":CPF", $cpf);
		$sql->execute();
	return $this->db->lastInsertId();


	}


public function edit($id, $id_company, $xNome, $ie, $xEnder, $xMun, $uf, $cnpj, $cpf){
$sql = $this->db->prepare("UPDATE transportadora SET id_company = :id_company,xNome = :xNome, IE = :IE,  xEnder = :xEnder, xMun = :xMun, UF = :UF, CNPJ = :CNPJ, CPF = :CPF WHERE id = :id AND id_company = :id_company2");
$sql->bindValue(":id_company2", $id_company);
$sql->bindValue(":id", $id);
$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":xNome", $xNome);
$sql->bindValue(":IE", $ie);
$sql->bindValue(":xEnder", $xEnder);
$sql->bindValue(":xMun", $xMun);
$sql->bindValue(":UF", $uf);
$sql->bindValue(":CNPJ", $cnpj);
$sql->bindValue(":CPF", $cpf);
$sql->execute();


	}


public function searchTransportadoraByName($xNome, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT xNome, id FROM transportadora WHERE xNome LIKE :xNome LIMIT 10");
	$sql->bindValue(':xNome', '%'.$xNome.'%');
	$sql->execute();

	if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

	return $array;
}
}