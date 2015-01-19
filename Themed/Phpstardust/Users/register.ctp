<div class="panel panel-default boxform">
	  <div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-user"></i> <?php echo __d('phpstardust', 'Register'); ?></h3>
	  </div>
	  <div class="panel-body">
		
		<div class="row">
		
			<div class="col-lg-12">
			
			<?php echo $this->Form->create('User', array('action' => 'register')); ?>
			
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
              <div class="checkbox">
				<label>
                  <?php
                  echo $this->Form->checkbox('accept', array(
						'value' => 1,
						'hiddenField' => 'N'
					));
				  echo ' <div class="checkboxText">' .__d('phpstardust', 'Accept ToS and Privacy policy.') .'</div>';
				  ?>
				</label>
                <?php echo $this->Form->error('accept', null, array('class' => 'error-message alert alert-warning')); ?>
			  </div>
			  <div class="form-group text-center">
                <?php
				echo $this->Form->input('role', array('type'=>'hidden', 'value'=>'user'));
				echo $this->Form->button(__d('phpstardust', 'Register'),array(
					'type'=>'submit',
					'class'=>'btn btn-psd btn-lg'
				));
				?>
			  </div>
			
            <?php echo $this->Form->end(); ?>
				
			</div>

		</div>
        
        <div class="row">
        
        	<div class="col-lg-12 links">
            <?php
            	echo $this->Html->link(
					__d('phpstardust', 'Go to Login'),
					'/login'
				);
			?>
            </div>
        
        </div>

	  </div>

</div>