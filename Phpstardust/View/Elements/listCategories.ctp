<ul>
<?php foreach ($categories as $categorie): ?>
	<li><a href="<?php echo Configure::read('Psd.url'); ?>/category/<?php echo $categorie['Categorie']['slug']; ?>"><?php echo $categorie['Categorie']['name']; ?></a></li>
<?php endforeach; ?>
</ul>
<?php unset($categorie); ?>