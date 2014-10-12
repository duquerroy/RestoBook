<?php
/*
 * View/Events/edit.ctp
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
?>
<div class="events form">
<div class="input-group">
<?php echo $this->Form->create('Event');?>
	<fieldset>
 		<legend><?php __('Edit Event'); ?></legend>
	<?php
		$this->Form->inputDefaults(array(
        'class' => 'form-control'
    		)
		);
		echo $this->Form->input('id');
		echo $this->Form->input('event_type_id');
		// echo $this->Form->input('title');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('special_clause');
		echo $this->Form->input('start',
	        array(
	           'id'=>'datetimepicker',
	           'type'=>'text'
	        ));
		echo $this->Form->input('end',
	        array(
	           'id'=>'datetimepicker1',
	           'type'=>'text'
	        ));
		echo $this->Form->input('all_day');
		echo $this->Form->input('user_id');

		echo $this->Form->input('status', array('options' => array(
					'Prévu' => 'Prévu',
					'Confirmé' => 'Confirmé',
					// 'In Progress' => 'In Progress',
					// 'Rescheduled' => 'Rescheduled',
					// 'Completed' => 'Completed'
					)
				)
			);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('View Event', true), array('plugin' => 'full_calendar', 'action' => 'view', $this->Form->value('Event.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Manage Events', true), array('plugin' => 'full_calendar', 'action' => 'index'));?></li>
		<li><li><?php echo $this->Html->link(__('View Calendar', true), array('plugin' => 'full_calendar', 'controller' => 'full_calendar')); ?></li>
	</ul>
</div>
</div>
