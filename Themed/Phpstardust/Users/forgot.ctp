<div class="panel panel-default boxform">
	  <div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-user"></i> <?php echo __d('phpstardust', 'Forgot password?'); ?></h3>
	  </div>
	  <div class="panel-body">
		
		<div class="row">
		
			<div class="col-lg-12">
			
			<?php echo $this->Form->create('User', array('url' => 'forgot')); ?>
			
			  <div class="form-group">
                <?php
                
				echo $this->Form->input('email',array(
					'autofocus'=>'autofocus',
					'placeholder' => 'Enter email',
					'class' => 'form-control',
					'label' => __d('phpstardust','Send me a new password')
				));
				
				?>
			  </div>
			  <div class="form-group text-center">
                <?php
				echo $this->Form->button(__d('phpstardust', 'Send'),array(
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
