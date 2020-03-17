<?php

App::uses('ApiController', 'Controller');

class CertificatesController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('request');
	}

	function index(){
		$data = $this->request->query;

		$this->paginate = array(
		 	'fields' => array('Certificate.*'),
			'limit' => '10',
		);
		$this->set('requests', $this->paginate( $this->Certificate ));
	}

	function request() {
		$this->layout = 'request';

		if($this->request->is('post')) {
			$data = $this->request->data;
			
			$this->Certificate->create();
		    if($this->Certificate->save($data)){
				unset($this->request->data);

				$this->Flash->set('Successfully Added', array('key' => 'success'));
			} else {
				$this->Flash->set('Please recheck input fields', array('key' => 'error'));
			}
		}
	}
}

?>