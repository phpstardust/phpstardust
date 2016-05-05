<?php

class Categorie extends AppModel {
	
	public $validate = array(
        'name' => array(
			  'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Name already exists.'
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
			$data = trim($data);
		}
		
		return $data;
	}
	
	
	
	
	public function beforeSave($options = array()) {
		
		if (!empty($this->data)) {
			$this->data = $this->cleanVars($this->data);
		}
		
		if (isset($this->data[$this->alias]['name'])) $this->data[$this->alias]['slug'] = strtolower(Inflector::slug($this->data[$this->alias]['name'],'-'));
		
		return true;
		
	}
	
	
	
	
}

?>
