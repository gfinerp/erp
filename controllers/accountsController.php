<?php

class accountsController extends controller{


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

             $data['payses'] = array(
                '0'=>'NÃO',
                '1'=>'SIM'

            );

            if($u->hasPermission('accounts_view')){
                $c = new Accounts();
                $offset = 0;
                $data['p'] = 1;
                if(isset($_GET['p']) && !empty($_GET['p'])){
                    $data['p'] = intval($_GET['p']);
                    if($data['p'] == 0){
                        $data['p'] = 1;
                    }
                }

                $offset = ( 10 * ($data['p']-1));

    $data['accounts_list'] = $c->getList($offset, $u->getCompany());
    $data['accounts_count'] = $c->getCount($u->getCompany());
    $data['p_count'] = ceil($data['accounts_count'] / 10);
    $data['edit_permission'] = $u->hasPermission('accounts_edit');
            	

                $this->loadTemplate('accounts', $data);
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

            if($u->hasPermission('accounts_edit')){
                $c = new Accounts();
              
                if(isset($_POST['datev']) && !empty($_POST['datev'])){
                    $datev = addslashes($_POST['datev']);                    
                    $name = addslashes($_POST['name']);
                    $phone = addslashes($_POST['phone']);
                    $value = addslashes($_POST['value']);
                    $pay = addslashes($_POST['pay']);
                    $num = addslashes($_POST['num']);
                    $value = str_replace('.', '', $value);
                    $value = str_replace(',', '.', $value);                   

                    $c->add($u->getCompany(),$datev, $name, $phone, $value, $pay, $num);
                         header("Location: ".BASE_URL."/accounts");

                }

                $this->loadTemplate('accounts_add', $data);
        }else{
            header("Location: ".BASE_URL."/accounts");

        }

        }

        public function edit($id){
              $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

         $data['payses'] = array(
                '0'=>'NÃO',
                '1'=>'SIM'

            );

            if($u->hasPermission('accounts_edit')){
                $c = new Accounts();
              
                    if(isset($_POST['datev']) && !empty($_POST['datev'])){
                    $datev = addslashes($_POST['datev']);                    
                    $name = addslashes($_POST['name']);
                    $phone = addslashes($_POST['phone']);
                    $value = addslashes($_POST['value']);
                    $pay = addslashes($_POST['pay']);
                    $num = addslashes($_POST['num']);
                    $value = str_replace('.', '', $value);
                    $value = str_replace(',', '.', $value);

                    $c->edit( $id, $datev, $name, $phone, $value, $pay, $num, $u->getCompany(), $u->getId());
                         header("Location: ".BASE_URL."/accounts");

                }
                     $data['accounts_info'] = $c->getInfo($id, $u->getCompany());
                $this->loadTemplate('accounts_edit', $data);
        
        }

        }

        


    }