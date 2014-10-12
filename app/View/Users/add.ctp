<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="users form">
			<div class="input-group">
			<?php echo $this->Form->create('User'); ?>
			<legend><?php echo __('Ajout d\'un utilisateur'); ?></legend>
			<?php
			$this->Form->inputDefaults(array('class' => 'form-control'));
			echo $this->Form->input('username');
			echo $this->Form->input('password');
			// echo $this->Form->input('role');
			echo $this->Form->end(__('Envoyer')); ?>
			</div>
		</div>
	</div>
</div>
