<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class Installer extends AppModel {
	
	
	
	
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
		)
    );
	
	
	
	
	public function cleanVars($data) {
		if (is_array($data)) {
			foreach ($data as $key => $var) {
				$data[$key] = $this->cleanVars($var);
			}
		} else {
			$data = strip_tags($data, Configure::read('Psd.allowedHtmlTags'));
		}
		
		return $data;
	}
	
	
	
	
	public function beforeSave($options = array()) {
		
		if (!empty($this->data)) {
			$this->data = $this->cleanVars($this->data);
		}

		$this->id = $this->data[$this->alias]['id'];
		
		if (!empty($this->data[$this->alias]['password'])) {
			
			$passwordHasher = new BlowfishPasswordHasher();
			
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
			
		}
		
		return true;
		
	}



	
}

?>