<h1>Edit User</h1>
<?php echo $this->Html->link(
    'Home',
    array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'dashboard')
); ?>
 &gt;
<?php echo $this->Html->link(
    __d('phpstardust', 'Users'),
    array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'index')
); ?>
 &gt;
<?php echo __d('phpstardust', 'Edit'); ?>
<?php
echo $this->Form->create('User');
echo $this->Form->input('email');
echo $this->Form->input('username');
echo $this->Form->input('password', array('value' => ''));
echo $this->Form->input('role',array(
	'options' => Configure::read('roles'),
	'empty' => __d('phpstardust', 'Select'),
	'label' => __d('phpstardust', 'Role')
));
echo $this->Form->input('status',array(
	'options' => array(0 => __d('phpstardust', 'Inactive'), 1 => __d('phpstardust', 'Active')),
	'empty' => __d('phpstardust', 'Select'),
	'label' => __d('phpstardust', 'Status')
));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end(__d('phpstardust', 'Save'));
?>