<?php

class GraduatesController extends AppController {

	public $uses = array('Graduate', 'Log');

	function index(){
		$this->Session->read('Auth')['User']['id'];
	}

	function add() {
		$this->Graduate->validate['reference_number'] = array();

		if($this->request->is('post')) {
			$data = $this->request->data;
			
			$this->Graduate->create();
		    if($this->Graduate->save($data)){
				$fname = $data['Graduate']['first_name'];
				$mname = $data['Graduate']['middle_name'];
				$lname = $data['Graduate']['last_name'];

				//logs params
				$params["Log"]["user_id"] = $this->Session->read('Auth')['User']['id'];
				$params["Log"]["action"] = "Add Graduate";
				$params["Log"]["description"] = "Added ".$lname.", ".$fname." ".$mname." on graduates list.";

				$this->Log->create();
				$this->Log->save($params);

				unset($this->request->data);

				$this->Flash->set('Successfully Added', array('key' => 'success'));
			} else {
				$this->Flash->set('Please recheck input fields', array('key' => 'error'));
			}
		}

		$results = array( 0=>'Not yet competent.', 1 => 'Competent');
		$this->set('assessment_results', $results);
	}
}

?>