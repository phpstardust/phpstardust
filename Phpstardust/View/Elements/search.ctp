<?php
		
	echo $this->Form->create('Page', array('action' => 'home')); 

	echo $this->Form->input('q',array(
		'type'=>'text',
		'label'=>false,
		'div'=>false
	));
	
	echo $this->Form->button('<i class="fa fa-search"></i> ' .__d('phpstardust', 'Search'),array(
		'type'=>'submit',
		'class' => 'btn btn-psd'
	));
	
	echo $this->Form->end();

?>