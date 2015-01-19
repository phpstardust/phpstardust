<?php

App::uses('AppController', 'Controller');
App::uses('File', 'Utility');

class SettingsController extends AppController {

	public $uses = array('Phpstardust.Setting');
	
	public $components = array(
		'Session','Cookie','RequestHandler','Paginator', 'Phpstardust.Psd',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
					'scope' => array('status' => 1)
                )
            ),
			'flash' => array(
				'key'=>'auth',
				'element'=>'authError'
			  ),
			'loginAction' => array('controller' => 'users', 'action' => 'login')
		)
	);
	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	
	

	public function edit($id = NULL) {
		
		if (!$id) {
			throw new NotFoundException(__d('phpstardust','Element not found.'));
		}
	
		$setting = $this->Setting->findById($id);
		
		if (!$setting) {
			throw new NotFoundException(__d('phpstardust','Element not found.'));
		}
	
		if ($this->request->is(array('post', 'put'))) {
			
			$this->Setting->id = $id;
			
			if ($this->Setting->save($this->request->data)) {
				 
				$this->Session->setFlash(
					__d('phpstardust', 'Settings has been modified.'), 'flash_success'
				);
				
				return $this->redirect(array('action' => 'edit', $id));
				
			}
			else $this->Setting->validationErrors = $this->Psd->translateValidationMessages($this->Setting->validationErrors);
			
		}
	
		if (!$this->request->data) $this->request->data = $setting;
		
	}
	
	
	
	
	function backupDb($tables = '*') {
		
		//$tables Comma separated list of tables you want to download, or '*' for all tables.

		$return = '';
	
		$modelName = $this->modelClass;
	
		$dataSource = $this->{$modelName}->getDataSource();
		$databaseName = $dataSource->getSchemaName();
	
		$return .= '-- Database: `' . $databaseName . '`' . "\n";
		$return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";
	
		if ($tables == '*') {
			$tables = array();
			$result = $this->{$modelName}->query('SHOW TABLES');
			foreach($result as $resultKey => $resultValue){
				$tables[] = current($resultValue['TABLE_NAMES']);
			}
		} else {
			$tables = is_array($tables) ? $tables : explode(',', $tables);
		}
	
		foreach ($tables as $table) {
			$tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);
	
			$return .= 'DROP TABLE IF EXISTS ' . $table . ';';
			$createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
			$createTableEntry = current(current($createTableResult));
			$return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";
	
			foreach($tableData as $tableDataIndex => $tableDataDetails) {
	
				$return .= 'INSERT INTO ' . $table . ' VALUES(';
	
				foreach($tableDataDetails[$table] as $dataKey => $dataValue) {
	
					if(is_null($dataValue)){
						$escapedDataValue = 'NULL';
					}
					else {
	
						$escapedDataValue = mb_convert_encoding( $dataValue, "UTF-8", "ISO-8859-1" );
	
						$escapedDataValue = $this->{$modelName}->getDataSource()->value($escapedDataValue);
					}
	
					$tableDataDetails[$table][$dataKey] = $escapedDataValue;
				}
				$return .= implode(',', $tableDataDetails[$table]);
	
				$return .= ");\n";
			}
	
			$return .= "\n\n\n";
		}
	
		$dbName = strtolower(Inflector::slug(Configure::read('Psd.name'),'-'));
		
		$fileName = $dbName . '-backup-' . date('Y-m-d_H-i-s') . '.sql';
	
		$this->autoRender = false;
		$this->response->type('Content-Type: text/x-sql');
		$this->response->download($fileName);
		$this->response->body($return);
	}
	
	
	
	
	public function importDb() {
		
        if ($this->request->is('post')) {
			
			if ($this->request->data["Setting"]["file"]["name"]!="") {
				
				$newfile = $this->Psd->upload('Setting','file');
				
				$filename = Configure::read('Psd.uploads') .$newfile["name"];
				
				$pathinfo = pathinfo($filename);
				$ext = strtolower($pathinfo['extension']);
				
				if ($ext=="sql") {
				
				$sql = new File($filename);
				$code = $sql->read(true, 'r');
				
				$result = $this->Setting->query($code);
				
				if ($result) {
					
					$this->Psd->deleteFile($newfile["name"]);
					
					$this->Session->setFlash(
						__d('phpstardust', 'Database has been imported.'), 'flash_success'
					);
					
					return $this->redirect(array('controller' => 'pages', 'action' => 'dashboard'));
				
				}
				
				}
				else {
					
					$this->Psd->deleteFile($newfile["name"]);
					
					$this->Session->setFlash(
						__d('phpstardust', 'Choose SQL file.'), 'flash_warning'
					);
				
                	return $this->redirect(array('action' => 'importDb'));
					
				}
				
			}
			else {
				
				$this->Session->setFlash(
					__d('phpstardust', 'Choose SQL file.'), 'flash_warning'
				);
				
                return $this->redirect(array('action' => 'importDb'));
				
			}
			
        }
		
    }
	
	
	
	
	public function beforeFilter() {
		
		$this->theme = Configure::read('Psd.themeBackend');
		
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
    	$this->Cookie->httpOnly = true;
		
		$this->Auth->allow(Configure::read('publicPages'));
		
		if ($this->Psd->isOffline($this->params["action"])) exit(Configure::read('Psd.maintenanceMessage'));
		
		if (!$this->Psd->checkUserPermission($this->params["controller"], $this->params["action"])) 
		{
			
			$this->Session->setFlash(
				__d('phpstardust', 'Access denied!'), 'flash_warning'
			);
			
			$this->redirect(array(
				'plugin'=>'phpstardust',
				'controller'=>'pages',
				'action' => 'dashboard'
			));
		
		}
		
		$this->Psd->setTimezone();
		
		$this->Psd->setLanguage();
		
	}
	
	
	

}
