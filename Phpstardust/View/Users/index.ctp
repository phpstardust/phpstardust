<h1>Users</h1>
<?php echo $this->Html->link(
    'Home',
    array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'dashboard')
); ?>
 &gt;
<?php echo $this->Html->link(
    __d('phpstardust', 'Users'),
    array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'index')
); ?>
<br><br>
<?php echo $this->Html->link(
    __d('phpstardust', 'Add User'),
    array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'add')
); ?>
<br><br>
<?php 

echo $this->Form->create('User', array('action' => 'index')); 

echo $this->Form->input('q',array(
	'type'=>'text',
	'label'=>false,
	'div'=>false
));

echo $this->Form->button(__d('phpstardust', 'Search'),array(
	'type'=>'submit'
));

echo $this->Form->end();

?>
<br><br>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th><?php echo __d('phpstardust', 'Role'); ?></th>
        <th><?php echo __d('phpstardust', 'Status'); ?></th>
        <th><?php echo __d('phpstardust', 'Created'); ?></th>
        <th><?php echo __d('phpstardust', 'Actions'); ?></th>
    </tr>

    <?php foreach ($rows as $row): ?>
    <tr>
        <td><?php echo $row['User']['id']; ?></td>
        <td><?php echo $row['User']['username']; ?></td>
        <td><?php echo $row['User']['role']; ?></td>
        <td><?php if ($row['User']['status']==1) echo __d('phpstardust', 'Active'); else echo __d('phpstardust', 'Inactive'); ?></td>
        <td><?php echo $this->Time->format('Y/m/d H:i:s' , $row['User']['created']); ?></td>
        <td>
        	<?php
                echo $this->Html->link(
                    __d('phpstardust', 'Edit'), array('action' => 'edit', $row['User']['id'])
                );
            ?>
            <?php
                echo $this->Form->postLink(
                    __d('phpstardust', 'Delete'),
                    array('action' => 'delete', $row['User']['id']),
                    array('confirm' => __d('phpstardust', 'Are you sure?'))
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($row); ?>
</table>
<?php echo $this->element('pagination'); ?>