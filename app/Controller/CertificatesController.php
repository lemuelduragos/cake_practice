<?php

App::uses('ApiController', 'Controller');

class CertificatesController extends AppController {

	function index(){
		$this->Session->read('Auth')['User']['id'];
	}

	function add() {
		
		$this->set('assessment_results', $roles);
	}
}

?>