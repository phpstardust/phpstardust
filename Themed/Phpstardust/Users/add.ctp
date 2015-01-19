<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-plus"></i> <?php echo __d('phpstardust', 'Add'); ?></h3>
	  </div>
	  <div class="panel-body">
		
		<div class="row">
		
			<div class="col-lg-12">
			
            <?php echo $this->Form->create('User', array('role' => 'form')); ?>
			  <div class="form-group">
                <?php
                
				echo $this->Form->input('email',array(
					'autofocus'=>'autofocus',
					'placeholder' => 'Enter email',
					'class' => 'form-control',
					'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
				));
				
				?>
			  </div>
			  <div class="form-group">
                <?php
                
				echo $this->Form->input('username',array(
					'placeholder' => 'Enter username',
					'class' => 'form-control',
					'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
				));
				
				?>
			  </div>
              <div class="form-group">
                <?php
                
				echo $this->Form->input('password',array(
					'type' => 'password',
					'placeholder' => 'Enter password',
					'class' => 'form-control',
					'error' => array('attributes' => array('wrap' => 'div','class' => 'alert alert-warning help-block'))
				));
				
				?>
			  </div>
              <div class="form-group">
                <?php
                
				echo $this->Form->input('role',array(
					'options' => Configure::read('roles'),
					'empty' => __d('phpstardust', 'Select'),
					'label' => __d('phpstardust', 'Role'),
					'class' => 'form-control'
				));
				
				?>
			  </div>
              <div class="form-group">
                <?php
                
				echo $this->Form->input('status',array(
					'options' => array(0 => __d('phpstardust', 'Inactive'), 1 => __d('phpstardust', 'Active')),
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