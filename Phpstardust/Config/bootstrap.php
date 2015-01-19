<?php

Configure::write(
    'Psd',
    array(
		'name' => 'Name website',
		'email' => 'your@email',
        'url' => 'http://www.example_website.com',
		'themeBackend' => 'Phpstardust',
		'themeFrontend' => 'Frontend',
		'per_page' => 20,
        'uploads' => WWW_ROOT . 'files/uploads' . DS,
		'maintenanceMessage' => 'Maintenance mode',
		'feedLimit' => 20,
		'allowedHtmlTags' => '<p><div><br><a><strong><ol><ul><li><img><blockquote><table><th><td><tr><thead><tbody><em><s>'
    )
);

Configure::write(
    'PsdInfo',
    array(
		'name' => 'PhpStarDust',
		'version' => '1.0',
		'codename' => 'Cosmogonia',
		'website' => 'http://www.phpstardust.org',
		'license' => 'MIT license'
    )
);

Configure::write(
    'publicPages',
    array(
		'login', 
		'install',
		'register', 
		'activate', 
		'forgot', 
		'home', 
		'single', 
		'page', 
		'category', 
		'feed'
	)
);

Configure::write(
    'roles',
    array(
		'admin' => 'Admin', 
		'user' => 'User'
	)
);

Configure::write(
    'permissions',
    array(
		'admin' => array(
			'pages' => array(
				'index',
				'add',
				'edit',
				'delete',
				'deleteImage',
				'dashboard', 
				'home', 
				'single', 
				'page', 
				'category', 
				'feed'
			),
			'users' => array('index','add','edit','delete'),
			'articles' => array('index','add','edit','delete','deleteImage', 'upload'),
			'categories' => array('index','add','edit','delete'),
			'settings' => array('edit', 'backupDb', 'importDb')
		),
		'user' => array(
			'pages' => array('index','dashboard', 'home', 'single', 'page', 'category', 'feed'),
			'users' => array('index'),
			'articles' => array('index'),
			'categories' => array('index'),
			'settings' => array('index')
		)
	)
);

?>