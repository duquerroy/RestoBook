<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="settings form">
			<div class="input-group">
				<?php echo $this->Form->create('User'); ?>
				<legend><?php echo __('Modifier fiche utilisateur'); ?></legend>
				<?php
				$this->Form->inputDefaults(array(
				'class' => 'form-control'));
				echo $this->Form->input('id');
				echo $this->Form->input('username');
				echo $this->Form->input('password');
				// echo $this->Form->input('role');
				?>
				<?php echo $this->Form->end(__('Submit')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?>
				<?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?>
			</div>
		</div>
	</div>
</div>
