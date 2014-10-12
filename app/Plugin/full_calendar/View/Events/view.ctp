<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="events view">
		<h2><?php echo __('Réservations'); ?></h2>
			<dl><?php $i = 0; $class = ' class="altrow"';?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Event Type'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($event['EventType']['name'], array('controller' => 'event_types', 'action' => 'view', $event['EventType']['id'])); ?></dd>

				<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('customer_id'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $event['Customer']['lastName']." ".$event['Customer']['groupName']; ?></dd>

				<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('special_clause'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $event['Event']['special_clause']; ?></dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notes'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $event['Event']['notes']; ?></dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Status'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $event['Event']['status']; ?></dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Start'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $event['Event']['start']; ?></dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('End'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php if($event['Event']['all_day'] != 1) { echo $event['Event']['end']; } else { echo "N/A"; } ?></dd>
		                <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('All Day'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php if($event['Event']['all_day'] == 1) { echo "Yes"; } else { echo "No"; } ?></dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $event['Event']['created']; ?></dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $event['Event']['modified']; ?></dd>
			</dl>
			<?php echo $this->Html->link(__('Edit Event', true), array('plugin' => 'full_calendar', 'action' => 'add', $event['Event']['id'])); ?>
			<?php echo $this->Html->link(__('Delete Event', true), array('plugin' => 'full_calendar', 'action' => 'delete', $event['Event']['id']), null, sprintf(__('Are you sure you want to delete this %s event?', true), $event['EventType']['name'])); ?>
			<?php echo $this->Html->link(__('Manage Events', true), array('plugin' => 'full_calendar', 'action' => 'index')); ?>
			<?php echo $this->Html->link(__('View Calendar', true), array('plugin' => 'full_calendar', 'controller' => 'full_calendar')); ?>
		</div>
	</div>
</div>
