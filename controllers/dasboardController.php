<?php
class dasboardController extends controller {

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

        $s = new Sales();

              $data['formases'] = array(
                '01'=>'Dinheiro',
                '02'=>'Cheque',
                '03'=>'Cartão de Crédito',
                '04'=>'Cartão de Dédito',
                '05'=>'Crédito Loja',
                '10'=>'Vale Alimentação',
                '11'=>'Vale Refeição',
                '12'=>'Vale Presente',
                '13'=>'Vale Combustível',
                '14'=>'Duplicata Mercantil',
                '99'=>'Outros'
                 );

        $data['products_sold'] = $s->getSoldProducts(date('Y-m-d', strtotime('-30 days')), date('Y-m-d H:i:s'), $u->getCompany());
        $data['revenue'] = $s->getTotalRevenue(date('Y-m-d', strtotime('-30 days')), date('Y-m-d H:i:s'), $u->getCompany());
        $data['accounts'] = $s->getTotalExpenses(date('Y-m-d', strtotime('-30 days')), date('Y-m-d H:i:s'), $u->getCompany());
        $data['days_list'] = array();
       $data['days_list'] = array();
        for($q=1;$q<31;$q++) {
            $data['days_list'][] = date($q.'/m');
        }

         $data['revenue_list'] = $s->getRevenueList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());
         $data['accounts_list'] = $s->getExpensesList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());


        $data['forma_list'] = $s->getFormaStatusList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());

        $this->loadTemplate('dasboard', $data);
    }

}


