<div class="panel panel-default">
	<div class="panel-heading">
	  <h3 class="panel-title"><i class="fa fa-user"></i> <?php echo __d('phpstardust', 'Articles'); ?> <span class="badge"><?php echo $count; ?></span></h3>
	</div>
	<div class="panel-body">
	  
	  <div class="row">
	  
		  <div class="col-lg-6">
			  <?php 
			  echo $this->Html->link(
				  '<i class="fa fa-plus"></i> ' .__d('phpstardust', 'Add'),
				  array('plugin' => 'phpstardust', 'controller' => 'articles', 'action' => 'add'),
				  array('class'=>'btn btn-psd', 'escape' => false)
			  ); 
			  ?>
		  </div>
		  
		  <div class="col-lg-6">
			  <?php echo $this->Form->create('Article', array('url' => 'index', 'class' => 'navbar-form searchform', 'role' => 'search', 'type' => 'get')); ?>
			  <div class="input-group searchbox">
                  <?php
                  echo $this->Form->input('q',array(
						'type'=>'text',
						'autofocus'=>'autofocus',
						'label'=>false,
						'div'=>false,
						'class' => 'form-control',
						'placeholder' => 'Search'
					));
					?>
				  <div class="input-group-btn">
                      <?php
					  echo $this->Form->button('<i class="fa fa-search"></i> ' .__d('phpstardust', 'Search'),array(
							'type'=>'submit',
							'class' => 'btn btn-psd'
						));
						?>
				  </div>
			  </div>
              <?php echo $this->Form->end(); ?>
		  </div>
		  
	  </div>
	  
	  <div class="row">
	  
		  <div class="col-lg-12">
		  
			  <table class="table table-responsive hidden-xs">
				<caption></caption>
				<thead>
				  <tr>
					<th>ID</th>
                    <th><?php echo __d('phpstardust', 'Title'); ?></th>
                    <th><?php echo __d('phpstardust', 'User'); ?></th>
                    <th><?php echo __d('phpstardust', 'Status'); ?></th>
                    <th><?php echo __d('phpstardust', 'Created'); ?></th>
                    <th><?php echo __d('phpstardust', 'Actions'); ?></th>
				  </tr>
				</thead>
				<tbody>
                  <?php foreach ($rows as $row): ?>
				  <tr>
					<td><?php echo $row['Article']['id']; ?></td>
                    <td><?php echo $row['Article']['title']; ?></td>
                    <td><?php echo $row['User']['username']; ?></td>
					<td><?php if ($row['Article']['status']==1) echo '<span class="label label-success">' .__d('phpstardust', 'Published') .'</span>'; else echo '<span class="label label-default">' .__d('phpstardust', 'Draft') .'</span>'; ?></td>
                    <td><?php echo $this->Time->format('Y/m/d H:i:s' , $row['Article']['created']); ?></td>
                    <td>
                      <?php 
					  echo $this->Html->link(
						  '<i class="fa fa-pencil"></i> ' .__d('phpstardust', 'Edit'),
						  array('action' => 'edit', $row['Article']['id']),
						  array('class'=>'btn btn-psd', 'escape' => false)
					  ); 
					  ?>
                      <?php
							echo $this->Form->postLink(
								'<i class="fa fa-remove"></i> ' .__d('phpstardust', 'Delete'),
								array('action' => 'delete', $row['Article']['id']),
								array('class'=>'btn btn-psd', 'escape' => false, 'confirm' => __d('phpstardust', 'Are you sure?'))
							);
						?>
					</td>
				  </tr>
                  <?php endforeach; ?>
				</tbody>
			  </table>
			  
			  <ul class="list-group visible-xs-block mobiletable">
              	<?php foreach ($rows as $row): ?>
				<li class="list-group-item">
				  <p><strong><?php echo $row['Article']['title']; ?></strong></p>
				  <div class="btn-group btn-group-justified" role="group">
					<?php 
					  echo $this->Html->link(
						  '<i class="fa fa-pencil"></i> ' .__d('phpstardust', 'Edit'),
						  array('action' => 'edit', $row['Article']['id']),
						  array('class'=>'btn btn-psd', 'escape' => false)
					  ); 
					  ?>
                      <?php
							echo $this->Form->postLink(
								'<i class="fa fa-remove"></i> ' .__d('phpstardust', 'Delete'),
								array('action' => 'delete', $row['Article']['id']),
								array('class'=>'btn btn-danger', 'escape' => false, 'confirm' => __d('phpstardust', 'Are you sure?'))
							);
						?>
				  </div>
				</li>
                <?php endforeach; ?>
    			<?php unset($row); ?>
			  </ul>
		  
		  </div>
	  
	  </div>
	  
	</div>
	
	<div class="panel-footer">
	  <?php echo $this->element('pagination'); ?>
    </div>

</div>
