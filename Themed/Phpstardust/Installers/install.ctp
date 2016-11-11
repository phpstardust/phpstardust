<div class="panel panel-default boxform">
	  <div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-wrench"></i> <?php echo __d('phpstardust', 'Install CMS'); ?></h3>
	  </div>
	  <div class="panel-body">
		
		<div class="row">
		
			<div class="col-lg-12">
			
			<?php echo $this->Form->create('Installer', array('url' => 'install')); ?>
			
			  <div class="form-group">
                <?php
                
				echo $this->Form->input('email',array(
					'autofocus'=>'autofocus',
					'id' => 'email',
					'placeholder' => 'Enter email',
					'class' => 'form-control',
					'required' => true
				));
				
				?>
			  </div>
              <div class="form-group">
                <?php
                
				echo $this->Form->input('username',array(
					'id' => 'username',
					'placeholder' => 'Enter username',
					'class' => 'form-control',
					'required' => true
				));
				
				?>
			  </div>
			  <div class="form-group">
                <?php
                
				echo $this->Form->input('password',array(
					'id' => 'password',
					'placeholder' => 'Enter password',
					'class' => 'form-control',
					'required' => true
				));
				
				?>
			  </div>
			  <div class="form-group text-center">
                <?php
				echo $this->Form->button('<i class="fa fa-wrench"></i> ' .__d('phpstardust', 'Install CMS'),array(
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
				echo '<br><br>' .$this->Html->link(
					__d('phpstardust', 'Go to Login'),
					'/login'
				);
			?>
            </div>
        
        </div>

	  </div>

</div>
