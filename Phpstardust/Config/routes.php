<?php

Router::connect('/', array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'home'));

Router::promote();

Router::connect('/check', array('controller' => 'pages', 'action' => 'display', 'home'));

Router::connect('/admin', array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'login'));

Router::connect('/install', array('plugin'=>'phpstardust', 'controller' => 'installers', 'action' => 'install'));

Router::connect('/dashboard', array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'dashboard'));

Router::connect('/login', array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'login'));

Router::connect('/logout', array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'logout'));

Router::connect('/register', array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'register'));

Router::connect('/forgot-password', array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'forgot'));

Router::connect(
	'/activate/:activationcode',
	array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'activate'),
	array(
		'pass' => array('activationcode')
	)
);

Router::connect(
	'/post/:slug',
	array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'single'),
	array(
		'pass' => array('slug')
	)
);

Router::connect('/feed', array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'feed'));

Router::connect(
	'/:slug',
	array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'page'),
	array(
		'pass' => array('slug')
	)
);

Router::connect(
	'/category/:slug',
	array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'category'),
	array(
		'pass' => array('slug')
	)
);

?>