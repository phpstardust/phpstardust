<h1><?php echo __d('phpstardust','Categories'); ?></h1>
<?php echo $this->Html->link(
    'Home',
    array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'dashboard')
); ?>
 &gt;
<?php echo $this->Html->link(
    __d('phpstardust','Categories'),
    array('plugin' => 'phpstardust', 'controller' => 'categories', 'action' => 'index')
); ?>
<br><br>
<?php echo $this->Html->link(
    __d('phpstardust','Add Category'),
    array('plugin' => 'phpstardust', 'controller' => 'categories', 'action' => 'add')
); ?>
<br><br>
<?php 

echo $this->Form->create('Categorie', array('action' => 'index')); 

echo $this->Form->input('q',array(
	'type'=>'text',
	'label'=>false,
	'div'=>false
));

echo $this->Form->button(__d('phpstardust','Search'),array(
	'type'=>'submit'
));

echo $this->Form->end();

?>
<br><br>
<table>
    <tr>
        <th>ID</th>
        <th><?php echo __d('phpstardust','Name'); ?></th>
        <th><?php echo __d('phpstardust','Created'); ?></th>
        <th><?php echo __d('phpstardust','Actions'); ?></th>
    </tr>

    <?php foreach ($rows as $row): ?>
    <tr>
        <td><?php echo $row['Categorie']['id']; ?></td>
        <td><?php echo $row['Categorie']['name']; ?></td>
        <td><?php echo $this->Time->format('Y/m/d H:i:s' , $row['Categorie']['created']); ?></td>
        <td>
        	<?php
                echo $this->Html->link(
                    __d('phpstardust','Edit'), array('action' => 'edit', $row['Categorie']['id'])
                );
            ?>
            <?php
                echo $this->Form->postLink(
                    __d('phpstardust','Delete'),
                    array('action' => 'delete', $row['Categorie']['id']),
                    array('confirm' => __d('phpstardust','Are you sure?'))
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($row); ?>
</table>
<?php echo $this->element('pagination'); ?>