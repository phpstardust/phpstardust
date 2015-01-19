<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhpStarDust</title>
    <?php echo $this->Html->css('bootstrap/css/bootstrap.min.css') ."\r\n"; ?>
    <?php echo $this->Html->css('font-awesome/css/font-awesome.min.css') ."\r\n"; ?>
    <?php echo $this->Html->css('style.css') ."\r\n"; ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo $this->Html->script('jquery.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('bootstrap/js/bootstrap.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('ckeditor/ckeditor.js') ."\r\n"; ?>
  </head>
<body>

<?php 

if (AuthComponent::user('id')) echo $this->element('navbar'); 
else echo $this->element('publicNavbar'); 

?>

<?php echo $this->Session->flash(); ?>

<?php if (AuthComponent::user('id') && $this->params["action"]!="dashboard") echo $this->element('breadcrumbs'); ?>




<div class="container-fluid">

	<?php if (AuthComponent::user('id')) { ?>

	<div class="row">
    
    	<div class="col-lg-3">
        
        	<?php echo $this->element('menu'); ?>
        
        </div><!-- col-lg-3 -->
        
        <div class="col-lg-9 content">
            
			<?php echo $this->fetch('content'); ?>
        
        </div><!-- col-lg-9 -->
    
	</div><!-- row -->
    
    <?php } else { ?>
    
    <div class="row">
        
        <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 content">
            
		<?php echo $this->fetch('content'); ?>
    
    </div><!-- col-lg-12 -->
    
	</div><!-- row -->
    
    <?php } ?>

</div>



<?php if (AuthComponent::user('id') && AuthComponent::user('role')=="admin") { ?>
<div class="modal fade" id="psdModal" tabindex="-1" role="dialog" aria-labelledby="psdModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="psdModalTitle"><?php echo __d('phpstardust', 'Add Image'); ?></h4>
      </div>
      <div class="modal-body" id="psdModalBody">
      <iframe width="500" height="160" src="<?php echo Configure::read('Psd.url'); ?>/phpstardust/articles/upload" frameborder="0" scrolling="no"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-psd" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>



</body>
</html>