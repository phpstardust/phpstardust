<?php

echo $this->Form->create('User', array('action' => 'forgot'));
echo $this->Form->input('email');
echo $this->Form->end(__d('phpstardust', 'Send me a new password'));
echo $this->Html->link(
    __d('phpstardust', 'Go to Login'),
    '/login'
);

?>