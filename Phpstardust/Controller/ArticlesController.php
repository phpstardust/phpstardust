<?php

App::uses('AppController', 'Controller');

class ArticlesController extends AppController {

	public $uses = array('Phpstardust.User', 'Phpstardust.Article', 'Phpstardust.Categorie');
	
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
		
		if (isset($this->request->query['q']) && $this->request->query['q']!="") $this->request->data["Article"]["q"] = addslashes(trim(strip_tags($this->request->query['q'])));
		
		$data = NULL;
		
		if (!isset($this->request->data["Article"]["q"])) {
			
			$this->Paginator->settings = array(
				'limit' => Configure::read('Psd.per_page'),
				'order' => array('Article.title' => 'ASC' )
			);
			
			$data = $this->Paginator->paginate('Article');
			
		} else {
		
			$this->Paginator->settings = array(
				'limit' => Configure::read('Psd.per_page'),
				'order' => array('Article.title' => 'ASC' ),
				'conditions' => array(
					"Article.title LIKE '%" .$this->request->data["Article"]["q"] ."%'"
				)
			);
			
			$data = $this->Paginator->paginate(
				'Article',
				array(
					"Article.title LIKE '%" .$this->request->data["Article"]["q"] ."%'"
				)
			);
			
		}
		
		$this->set('rows', $data);
		$this->set('count', $this->Article->find('count'));
		
	}
	
	
	
	
	public function add() {
		
		$this->set('categories', $this->Article->Categorie->find('list'));
		
        if ($this->request->is('post')) {
			
            $this->Article->create();
			
			if ($this->request->data["Article"]["image"]["name"]!="") {
				
				$newfile = $this->Psd->upload('Article','image');
				$this->request->data["Article"]["image"] = $newfile["name"];
				
			}
			else $this->request->data["Article"]["image"] = "";
			
            if ($this->Article->save($this->request->data)) {
				
				$this->Session->setFlash(
					__d('phpstardust', 'Article has been saved.'), 'flash_success'
				);
				
                return $this->redirect(array('action' => 'index'));
				
            }
			else $this->Article->validationErrors = $this->Psd->translateValidationMessages($this->Article->validationErrors);
			
        }
		
    }
	
	
	
	
	public function upload() {
		
		$this->theme = '';
		$this->layout = 'upload';
		
        if ($this->request->is('post')) {
			
			if ($this->request->data["Article"]["image"]["name"]!="") {
				
				$newfile = $this->Psd->upload('Article','image');
				
				$this->Session->setFlash(
					__d('phpstardust', 'Upload complete.')
				);
				
				$this->set('image', Configure::read('Psd.url') .'/files/uploads/' .$newfile["name"]);
				
			}
			else $this->Article->validationErrors = $this->Psd->translateValidationMessages($this->Article->validationErrors);
			
        }
		
    }
	
	
	
	
	public function edit($id = NULL) {
		
		if (!$id) {
			throw new NotFoundException(__d('phpstardust','Element not found.'));
		}
	
		$article = $this->Article->findById($id);
		
		if (!$article) {
			throw new NotFoundException(__d('phpstardust','Element not found.'));
		}
		
		$this->set('categories', $this->Article->Categorie->find('list'));
	
		if ($this->request->is(array('post', 'put'))) {
			
			$this->Article->id = $id;
			
				if ($this->request->data["Article"]["image"]["name"]!="") {
					
					if ($this->Psd->fileExists($this->request->data["Article"]["oldimage"]))
					$this->Psd->deleteFile($this->request->data["Article"]["oldimage"]);
					$newfile = $this->Psd->upload('Article','image');
					$this->request->data["Article"]["image"] = $newfile["name"];
					
				}
				else $this->request->data["Article"]["image"] = $this->request->data["Article"]["oldimage"];
			
			if ($this->Article->save($this->request->data)) {
				 
				$this->Session->setFlash(
					__d('phpstardust', 'Article has been modified.'), 'flash_success'
				);
				
				return $this->redirect(array('action' => 'edit', $id));
				
			}
			else $this->Article->validationErrors = $this->Psd->translateValidationMessages($this->Article->validationErrors);
			
		}
	
		if (!$this->request->data) {
			$article["Article"]["oldimage"] = $article["Article"]["image"];
			$this->request->data = $article;
		}
		
	}
	
	
	
	
	public function delete($id = NULL) {
		
		$this->autoRender = false;
		
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException(__d('phpstardust','Element not found.'));
		}
		
		$this->Article->id = $id;
		$image = $this->Article->field('image');
	
		if ($this->Article->delete($id)) {
			
			if ($this->Psd->fileExists($image)) $this->Psd->deleteFile($image);
			
			$this->Session->setFlash(
				__d('phpstardust', 'Article has been deleted.'), 'flash_success'
			);
			
			return $this->redirect(array('action' => 'index'));
		}
		
	}
	
	
	
	
	public function deleteImage($id = NULL) {
		
		$this->autoRender = false;
		
		if ($this->request->is('post')) {
			throw new MethodNotAllowedException(__d('phpstardust','Element not found.'));
		}
		
		$this->Article->id = $id;
		$image = $this->Article->field('image');
		
		$this->Article->updateAll(
			array('Article.image' => NULL),
			array('Article.id' => $id)
		);
		
		if ($this->Psd->fileExists($image)) $this->Psd->deleteFile($image);
		
		$this->Session->setFlash(
			__d('phpstardust', 'Image has been deleted.'), 'flash_success'
		);
		
		return $this->redirect(array('action' => 'edit', $id));
		
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
