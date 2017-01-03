<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo Configure::read('Psd.url') .'/dashboard'; ?>"><?php echo Configure::read('Psd.name'); ?></a>
      <a class="navbar-brand" href="<?php echo Configure::read('Psd.url'); ?>" target="_blank"><?php echo __d('phpstardust', 'View') .' ' .__d('phpstardust', 'Website'); ?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Welcome <?php echo AuthComponent::user('username'); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li>
            	<?php 
			
				echo $this->Html->link(
					'<i class="fa fa-pencil"></i> ' .__d('phpstardust', 'Edit'),
					array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'edit', AuthComponent::user('id')),
					array('escape' => false)
				); 
				
				?>
            </li>
            <li><?php 
			
				echo $this->Html->link(
					'<i class="fa fa-wrench"></i> ' .__d('phpstardust', 'Settings'),
					array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'edit', 1),
					array('escape' => false)
				); 
				
				?></li>
            <li class="divider"></li>
            <li><a href="<?php echo Configure::read('Psd.url') .'/logout'; ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
