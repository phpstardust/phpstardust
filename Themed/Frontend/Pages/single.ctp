<div class="row">    
  <br>
  <div class="col-md-2 col-sm-3 text-center">
  	<?php if ($this->Psd->getArticleImage!==false) { ?>
	<a class="story-img" href="<?php echo $this->Psd->getArticleUrl($row); ?>">
	<?php echo $this->Psd->getArticleImage($row, 'img-circle', 'width:100px;height:100px'); ?></a>
    <?php } ?>
  </div>
  <div class="col-md-10 col-sm-9">
	<h3><?php echo $this->Psd->getArticleTitle($row); ?></h3>
	<div class="row">
	  <div class="col-xs-9">
		<?php echo $this->Psd->getArticleText($row); ?>
		<ul class="list-inline">
        	<li><a href="#"><?php echo $this->Psd->getArticleCreated($row); ?></a></li>
 		</ul>
		</div>
	  <div class="col-xs-3"></div>
	</div>
	<br><br>
  </div>
</div>
<hr>
<?php unset($row); ?>
