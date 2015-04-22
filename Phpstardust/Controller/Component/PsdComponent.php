<?php

App::uses('Component', 'Controller');

class PsdComponent extends Component {
	
	public $components = array('Session','Cookie');
	
	
	
	
	public function generatePassword($length = 8) {
		
	  $password = "";
	  $characters = "0123456789bcdfghjkmnpqrstvwxyz";
	  $i = 0;
	  
	  while ($i<$length) {
		  
		$char = substr($characters, mt_rand(0, strlen($characters)-1), 1);
		
		if (!strstr($password, $char)) {
			
		  $password .= $char;
		  $i++;
		  
		}
		
	  }
	  
	  return($password);
	  
	}
	
	
	
	
	public function setTimezone() {
		
		$Setting = ClassRegistry::init('Setting');
		
		$Setting->id = 1;
		
		(string)$timezone = $Setting->field('timezone');
		
		Configure::write('Config.timezone',$timezone);
	
	}
	
	
	
	
	public function setLanguage() {
		
		$Setting = ClassRegistry::init('Setting');
		
		$Setting->id = 1;
		
		(string)$language = $Setting->field('language');
		
		Configure::write('Config.language', $language);
		$this->Session->write('Config.language', $language);
		CakeSession::write('Config.language', $language);
		
	}
	
	
	
	
	public function checkUserPermission($controller=NULL, $action=NULL) {
		
		$return = true;
		
		if (array_key_exists($this->Session->read('Auth.User.role'), Configure::read('permissions'))) {
			if (array_key_exists($controller, Configure::read('permissions.' .$this->Session->read('Auth.User.role')))) {
				
				if (in_array($action, Configure::read('permissions.' .$this->Session->read('Auth.User.role') .'.' .$controller))) {
					$return = true;
				}
				else $return = false;
				
			}
			
		}
		
		if ($controller=="users" && ($action=='login' || $action=='register' || $action=='activate' || $action=='forgot' || $action=='logout')) $return = true;
		
		return($return);
		
	}
	
	
	
	
	public function translateValidationMessages($messages=NULL) {
	
		$validMessages = array();
				
		foreach($messages as $key => $item) {

			$validMessages[$key][0] = __d('phpstardust', $item[0]);
			
		}
		
		unset($messages);
		
		return $validMessages;
		
	}
	
	
	
	
	public function upload($model,$field) {
		
		  if ($_FILES['data']['size'][$model][$field] == 0 || $_FILES['data']['error'][$model][$field]!== 0) return false;
		
		  if (is_uploaded_file($_FILES['data']['tmp_name'][$model][$field])) {
	
			  $uploadDir = Configure::read('Psd.uploads');
	  
			  $fileTmp = $_FILES['data']['tmp_name'][$model][$field];
			  
			  $fileName = $_FILES['data']['name'][$model][$field];
			  
			  $file = pathinfo($uploadDir . $fileName);
			  
			  $fileName = md5($file['filename'] .time()) ."." .$file['extension'];
		  
		  	  if (!file_exists($uploadDir)) {
				  
			  	mkdir($uploadDir);
				
			  }	
			
			  if (move_uploaded_file($fileTmp, $uploadDir . $fileName)) {
				  
				  return array('name'=>$fileName,'type'=>$file['extension'],'size'=>$_FILES['data']['size'][$model][$field]);
				  
			  }
			  else return false;
		  
		  }
		  else return false;
		
	}
	
	
	
	
	public function deleteFile($file=NULL) {
		
		if (is_file($file) && file_exists(Configure::read('Psd.uploads') .$file)) {
			
			unlink(Configure::read('Psd.uploads') .$file);
			return(true);
			
		}
		else return(false);
		
	}
	
	
	
	
	public function fileExists($file=NULL) {
		
		if (is_file($file) && file_exists(Configure::read('Psd.uploads') .$file)) return(true);
		else return(false);
		
	}
	
	
	
	
	public function isOffline($action=NULL) {
		
		$Setting = ClassRegistry::init('Setting');
		
		$Setting->id = 1;
		$status = $Setting->field('status');
		
		if ((!$this->Session->check('Auth.User') && $status==1) && $action!="login") return(true);
		else return(false);
		
	}
	

	
	
}
