<?php

class ProductsController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('login','index', 'select', 'logout');
	}

	function index(){
		$this->Session->read('Auth')['User']['id'];
	}

	function select() {
		$this->layout = false;
		// $data = $this->Product->find('all');
		// return json_encode($data);


		$this->paginate = array(
			'order' => array('Product.name' => 'asc'),
	        'limit' => 10
   	 	);
		$data=$this->paginate('Product');
		$this->set('products', $data);

	}


}

?>