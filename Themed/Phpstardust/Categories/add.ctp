<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-plus"></i> <?php echo __d('phpstardust', 'Add'); ?></h3>
	  </div>
	  <div class="panel-body">
		
		<div class="row">
		
			<div class="col-lg-12">
			
            <?php echo $this->Form->create('Categorie', array('role' => 'form')); ?>
			  <div class="form-group">
                <?php
                
				echo $this->Form->input('name',array(
					'label' => __d('phpstardust', 'Name'),
					'placeholder' => __d('phpstardust', 'Enter') .' ' .__d('phpstardust', 'Name'),
					'class' => 'form-control',
					'autofocus'=>'autofocus',
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