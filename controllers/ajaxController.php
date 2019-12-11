<?php

class ajaxController extends controller{


	 public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false){
        	header("Location: ".BASE_URL."/login");
        	exit;
        	
        }
    }

  

    public function get_city_list() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $c = new Cidade();

        if(isset($_GET['state']) && !empty($_GET['state'])) {
            $state = addslashes($_GET['state']);
            $data['cities'] = $c->getCityList($state);
        }

        foreach($data['cities'] as $cityk => $city) {
            $data['cities'][$cityk]['Nome'] = $city['Nome'];
            $data['cities'][$cityk]['0'] = $city['0'];
        }

        $json = json_encode($data);


        echo $json;
    }


    public function index(){}

    public function search_clients(){
    	$data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Clients();

        if(isset($_GET['q']) && !empty($_GET['q'])){
        	$q = addslashes($_GET['q']);

        	$clients = $c->searchClientsByName($q, $u->getCompany());

        	foreach($clients as $citem) {
        		$data[] = array(
        			'name'=> $citem['name'],
        			'link'=> BASE_URL.'/clients/edit/'.$citem['id'],
        			'id'  => $citem['id']
                    );
        	}
        }

        echo json_encode($data);
    }

    public function search_clients_service(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Clients();

        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = addslashes($_GET['q']);

            $clients = $c->searchClientsByName($q, $u->getCompany());

            foreach($clients as $citem) {
                $data[] = array(
                    'name'=> $citem['name'],
                    'link'=> BASE_URL.'/services/edit/'.$citem['id'],
                    'id'  => $citem['id']
                    );
            }
        }

        echo json_encode($data);
    }

      public function search_salesman(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Salesman();

        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = addslashes($_GET['q']);

            $salesman = $c->searchSalesmanByName($q, $u->getCompany());

            foreach($salesman as $citem) {
                $data[] = array(
                    'name_vendedor'=> $citem['name_vendedor'],
                    'link'=> BASE_URL.'/salesman/edit/'.$citem['id'],
                    'id'  => $citem['id']
                    );
            }
        }

        echo json_encode($data);
    }

    public function search_trans(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Transportadora();

        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = addslashes($_GET['q']);

            $transportadora = $c->searchTransportadoraByName($q, $u->getCompany());

            foreach($transportadora as $citem) {
                $data[] = array(
                    'xNome'=> $citem['xNome'],
                    'link'=> BASE_URL.'/transportadora/edit/'.$citem['id'],
                    'id'  => $citem['id']
                    );
            }
        }

        echo json_encode($data);
    }

    public function search_inventory(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Inventory();

        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = addslashes($_GET['q']);

            $inventory = $c->searchInventoryByCode($q, $u->getCompany());

            foreach($inventory as $citem) {
                $data[] = array(

                    'code'=> $citem['code'],
                    'name'=> $citem['name'],
                    'link'=> BASE_URL.'/inventory/edit/'.$citem['id']

                    );
            }

             $inventory = $c->searchInventoryByName($q, $u->getCompany());

            foreach($inventory as $citem) {
                $data[] = array(

                    'code'=> $citem['code'],
                    'name'=> $citem['name'],
                    'link'=> BASE_URL.'/inventory/edit/'.$citem['id']

                    );
            }
        }

        echo json_encode($data);
    }

     public function search_products(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $i = new Inventory();

        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = addslashes($_GET['q']);

            $data = $i->searchProductsByName($q, $u->getCompany());

          
        }

        echo json_encode($data);
    }

         public function search_accounts(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Accounts();

        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = addslashes($_GET['q']);

            $accounts = $c->searchAccountsByNum($q, $u->getCompany());

            foreach($accounts as $citem) {
                $data[] = array(
                    'num'=> $citem['num'],
                    'name'=> $citem['name'],
                    'link'=> BASE_URL.'/accounts/edit/'.$citem['id'],
                    'id'  => $citem['id']
                    );
            }

             $accounts = $c->searchAccountsByName($q, $u->getCompany());

            foreach($accounts as $citem) {
                $data[] = array(
                    'num'=> $citem['num'],
                    'name'=> $citem['name'],
                    'link'=> BASE_URL.'/accounts/edit/'.$citem['id'],
                    'id'  => $citem['id']
                    );
            }

        }

        echo json_encode($data);
    }


 public function search_product(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Inventory();

        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = addslashes($_GET['q']);

            $inventory = $c->searchProductsByCode($q, $u->getCompany());

            foreach($inventory as $citem) {
                $data[] = array(

                    'code'=> $citem['code'],
                    'name'=> $citem['name'],
                    'price'=> $citem['price'],
                    'id'  => $citem['id']

                    );
            }

             $inventory = $c->searchProductsByName($q, $u->getCompany());

            foreach($inventory as $citem) {
                $data[] = array(

                    'code'=> $citem['code'],
                    'name'=> $citem['name'],
                    'price'=> $citem['price'],
                    'id'  => $citem['id']

                    );
            }
        }

        echo json_encode($data);
    }




    public function add_client(){

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Clients();
        $ci = new Cidade();

        


        if(isset($_POST['name']) && !empty($_POST['name'])){
                    $name = addslashes($_POST['name']);
                    $cpf = addslashes($_POST['cpf']);
                    $cnpj = addslashes($_POST['cnpj']);
                    $adress_zipcode = addslashes($_POST['adress_zipcode']);
                    $adress = addslashes($_POST['adress']);
                    $adress_number = addslashes($_POST['adress_number']);
                    $adress_neighb = addslashes($_POST['adress_neighb']);
                    $adress_citycode = addslashes($_POST['adress_city']);
                    $adress_state = addslashes($_POST['adress_state']);
                    $adress_country = addslashes($_POST['adress_country']);
                    $adress_city = $ci->getCity($adress_citycode);
           
            $data['id'] = $c->add($u->getCompany(),  $name, $cpf, $cnpj,
             $adress_zipcode, $adress, $adress_number, $adress_neighb,
             $adress_city, $adress_state, $adress_country, $adress_citycode);

                $data['states'] = $ci->getStates();

        }

        echo json_encode($data);
    }
}