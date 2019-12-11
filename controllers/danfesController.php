<?php
/**
* 
*/
class danfesController extends controller
{
	
public function index() {
$dados = array();

$this->loadView('danfe', $dados);

}
}