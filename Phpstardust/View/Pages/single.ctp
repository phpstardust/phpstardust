<h1><a href="<?php echo Configure::read('Psd.url'); ?>"><?php echo Configure::read('Psd.name'); ?></a></h1>
<br><br>
<table>

    <tr>
        <td style="width:80%">
			<a href="<?php echo $this->Psd->getArticleUrl($row); ?>"><?php echo $this->Psd->getArticleTitle($row); ?></a><br>
            <?php echo $this->Psd->getArticleCreated($row); ?><br>
            <?php echo $this->Psd->getArticleImage($row); ?><br>
            <?php echo $this->Psd->getArticleText($row); ?><br><br>
    		<?php unset($row); ?>
        </td>
        <td>
        <?php echo $this->element('search'); ?><br>
        <?php echo $this->element('listPages'); ?><br>
        <?php echo $this->element('listCategories'); ?><br>
        </td>
    </tr>
  
</table>