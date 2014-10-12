<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="events view popupevent">
		<h2><?php echo __('Réservations'); ?></h2>
			<ul class='clearfix'>
				<li class="tit"><?php echo __('Salle'); ?></li>
				<li><?php echo $this->Html->link($event['EventType']['name'], array('controller' => 'event_types', 'action' => 'view', $event['EventType']['id'])); ?></li>
			</ul><ul class='clearfix back'>
				<li class="tit"><?php echo __('Client'); ?></li>
				<li><?php echo $event['Customer']['lastName']." ".$event['Customer']['groupName']; ?></li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('Clause spéciale'); ?></li>
				<li><?php echo $event['Event']['special_clause']; ?></li>
			</ul><ul class='clearfix back'>
				<li class="tit"><?php echo __('Notes'); ?></li>
				<li><?php echo $event['Event']['notes']; ?></li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('Status'); ?></li>
				<li><?php echo $event['Event']['status']; ?></li>
			</ul><ul class='clearfix back'>
				<li class="tit"><?php echo __('Start'); ?></li>
				<li><?php echo $event['Event']['start']; ?></li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('End'); ?></li>
				<li><?php if($event['Event']['all_day'] != 1) { echo $event['Event']['end']; } else { echo "N/A"; } ?></li>
			</ul><ul class='clearfix back'>
		        <li class="tit"><?php echo __('Toute la journée'); ?></li>
				<li><?php if($event['Event']['all_day'] == 1) { echo "Yes"; } else { echo "No"; } ?></li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('Créé'); ?></li>
				<li><?php echo $event['Event']['created']; ?></li>
			</ul><ul class='clearfix back'>
				<li class="tit"><?php echo __('Modifié'); ?></li>
				<li><?php echo $event['Event']['modified']; ?></li>
			</ul>
			<?php echo $this->Html->link(__('Modifier', true), array('plugin' => 'full_calendar', 'action' => 'add', $event['Event']['id'])); ?>
			<?php echo $this->Html->link(__('Supprimer', true), array('plugin' => 'full_calendar', 'action' => 'delete', $event['Event']['id']), null, sprintf(__('Êtes-vous sûr de vouloir supprimer cet événement ?', true), $event['EventType']['name'])); ?>
			<?php echo $this->Html->link(__('Voir le calendrier', true), array('plugin' => 'full_calendar', 'controller' => 'full_calendar')); ?>
		</div>
	</div>
</div>
