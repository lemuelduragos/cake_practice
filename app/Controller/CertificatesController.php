<?php

App::uses('ApiController', 'Controller');

class CertificatesController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('request');
	}

	function index(){
		$this->Session->read('Auth')['User']['id'];
	}

	function add() {
		$results = array( 0=>'Not yet competent.', 1 => 'Competent');
		$this->set('assessment_results', $results);
	}

	function request() {
		$this->layout = 'request';
	}
}

?>