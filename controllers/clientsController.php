<?php

class clientsController extends controller{


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

            if($u->hasPermission('clients_view')){
                $c = new Clients();
                $offset = 0;
                $data['p'] = 1;
                if(isset($_GET['p']) && !empty($_GET['p'])){
                    $data['p'] = intval($_GET['p']);
                    if($data['p'] == 0){
                        $data['p'] = 1;
                    }
                }

                $offset = ( 10 * ($data['p']-1));

    $data['clients_list'] = $c->getList($offset, $u->getCompany());
    $data['clients_count'] = $c->getCount($u->getCompany());
    $data['p_count'] = ceil($data['clients_count'] / 10);
    $data['edit_permission'] = $u->hasPermission('clients_edit');
            	

                $this->loadTemplate('clients', $data);
    	}else{
            header("Location: ".BASE_URL);

        }

        }

        public function add(){
              $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

            if($u->hasPermission('clients_edit')){
                $c = new Clients();
                      $ci = new Cidade();

                if(isset($_POST['name']) && !empty($_POST['name'])){
                    $name = addslashes($_POST['name']);
                    $email = addslashes($_POST['email']);
                    $cpf = addslashes($_POST['cpf']);
                    $cnpj = addslashes($_POST['cnpj']);
                    $phone = addslashes($_POST['phone']);
                    $stars = addslashes($_POST['stars']);
                    $internal_obs = addslashes($_POST['internal_obs']);
                    $adress_zipcode = addslashes($_POST['adress_zipcode']);
                    $adress = addslashes($_POST['adress']);
                    $adress_number = addslashes($_POST['adress_number']);
                    $adress_neighb = addslashes($_POST['adress_neighb']);
                    $adress2 = addslashes($_POST['adress2']);
                    $adress_citycode = addslashes($_POST['adress_city']);
                    $adress_state = addslashes($_POST['adress_state']);
                    $adress_country = addslashes($_POST['adress_country']);
                    $adress_city = $ci->getCity($adress_citycode);

                    $c->add($u->getCompany(), $name, $email, $cpf, $cnpj, $phone, $stars, $internal_obs, $adress_zipcode, $adress, $adress_number, $adress_neighb, $adress2, $adress_city, $adress_state, $adress_country, $adress_citycode);
                         header("Location: ".BASE_URL."/clients");


                }

                $data['states'] = $ci->getStates();

   
                $this->loadTemplate('clients_add', $data);
        }else{
            header("Location: ".BASE_URL."/clients");

        }

        }


        public function edit($id){

                 $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

         $ci =  new Cidade();


            if($u->hasPermission('clients_edit')){
                $c = new Clients();
              
                if(isset($_POST['name']) && !empty($_POST['name'])){
                    $name = addslashes($_POST['name']);
                    $email = addslashes($_POST['email']);
                    $cpf = addslashes($_POST['cpf']);
                    $cnpj = addslashes($_POST['cnpj']);
                    $phone = addslashes($_POST['phone']);
                    $stars = addslashes($_POST['stars']);
                    $internal_obs = addslashes($_POST['internal_obs']);
                    $adress_zipcode = addslashes($_POST['adress_zipcode']);
                    $adress = addslashes($_POST['adress']);
                    $adress_number = addslashes($_POST['adress_number']);
                    $adress_neighb = addslashes($_POST['adress_neighb']);
                    $adress2 = addslashes($_POST['adress2']);
                   $adress_citycode = addslashes($_POST['adress_city']);
                    $adress_state = addslashes($_POST['adress_state']);
                    $adress_country = addslashes($_POST['adress_country']);
                    $adress_city = $ci->getCity($adress_citycode);
                        

                    $c->edit($id, $u->getCompany(), $name, $email,$cpf, $cnpj, $phone, $stars, $internal_obs, $adress_zipcode, $adress, $adress_number, $adress_neighb, $adress2, $adress_city, $adress_state, $adress_country, $adress_citycode);
                         header("Location: ".BASE_URL."/clients");

                }
                $data['client_info'] = $c->getInfo($id, $u->getCompany());
                                $data['states'] = $ci->getStates();
                                $data['cities'] = $ci->getCityList($data['client_info']['adress_state']);

                $this->loadTemplate('clients_edit', $data);
        }else{
            header("Location: ".BASE_URL."/clients");

        }

    }

          public function view($id){

                 $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

            if($u->hasPermission('clients_view')){
                $c = new Clients();
              
                if(isset($_POST['name']) && !empty($_POST['name'])){
                    $name = addslashes($_POST['name']);
                    $email = addslashes($_POST['email']);
                    $cpf = addslashes($_POST['cpf']);
                    $cnpj = addslashes($_POST['cnpj']);
                    $phone = addslashes($_POST['phone']);
                    $stars = addslashes($_POST['stars']);
                    $internal_obs = addslashes($_POST['internal_obs']);
                    $adress_zipcode = addslashes($_POST['adress_zipcode']);
                    $adress = addslashes($_POST['adress']);
                    $adress_number = addslashes($_POST['adress_number']);
                    $adress_neighb = addslashes($_POST['adress_neighb']);
                    $adress2 = addslashes($_POST['adress2']);
                    $adress_city = addslashes($_POST['adress_city']);
                    $adress_state = addslashes($_POST['adress_state']);
                    $adress_country = addslashes($_POST['adress_country']);
                        

                    $c->view($id, $u->getCompany(), $name, $email,$cpf, $cnpj, $phone, $stars, $internal_obs, $adress_zipcode, $adress, $adress_number, $adress_neighb, $adress2, $adress_city, $adress_state, $adress_country);
                         header("Location: ".BASE_URL."/clients");

                }
                $data['client_info'] = $c->getInfo($id, $u->getCompany());

                $this->loadTemplate('clients_view', $data);
        }else{
            header("Location: ".BASE_URL."/clients");

        }



        }



    }