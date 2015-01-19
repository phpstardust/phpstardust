<h1><a href="<?php echo $this->Psd->getSiteurl(); ?>"><?php echo $this->Psd->getSitename(); ?></a></h1>
<br><br>
<table>

    <tr>
        <td style="width:80%">
			<a href="<?php echo $this->Psd->getPageUrl($row); ?>"><?php echo $this->Psd->getPageTitle($row); ?></a><br>
            <?php echo $this->Psd->getPageCreated($row); ?><br>
            <?php echo $this->Psd->getPageImage($row); ?><br>
            <?php echo $this->Psd->getPageText($row); ?><br><br>
    		<?php unset($row); ?>
        </td>
        <td>
        <?php echo $this->element('search'); ?><br>
        <?php echo $this->element('listPages'); ?><br>
        <?php echo $this->element('listCategories'); ?><br>
        </td>
    </tr>
  
</table>