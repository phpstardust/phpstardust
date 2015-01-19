<?php

App::uses('ConnectionManager', 'Model');

class InstallersController extends AppController {

	public $uses = array('Phpstardust.Page');
	
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

	
	
	
	public function install() {
		
		$db = ConnectionManager::getDataSource('default');
		
		$dbVars = $db->config;
		$prefix = $dbVars["prefix"];
	
		if (count($db->query('SHOW TABLES LIKE "' .$prefix .'settings"'))==1) {
			if (AuthComponent::user('id')) $this->redirect('/dashboard');
			else $this->redirect('/login');
			exit;
		}
		  
        if ($this->request->is('post')) {
			
			$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'articles` (
			  `id` bigint(64) NOT NULL auto_increment,
			  `user_id` bigint(64) NOT NULL,
			  `title` varchar(255) collate utf8_unicode_ci default NULL,
			  `slug` varchar(255) collate utf8_unicode_ci default NULL,
			  `image` varchar(255) collate utf8_unicode_ci default NULL,
			  `description` varchar(255) collate utf8_unicode_ci default NULL,
			  `keywords` varchar(255) collate utf8_unicode_ci default NULL,
			  `text` longtext collate utf8_unicode_ci,
			  `status` int(11) NOT NULL,
			  `created` datetime NOT NULL,
			  `modified` datetime NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
			
			$db->query($sql);
			
			$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'articles_categories` (
			  `id` bigint(64) NOT NULL auto_increment,
			  `article_id` bigint(64) NOT NULL,
			  `categorie_id` bigint(64) NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
			
			$db->query($sql);
			
			$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'categories` (
			  `id` bigint(64) NOT NULL auto_increment,
			  `name` varchar(255) collate utf8_unicode_ci default NULL,
			  `slug` varchar(255) collate utf8_unicode_ci default NULL,
			  `created` datetime NOT NULL,
			  `modified` datetime NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
			
			$db->query($sql);
			
			$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'pages` (
			  `id` bigint(64) NOT NULL auto_increment,
			  `user_id` bigint(64) NOT NULL,
			  `title` varchar(255) collate utf8_unicode_ci default NULL,
			  `slug` varchar(255) collate utf8_unicode_ci default NULL,
			  `image` varchar(255) collate utf8_unicode_ci default NULL,
			  `description` varchar(255) collate utf8_unicode_ci default NULL,
			  `keywords` varchar(255) collate utf8_unicode_ci default NULL,
			  `text` longtext collate utf8_unicode_ci,
			  `status` int(11) NOT NULL,
			  `created` datetime NOT NULL,
			  `modified` datetime NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
			
			$db->query($sql);
			
			$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'settings` (
			  `id` bigint(64) NOT NULL auto_increment,
			  `title` varchar(255) collate utf8_unicode_ci default NULL,
			  `description` varchar(255) collate utf8_unicode_ci default NULL,
			  `keywords` varchar(255) collate utf8_unicode_ci default NULL,
			  `timezone` varchar(255) collate utf8_unicode_ci default NULL,
			  `language` varchar(255) collate utf8_unicode_ci default NULL,
			  `status` int(11) NOT NULL,
			  `modified` datetime NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
			
			$db->query($sql);
			
			$date = date("Y-m-d H:i:s");
			
			$sql = "INSERT INTO `" .$prefix ."settings` (`id`, `title`, `description`, `keywords`, `timezone`, `language`, `status`, `modified`) VALUES
(1, 'Title website', 'Website based on PhpStarDust.', 'phpstardust, cms, cakephp', 'Europe/Rome', 'eng', 0, '" .$date ."');";
			
			$db->query($sql);
			
			$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'users` (
			  `id` bigint(64) NOT NULL auto_increment,
			  `email` varchar(255) collate utf8_unicode_ci default NULL,
			  `username` varchar(255) collate utf8_unicode_ci default NULL,
			  `password` varchar(255) collate utf8_unicode_ci default NULL,
			  `role` varchar(255) collate utf8_unicode_ci default NULL,
			  `status` int(11) NOT NULL,
			  `last_login` datetime NOT NULL,
			  `activationcode` varchar(255) collate utf8_unicode_ci default NULL,
			  `created` datetime NOT NULL,
			  `modified` datetime NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
			
			$db->query($sql);
			
			$this->loadModel('Phpstardust.User');
			
            $this->User->create();
			
			$saveUser = array(
				'email' => $this->request->data["Installer"]["email"],
				'username' => $this->request->data["Installer"]["username"],
				'password' => $this->request->data["Installer"]["password"],
				'role' => 'admin',
				'status' => 1,
				'last_login' => $date,
				'activationcode' => "",
				'created' => $date,
				'modified' => $date
			);
			
            if ($this->User->save($saveUser)) {
				
				$this->Session->setFlash(
					__d('phpstardust', 'Installation completed. Use the force.'), 'flash_success'
				);
				
                return $this->redirect('/login');
				
            }
			else $this->User->validationErrors = $this->Psd->translateValidationMessages($this->User->validationErrors);
			
        }
		
    }
	
	
	
	
	public function beforeFilter() {
		
		$this->theme = Configure::read('Psd.themeBackend');
		
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
    	$this->Cookie->httpOnly = true;
		
		$this->Auth->allow(Configure::read('publicPages'));
		
	}
	



}
