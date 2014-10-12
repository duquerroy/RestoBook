<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="users index">
			<h2><?php echo __('Utilisateurs'); ?></h2>
			<table class="table">
			<tr>
				<th><?php echo $this->Paginator->sort('username'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($users as $user): ?>
				<tr>
					<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
					<td class="actions">
						<ul class="reserv">
							<li class="action"><?php echo $this->Html->link(__(''), array('action' => 'view', $user['User']['id']), array ("class"=>"action1")); ?></li>
							<li class="action "><?php echo $this->Html->link(__(''), array('action' => 'edit', $user['User']['id']), array ("class"=>"action2")); ?></li>
							<li class="action "><?php echo $this->Form->postLink(__(''), array('action' => 'delete', $user['User']['id']), array ("class"=>"action3"), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?></li>
						</ul>
					</td>



				</tr>
			<?php endforeach; ?>
			</table>
			<?php if ($this->Paginator->numbers != null) {  ?>
			<p>
			<?php
			echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
			?>
			</p>
			<div class="paging">
				<?php
					echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('separator' => ''));
					echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
				?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
