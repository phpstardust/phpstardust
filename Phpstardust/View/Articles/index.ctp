<h1><?php echo __d('phpstardust','Articles'); ?></h1>
<?php echo $this->Html->link(
    'Home',
    array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'dashboard')
); ?>
 &gt;
<?php echo $this->Html->link(
    __d('phpstardust','Articles'),
    array('plugin' => 'phpstardust', 'controller' => 'articles', 'action' => 'index')
); ?>
<br><br>
<?php echo $this->Html->link(
    __d('phpstardust','Add Article'),
    array('plugin' => 'phpstardust', 'controller' => 'articles', 'action' => 'add')
); ?>
<br><br>
<?php 

echo $this->Form->create('Article', array('action' => 'index')); 

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
        <th><?php echo __d('phpstardust','Title'); ?></th>
        <th><?php echo __d('phpstardust','User'); ?></th>
        <th><?php echo __d('phpstardust','Status'); ?></th>
        <th><?php echo __d('phpstardust','Created'); ?></th>
        <th><?php echo __d('phpstardust','Actions'); ?></th>
    </tr>

    <?php foreach ($rows as $row): ?>
    <tr>
        <td><?php echo $row['Article']['id']; ?></td>
        <td><?php echo $row['Article']['title']; ?></td>
        <td><?php echo $row['User']['username']; ?></td>
        <td><?php if ($row['Article']['status']==1) echo __d('phpstardust','Published'); else echo __d('phpstardust','Draft'); ?></td>
        <td><?php echo $this->Time->format('Y/m/d H:i:s' , $row['Article']['created']); ?></td>
        <td>
        	<?php
                echo $this->Html->link(
                    __d('phpstardust','Edit'), array('action' => 'edit', $row['Article']['id'])
                );
            ?>
            <?php
                echo $this->Form->postLink(
                    __d('phpstardust','Delete'),
                    array('action' => 'delete', $row['Article']['id']),
                    array('confirm' => __d('phpstardust','Are you sure?'))
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($row); ?>
</table>
<?php echo $this->element('pagination'); ?>