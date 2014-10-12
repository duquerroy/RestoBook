<div class="customers view">
<h2><?php echo __('Customer'); ?></h2>
	<dl>
		<dt><?php echo __('Id Customer'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LastName'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['lastName']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FirstName'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['firstName']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('GroupName'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['groupName']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Work'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['work']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($customer['Customer']['note']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Customer'), array('action' => 'delete', $customer['Customer']['id']), null, __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?> </li>
	</ul>
</div>
