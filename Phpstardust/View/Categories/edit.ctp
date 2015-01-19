<h1><?php echo __d('phpstardust','Edit Category'); ?></h1>
<?php echo $this->Html->link(
    'Home',
    array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'dashboard')
); ?>
 &gt;
<?php echo $this->Html->link(
    __d('phpstardust','Categories'),
    array('plugin' => 'phpstardust', 'controller' => 'categories', 'action' => 'index')
); ?>
 &gt;
<?php echo __d('phpstardust','Edit'); ?>
<?php
echo $this->Form->create('Categorie');
echo $this->Form->input('name',array(
	'label' => __d('phpstardust', 'Name')
));
echo $this->Form->input('slug');
echo $this->Form->input('created',array(
	'label' => __d('phpstardust', 'Created')
));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end(__d('phpstardust', 'Save'));
?>