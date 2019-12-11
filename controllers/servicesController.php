<?php

class servicesController extends controller{


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
        $c = new Clients();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        // $data['client_info'] = $c->getInfo();

            if($u->hasPermission('clients_view')){
                $c = new Clients();
                $s = new Services();
                $offset = 0;
                $data['p'] = 1;
                if(isset($_GET['p']) && !empty($_GET['p'])){
                    $data['p'] = intval($_GET['p']);
                    if($data['p'] == 0){
                        $data['p'] = 1;
                    }
                }

                $offset = ( 10 * ($data['p']-1));

    $data['services_list'] = $s->getList($offset, $u->getCompany());
    $data['services_count'] = $s->getCount($u->getCompany());
    $data['p_count'] = ceil($data['services_count'] / 10);
    $data['edit_permission'] = $u->hasPermission('clients_edit');
              

                $this->loadTemplate('services', $data);
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
                $s =  new Services();

                if(isset($_POST['client_id']) && !empty($_POST['client_id'])){
                    $client_id = addslashes($_POST['client_id']);
                    $vendedor_id = addslashes($_POST['salesman_id']);
                    $veiculo = addslashes($_POST['veiculo']);
                    $placa = addslashes($_POST['placa']);
                    $odometro = addslashes($_POST['odometro']);
                    $odometro2 = addslashes($_POST['odometro2']);
                    $status = addslashes($_POST['status']);
                    $servico = addslashes($_POST['servico']);
                    $obs = addslashes($_POST['obs']);
                    


                    $s->add($u->getCompany(), $client_id, $vendedor_id, $veiculo, $placa, $odometro, $odometro2,$status, $servico, $obs);
                         header("Location: ".BASE_URL."/services");


                }


   
                $this->loadTemplate('services_add', $data);
        }else{
            header("Location: ".BASE_URL."/services");

        }

        }


        public function edit($id){

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();


            if($u->hasPermission('clients_edit')){
                $c = new Clients();
                $s = new Services();
              
                if(isset($_POST['status']) && !empty($_POST['status'])){
                    $status = addslashes($_POST['status']);


                    $s->edit($id, $u->getCompany(),$status);
                         header("Location: ".BASE_URL."/services");

                }
                $data['statuses'] = array(
                '0'=>'Aguard. pag.',
                '1'=>'Pago',
                '2'=>'Orcamento',
                '3'=>'Cancelado'
            );
                
           
        $data['services_info_names'] = $s->getInfoNames($id, $u->getCompany());
        $data['services_info'] = $s->getInfo($id, $u->getCompany());
        
                $this->loadTemplate('services_edit', $data);
        }else{
            header("Location: ".BASE_URL."/services");

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
                $s = new Services();
              
                if(isset($_POST['client_id']) && !empty($_POST['client_id'])){
                   $client_id = addslashes($_POST['client_id']);
                    $vendedor_id = addslashes($_POST['salesman_id']);
                    $veiculo = addslashes($_POST['veiculo']);
                    $placa = addslashes($_POST['placa']);
                    $odometro = addslashes($_POST['odometro']);
                    $odometro2 = addslashes($_POST['odometro2']);
                    $status = addslashes($_POST['status']);
                    $servico = addslashes($_POST['servico']);
                    $obs = addslashes($_POST['obs']);

                        

                    $s->view($id, $u->getCompany(), $client_id, $vendedor_id, $veiculo, $placa, $odometro, $odometro2,$status, $servico, $obs);
                         header("Location: ".BASE_URL."/services");

                }
                $data['client_info'] = $c->getInfo($id, $u->getCompany());

                $this->loadTemplate('services_view', $data);
        }else{
            header("Location: ".BASE_URL."/services");

        }



        }



    }