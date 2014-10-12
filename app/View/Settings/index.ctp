<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="settings index">
			<h2><?php echo __('Options'); ?></h2>
			<table class="table">
			<tr>
				<th><?php echo $this->Paginator->sort('valeur'); ?></th>
				<th><?php echo $this->Paginator->sort('description'); ?></th>
				<th class="actions"><?php echo __('Action'); ?></th>
			</tr>
			<?php foreach ($settings as $setting): ?>
				<tr>
					<td><?php echo h($setting['Setting']['value']); ?>&nbsp;</td>
					<td><?php echo h($setting['Setting']['desc']); ?>&nbsp;</td>
					<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $setting['Setting']['id']), array ("class"=>"btn btn-primary", "role"=>"button")); ?>
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
					echo $this->Paginator->numbers(array('separator' => ' --- '));
					echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
				?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

