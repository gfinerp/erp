<?php
class loginController extends controller{
	public function index(){

		$data = array();
			if(isset($_POST['email']) && !empty($_POST['email'])){
				$email = addslashes($_POST['email']);
				$pass = addslashes($_POST['password']);

				$u = new Users();

				if($u->doLogin($email, $pass)){
					header("Location: ".BASE_URL);
					exit;

				}else{
					$data['error'] = 'E-mail e/ou senha errados.';
				}
			}
		
		$this->loadView('login', $data);
	}

	#ADICIONAR PERMISSOES
	public function logout(){
		$u = new Users();
		$u->setLoggedUser();
		if($u->hasPermission('logout')){
			$u->logout();
						header("Location: ".BASE_URL);

			}else{
				echo "NAO PODE FAZER LOGOUT...";
				exit;

			}
	}

}