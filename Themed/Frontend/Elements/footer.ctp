<div class="container" id="footer">
  <div class="row">
    <div class="col col-sm-6">
      <a class="btn btn-default btn-lg" href="<?php echo Configure::read('Psd.url'); ?>/feed"><i class="fa fa-rss"></i> Feed RSS</a>
    </div>
    <div class="col col-sm-6">
      <div class="btn-group">
          <button type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <?php echo __d('phpstardust','Categories'); ?> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
          	<?php foreach ($categories as $categorie): ?>
            <li><a href="<?php echo Configure::read('Psd.url'); ?>/category/<?php echo $categorie['Categorie']['slug']; ?>"><?php echo $categorie['Categorie']['name']; ?></a></li>
    		<?php endforeach; ?>
    	  </ul>
    	  <?php unset($categorie); ?>
        </div>
    </div>
  </div>
</div>

<hr>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
          <p class="pull-right">Based on <a href="http://www.phpstardust.org">PhpStarDust</a>. Theme by <a href="http://bootstrapzero.com/bootstrap-template/blog">Blog Bootstrap Template</a></p>      
      </div>
    </div>
  </div>
</footer>