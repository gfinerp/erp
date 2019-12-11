<?php

class transportadoraController extends controller{


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

            if($u->hasPermission('transportadora_view')){
                $c = new Transportadora();
                $offset = 0;
                $data['p'] = 1;
                if(isset($_GET['p']) && !empty($_GET['p'])){
                    $data['p'] = intval($_GET['p']);
                    if($data['p'] == 0){
                        $data['p'] = 1;
                    }
                }

                $offset = ( 10 * ($data['p']-1));

    $data['transportadora_list'] = $c->getList($offset, $u->getCompany());
    $data['transportadora_count'] = $c->getCount($u->getCompany());
    $data['p_count'] = ceil($data['transportadora_count'] / 10);
    $data['edit_permission'] = $u->hasPermission('transportadora_edit');
            	

                $this->loadTemplate('transportadora', $data);
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

            if($u->hasPermission('transportadora_edit')){
                $c = new Transportadora();
                      $ci = new Cidade();

                if(isset($_POST['xNome']) && !empty($_POST['xNome'])){
                    $xNome = addslashes($_POST['xNome']);
                    $ie = addslashes($_POST['IE']);
                    $xEnder = addslashes($_POST['xEnder']);
                    $xMun = addslashes($_POST['xMun']);
                    $uf = addslashes($_POST['UF']);
                    $cnpj = addslashes($_POST['CNPJ']);
                    $cnpj = str_replace('.', '', $cnpj);
                    $cnpj = str_replace(',', '', $cnpj);
                    $cnpj = str_replace('-', '', $cnpj);
                    $cnpj = str_replace('/', '', $cnpj);
                    $cpf = addslashes($_POST['CPF']);
                    $cpf = str_replace('.', '', $cpf);
                    $cpf = str_replace(',', '.', $cpf);
                    $cpf = str_replace('-', '', $cpf);                  

                 
                    $c->add($u->getCompany(), $xNome, $ie, $xEnder, $xMun, $uf, $cnpj, $cpf);
                         header("Location: ".BASE_URL."/transportadora");


                }

                $data['states'] = $ci->getStates();

   
                $this->loadTemplate('transportadora_add', $data);
        }else{
            header("Location: ".BASE_URL."/transportadora");

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


            if($u->hasPermission('transportadora_edit')){
                $c = new Transportadora();
              
                if(isset($_POST['xNome']) && !empty($_POST['xNome'])){
                    $xNome = addslashes($_POST['xNome']);
                    $ie = addslashes($_POST['IE']);
                    $xEnder = addslashes($_POST['xEnder']);
                    $xMun = addslashes($_POST['xMun']);
                    $uf = addslashes($_POST['UF']);
                    $cnpj = addslashes($_POST['CNPJ']);
                    $cnpj = str_replace('.', '', $cnpj);
                    $cnpj = str_replace(',', '', $cnpj);
                    $cnpj = str_replace('-', '', $cnpj);
                    $cnpj = str_replace('/', '', $cnpj);
                    $cpf = addslashes($_POST['CPF']);
                    $cpf = str_replace('.', '', $cpf);
                    $cpf = str_replace(',', '.', $cpf);
                    $cpf = str_replace('-', '', $cpf); 
                        

                    $c->edit($id, $u->getCompany(), $xNome, $ie, $xEnder, $xMun, $uf, $cnpj, $cpf);
                         header("Location: ".BASE_URL."/transportadora");

                }
                $data['trans_info'] = $c->getInfo($id, $u->getCompany());
                                $data['states'] = $ci->getStates();
                                $data['cities'] = $ci->getCityList($data['trans_info']['adress_state']);

                $this->loadTemplate('transportadora_edit', $data);
        }else{
            header("Location: ".BASE_URL."/transportadora");

        }

    }




    }