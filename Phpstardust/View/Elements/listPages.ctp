<ul>
<li><a href="<?php echo Configure::read('Psd.url'); ?>/feed">Feed RSS</a></li>
<?php foreach ($pages as $page): ?>
	<li><a href="<?php echo Configure::read('Psd.url'); ?>/<?php echo $page['Page']['slug']; ?>"><?php echo $page['Page']['title']; ?></a></li>
<?php endforeach; ?>
</ul>
<?php unset($page); ?>