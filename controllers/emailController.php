<?php
class emailController extends controller {

    public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false){
        	header("Location: ".BASE_URL."/login");
        	exit;
        	
        }
    }

    public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        
        $this->loadTemplate('email', $data);
    }


      public function envia(){
              $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();


                $this->loadTemplate('email_envia', $data);


        

        
}

}


