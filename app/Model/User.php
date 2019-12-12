<?php

class User extends AppModel
{
	public $validate = array(
	    'photo' => array(
	        'rule' => array(
	        	'extension',
	            array('gif', 'jpeg', 'png', 'jpg')
	        ),
	        'message' => 'Please supply a valid image.'
	    ),
	    'new_password' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'required' => true,
                'message' => 'Please input new password'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 8, 225),
                'message' => 'Between 8 to 25 characters'
            )),
	   'confirm_password' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'required' => true,
                'message' => 'Please input new password'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 8, 225),
                'message' => 'Between 8 to 25 characters'
            )),
	   'username' => array(
            'isUnique' => array(
                'rule' => 'isUnique',
                'allowEmpty' => false,
                'message' => 'Usename already in use.'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 8, 25),
                'message' => 'Between 8 to 25 characters'
            )),
	    'first_name' => array(
            'isUnique' => array(
                'rule' => 'notBlank',
                'allowEmpty' => false,
                'message' => 'Please input your first name.'
           )),
	    'middle_name' => array(
            'isUnique' => array(
                'rule' => 'notBlank',
                'allowEmpty' => false,
                'message' => 'Please input your middle name.'
            )),

		'last_name' => array(
            'isUnique' => array(
                'rule' => 'notBlank',
                'allowEmpty' => false,
                'message' => 'Please input your last name.'
            )),
		'password' => array(
            'between' => array(
                'rule' => array('lengthBetween', 8, 225),
                'allowEmpty' => false,
                'required' => true,
                'message' => 'Please input new password'
            )
        ),
    	'email_address' => array(
    	 		'email' => array(
    	 			'rule' => 'email',
    	 			'message' => 'Please input a valid email address.'
    	 			),
    	 	'unique' => array(
    	 			'rule' => 'isUnique',
    	 			'message' => 'Email address is already in use.'
    	 			)
    	 	)
	);
		
}

?>