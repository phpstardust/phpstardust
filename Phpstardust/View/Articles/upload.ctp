<?php

if (isset($image)) {

?>
<script type="text/javascript">
function addToEditor() {
	var data = parent.CKEDITOR.instances.text.getData();
	data += '<img src="<?php echo $image; ?>">';
	parent.CKEDITOR.instances.text.setData(data);
	parent.$('#psdModal').modal('hide');
}
</script>
<?php

echo $this->Form->button(__d('phpstardust', 'Add Image'),array(
	'onclick'=>'addToEditor();'
));

} else {
			  
echo $this->Form->create('Article', array('action' => 'upload', 'role' => 'form', 'type' => 'file'));

echo $this->Form->input('image', array('label' => __d('phpstardust', 'Image'), 'type' => 'file'));

echo $this->Form->end(__d('phpstardust', 'Upload'));

}

?>