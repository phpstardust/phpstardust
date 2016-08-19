<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {

	public $uses = array('Phpstardust.User');
	
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

	
	
	
	public function login() {
		
		if ($this->Session->read('Auth.User')) $this->redirect(array('controller' => 'pages', 'action' => 'dashboard'));
		
		if ($this->Cookie->check('remember_me_cookie')) {
			
			$cookie = $this->Cookie->read('remember_me_cookie');

			$user = $this->User->find('first', array(
				'conditions' => array(
					'User.username' => $cookie['username']
				)
			));
			
			if ($this->Auth->login($user["User"])) {
				
				$this->redirect(array('controller' => 'pages', 'action' => 'dashboard'));
				
			}
			
		}
		
		if ($this->request->is('post')) {
			
			if ($this->Auth->login()) {
				
				if ($this->request->data['User']['remember']==1) {
					
					unset($this->request->data['User']['remember']);
					unset($this->request->data['User']['password']);
	
					$this->Cookie->write('remember_me_cookie', $this->request->data['User'], true, '2 weeks');
					
				}
				
				$this->User->id = $this->Auth->user('id');
        		$this->User->saveField('last_login', date("Y-m-d H:i:s"));
			
				$this->redirect(array('controller' => 'pages', 'action' => 'dashboard'));
				
			}
			
			$this->Session->setFlash(
				__d('phpstardust', 'Your username or password are incorrect.'), 'flash_warning'
			);
				
		}
		
		
	}
	
	
	
	
	public function logout() {
		
		$this->Session->destroy();
		
		$this->Cookie->delete('remember_me_cookie');
		
		return $this->redirect($this->Auth->logout());
		
	}
	
	
	
	
	public function index() {
		
		$data = NULL;
		
		if (!isset($this->request->data["User"]["q"])) {
			
			$this->Paginator->settings = array(
				'limit' => Configure::read('Psd.per_page'),
				'order' => array('User.username' => 'ASC' )
			);
			
			$data = $this->Paginator->paginate('User');
			
		} else {
		
			$this->Paginator->settings = array(
				'limit' => Configure::read('Psd.per_page'),
				'order' => array('User.username' => 'ASC' ),
				'conditions' => array(
					"User.username LIKE '%" .$this->request->data["User"]["q"] ."%'"
				)
			);
			
			$data = $this->Paginator->paginate(
				'User',
				array(
					"User.username LIKE '%" .$this->request->data["User"]["q"] ."%'"
				)
			);
			
		}
		
		$this->set('rows', $data);
		$this->set('count', $this->User->find('count'));
		
	}
	
	
	
	
	public function add() {
		
        if ($this->request->is('post')) {
			
            $this->User->create();
			
            if ($this->User->save($this->request->data)) {
				
				$this->Session->setFlash(
					__d('phpstardust', 'User has been saved.'), 'flash_success'
				);
				
                return $this->redirect(array('action' => 'index'));
				
            }
			else $this->User->validationErrors = $this->Psd->translateValidationMessages($this->User->validationErrors);
			
        }
		
    }
	
	
	
	
	public function edit($id = NULL) {
		
		if (!$id) {
			throw new NotFoundException(__d('phpstardust','Element not found.'));
		}
	
		$user = $this->User->findById($id);
		
		if (!$user) {
			throw new NotFoundException(__d('phpstardust','Element not found.'));
		}
	
		if ($this->request->is(array('post', 'put'))) {
			
			$this->User->id = $id;
			
			if ($this->User->save($this->request->data)) {
				 
				 $this->Session->setFlash(
					__d('phpstardust', 'User has been modified.'), 'flash_success'
				);
				
				return $this->redirect(array('action' => 'edit', $id));
				
			}
			else $this->User->validationErrors = $this->Psd->translateValidationMessages($this->User->validationErrors);
			
		}
	
		if (!$this->request->data) $this->request->data = $user;
		
	}
	
	
	
	
	public function delete($id = NULL) {
		
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException(__d('phpstardust','Element not found.'));
		}
	
		if ($this->User->delete($id)) {
			
			$this->Session->setFlash(
				__d('phpstardust', 'User has been deleted.'), 'flash_success'
			);
			
			return $this->redirect(array('action' => 'index'));
		}
		
	}
	
	
	
	
	public function register() {
		
        if ($this->request->is('post')) {
			
			$this->request->data["User"]["activationcode"] = md5($this->Psd->generatePassword());
			
            if ($this->User->save($this->request->data)) {
				
				$msg = __d('phpstardust', 'Hi') .' <b>' .$this->request->data["User"]["username"] .'</b>, ' .__d('phpstardust', 'Welcome') .' in ' .Configure::read('Psd.name') .'.<br><br>';
				$msg .= __d('phpstardust', 'For activate your account') .' <a href="' .Configure::read('Psd.url') .'/activate/' .$this->request->data["User"]["activationcode"] .'" target="_blank">' .__d('phpstardust', 'click here') .'</a>.<br><br>';
				$msg .= __d('phpstardust', 'Best regards') .', Staff ' .Configure::read('Psd.name');
				
				$Email = new CakeEmail();
				$Email->config('default');
				$Email->emailFormat('html');
				$Email->from(array(Configure::read('Psd.email') => Configure::read('Psd.name')));
				$Email->to($this->request->data["User"]["email"]);
				$Email->subject(__d('phpstardust', 'Activation account') .' - ' .Configure::read('Psd.name'));
				$Email->send($msg);
				
				$this->Session->setFlash(
					__d('phpstardust', 'Registration complete. We have sent you an email with a link to activate your account.'), 'flash_success'
				);
				
                return $this->redirect(array('action' => 'register'));
				
            }
			else $this->User->validationErrors = $this->Psd->translateValidationMessages($this->User->validationErrors);
			
        }
		
    }
	
	
	
	
	public function activate($activationcode=NULL) {
		
		$this->autoRender = false;
		
		$data = $this->User->findByActivationcode($activationcode);
		
		if (count($data)>0) {
			
			$this->User->id = $data["User"]["id"];
			$this->User->saveField('status', 1);
			
			$this->Session->setFlash(
				__d('phpstardust', 'Account activated.'), 'flash_success'
			);
			
			return $this->redirect(array('action' => 'login'));
		
		}
		else {
			
			$this->Session->setFlash(
				__d('phpstardust', 'Activation code not found.'), 'flash_warning'
			);
				
            return $this->redirect(array('action' => 'register'));
			
		}
		
    }
	
	
	
	
	public function forgot() {
		
		if ($this->request->is('post')) {
		
			$data = $this->User->findByEmail($this->request->data["User"]["email"]);
			
			if (count($data)>0) {
				
				$password = $this->Psd->generatePassword();
				
				$this->User->id = $data["User"]["id"];
				$this->User->saveField('password', $password);
				
				$msg = __d('phpstardust', 'Hi') .' <b>' .$data["User"]["username"] .'</b>,<br><br>';
				$msg .= __d('phpstardust', 'this is a new password:') .' <b>' .$password .'</b><br><br>';
				$msg .= __d('phpstardust', 'Best regards') .', Staff ' .Configure::read('Psd.name');
				
				$Email = new CakeEmail();
				$Email->config('default');
				$Email->emailFormat('html');
				$Email->from(array(Configure::read('Psd.email') => Configure::read('Psd.name')));
				$Email->to($this->request->data["User"]["email"]);
				$Email->subject(__d('phpstardust', 'New password') .' - ' .Configure::read('Psd.name'));
				$Email->send($msg);
				
				$this->Session->setFlash(
					__d('phpstardust', 'Password sent.'), 'flash_success'
				);
				
				return $this->redirect(array('action' => 'forgot'));
			
			}
			else {
				
				$this->Session->setFlash(
					__d('phpstardust', 'Email not found.'), 'flash_warning'
				);
					
				return $this->redirect(array('action' => 'forgot'));
				
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
