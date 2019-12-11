<?php

class salesmanController extends controller{


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

            if($u->hasPermission('salesman_view')){
                $c = new Salesman();
                $offset = 0;
                $data['p'] = 1;
                if(isset($_GET['p']) && !empty($_GET['p'])){
                    $data['p'] = intval($_GET['p']);
                    if($data['p'] == 0){
                        $data['p'] = 1;
                    }
                }

                $offset = ( 10 * ($data['p']-1));

    $data['salesman_list'] = $c->getList($offset, $u->getCompany());
    $data['salesman_count'] = $c->getCount($u->getCompany());
    $data['p_count'] = ceil($data['salesman_count'] / 10);
    $data['edit_permission'] = $u->hasPermission('salesman_edit');
            	

                $this->loadTemplate('salesman', $data);
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

            if($u->hasPermission('salesman_edit')){
                $c = new Salesman();
              
                if(isset($_POST['name']) && !empty($_POST['name'])){
                    $name = addslashes($_POST['name']);
                   
                    $c->add($u->getCompany(), $name);
                         header("Location: ".BASE_URL."/salesman");

                }


                $this->loadTemplate('salesman_add', $data);
        }else{
            header("Location: ".BASE_URL."/salesman");

        }

        }


        public function edit($id){

                 $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

            if($u->hasPermission('salesman_edit')){
                $c = new Salesman();
              
                if(isset($_POST['name_vendedor']) && !empty($_POST['name_vendedor'])){
                    $name_vendedor = addslashes($_POST['name_vendedor']);
                    
                    $c->edit($id, $u->getCompany(), $name_vendedor);
                         header("Location: ".BASE_URL."/salesman");

                }
                $data['salesman_info'] = $c->getInfo($id, $u->getCompany());

                $this->loadTemplate('salesman_edit', $data);
        }else{
            header("Location: ".BASE_URL."/salesman");

        }

    }

         
public function delete($id){

        $u = new Users();
        $u->setLoggedUser();
      

            if($u->hasPermission('salesman_edit')){
                $c = new Salesman();
                $c->delete($id, $u->getCompany(), $u->getId());

                header("Location: ".BASE_URL."/salesman");

            }

}


    }