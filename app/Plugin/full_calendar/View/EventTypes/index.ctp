<div class="eventTypes index">
	<h2><?php echo __('Salles'); ?></h2>
	<table class="table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('nom'); ?></th>
			<th><?php echo $this->Paginator->sort('couleur'); ?></th>
			<th><?php echo $this->Paginator->sort('capacité'); ?></th>
			<th><?php echo $this->Paginator->sort('capacité Cumulé'); ?></th>
			<!-- <th><?php //echo $this->Paginator->sort('month_from'); ?></th> -->
			<!-- <th><?php //echo $this->Paginator->sort('month_to'); ?></th> -->
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($eventTypes as $eventType): ?>
	<tr>

		<td>
			<?php //echo h($eventType['EventType']['name']); ?>
			<?php echo h($eventTypesTree[$eventType['EventType']['id']]); ?>&nbsp;
		</td>

		<td class="<?php echo h($eventType['EventType']['color']); ?>"><?php echo h($eventType['EventType']['color']); ?>&nbsp;</td>

		<td><?php echo h($eventType['EventType']['capacity']); ?>&nbsp;</td>
		<td><?php echo h($totArray[$eventType['EventType']['id']]); ?>&nbsp;</td>
		<!-- <td><?php //echo h($eventType['EventType']['month_from']); ?>&nbsp;</td> -->
		<!-- <td><?php //echo h($eventType['EventType']['month_to']); ?>&nbsp;</td> -->
		<td><?php if (isset($parent[$eventType['EventType']['parent_id']])) echo $parent[$eventType['EventType']['parent_id']]; ?>&nbsp;</td>

		<td class="actions">
			<ul class="reserv">
			<li class="action"><?php echo $this->Html->link(__(''), array('action' => 'view', $eventType['EventType']['id']), array ("class"=>"action1")); ?></li>
			<li class="action "><?php echo $this->Html->link(__(''), array('action' => 'edit', $eventType['EventType']['id']), array ("class"=>"action2")); ?></li>
			<li class="action "><?php echo $this->Form->postLink(__(''), array('action' => 'delete', $eventType['EventType']['id']), array ("class"=>"action3"), __('Are you sure you want to delete # %s?', $eventType['EventType']['id'])); ?></li>
		</ul>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<!-- <p>
	<?php
	//echo $this->Paginator->counter(array(
	//'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	//));
	?>	</p>
	<div class="paging">
	<?php
		//echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		//echo $this->Paginator->numbers(array('separator' => ''));
		//echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div> -->
</div>

