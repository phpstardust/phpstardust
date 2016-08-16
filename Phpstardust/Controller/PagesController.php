<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public $uses = array(
		'Phpstardust.Psd', 
		'Phpstardust.User', 
		'Phpstardust.Page', 
		'Phpstardust.Article', 
		'Phpstardust.Categorie', 
		'Phpstardust.Setting', 
		'Phpstardust.Articlescategorie'
	);
	
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
	
	
	public $helpers = array('Html', 'Form', 'Session', 'Rss');
	
	
	

	public function dashboard() {
	
		$msg = "<b>" .__d('phpstardust', 'Name') .":</b> " .Configure::read('PsdInfo.name') ."<br>";
		$msg .= "<b>" .__d('phpstardust', 'Version') .":</b> " .Configure::read('PsdInfo.version') ."<br>";
		$msg .= "<b>" .__d('phpstardust', 'Codename') .":</b> " .Configure::read('PsdInfo.codename') ."<br>";
		$msg .= "<b>" .__d('phpstardust', 'Website') .":</b> <a href='" .Configure::read('PsdInfo.website') ."' target='_blank'>" .Configure::read('PsdInfo.website') ."</a><br>";
		$msg .= "<b>" .__d('phpstardust', 'License') .":</b> " .Configure::read('PsdInfo.license') ."<br>";
		
		$this->set('info', $msg);
				
	}
	
	
	
	
	public function home() {
		
		$this->theme = Configure::read('Psd.themeFrontend');
		
		$data = NULL;
		
		if (!isset($this->request->data["Page"]["q"])) {
			
			$this->Paginator->settings = array(
				'limit' => Configure::read('Psd.per_page'),
				'order' => array('Article.id' => 'DESC' ),
				'conditions' => array("Article.status" => 1)
			);
			
			$data = $this->Paginator->paginate('Article');
			
		} else {
		
			$this->Paginator->settings = array(
				'limit' => Configure::read('Psd.per_page'),
				'order' => array('Article.id' => 'DESC' ),
				'conditions' => array("OR" => array(
						"Article.title LIKE '%" .$this->request->data["Page"]["q"] ."%'",
						"Article.text LIKE '%" .$this->request->data["Page"]["q"] ."%'"
					)
				)
			);
			
			$data = $this->Paginator->paginate(
				'Article',
				array("OR" => array(
						"Article.title LIKE '%" .$this->request->data["Page"]["q"] ."%'",
						"Article.text LIKE '%" .$this->request->data["Page"]["q"] ."%'"
					)
				)
			);
			
		}
		
		$this->set('rows', $data);
		
		$pages = $this->Page->find('all', array(
			'conditions' => array('Page.status'=>1)
		));
		
		$this->set('pages', $pages);
		
		$categories = $this->Categorie->find('all');
		
		$this->set('categories', $categories);
		
		$meta = $this->Setting->find('first', array(
			'conditions' => array('Setting.id' => 1)
		));
		
		$this->set('metaTitle', $meta["Setting"]["title"]);
		$this->set('metaDescription', $meta["Setting"]["description"]);
		$this->set('metaKeywords', $meta["Setting"]["keywords"]);
		
	}
	
	
	
	
	public function single($slug = NULL) {
		
		$this->theme = Configure::read('Psd.themeFrontend');
		
		if (!$slug) {
			throw new NotFoundException(__('Element not found.'));
		}
	
		$article = $this->Article->findBySlug($slug);
		
		if (!$article) {
			throw new NotFoundException(__('Element not found.'));
		}
	
		$this->set('row', $article);
		
		$pages = $this->Page->find('all', array(
			'conditions' => array('Page.status'=>1)
		));
		
		$this->set('pages', $pages);
		
		$categories = $this->Categorie->find('all');
		
		$this->set('categories', $categories);
		
		$meta = $this->Setting->find('first', array(
			'conditions' => array('Setting.id' => 1)
		));
		
		$this->set('metaTitle', $article["Article"]["title"] .' | ' .$meta["Setting"]["title"]);
		$this->set('metaDescription', $article["Article"]["description"]);
		$this->set('metaKeywords', $article["Article"]["keywords"]);
		
	}
	
	
	
	
	public function page($slug = NULL) {
		
		$this->theme = Configure::read('Psd.themeFrontend');
		
		if (!$slug) {
			throw new NotFoundException(__('Element not found.'));
		}
	
		$page = $this->Page->findBySlug($slug);
		
		if (!$page) {
			throw new NotFoundException(__('Element not found.'));
		}
	
		$this->set('row', $page);
		
		$pages = $this->Page->find('all', array(
			'conditions' => array('Page.status'=>1)
		));
		
		$this->set('pages', $pages);
		
		$categories = $this->Categorie->find('all');
		
		$this->set('categories', $categories);
		
		$meta = $this->Setting->find('first', array(
			'conditions' => array('Setting.id' => 1)
		));
		
		$this->set('metaTitle', $page["Page"]["title"] .' | ' .$meta["Setting"]["title"]);
		$this->set('metaDescription', $page["Page"]["description"]);
		$this->set('metaKeywords', $page["Page"]["keywords"]);
		
	}
	
	
	
	
	public function category($slug = NULL) {
		
		$this->theme = Configure::read('Psd.themeFrontend');
		
		if (!$slug) {
			throw new NotFoundException(__('Element not found.'));
		}
	
		$category = $this->Categorie->findBySlug($slug);
		
		if (!$category) {
			throw new NotFoundException(__('Element not found.'));
		}
		
		$id = $category["Categorie"]["id"];
		
		$this->paginate = array(
			'limit' => Configure::read('Psd.per_page'),
			'order'=>array('Article.id'=>'DESC'),
			'joins' => array(
				array(
					'alias' => 'Articlescategorie',
					'table' => $this->Page->tablePrefix .'articles_categories',
					'type' => 'INNER',
					'conditions' => '`Article`.`id` = `Articlescategorie`.`article_id`'
				),
				array(
					'alias' => 'Categorie',
					'table' => $this->Page->tablePrefix .'categories',
					'type' => 'INNER',
					'conditions' => '`Categorie`.`id` = `Articlescategorie`.`categorie_id`'
				)
		),
		'conditions'=>array("Categorie.id" => $id, 'Article.status'=>1),
		'order'=>array('Article.id'=>'DESC')
		);
		
		$rows = $this->Article->find('all',array(
			'joins' => array(
				array(
					'alias' => 'Articlescategorie',
					'table' => $this->Page->tablePrefix .'articles_categories',
					'type' => 'INNER',
					'conditions' => '`Article`.`id` = `Articlescategorie`.`article_id`'
				),
				array(
					'alias' => 'Categorie',
					'table' => $this->Page->tablePrefix .'categories',
					'type' => 'INNER',
					'conditions' => '`Categorie`.`id` = `Articlescategorie`.`categorie_id`'
				)
		),
		'conditions'=>array("Categorie.id" => $id, 'Article.status'=>1),
		'order'=>array('Article.id'=>'DESC')
		));
		
		$rows = $this->paginate('Article');
	
		$this->set('rows', $rows);
		
		$pages = $this->Page->find('all', array(
			'conditions' => array('Page.status'=>1)
		));
		
		$this->set('pages', $pages);
		
		$categories = $this->Categorie->find('all');
		
		$this->set('categories', $categories);
		
		$meta = $this->Setting->find('first', array(
			'conditions' => array('Setting.id' => 1)
		));
		
		$this->set('metaTitle', $category["Categorie"]["name"] .' | ' .$meta["Setting"]["title"]);
		
	}
	
	
	
	
		public function feed() {
			
			$this->layout = 'rss';
			
			$this->set('title', 'Feed RSS');
			
			if ($this->RequestHandler->isRss()) {
				
			$articles = $this->Article->find(
				'all',
				array(
					'limit' => Configure::read('Psd.feedLimit'), 
					'conditions' => array('Article.status'=>1),
					'order' => 'Article.created DESC'
				)
			);
			
			return $this->set(compact('articles'));
			
			}
			
			$this->paginate = array(
				'order' => 'Article.created DESC',
				'limit' => Configure::read('Psd.feedLimit'),
				'conditions' => array('Article.status'=>1),
			);
			
			$articles = $this->paginate('Article');
			
			$this->set(compact('articles'));
			
		}

	
	
	
	public function index() {
		
		$data = NULL;
		
		if (!isset($this->request->data["Page"]["q"])) {
			
			$this->Paginator->settings = array(
				'limit' => Configure::read('Psd.per_page'),
				'order' => array('Page.title' => 'ASC' )
			);
			
			$data = $this->Paginator->paginate('Page');
			
		} else {
		
			$this->Paginator->settings = array(
				'limit' => Configure::read('Psd.per_page'),
				'order' => array('Page.title' => 'ASC' ),
				'conditions' => array(
					"Page.title LIKE '%" .$this->request->data["Page"]["q"] ."%'"
				)
			);
			
			$data = $this->Paginator->paginate(
				'Page',
				array(
					"Page.title LIKE '%" .$this->request->data["Page"]["q"] ."%'"
				)
			);
			
		}
		
		$this->set('rows', $data);
		$this->set('count', $this->Page->find('count'));
		
	}
	
	
	
	
	public function add() {
		
        if ($this->request->is('post')) {
			
            $this->Page->create();
			
			if ($this->request->data["Page"]["image"]["name"]!="") {
				
				$newfile = $this->Psd->upload('Page','image');
				$this->request->data["Page"]["image"] = $newfile["name"];
				
			}
			else $this->request->data["Page"]["image"] = "";
			
            if ($this->Page->save($this->request->data)) {
				
				$this->Session->setFlash(
					__d('phpstardust', 'Page has been saved.'), 'flash_success'
				);
				
                return $this->redirect(array('action' => 'index'));
				
            }
			else $this->Page->validationErrors = $this->Psd->translateValidationMessages($this->Page->validationErrors);
			
        }
		
    }
	
	
	
	
	public function edit($id = NULL) {
		
		if (!$id) {
			throw new NotFoundException(__d('phpstardust','Element not found.'));
		}
	
		$page = $this->Page->findById($id);
		
		if (!$page) {
			throw new NotFoundException(__d('phpstardust','Element not found.'));
		}
	
		if ($this->request->is(array('post', 'put'))) {
			
			$this->Page->id = $id;
			
				if ($this->request->data["Page"]["image"]["name"]!="") {
					
					if ($this->Psd->fileExists($this->request->data["Page"]["oldimage"]))
					$this->Psd->deleteFile($this->request->data["Page"]["oldimage"]);
					$newfile = $this->Psd->upload('Page','image');
					$this->request->data["Page"]["image"] = $newfile["name"];
					
				}
				else $this->request->data["Page"]["image"] = $this->request->data["Page"]["oldimage"];
			
			if ($this->Page->save($this->request->data)) {
				 
				$this->Session->setFlash(
					__d('phpstardust', 'Page has been modified.'), 'flash_success'
				);
				
				return $this->redirect(array('action' => 'edit', $id));
				
			}
			else $this->Page->validationErrors = $this->Psd->translateValidationMessages($this->Page->validationErrors);
			
		}
	
		if (!$this->request->data) {
			$page["Page"]["oldimage"] = $page["Page"]["image"];
			$this->request->data = $page;
		}
		
	}
	
	
	
	
	public function delete($id = NULL) {
		
		$this->autoRender = false;
		
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException(__d('phpstardust','Element not found.'));
		}
		
		$this->Page->id = $id;
		$image = $this->Page->field('image');
	
		if ($this->Page->delete($id)) {
			
			if ($this->Psd->fileExists($image)) $this->Psd->deleteFile($image);
			
			$this->Session->setFlash(
				__d('phpstardust', 'Page has been deleted.'), 'flash_success'
			);
			
			return $this->redirect(array('action' => 'index'));
		}
		
	}
	
	
	
	
	public function deleteImage($id = NULL) {
		
		$this->autoRender = false;
		
		if ($this->request->is('post')) {
			throw new MethodNotAllowedException(__d('phpstardust','Element not found.'));
		}
		
		$this->Page->id = $id;
		$image = $this->Page->field('image');
		
		$this->Page->updateAll(
			array('Page.image' => NULL),
			array('Page.id' => $id)
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
