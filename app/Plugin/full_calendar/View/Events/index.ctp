<div class="events index">

	<h2><?php echo __('Réservations'); ?></h2>
	<table id='tableData' class="table">

	<thead>
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Début'); ?></th>
			<th><?php echo __('Fin'); ?></th>
			<th><?php echo __('Journée'); ?></th>
			<th><?php echo __('notes'); ?></th>
			<th><?php echo __('Clause Spéciale'); ?></th>
			<th><?php echo __('Nbr Adulte'); ?></th>
			<th><?php echo __('Nbr Enfant'); ?></th>
			<th><?php echo __('Nbr 3ans'); ?></th>
			<th><?php echo __('Salle bloquée'); ?></th>
			<th><?php echo __('Resto bloqué'); ?></th>
			<th><?php echo __('Nbr Tables'); ?></th>
			<th><?php echo __('Client'); ?></th>
			<th><?php echo __('Salle'); ?></th>
			<th><?php echo __('Utilisateur'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($events as $event): ?>
		<tr>
			<td><?php echo h($event['Event']['id']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['start']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['end']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['all_day']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['notes']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['special_clause']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['size_adulte']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['size_enfant']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['size_3ans']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['block_room']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['block_resto']); ?>&nbsp;</td>
			<td><?php echo h($event['Event']['nb_tables']); ?>&nbsp;</td>
			<td><?php echo $customers[$event['Event']['customer_id']]; ?>&nbsp;</td>
			<td><?php echo $eventTypes[$event['Event']['event_type_id']]; ?>&nbsp;</td>
			<td><?php echo $users[$event['Event']['user_id']]; ?>&nbsp;</td>
			<td><?php echo h($event['Event']['status']); ?>&nbsp;</td>
			<td class="actions">

				<?php //echo $this->Html->link(__('View'), array('action' => 'view', $event['Event']['id']), array ("class"=>"btn btn-primary", "role"=>"button")); ?>
				<?php echo $this->Html->link(__('Editer'), array('action' => 'add', $event['Event']['id']), array ("class"=>"btn btn-primary", "role"=>"button")); ?>
				<?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $event['Event']['id']), array ("class"=>"btn btn-danger", "role"=>"button"), __('Êtes-vous sûr de vouloir supprimer cette réservation ?', $event['Event']['id'])); ?>


			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
	<!-- <p>
	<?php
	// echo $this->Paginator->counter(array(
	// 'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	// ));
	?>	</p>
	<div class="paging">
	<?php
		// echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		// echo $this->Paginator->numbers(array('separator' => ''));
		// echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div> -->
</div>






