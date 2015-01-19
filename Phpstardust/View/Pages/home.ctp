<h1><a href="<?php echo $this->Psd->getSiteurl(); ?>"><?php echo $this->Psd->getSitename(); ?></a></h1>
<br><br>
<table>

    <tr>
        <td style="width:80%">
        	<?php if (count($rows)>0) { ?>
        	<?php foreach ($rows as $row): ?>
			<a href="<?php echo $this->Psd->getArticleUrl($row); ?>"><?php echo $this->Psd->getArticleTitle($row); ?></a><br>
            <?php echo $this->Psd->getArticleCreated($row); ?><br>
            <?php echo $this->Psd->getArticleImage($row); ?><br>
            <?php echo $this->Psd->getArticleText($row); ?><br><br>
            <?php endforeach; ?>
    		<?php unset($row); ?>
            <?php } else echo __d('phpstardust','No articles found.'); ?>
        </td>
        <td>
        <?php echo $this->element('search'); ?><br>
        <?php echo $this->element('listPages'); ?><br>
        <?php echo $this->element('listCategories'); ?><br>
        </td>
    </tr>
  
</table>
<?php echo $this->element('pagination'); ?>