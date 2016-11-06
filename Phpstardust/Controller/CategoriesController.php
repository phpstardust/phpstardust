<?php

App::uses('AppController', 'Controller');

class CategoriesController extends AppController {

	public $uses = array('Phpstardust.User', 'Phpstardust.Categorie');
	
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

	
	
	
	public function index() {
		
		if (isset($this->request->query['q']) && $this->request->query['q']!="") $this->request->data["Categorie"]["q"] = addslashes(trim(strip_tags($this->request->query['q'])));
		
		$data = NULL;
		
		if (!isset($this->request->data["Categorie"]["q"])) {
			
			$this->Paginator->settings = array(
				'limit' => Configure::read('Psd.per_page'),
				'order' => array('Categorie.name' => 'ASC' )
			);
			
			$data = $this->Paginator->paginate('Categorie');
			
		} else {
		
			$this->Paginator->settings = array(
				'limit' => Configure::read('Psd.per_page'),
				'order' => array('Categorie.name' => 'ASC' ),
				'conditions' => array(
					"Categorie.name LIKE '%" .$this->request->data["Categorie"]["q"] ."%'"
				)
			);
			
			$data = $this->Paginator->paginate(
				'Categorie',
				array(
					"Categorie.name LIKE '%" .$this->request->data["Categorie"]["q"] ."%'"
				)
			);
			
		}
		
		$this->set('rows', $data);
		$this->set('count', $this->Categorie->find('count'));
		
	}
	
	
	
	
	public function add() {
		
        if ($this->request->is('post')) {
			
            $this->Categorie->create();
			
            if ($this->Categorie->save($this->request->data)) {
				
				$this->Session->setFlash(
					__d('phpstardust', 'Category has been saved.'), 'flash_success'
				);
				
                return $this->redirect(array('action' => 'index'));
				
            }
			else $this->Categorie->validationErrors = $this->Psd->translateValidationMessages($this->Categorie->validationErrors);
			
        }
		
    }
	
	
	
	
	public function edit($id = NULL) {
		
		if (!$id) {
			throw new NotFoundException(__d('phpstardust','Element not found.'));
		}
	
		$categorie = $this->Categorie->findById($id);
		
		if (!$categorie) {
			throw new NotFoundException(__d('phpstardust','Element not found.'));
		}
	
		if ($this->request->is(array('post', 'put'))) {
			
			$this->Categorie->id = $id;
			
			if ($this->Categorie->save($this->request->data)) {
				 
				$this->Session->setFlash(
					__d('phpstardust', 'Category has been modified.'), 'flash_success'
				);
				
				return $this->redirect(array('action' => 'edit', $id));
				
			}
			else $this->Categorie->validationErrors = $this->Psd->translateValidationMessages($this->Categorie->validationErrors);
			
		}
	
		if (!$this->request->data) {
			$this->request->data = $categorie;
		}
		
	}
	
	
	
	
	public function delete($id = NULL) {
		
		$this->autoRender = false;
		
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException(__d('phpstardust','Element not found.'));
		}
	
		if ($this->Categorie->delete($id)) {
			
			$this->Session->setFlash(
				__d('phpstardust', 'Category has been deleted.'), 'flash_success'
			);
			
			return $this->redirect(array('action' => 'index'));
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
