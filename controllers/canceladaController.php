<?php
/**
* 
*/
class canceladaController extends controller
{
	
public function index() {
$dados = array();

$this->loadView('cancelada', $dados);

}
}