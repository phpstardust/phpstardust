<?php

echo $this->Form->create('User', array('action' => 'register'));
echo $this->Form->input('email');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->checkbox('accept', array(
	'value' => 1,
	'hiddenField' => 'N',
));
echo ' ' .__d('phpstardust', 'Accept ToS and Privacy policy.');
echo $this->Form->error('accept');
echo $this->Form->input('role', array('type'=>'hidden', 'value'=>'user'));
echo $this->Form->end(__d('phpstardust', 'Register'));
echo $this->Html->link(
    __d('phpstardust', 'Go to Login'),
    '/login'
);

?>