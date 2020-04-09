<?php

App::uses('ApiController', 'Controller');

class CertificatesController extends AppController {

	public $uses = array('Certificate', 'Log');

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('request');
	}

	function index(){
		$data = $this->request->query;
		$query = $data;
		$condition = array();

		$search_condition_keys = array_keys($data);

		$first_name = isset($data["first_name"])? $data["first_name"] : '';
		$middle_name = isset($data["middle_name"])? $data["middle_name"] : '';
		$last_name = isset($data["last_name"])? $data["last_name"] : '';
		$status = isset($data["status"])? $data["status"] : '';
		$qualification_title = isset($data["qualification_title"])? $data["qualification_title"] : '';
		$center = isset($data["center"])? $data["center"] : '';
		$venue = isset($data["venue"])? $data["venue"] : '';
		$email_address = isset($data["email_address"])? $data["email_address"] : '';
		$contact_number = isset($data["contact_number"])? $data["contact_number"] : '';

		$conditions = array(
				"first_name LIKE" => '%'.$first_name."%",
				"middle_name LIKE" => '%'.$middle_name."%",
				"last_name LIKE" => '%'.$last_name."%",
				"status LIKE" => '%'.$status."%",
				"qualification_title LIKE" => '%'.$qualification_title."%",
				"center LIKE" => '%'.$center."%",
				"venue LIKE" => '%'.$venue."%",
				"email_address LIKE" => '%'.$email_address."%",
				"contact_number LIKE" => '%'.$contact_number."%"
			);

		if(!isset($data["first_name"]) || empty($data["first_name"])) {
			unset($conditions["first_name LIKE"]);
		}

		if(!isset($data["middle_name"]) || empty($data["middle_name"])) {
			unset($conditions["middle_name LIKE"]);
		}

		if(!isset($data["last_name"]) || empty($data["last_name"])) {
			unset($conditions["last_name LIKE"]);
		}

		if(!isset($data["status"])) {
			unset($conditions["status LIKE"]);
		}

		if(!isset($data["qualification_title"]) || empty($data["qualification_title"])) {
			unset($conditions["qualification_title LIKE"]);
		}

		if(!isset($data["center"]) || empty($data["center"])) {
			unset($conditions["center LIKE"]);
		}

		if(!isset($data["venue"]) || empty($data["venue"])) {
			unset($conditions["venue LIKE"]);
		}

		if(!isset($data["email_address"]) || empty($data["email_address"])) {
			unset($conditions["email_address LIKE"]);
		}

		if(!isset($data["contact_number"]) || empty($data["contact_number"])) {
			unset($conditions["contact_number LIKE"]);
		}

	    $status = array( 0=>'Pending', 1 => 'Claim Slip Sent', 2 => 'Claimed');

		$this->paginate = array(
		 	'fields' => array('Certificate.*'),
			'limit' => '10',
			'conditions' => array('OR' => $conditions)
		);

		if(isset($data["success"]) && $data["success"] == 'true') {
			$email = isset($data["email"]) ? $data["email"] : "";
			if (empty($email)) {
				$this->Flash->set('Successfully Updated Status', array('key' => 'success'));
			} else {
				$this->Flash->set('Successfully Updated Status. An email has been sent to '.$email, array('key' => 'success'));
			}
			
		} else {
			$this->Session->delete('Flash.success');
		}

		$this->set('status_options', $status);
		$this->set('form_data', $data);
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

	function update_status() {
		$this->layout = false;
		$this->autoRender = false;

		$data = $this->request->data["Certificate"];

		$id = $data["id"];
		$this->Certificate->id = $id;
		
		if($this->Certificate->saveField('status', $data["status"])){
			$fname = $data['first_name'];
			$mname = $data['middle_name'];
			$lname = $data['last_name'];
			$last = $data['last_status'];
			$email_address = "";

			//logs paramst
			$params["Log"]["user_id"] = $this->Session->read('Auth')['User']['id'];
			$params["Log"]["action"] = "Status Udpate";
			$params["Log"]["description"] = "Updated ".$lname.", ".$fname." ".$mname." status from ". $this->get_status($last). " to ".$this->get_status($data["status"]);

			$this->Log->create();
			$this->Log->save($params);

			unset($this->request->data);

			if($data['status'] == 1) {
				$email_address = $data['email_address'];
				$number = $data['contact_number'];
				$this->send_sms($number);
				$this->send_email($email_address);
			}
		}

 		$this->redirect(array('controller' => 'certificates', 'action' => 'index', "?" => array('success' => 'true')));
	}

	function send_email($email) {
		$this->layout = false;
		$this->autoRender = false;

		$Email = new CakeEmail('gmail');
		$Email->from(array('etesda.is@gmail.com' => 'eTesda Infromation System'));
		$Email->to($email);
		$Email->subject('National Certificate Request');
		$Email->send('Your national certificate is ready for release.');

 		$this->redirect(array('controller' => 'certificates', 'action' => 'index', "?" => array('success' => 'true', 'email' => $email)));
	}

	function send_sms($number) {
		$this->layout = false;
		$this->autoRender = false;

		$country_code = '63';
		$number = substr_replace($number, '+'.$country_code, 0, ($number[0] == '0'));

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://rest.nexmo.com/sms/json');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "from=eTesda&text=Your national certificate is ready for release.&to=".$number."&api_key=7024701d&api_secret=SLthNWi9BdQijSkh");
		curl_setopt($ch, CURLOPT_POST, 1);

		$headers = array();
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
	}

	function get_status($status) {
		$this->layout = false;
		$this->autoRender = false;


		switch($status) {
			case '1':
				return "Pending";
			case '2':
				return "Claim Slip Sent";
			case '3':
				return "Claimed";
		}
	}
}

?>