<?php 

class LogsController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('login', 'logout', 'register');
		if ($id = $this->Session->read('Auth')['User']['role'] != 1) {
			$this->redirect($this->Auth->logout());
			unset($_SESSION['User']);  
		}
	}

	function index() {
		$this->paginate = array(
		 	'fields' => array('Log.*', 'user.first_name', 'user.middle_name', 'user.last_name'),
			'joins' => array(
				array (
					'table' => 'Users',
					'alias' => 'user',
					'type' => 'INNER',
					'conditions' => array(
						'Log.user_id = user.id'
					)
				)
			),
			'limit' => '10'
		);
		$this->set('logs', $this->paginate( $this->Log ));
	}	

	function staff_logs() {
		$data = $this->request->query;

		$this->paginate = array(
		 	'fields' => array('Log.*', 'user.first_name', 'user.middle_name', 'user.last_name'),
			'joins' => array(
				array (
					'table' => 'Users',
					'alias' => 'user',
					'type' => 'INNER',
					'conditions' => array(
						'Log.user_id = user.id'
					)
				)
			),
			'limit' => '10',
			'conditions' => array('user.id' => $data['id'])
		);
		$this->set('name', $data['name']);
		$this->set('logs', $this->paginate( $this->Log ));
	}	
}


?>