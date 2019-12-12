<?php

class ApiController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();

		$this->loadModel('Queue');
		$this->Auth->allow('login','index', 'select_registrar', 'logout', 'add', 'select_serving');
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
		$result["upcoming"] = "";
		$start = date('Y-m-d');

		$data = $this->request->data;
		$device_token = isset($data["device_token"])? $data["device_token"] : "";

		if($device_token != "") {
			$priority = $this->Queue->find('first', 
				array(
					'conditions' => array('date_added >=' => $start, 'device_token' => $device_token, 'OR' => array('served' => 0, 'serving' => 1)),
					'fields'=>array('priority', 'serving', 'office')
				)
			);

			$upcoming = $this->Queue->find('first', 
				array(
					'conditions' => array('date_added >=' => $start, 'device_token IN' => [$device_token],  'OR' => array('served' => 0, 'serving' => 1)),
					'fields'=>array('priority', 'serving', 'office'),
					'limit' => 5
				)
			);

			if($upcoming && isset($priority["Queue"]["priority"])) {
				if($priority["Queue"]["serving"]) {
					$result["upcoming"] = "It's your turn. \nPlease proceed to your requested office.";
				} else {
					$result["upcoming"] = "It's almost your turn. Please stand by.";
				}
			} else if (!$upcoming && isset($priority["Queue"]["priority"])) {
				$result["upcoming"] = "Your request is on queue. Please wait.";
			}
		}

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

		$result["registrar"] = isset($registrar["Queue"]) ? $registrar["Queue"]["priority"] : "Available";
		$result["cashier"] = isset($cashier["Queue"]) ? $cashier["Queue"]["priority"] : "Available";
		$result["bookkeeper"] = isset($bookkeeper["Queue"]) ? $bookkeeper["Queue"]["priority"] : "Available";
		$number = isset($priority["Queue"]) ? $priority["Queue"]["priority"] : "No Priority Number";
		$result["serving"] = isset($priority["Queue"]) ? $priority["Queue"]["serving"] == 1 : false;
		$office = isset($priority["Queue"]) ? $this->getOfficeString($priority["Queue"]["office"]) . ": ": "";

		$result["priority"] = $office.$number;

		return new CakeResponse(array('type' => 'json', 'body' => json_encode($result)));
	}

	function add() {
		$this->layout = false;
		$this->autoRender=false;

		$result = [];

		$start = date('Y-m-d');

		if($this->request->is('post')) {
			$data = $this->request->data;

			$name = isset($data["name"])? $data["name"] : "";
			$id_number = isset($data["id_number"])? $data["id_number"] : "";
			$type = isset($data["type"])? $data["type"] : "";
			$office = isset($data["office"])? $data["office"] : "";
			$contact = isset($data["contact"])? $data["contact"] : "";
			$device_token = isset($data["device_token"])? $data["device_token"] : "";

			//check if user has current active priority number
			$record = $this->Queue->find('first', 
				array(
					'conditions' => array('date_added >=' => $start, 'served' => 0, 'OR' => array('name' => $name, 'id_number' => $id_number)),
					'fields'=>array('priority'),
					'order' => 'priority DESC'
				)
			);

			if($record) {
				$result["success"] = false;
				$result["data"]["error"] = "Duplicate registration";

				return new CakeResponse(array('type' => 'json', 'body' => json_encode($result)));;
			}

			$last = $this->Queue->find('first', 
				array(
					'conditions' => array('date_added >=' => $start),
					'fields'=>array('priority'),
					'order' => 'priority DESC'
				)
			);

			if(isset($last["Queue"])) {
				$params["Queue"]["priority"] = $last["Queue"]["priority"] + 1;
			} else {
				$params["Queue"]["priority"] = 1;
			}

			$params["Queue"]["name"] = $name;
			$params["Queue"]["id_number"] = $id_number;
			$params["Queue"]["office"] = $office;
			$params["Queue"]["student_type"] = $type;
			$params["Queue"]["device_token"] = $device_token;
			$params["Queue"]["contact_number"] = $contact;
	
			$this->Queue->create();
			if($this->Queue->save($params)){
				$result["success"] = true;
				$result["data"]["priority"] = $params["Queue"]["priority"];
				$result["data"]["office"] = $this->getOfficeString(array($params["Queue"]["office"]));
				unset($this->request->data);
			} else {
				$result["success"] = false;
				$result["data"]["error"] = "Failed to create priority";
				unset($this->request->data);
			}
		}

		return new CakeResponse(array('type' => 'json', 'body' => json_encode($result)));
	}

	function sendPushNotification($tokens, $is_served = false) {

		$this->layout = false;
		$this->autoRender=false;

		if (empty($tokens)) return;

		if (count($tokens) > 1){
			$fields['registration_ids'] = $tokens;
		} else {
			$fields['to'] = $tokens[0];
		}

		$message = (!$is_served) ? "Your priority number is upcoming. Please be on the vacinity for faster transaction!" : "Your priority number is being served!";

		$fields['notification'] = [
			'body' => $message,
			'sound' => 'default',
			'contentTitle' => 'NORSU Queue'
		];

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: key=AIzaSyAEguff_svdTh9d1fF4jZs8Aon0LE4IwCM', 'Content-Type: application/json']);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));

		curl_exec($curl);

		curl_close($curl);
	}

	function getOfficeString($type) {
        switch($type) {
            case "1" :
                return "Registrar";
                break;
            case "2" :
                return "Cashier";
                break;
            case "3" :
                return "Bookkeeper";
                break;
        }
	}
}
