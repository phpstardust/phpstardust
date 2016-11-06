<header class="navbar navbar-default navbar-fixed-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?php echo Configure::read('Psd.url'); ?>" class="navbar-brand"><?php echo Configure::read('Psd.name'); ?></a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
      	<?php foreach ($pages as $page): ?>
        <li><a href="<?php echo Configure::read('Psd.url'); ?>/<?php echo $page['Page']['slug']; ?>"><?php echo $page['Page']['title']; ?></a></li>
        <?php endforeach; ?>
        <?php unset($page); ?>
      </ul>
      <ul class="nav navbar-right navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __d('phpstardust', 'Search'); ?></a>
          <ul class="dropdown-menu" style="padding:12px;">
            <?php echo $this->Form->create('Page', array('action' => 'home', 'class' => 'form-inline', 'type' => 'get')); ?>
              <li class="text-center" style="margin-bottom:20px;">
              <?php
              echo $this->Form->input('q',array(
					'type'=>'text',
					'label'=>false,
					'div'=>false,
					'class' => 'form-control'
				));
				?>
              </li>
              <li class="text-center"><button type="submit" class="btn btn-default"><?php echo __d('phpstardust', 'Search'); ?></button></li>
            <?php echo $this->Form->end(); ?>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</header>
