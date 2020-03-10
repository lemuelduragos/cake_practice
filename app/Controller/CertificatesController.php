<?php

App::uses('ApiController', 'Controller');

class CertificatesController extends AppController {

	function index(){
		$this->Session->read('Auth')['User']['id'];
	}

	function add() {
		$roles = array( 0=>'Not yet competent.', 1 => 'Competent');
		$this->set('assessment_results', $roles);
	}
}

?>