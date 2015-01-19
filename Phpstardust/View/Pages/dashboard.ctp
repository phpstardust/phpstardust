<h1><?php echo __d('phpstardust', 'Welcome'); ?> :)</h1>
<p><?php echo $info; ?></p>
<table>
    <tr>
        <th><?php echo __d('phpstardust', 'Module'); ?></th>
        <th>Link</th>
    </tr>

    <tr>
        <td><?php echo __d('phpstardust', 'Users'); ?></td>
        <td>
        	<?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Open'),
					array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'index')
				); 
				
				?>
        </td>
    </tr>
    
    <tr>
        <td><?php echo __d('phpstardust', 'Articles'); ?></td>
        <td>
        	<?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Open'),
					array('plugin' => 'phpstardust', 'controller' => 'articles', 'action' => 'index')
				); 
				
				?>
        </td>
    </tr>
    
    <tr>
        <td><?php echo __d('phpstardust', 'Categories'); ?></td>
        <td>
        	<?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Open'),
					array('plugin' => 'phpstardust', 'controller' => 'categories', 'action' => 'index')
				); 
				
				?>
        </td>
    </tr>
    
    <tr>
        <td><?php echo __d('phpstardust', 'Pages'); ?></td>
        <td>
        	<?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Open'),
					array('plugin' => 'phpstardust', 'controller' => 'pages', 'action' => 'index')
				); 
				
				?>
        </td>
    </tr>
    
    <tr>
        <td><?php echo __d('phpstardust', 'Settings'); ?></td>
        <td>
        	<?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Open'),
					array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'edit', 1)
				); 
				
				?>
        </td>
    </tr>
    
    <tr>
        <td>Backup Database</td>
        <td>
        	<?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Open'),
					array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'backupDb')
				); 
				
				?>
        </td>
    </tr>
    
    <tr>
        <td><?php echo __d('phpstardust', 'Import'); ?> Database</td>
        <td>
        	<?php 
			
				echo $this->Html->link(
					__d('phpstardust', 'Open'),
					array('plugin' => 'phpstardust', 'controller' => 'settings', 'action' => 'importDb')
				); 
				
				?>
        </td>
    </tr>

</table>