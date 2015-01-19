<h1><?php echo __d('phpstardust','Edit Article'); ?></h1>
<?php echo $this->Html->link(
    'Home',
    array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'dashboard')
); ?>
 &gt;
<?php echo $this->Html->link(
    __d('phpstardust','Articles'),
    array('plugin' => 'phpstardust', 'controller' => 'articles', 'action' => 'index')
); ?>
 &gt;
<?php echo __d('phpstardust','Edit'); ?>
<?php
echo $this->Form->create('Article', array('type' => 'file'));
echo $this->Form->input('title',array(
	'label' => __d('phpstardust', 'Title')
));
echo $this->Form->input('slug');
echo $this->Form->input('image', array('label' => __d('phpstardust', 'Image'), 'type' => 'file'));
if ($this->data['Article']['oldimage']!="") {
	echo $this->Html->link(
		__d('phpstardust', 'View image'),
		Configure::read('Psd.url') .'/files/uploads/' .$this->data['Article']['image'],
		array('target' => '_blank')
	);
	echo '<br><br>';
	echo $this->Html->link(
		__d('phpstardust', 'Delete image'), 
		array('action' => 'deleteImage', $this->data['Article']['id']),
		array('confirm' => __d('phpstardust', 'Are you sure?'))
	);
	echo '<br><br>';
}
echo $this->Form->input('description', array('label' => __d('phpstardust', 'Description'), 'type' => 'textarea'));
echo $this->Form->input('keywords');
echo $this->Form->input('text', array('label' => __d('phpstardust', 'Text'), 'type' => 'textarea'));
echo $this->Form->input('created',array(
	'label' => __d('phpstardust', 'Created')
));
echo $this->Form->input('status',array(
	'options' => array(0 => __d('phpstardust', 'Draft'), 1 => __d('phpstardust', 'Published')),
	'empty' => __d('phpstardust', 'Select'),
	'label' => __d('phpstardust', 'Status')
));
echo $this->Form->input('Categorie',array(
	'label' => __d('phpstardust', 'Categories')
));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('oldimage', array('type' => 'hidden'));
echo $this->Form->end(__d('phpstardust', 'Save'));
?>