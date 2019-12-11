<?php

class reportController extends controller{


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

        $s = new Sales();

            if($u->hasPermission('report_view')){

        $data['days_list'] = array();
       $data['days_list'] = array();
        for($q=30;$q>0;$q--) {
            $data['days_list'][] = date('d/m', strtotime('-'.$q.' days'));
        }

         $data['revenue_list'] = $s->getRevenueList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());


            

                $this->loadTemplate('report', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

         
    }




public function sales(){
       $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

            $data['formases'] = array(
                '01'=>'Dinheiro',
                '02'=>'Cheque',
                '03'=>'Cartão de Crédito',
                '04'=>'Cartão de Débito',
                '05'=>'Crédito Loja',
                '10'=>'Vale Alimentação',
                '11'=>'Vale Refeição',
                '12'=>'Vale Presente',
                '13'=>'Vale Combustível',
                '15'=>'Boleto Bancário',
                '90'=>'Sem Pagamento',
                '99'=>'Outros'
                 );

        $data['statuses'] = array(
                '0'=>'Aguard. pag.',
                '1'=>'Pago',
                '2'=>'Cancelado',
                '3'=>'Troca',
                '4'=>'Orcamento'
            );

            if($u->hasPermission('report_view')){
            

                $this->loadTemplate('report_sales', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

}

public function sales_pdf(){

      $data = array();
        $u = new Users();
        $u->setLoggedUser();

            $data['formases'] = array(
                '01'=>'Dinheiro',
                '02'=>'Cheque',
                '03'=>'Cartão de Crédito',
                '04'=>'Cartão de Débito',
                '05'=>'Crédito Loja',
                '10'=>'Vale Alimentação',
                '11'=>'Vale Refeição',
                '12'=>'Vale Presente',
                '13'=>'Vale Combustível',
                '15'=>'Boleto Bancário',
                '90'=>'Sem Pagamento',
                '99'=>'Outros'
                 );

        $data['statuses'] = array(
                '0'=>'Aguard. pag.',
                '1'=>'Pago',
                '2'=>'Cancelado',
                '3'=>'Troca',
                '4'=>'Orcamento'
            );

            if($u->hasPermission('report_view')){
                    $client_name = addslashes($_GET['client_name']);
                    $salesman_name_vendedor = addslashes($_GET['salesman_name_vendedor']);
                    $period1 = addslashes($_GET['period1']);
                    $period2 = addslashes($_GET['period2']);
                    $status = addslashes($_GET['status']);
                    $forma = addslashes($_GET['forma']);
                    $order = addslashes($_GET['order']);
                    
                    $s = new Sales();
                    $data['sales_list'] = $s->getSalesFiltered($client_name, $salesman_name_vendedor,
                     $period1, $period2, $status, $forma  ,$order, $u->getCompany());

                    $data['filters'] = $_GET;


                    $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_sales_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();


        }else{
            header("Location: ".BASE_URL);

        } 


}


public function services(){
       $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();


        $data['statuses'] = array(
                '0'=>'Aguard. pag.',
                '1'=>'Pago',
                '2'=>'Orcamento',
                '3'=>'Cancelado'
            );

            if($u->hasPermission('report_view')){
            

                $this->loadTemplate('report_services', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

}

public function services_pdf(){

      $data = array();
        $u = new Users();
        $u->setLoggedUser();


        $data['statuses'] = array(
                '0'=>'Aguard. pag.',
                '1'=>'Pago',
                '2'=>'Orcamento',
                '3'=>'Cancelado'
            );

            if($u->hasPermission('report_view')){
                    $client_name = addslashes($_GET['client_name']);
                    $salesman_name_vendedor = addslashes($_GET['salesman_name']);
                    $period1 = addslashes($_GET['period1']);
                    $period2 = addslashes($_GET['period2']);
                    $status = addslashes($_GET['status']);
                    $order = addslashes($_GET['order']);
                    
                    $s = new Services();
                    $data['services_list'] = $s->getServicesFiltered($client_name, $salesman_name_vendedor,$period1, $period2, $status,$order, $u->getCompany());

                    $data['filters'] = $_GET;


                    $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_services_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();


        }else{
            header("Location: ".BASE_URL);

        } 


}

public function inventory(){

      $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

          $data['categoriases'] = array(
                '0'=>'Vendas',
                '1'=>'Serviços'         
            );

            if($u->hasPermission('report_view')){
            

                $this->loadTemplate('report_inventory', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

}


public function inventory_pdf(){

      $data = array();
        $u = new Users();
        $u->setLoggedUser();

          $data['categoriases'] = array(
                '0'=>'Vendas',
                '1'=>'Serviços'         
            );

            if($u->hasPermission('report_view')){
                    $category = addslashes($_GET['category']);
                    $i = new Inventory();

                    $data['inventory_list'] = $i->getInventoryFiltered($category, $u->getCompany());

                         $data['filters'] = $_GET;


                    $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_inventory_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();


        }else{
            header("Location: ".BASE_URL);

        } 


}



public function accounts(){
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

            if($u->hasPermission('report_view')){
            

                $this->loadTemplate('report_accounts', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

}

public function accounts_pdf(){

      $data = array();
        $u = new Users();
        $u->setLoggedUser();

        

           $data['payses'] = array(
                '0'=>'NÃO',
                '1'=>'SIM'

            );


            if($u->hasPermission('report_view')){
                    $period1 = addslashes($_GET['period1']);
                    $period2 = addslashes($_GET['period2']);
                    $pay = addslashes($_GET['pay']);
                    
                    $s = new Accounts();
                    $data['accounts_list'] = $s->getAccountsFiltered($period1, $period2, $pay, $u->getCompany());

                    $data['filters'] = $_GET;


                    $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_accounts_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();


        }else{
            header("Location: ".BASE_URL);

        } 



    }



    public function nfces(){
       $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

            $data['formases'] = array(
                '01'=>'Dinheiro',
                '02'=>'Cheque',
                '03'=>'Cartão de Crédito',
                '04'=>'Cartão de Débito',
                '05'=>'Crédito Loja',
                '10'=>'Vale Alimentação',
                '11'=>'Vale Refeição',
                '12'=>'Vale Presente',
                '13'=>'Vale Combustível',
                '15'=>'Boleto Bancário',
                '90'=>'Sem Pagamento',
                '99'=>'Outros'
                 );

        $data['statuses'] = array(
                '0'=>'Aguard. pag.',
                '1'=>'Pago',
                '2'=>'Cancelado',
                '3'=>'Troca',
                '4'=>'Orcamento'
            );

            if($u->hasPermission('report_view')){
            

                $this->loadTemplate('report_nfces', $data);
        }else{
            header("Location: ".BASE_URL);

        } 

}

public function nfces_pdf(){

      $data = array();
        $u = new Users();
        $u->setLoggedUser();

          $data['formases'] = array(
                '01'=>'Dinheiro',
                '02'=>'Cheque',
                '03'=>'Cartão de Crédito',
                '04'=>'Cartão de Débito',
                '05'=>'Crédito Loja',
                '10'=>'Vale Alimentação',
                '11'=>'Vale Refeição',
                '12'=>'Vale Presente',
                '13'=>'Vale Combustível',
                '15'=>'Boleto Bancário',
                '90'=>'Sem Pagamento',
                '99'=>'Outros'
                 );

        $data['statuses'] = array(
                '0'=>'Aguard. pag.',
                '1'=>'Pago',
                '2'=>'Cancelado',
                '3'=>'Troca',
                '4'=>'Orcamento'
            );
        
            if($u->hasPermission('report_view')){
                    $client_name = addslashes($_GET['client_name']);
                    $salesman_name_vendedor = addslashes($_GET['salesman_name_vendedor']);
                    $period1 = addslashes($_GET['period1']);
                    $period2 = addslashes($_GET['period2']);
                    $status = addslashes($_GET['status']);
                    $forma = addslashes($_GET['forma']);
                    $order = addslashes($_GET['order']);
                    
                    $s = new Sales();
                    $data['sales_list'] = $s->getSalesFiltered($client_name, $salesman_name_vendedor,
                     $period1, $period2, $status, $forma  ,$order, $u->getCompany());

                    $data['filters'] = $_GET;


                    $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_nfces_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();


        }else{
            header("Location: ".BASE_URL);

        } 


}


    }