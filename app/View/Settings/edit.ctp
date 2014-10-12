<div class="settings form">
	<div class="users form">
		<div class="input-group">
		<?php echo $this->Form->create('Setting'); ?>
			<fieldset>
				<legend><?php echo __('Modifier une option'); ?></legend>
				<?php
				$this->Form->inputDefaults(array(
					'class' => 'form-control'));
				echo $this->Form->input('id');
				echo $this->Form->input('desc', array('label'=>'Description :', 'disabled'=>'disabled'));
				echo $this->Form->input('value', array('label'=>'Valeur :'));
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Envoyer')); ?>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('Liste des options'), array('action' => 'index')); ?></li>
			</ul>
		</div>
	</div>
</div>
