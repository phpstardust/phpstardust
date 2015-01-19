<?php

echo $this->Form->create('Installer', array('action' => 'install'));
echo $this->Form->input('email',array(
	'required' => true
));
echo $this->Form->input('username',array(
	'required' => true
));
echo $this->Form->input('password',array(
	'required' => true
));
echo $this->Form->end(__d('phpstardust', 'Install CMS'));
echo $this->Html->link(
    __d('phpstardust', 'Go to Login'),
    '/login'
);

?>