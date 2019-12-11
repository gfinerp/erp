<?php
class Clients extends controller{
	public function getList($offset, $id_company){
		$array = array();
		$sql = $this->db->prepare("SELECT * FROM clients WHERE id_company = :id_company LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}
		return $array;
	}

public function getInfo($id, $id_company){
	$array = array();

	$sql = $this->db->prepare("SELECT * FROM clients WHERE id = :id AND id_company = :id_company ");
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

	$sql = $this->db->prepare("SELECT COUNT(*) as c FROM clients WHERE id_company = :id_company");
	$sql->bindValue(":id_company" , $id_company);
	$sql->execute();


	$row = $sql->fetch();
		$r = $row['c'];

	return $r;

}

	public function add($id_company, $name,  $email = '', $cpf = '', $cnpj = '', $phone = '', $stars = '3', $internal_obs = '', $adress_zipcode = '', $adress = '', $adress_number = '', $adress_neighb = '', $adress2 = '', $adress_city = '', $adress_state = '', $adress_country = '', $adress_citycode = ''){
$sql = $this->db->prepare("INSERT INTO clients SET id_company = :id_company, name = :name, email = :email,  cpf = :cpf, cnpj = :cnpj, phone = :phone, stars = :stars, internal_obs = :internal_obs, adress_zipcode = :adress_zipcode, adress = :adress, adress_number = :adress_number, adress_neighb = :adress_neighb, adress2 = :adress2, adress_city = :adress_city, adress_citycode = :adress_citycode, adress_state = :adress_state, adress_country = :adress_country, adress_countrycode = 1058");

$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":name", $name);
$sql->bindValue(":email", $email);
$sql->bindValue(":cpf", $cpf);
$sql->bindValue(":cnpj", $cnpj);
$sql->bindValue(":phone", $phone);
$sql->bindValue(":stars", $stars);
$sql->bindValue(":internal_obs", $internal_obs);
$sql->bindValue(":adress_zipcode", $adress_zipcode);
$sql->bindValue(":adress", $adress);
$sql->bindValue(":adress_number", $adress_number);
$sql->bindValue(":adress_neighb", $adress_neighb);
$sql->bindValue(":adress2", $adress2);
$sql->bindValue(":adress_city", $adress_city);
$sql->bindValue(":adress_citycode", $adress_citycode);
$sql->bindValue(":adress_state", $adress_state);
$sql->bindValue(":adress_country", $adress_country);
$sql->execute();

	return $this->db->lastInsertId();


	}


public function edit($id, $id_company, $name, $email, $cpf, $cnpj, $phone, $stars, $internal_obs, $adress_zipcode, $adress, $adress_number, $adress_neighb, $adress2, $adress_city, $adress_state, $adress_country, $adress_citycode){
$sql = $this->db->prepare("UPDATE clients SET id_company = :id_company, name = :name, email = :email, cpf = :cpf, cnpj = :cnpj, phone = :phone, stars = :stars, internal_obs = :internal_obs, adress_zipcode = :adress_zipcode, adress = :adress,
 adress_number = :adress_number, adress_neighb = :adress_neighb, adress2 = :adress2, adress_city = :adress_city, adress_citycode = :adress_citycode, adress_state = :adress_state, adress_country = :adress_country, adress_countrycode = 1058 WHERE id = :id AND id_company = :id_company2");
$sql->bindValue(":id_company2", $id_company);
$sql->bindValue(":id", $id);
$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":name", $name);
$sql->bindValue(":email", $email);
$sql->bindValue(":cpf", $cpf);
$sql->bindValue(":cnpj", $cnpj);
$sql->bindValue(":phone", $phone);
$sql->bindValue(":stars", $stars);
$sql->bindValue(":internal_obs", $internal_obs);
$sql->bindValue(":adress_zipcode", $adress_zipcode);
$sql->bindValue(":adress", $adress);
$sql->bindValue(":adress_number", $adress_number);
$sql->bindValue(":adress_neighb", $adress_neighb);
$sql->bindValue(":adress2", $adress2);
$sql->bindValue(":adress_city", $adress_city);
$sql->bindValue(":adress_citycode", $adress_citycode);
$sql->bindValue(":adress_state", $adress_state);
$sql->bindValue(":adress_country", $adress_country);
$sql->execute();


	}

public function view($id, $id_company, $name, $email, $cpf, $cnpj, $phone, $stars, $internal_obs, $adress_zipcode, $adress, $adress_number, $adress_neighb, $adress2, $adress_city, $adress_state, $adress_country){
$sql = $this->db->prepare("UPDATE clients SET id_company = :id_company, name = :name, email = :email, cpf = :cpf, cnpj = :cnpj, phone = :phone, stars = :stars, internal_obs = :internal_obs, adress_zipcode = :adress_zipcode, adress = :adress, adress_number = :adress_number, adress_neighb = :adress_neighb, adress2 = :adress2, adress_city = :adress_city, adress_state = :adress_state, adress_country = :adress_country WHERE id = :id AND id_company = :id_company2");
$sql->bindValue(":id_company2", $id_company);
$sql->bindValue(":id", $id);
$sql->bindValue(":id_company", $id_company);
$sql->bindValue(":name", $name);
$sql->bindValue(":email", $email);
$sql->bindValue(":cpf", $cpf);
$sql->bindValue(":cnpj", $cnpj);
$sql->bindValue(":phone", $phone);
$sql->bindValue(":stars", $stars);
$sql->bindValue(":internal_obs", $internal_obs);
$sql->bindValue(":adress_zipcode", $adress_zipcode);
$sql->bindValue(":adress", $adress);
$sql->bindValue(":adress_number", $adress_number);
$sql->bindValue(":adress_neighb", $adress_neighb);
$sql->bindValue(":adress2", $adress2);
$sql->bindValue(":adress_city", $adress_city);
$sql->bindValue(":adress_state", $adress_state);
$sql->bindValue(":adress_country", $adress_country);
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
}