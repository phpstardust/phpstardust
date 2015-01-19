<div class="panel-group mainmenu" id="accordion" role="tablist" aria-multiselectable="true">
              
		<div class="panel panel-default">
		  <div class="panel-heading" role="tab" id="headingOne">
			<h4 class="panel-title">
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-user"></i> <?php echo __d('phpstardust', 'Users'); ?></a>
			</h4>
		  </div>
		  <div id="collapseOne" class="panel-collapse collapse <?php if ($this->params['controller']=="users") echo "in"; ?>" role="tabpanel" aria-labelledby="headingOne">
			<div class="panel-body">
			  <ul class="list-unstyled">
				  <li><i class="fa fa-list"></i> <?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'List'),
					array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'index')
				); 
				
				?></li>
				  <li><i class="fa fa-plus"></i> <?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Add'),
					array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'add')
				); 
				
				?></li>
			  </ul>
			</div>
		  </div>
		</div>
		
		<div class="panel panel-default">
		  <div class="panel-heading" role="tab" id="headingTwo">
			<h4 class="panel-title">
			  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-pencil"></i> <?php echo __d('phpstardust', 'Articles'); ?></a>
			</h4>
		  </div>
		  <div id="collapseTwo" class="panel-collapse collapse <?php if (($this->params['controller']=="articles" || $this->params['controller']=="categories") && $this->params['action']!="dashboard") echo "in"; ?>" role="tabpanel" aria-labelledby="headingTwo">
			<div class="panel-body">
			  <ul class="list-unstyled">
				  <li><i class="fa fa-list"></i> <?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'List'),
					array('plugin' => 'phpstardust', 'controller' => 'articles', 'action' => 'index')
				); 
				
				?></li>
				  <li><i class="fa fa-plus"></i> <?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Add'),
					array('plugin' => 'phpstardust', 'controller' => 'articles', 'action' => 'add')
				); 
				
				?></li>
                <li><i class="fa fa-tags"></i> <?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Categories'),
					array('plugin' => 'phpstardust', 'controller' => 'categories', 'action' => 'index')
				); 
				
				?></li>
			  </ul>
			</div>
		  </div>
		</div>
        
        <div class="panel panel-default">
		  <div class="panel-heading" role="tab" id="headingThree">
			<h4 class="panel-title">
			  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-file"></i> <?php echo __d('phpstardust', 'Pages'); ?></a>
			</h4>
		  </div>
		  <div id="collapseThree" class="panel-collapse collapse <?php if ($this->params['controller']=="pages" && $this->params['action']!="dashboard") echo "in"; ?>" role="tabpanel" aria-labelledby="headingThree">
			<div class="panel-body">
			  <ul class="list-unstyled">
				  <li><i class="fa fa-list"></i> <?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'List'),
					array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'index')
				); 
				
				?></li>
				  <li><i class="fa fa-plus"></i> <?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Add'),
					array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'add')
				); 
				
				?></li>
			  </ul>
			</div>
		  </div>
		</div>
        
        <div class="panel panel-default">
		  <div class="panel-heading" role="tab" id="headingFour">
			<h4 class="panel-title">
			  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-wrench"></i> <?php echo __d('phpstardust', 'Settings'); ?></a>
			</h4>
		  </div>
		  <div id="collapseFour" class="panel-collapse collapse <?php if ($this->params['controller']=="settings") echo "in"; ?>" role="tabpanel" aria-labelledby="headingFour">
			<div class="panel-body">
			  <ul class="list-unstyled">
				  <li><i class="fa fa-toggle-on"></i> <?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Settings'),
					array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'edit', 1)
				); 
				
				?></li>
				  <li><i class="fa fa-arrow-circle-down"></i> <?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Backup Database'),
					array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'backupDb')
				); 
				
				?></li>
                <li><i class="fa fa-arrow-circle-up"></i> <?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Import') .' Database',
					array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'importDb')
				); 
				
				?></li>
			  </ul>
			</div>
		  </div>
		</div>
  
</div>