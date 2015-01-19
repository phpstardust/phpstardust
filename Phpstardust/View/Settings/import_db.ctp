<h1><?php echo __d('phpstardust','Import'); ?> Database</h1>
<?php echo $this->Html->link(
    'Home',
    array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'dashboard')
); ?>
 &gt;
<?php echo __d('phpstardust','Import'); ?>
<?php
echo $this->Form->create('Setting', array('type' => 'file'));
echo $this->Form->input('file', array('type' => 'file'));
echo $this->Form->end(__d('phpstardust','Import') .' Database');
?>