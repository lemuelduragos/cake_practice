<?php

App::uses('ApiController', 'Controller');

class QueuesController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('login','index', 'select_registrar', 'logout', 'add', 'addApi');
	}

	function index(){
		$this->Session->read('Auth')['User']['id'];
	}

	function select_registrar() {
		$this->layout = false;
		$this->autoRender=false;

		$start = date('Y-m-d');

		$role = $this->Session->read('Auth')['User']['role'];

		$data = $this->Queue->find('all', 
			array('conditions' =>
			 	array(
					'served' => 0, 
					'date_added >=' => $start, 
					'serving !=' => 1,
					'office' => $role
				)
			)
		);
		return json_encode($data);
	}

	function select_serving() {
		$this->layout = false;
		$this->autoRender=false;

		$result = [];
		$start = date('Y-m-d');

		$registrar = $this->Queue->find('first', 
			array(
				'conditions' => array('serving' => 1, 'date_added >=' => $start, 'office' => 1),
				'fields'=>array('priority')
			)
		);

		$cashier = $this->Queue->find('first', 
			array(
				'conditions' => array('serving' => 1, 'date_added >=' => $start, 'office' => 2),
				'fields'=>array('priority')
			)
		);

		$bookkeeper = $this->Queue->find('first', 
			array(
				'conditions' => array('serving' => 1, 'date_added >=' => $start, 'office' => 3),
				'fields'=>array('priority')
			)
		);

		$result["role"] = $this->Session->read('Auth')['User']['role'];
		$result["registrar"] = isset($registrar["Queue"]) ? $registrar["Queue"]["priority"] : "Available";
		$result["cashier"] = isset($cashier["Queue"]) ? $cashier["Queue"]["priority"] : "Available";
		$result["bookkeeper"] = isset($bookkeeper["Queue"]) ? $bookkeeper["Queue"]["priority"] : "Available";

		return json_encode($result);
	}

	function next() {
		$this->layout = false;
		$this->autoRender=false;

		$start = date('Y-m-d');

		$Api = new ApiController();

		$role = $this->Session->read('Auth')['User']['role'];

		$params = $this->request->query;

		$this->Queue->id = $this->Queue->field('id', array('serving' => 1, 'office' => $role));
		if ($this->Queue->id) {
		    $this->Queue->saveField('serving', 0);
		}

		if(isset($params["id"]) && $params["id"] != "undefined") {
			$this->Queue->id = (int)$params["id"];
			$this->Queue->save(array('served' => 1, 'serving' => 1));

			$serving = $this->Queue->find('first', array(
					'conditions' => array('device_token !=' => "", 'serving' => 1),
					'fields'=>array('device_token')
				)
			);
			
			$device_token = isset($serving["Queue"]) ? $serving["Queue"]["device_token"] : "";

			$Api->sendPushNotification(array($device_token), true);
		}

		$upcoming = $this->Queue->find('list', 
			array(
				'conditions' => array('date_added >=' => $start, 'office' => $role, 'served' => 0),
				'fields'=> array('device_token'),
				'limit' => 5,
			)
		);

		$tokens = array_values($upcoming);
		$Api->sendPushNotification($tokens, false);
	}

	function add() {
		$start = date('Y-m-d');
		$roles = array(1 => 'Registrar', 2=>'Cashier', 3=>'Bookkeeper');
		$this->set('office', $roles);

		$student_type = array(0 => 'New Student', 1=>'Old Student', 2=>'Guest');
		$this->set('student_type', $student_type);

		if($this->request->is('post')) {
			$data = $this->request->data;

			$name = $data["Queue"]["name"];
			$id_number = $data["Queue"]["id_number"];

			//check if user has current active priority number
			$record = $this->Queue->find('first', 
				array(
					'conditions' => array('date_added >=' => $start, 'served' => 0, 'OR' => array('name' => $name, 'id_number' => $id_number)),
					'fields'=>array('priority'),
					'order' => 'priority DESC'
				)
			);

			if($record) {
				$this->Flash->set('Duplicate Registration', array('key' => 'error'));
				return;
			}

			$office = $data["Queue"]["office"];

			$last = $this->Queue->find('first', 
				array(
					'conditions' => array('date_added >=' => $start),
					'fields'=>array('priority'),
					'order' => 'priority DESC'
				)
			);

			if(isset($last["Queue"])) {
				$data["Queue"]["priority"] = $last["Queue"]["priority"] + 1;
			} else {
				$data["Queue"]["priority"] = 1;
			}
	
			$this->Queue->create();
			if($this->Queue->save($data)){
				unset($this->request->data);
				$this->Flash->set('Successfully Registered : Your priority number is :'. $data["Queue"]["priority"], array('key' => 'success'));
			} else {
				unset($this->request->data);
				$this->Flash->set('Failed Registration', array('key' => 'error'));
			}
		}
	}
}

?>