<?php

echo $this->Form->create('User', array('action' => 'login'));
echo $this->Form->inputs(array(
    'legend' => __('Login'),
    'username',
    'password'
));
echo $this->Form->checkbox('remember', array(
	'value' => 1,
	'hiddenField' => 'N'
));
echo ' ' .__d('phpstardust', 'Remember me');
echo $this->Form->end('Login');
echo $this->Html->link(
    __d('phpstardust', 'Forgot password?'),
    '/forgot-password'
);
echo '<br><br>' .$this->Html->link(
    __d('phpstardust', 'Register'),
    '/register'
);

?>