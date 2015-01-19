<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if (isset($metaTitle)) echo $metaTitle; ?></title>
    <?php if (isset($metaDescription) && $metaDescription!="") { ?>
    <meta name="description" content="<?php echo $metaDescription; ?>">
    <?php } ?>
    <?php if (isset($metaKeywords) && $metaKeywords!="") { ?>
    <meta name="keywords" content="<?php echo $metaKeywords; ?>">
    <?php } ?>
    <?php echo $this->Html->css('bootstrap.min.css') ."\r\n"; ?>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php echo $this->Html->css('styles.css') ."\r\n"; ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo $this->Html->script('jquery.min.js') ."\r\n"; ?>
    <?php echo $this->Html->script('bootstrap.min.js') ."\r\n"; ?>
  </head>
<body>

<?php echo $this->element('header'); ?>

<div id="masthead">  
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><?php echo Configure::read('Psd.name'); ?></h1>
      </div>
    </div> 
  </div><!-- /cont -->
  
 
</div>


<div class="container">
  <div class="row">
    
    <div class="col-md-12"> 
      
      <div class="panel">
        <div class="panel-body">
        
          
          <?php echo $this->fetch('content'); ?>
          
          
          <?php if ($this->params["action"]=="home" || $this->params["action"]=="category") echo $this->element('pagination'); ?>
        
          
        </div>
      </div>
                                                                                       
	                                                
                                                      
   	</div><!--/col-12-->
  </div>
</div>
                                                
                                                                                
<hr>

<?php echo $this->element('footer'); ?>

	</body>
</html>