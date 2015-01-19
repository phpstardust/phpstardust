<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-arrow-circle-up"></i> <?php echo __d('phpstardust','Import'); ?> Database</h3>
	  </div>
	  <div class="panel-body">
		
		<div class="row">
		
			<div class="col-lg-12">
			
            <?php echo $this->Form->create('Setting', array('role' => 'form', 'type' => 'file')); ?>
			  <div class="form-group">
                <?php
                
				echo $this->Form->input('file', array(
					'label' => __d('phpstardust', 'File'), 
					'type' => 'file',
					'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
				));
				
				?>
			  </div>
              <?php
			  echo $this->Form->button('<i class="fa fa-check"></i> ' .__d('phpstardust', 'Import') .' Database',array(
					'type'=>'submit',
					'class'=>'btn btn-psd'
				));
			  ?>
            <?php echo $this->Form->end(); ?>
				
			</div>

		</div>

	  </div>

</div>