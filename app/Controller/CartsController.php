<?php 

class CartsController extends AppController
{
	function index() {

	}
	function select() {

		$this->layout = false;
		$id = $this->Session->read('Auth')['User']['id'];

		$this->Cart->getVirtualField('total');
		$this->Cart->getVirtualField('name');

		$this->paginate = array(
			'Cart' => array(
				'conditions' => array('Cart.user_id' => $id),
				'joins' => array(
					array (
						'table' => 'users',
						'alias' => 'Owners',
						'type' => 'INNER',
						'conditions' => array(
							'Cart.user_id = Owners.id'
						)
					),
					array (
						'table' => 'products',
						'alias' => 'product',
						'type' => 'LEFT',
						'conditions' => array(
							'Cart.product_id = product.id'
						)
					)),
				'fields' => array(
					'Cart.id',
					'Cart.user_id',
					'Cart.product_id',
					'Cart.quantity',
					'product.name',
					'product.description',
					'product.price',
					'Cart.name',
					'Cart.total'
				),
				'limit' => '10',
				'order' => array('Cart.name' => 'asc')
			)
		);
		$data=$this->paginate('Cart');
		$this->set('carts', $data);
 		$this->Session->write("cart_data", $data);
		// pr($this->Cart->getDataSource()->getLog());

	}
	function count(){
		$this->autoRender=false;
		$id = $this->Session->read('Auth')['User']['id'];
		 $cartItems = $this->Cart->find('all', array(
		 	'fields' => array('SUM(Cart.quantity) AS quantity'),
        	'conditions' => array('Cart.user_id' => $id)
    	));

		// $counter = $cartItems['Cart'];
		return json_encode((int)$cartItems['0']['0']['quantity']);
	}

	function addCart() {
		$this->autoRender=false;
		if ($this->request->is('post')) {
			$id = $this->Session->read('Auth')['User']['id'];
			$data = array();
			$data = (array)$this->request->input('json_decode');
			$data['Cart']['user_id'] = $id;
			$data['Cart']['product_id'] = $data['product_id'];
			$data['Cart']['quantity'] = $data['quantity'];
			$quantity = $data['quantity'];
			$exist = $this->Cart->find('count', array(
				'conditions' => array(
					'AND' => array(
						array('user_id' => $id),
						array('product_id' => $data['product_id'])
					) 
				)
			));
			if(!$exist) {
				$this->Cart->create();
				$this->Cart->save($data);
			} else {
				$this->Cart->updateAll(
				    array('quantity' => 'quantity+'.$quantity), 
				    array(
				        'user_id' => $id,
				        'product_id' => $data['product_id']
				    )
				);
			}
		};
	}

	function delete(){
		$this->autoRender = false;
		$data = array();
		$data = (array)$this->request->input('json_decode');
		$id =  $data['0'];
		$this->Cart->delete($id);
		pr($id);
		pr($this->Cart->getDataSource()->getLog());

	}

	function checkout() {
		CartsController::reselect();
		$cartData = $this->Session->read("cart_data");
		$this->set('carts', $cartData);

	}

	function addQuantity() {
		$this->autoRender = false;
		$data['Cart'] = $this->request->data;
		pr($data);
		if($this->request->is('post')) {
			$this->Cart->save($data);

		}

	}
	function minusQuantity() {
		$this->autoRender = false;
		$data['Cart'] = $this->request->data;
		pr($data);
		if($this->request->is('post')) {
			$this->Cart->save($data);
		}
	}

	function reselect() {

		$id = $this->Session->read('Auth')['User']['id'];

		$this->Cart->getVirtualField('total');
		$this->Cart->getVirtualField('name');

		$this->paginate = array(
			'Cart' => array(
				'conditions' => array('Cart.user_id' => $id),
				'joins' => array(
					array (
						'table' => 'users',
						'alias' => 'Owners',
						'type' => 'INNER',
						'conditions' => array(
							'Cart.user_id = Owners.id'
						)
					),
					array (
						'table' => 'products',
						'alias' => 'product',
						'type' => 'LEFT',
						'conditions' => array(
							'Cart.product_id = product.id'
						)
					)),
				'fields' => array(
					'Cart.id',
					'Cart.user_id',
					'Cart.product_id',
					'Cart.quantity',
					'product.name',
					'product.description',
					'product.price',
					'Cart.name',
					'Cart.total'
				),
				'limit' => '10',
				'order' => array('Cart.name' => 'asc')
			)
		);
		$data=$this->paginate('Cart');
		$this->set('carts', $data);
 		$this->Session->write("cart_data", $data);
	}


	
}


?>