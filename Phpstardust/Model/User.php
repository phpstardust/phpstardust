<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	
	
	
	
	public $validate = array(
        'username' => array(
			  'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Username already exists.'
			  ),
			  'minLength' => array(
				'rule' => array('minLength', '3'),
				'message' => 'Username must be min 3 characters.'
			  )
		),
		'email' => array(
			  'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Email already exists.'
			  ),
			  'email' => array(
				'rule' => 'email',
				'message' => 'Insert a valid email.'
			  )
		),
		'password' => array(
			'between' => array(
				'on' => 'create',
				'rule'      => array('between', 8, 40),
				'message'   => 'The password is required and must be between 8 and 40 characters.'
			 ),
			'alphanumeric' => array(
				'on' => 'update',
				'rule' => 'alphanumeric',
    			'allowEmpty' => true,
				'message'   => ''
			)
		),
		'role' => array(
            'valid' => array(
                'rule' => array('listRoles'),
                'message' => 'Select role.'
            )
        ),
		'status' => array(
            'valid' => array(
                'rule' => array('inList', array(0, 1)),
                'message' => 'Select status.',
                'allowEmpty' => false
            )
        ),
		'accept' => array(
            'valid' => array(
                'rule' => array('inList', array(0, 1)),
                'message' => 'Accept ToS and Privacy policy.',
                'allowEmpty' => false,
				'required' => 'register'
            )
        )
    );
	
	
	
	
	public function listRoles($check) {
	
		$valid = false;
		
		foreach(Configure::read('roles') as $key => $value) {
			
			if ($check["role"]===$key) $valid = true;
				
		}
		
		return($valid);
		
	}
	
	
	
	
	public function cleanVars($data) {
		if (is_array($data)) {
			foreach ($data as $key => $var) {
				$data[$key] = $this->cleanVars($var);
			}
		} else {
			$data = strip_tags($data, Configure::read('Psd.allowedHtmlTags'));
			$data = trim($data);
		}
		
		return $data;
	}
	
	
	
	
	public function beforeSave($options = array()) {
		
		if (!empty($this->data)) {
			$this->data = $this->cleanVars($this->data);
		}

		$oldPassword = '';

		if (isset($this->data[$this->alias]['id'])) {
			$this->id = $this->data[$this->alias]['id'];
			$oldPassword = $this->field('password');
		}
		
		if (isset($this->data[$this->alias]['username'])) {
			$this->data[$this->alias]['username'] = str_replace(' ','',$this->data[$this->alias]['username']);
		}
		
		if (!empty($this->data[$this->alias]['password'])) {
			
			$passwordHasher = new BlowfishPasswordHasher();
			
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
			
		}
		else $this->data[$this->alias]['password'] = $oldPassword;
		
		return true;
		
	}
	
	
	
	
	public $hasMany = array(
        'Page' => array(
            'className' => 'Page',
            'foreignKey' => 'user_id',
			'dependent'=>true
        )
    );


	

}

?>
