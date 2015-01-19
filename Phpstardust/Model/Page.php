<?php

class Page extends AppModel {
	
	public $validate = array(
        'title' => array(
			  'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Title already exists.'
			  )
		),
		'image' => array(
			'rule' => array(
				'extension',
				array('gif', 'jpeg', 'png', 'jpg')
			),
			'message' => 'Please supply a valid image format (JPG, GIF or PNG).',
			'allowEmpty' => true
		),
		'status' => array(
            'valid' => array(
                'rule' => array('inList', array(0, 1)),
                'message' => 'Select status.',
                'allowEmpty' => false
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
		
		$this->data[$this->alias]['user_id'] = AuthComponent::user('id');
		if (isset($this->data[$this->alias]['title'])) $this->data[$this->alias]['slug'] = strtolower(Inflector::slug($this->data[$this->alias]['title'],'-'));
		
		return true;
		
	}

	
	
	
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
	
	
	

}

?>