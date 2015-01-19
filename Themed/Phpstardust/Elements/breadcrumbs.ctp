<div class="container-fluid">
	<ol class="breadcrumb">
      <li><i class="fa fa-home"></i> <?php echo $this->Html->link(
    'Home',
    array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'dashboard')
); ?></li>
	  <?php if ($this->params["controller"]!="settings") { ?>
      <li><a href="<?php echo Configure::read('Psd.url'); ?>/phpstardust/<?php echo $this->params["controller"]; ?>"><?php echo __d('phpstardust',Inflector::humanize($this->params["controller"])); ?></a></li>
      <?php } ?>
      <li class="active"><?php echo __d('phpstardust',Inflector::humanize($this->params["action"])); ?></li>
    </ol>
</div>