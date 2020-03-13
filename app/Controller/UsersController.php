<?php 

class UsersController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('login', 'logout', 'register');
	}

	function index() {
		$firstName = $this->Session->read('Auth')['User']['first_name'];
		$middleName = $this->Session->read('Auth')['User']['middle_name'];
		$lastName = $this->Session->read('Auth')['User']['last_name'];
		$role = $this->Session->read('Auth')['User']['role'];

		if ($role == 1) {
			$role = 'Admin';
		} else {
			$role = 'Staff';
		}

		$this->set('role', $role);
		$this->set('firstName', $firstName);
		$this->set('middleName', $middleName);
		$this->set('lastName', $lastName);
	}

	function select() {
		$id = $this->Session->read('Auth')['User']['id'];
		$this->autoRender = false;
		$data = $this->User->find('all', array(
			'conditions' => array('id' => $id)
			));
		return json_encode($data);
	}

	function view_staffs() {
		$this->paginate = array(
		 	'fields' => array('User.*'),
			'limit' => '10',
			'conditions' => array('role !=' => 1)
		);
		$this->set('staffs', $this->paginate( $this->User ));
	}

	function edit() {
		$this->User->validate['password'] = array();
		$this->User->validate['new_password'] = array();
		$this->User->validate['confirm_password'] = array();
		if($this->request->is('post')) {
			$currentPhoto = $this->Session->read('Auth')['User']['photo'];	
			$photo = $this->request->data['User']['photo'];
			$id = $this->Session->read('Auth')['User']['id'];
			$data = $this->request->data;
			$data['User']['id'] = $id;
			unset($data['User']['photo']);
			$this->User->save($data);

			$_SESSION['Auth']['User']['first_name'] = $data['User']['first_name'] ;
			$_SESSION['Auth']['User']['last_name'] = $data['User']['last_name'];
		}

	}
	function security() {
		if($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->data;
			$data['User']['id'] = $this->Session->read('Auth')['User']['id'];
			$this->set('username', $data['User']['username']);
			$password = $_SESSION['Auth']['User']['password'];
			if(AuthComponent::password($data['User']['password']) == $password) {
					if($data['User']['new_password'] != $data['User']['password']) {
						if($data['User']['new_password'] == $data['User']['confirm_password']) {
						$data['User']['password'] = AuthComponent::password($data['User']['new_password']);
						if($this->User->save($data)) {
							$this->Flash->set('Password Successfully Changed', array('key' => 'success'));
							$_SESSION['Auth']['User']['password'] = $data['User']['password'];
							unset($this->request->data);
						}
					} else {
						$this->Flash->set('Password Mismatched!', array('key' => 'error'));
						unset($this->request->data);
					}
				} else {
					$this->Flash->set('New password is the same as current', array('key' => 'error'));
					unset($this->request->data);
				}

			} else {
				$this->Flash->set('Incorrect Password', array('key' => 'error'));
				unset($this->request->data);
			}
		}
	}
	function register(){

		$this->User->validate['new_password'] = array();
		$this->User->validate['confirm_password'] = array();

		if($this->request->is('post')) {
			$data = $this->request->data;
			if($data['User']['password'] == $data['User']['confirm_password']){
				$data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
				unset($data['User']['confirm_password']);
				$this->User->create();
				if($this->User->save($data)){
					unset($this->request->data);
					$this->Flash->set('Successfully Registered', array('key' => 'success'));
				}
			} else {
				$this->Flash->set('Incorrect Password', array('key' => 'error'));
			}

		}
		$roles = array( 0=>'Staff', 1 => 'Admin');
		$this->set('roles', $roles);
	}

	public function login() {
		$this->layout = 'login';

		if(isset($this->Session->read('Auth')['User']['id'])){
			return $this->redirect($this->Auth->redirectUrl());
		}

		if ($this->request->is('post')) {
			$username = $this->request->data['User']['Username'];
			$password = AuthComponent::password($this->request->data['User']['Password']);
			// ;
			$conditions = array(
				'User.username' => $username,
				'User.password' => $password
			);
			$data = $this->User->find('first', array(
				'conditions' => $conditions
			));

			if (isset($data['User'])) {
				if ($this->Auth->login($data['User'])) {
					$this->redirect($this->Auth->redirectUrl());
				}
			} else {
				$this->Flash->set('Please check username and password.', array('key' => 'auth'));
			}
		}
	}

	public function login_redirect() {
		$this->autoLayout = false;
	    $this->autoRender = false ;

	    $role = $_SESSION['Auth']['User']['role'];
	    switch($role) {
	      case 1: 
	        $controller = " logs";
	        break;
	      default: 
	        $controller = " certificates";
	        break;
	    };

	    $this->redirect(array('controller' => $controller, 'action' => 'index')); // Line added

	}


	public function logout() {
		return $this->redirect($this->Auth->logout());
		unset($_SESSION['User']);  

	}

	public function chat() {
	}
}
?>


