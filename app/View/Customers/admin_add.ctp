<div class="customers form">
<?php echo $this->Form->create('Customer'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Customer'); ?></legend>
	<?php
		echo $this->Form->input('lastName');
		echo $this->Form->input('firstName');
		echo $this->Form->input('groupName');
		echo $this->Form->input('phone');
		echo $this->Form->input('work');
		echo $this->Form->input('fax');
		echo $this->Form->input('email');
		echo $this->Form->input('note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?></li>
	</ul>
</div>
