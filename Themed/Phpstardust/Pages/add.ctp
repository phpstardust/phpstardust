<?php echo $this->Psd->loadCkEditor('text'); ?>
<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-plus"></i> <?php echo __d('phpstardust', 'Add'); ?></h3>
	  </div>
	  <div class="panel-body">
		
		<div class="row">
		
			<div class="col-lg-12">
			
            <?php echo $this->Form->create('Page', array('role' => 'form', 'type' => 'file')); ?>
			  <div class="form-group">
                <?php
                
				echo $this->Form->input('title',array(
					'label' => __d('phpstardust', 'Title'),
					'placeholder' => __d('phpstardust', 'Enter') .' ' .__d('phpstardust', 'Title'),
					'class' => 'form-control',
					'autofocus'=>'autofocus',
					'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
				));
				
				?>
			  </div>
              <div class="form-group">
                <?php
                
				echo $this->Form->input('image', array(
					'label' => __d('phpstardust', 'Image'), 
					'type' => 'file',
					'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
				));
				
				?>
			  </div>
              <div class="form-group">
                <?php
                
				echo $this->Form->input('description',array(
					'type' => 'textarea',
					'label' => __d('phpstardust', 'Description'),
					'placeholder' => __d('phpstardust', 'Enter') .' ' .__d('phpstardust', 'Description'),
					'class' => 'form-control',
					'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
				));
				
				?>
			  </div>
              <div class="form-group">
                <?php
                
				echo $this->Form->input('keywords',array(
					'label' => __d('phpstardust', 'Keywords'),
					'placeholder' => __d('phpstardust', 'Enter') .' ' .__d('phpstardust', 'Keywords'),
					'class' => 'form-control',
					'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
				));
				
				?>
			  </div>
              <div class="form-group">
              <?php
			  echo $this->Form->button('<i class="fa fa-picture-o"></i> ' .__d('phpstardust', 'Add Image'),array(
					'type'=>'button',
					'data-toggle' => 'modal',
					'data-target' => '#psdModal',
					'class'=>'btn btn-psd'
				));
			  ?>
              </div>
              <div class="form-group">
                <?php
                
				echo $this->Form->input('text',array(
					'id' => 'text',
					'type' => 'textarea',
					'label' => __d('phpstardust', 'Text'),
					'placeholder' => __d('phpstardust', 'Enter') .' ' .__d('phpstardust', 'Text'),
					'class' => 'form-control',
					'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
				));
				
				?>
			  </div>
              <div class="form-group">
              	<label><?php echo __d('phpstardust', 'Created'); ?></label>
                <?php
                
				echo $this->Form->input('created',array(
					'label' => false,
					'placeholder' => __d('phpstardust', 'Enter') .' ' .__d('phpstardust', 'Created'),
					'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
				));
				
				?>
			  </div>
              <div class="form-group">
                <?php
                
				echo $this->Form->input('status',array(
					'options' => array(0 => __d('phpstardust', 'Draft'), 1 => __d('phpstardust', 'Published')),
					'empty' => __d('phpstardust', 'Select'),
					'label' => __d('phpstardust', 'Status'),
					'class' => 'form-control'
				));
				
				?>
			  </div>
              <?php
			  echo $this->Form->button('<i class="fa fa-check"></i> ' .__d('phpstardust', 'Save'),array(
					'type'=>'submit',
					'class'=>'btn btn-psd'
				));
			  ?>
            <?php echo $this->Form->end(); ?>
				
			</div>

		</div>

	  </div>

</div>