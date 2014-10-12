<div class="customers index">
	<h2><?php echo __('Clients'); ?></h2>
	<table id='tableData' class="table">
	<thead>
	<tr>
			<!-- <th><?php //echo  __('Id'); ?></th> -->
			<th><?php echo  __('Nom'); ?></th>
			<th><?php echo  __('Prénom'); ?></th>
			<th><?php echo  __('Groupe'); ?></th>
			<th><?php echo  __('Téléphone'); ?></th>
			<th><?php echo  __('Travail'); ?></th>
			<th><?php echo  __('Fax'); ?></th>
			<th><?php echo  __('Courriel'); ?></th>
			<th><?php echo  __('Notes'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($customers as $customer): ?>
	<tr>
		<!-- <td><?php //echo h($customer['Customer']['id']); ?>&nbsp;</td> -->
		<td><?php echo h($customer['Customer']['lastName']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['firstName']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['groupName']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['phone']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['work']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['fax']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['email']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['note']); ?>&nbsp;</td>
		<td class="actions">
		<ul class="reserv">
			<li class="action"><?php echo $this->Html->link(__(''), array('action' => 'view', $customer['Customer']['id']), array ("class"=>"action1")); ?></li>
			<li class="action "><?php echo $this->Html->link(__(''), array('action' => 'edit', $customer['Customer']['id']), array ("class"=>"action2")); ?></li>
			<li class="action "><?php echo $this->Form->postLink(__(''), array('action' => 'delete', $customer['Customer']['id']), array ("class"=>"action3"), __('Êtes-vous sûr de vouloir supprimer cette fiche client ?', $customer['Customer']['id'])); ?></li>
		</ul>
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
	</div>
</div>
<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?></li>
	</ul> -->
</div>


