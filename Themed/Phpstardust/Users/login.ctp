<div class="panel panel-default boxform">
	  <div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-user"></i> Login</h3>
	  </div>
	  <div class="panel-body">
		
		<div class="row">
		
			<div class="col-lg-12">
			
			<?php echo $this->Form->create('User', array('url' => 'login')); ?>
			
			  <div class="form-group">
                <?php
                
				echo $this->Form->input('username',array(
					'autofocus'=>'autofocus',
					'id' => 'username',
					'placeholder' => 'Enter username',
					'class' => 'form-control'
				));
				
				?>
			  </div>
			  <div class="form-group">
                <?php
                
				echo $this->Form->input('password',array(
					'id' => 'password',
					'placeholder' => 'Enter password',
					'class' => 'form-control'
				));
				
				?>
			  </div>
			  <div class="checkbox">
				<label>
                  <?php
                  echo $this->Form->checkbox('remember', array(
					  'value' => 1,
					  'hiddenField' => 'N'
				  ));
				  echo ' <div class="checkboxText">' .__d('phpstardust', 'Remember me') .'</div>';
				  ?>
				</label>
			  </div>
			  <div class="form-group text-center">
                <?php
				echo $this->Form->button('<i class="fa fa-check"></i> Login',array(
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
					__d('phpstardust', 'Forgot password?'),
					'/forgot-password'
				);
				echo '<br><br>' .$this->Html->link(
					__d('phpstardust', 'Register'),
					'/register'
				);
			?>
            </div>
        
        </div>

	  </div>

</div>
