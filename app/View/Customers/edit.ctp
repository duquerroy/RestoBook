<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="customers form">
			<div class="input-group">
				<?php echo $this->Form->create('Customer'); ?>
				<legend><?php echo __('Modifier Fiche client'); ?></legend>
				<?php
				$this->Form->inputDefaults(array(
				'class' => 'form-control'));
				echo $this->Form->input('id');
				echo $this->Form->input('lastName', array('label' => 'Nom'));
				echo $this->Form->input('firstName', array('label' => 'Prénom'));
				echo $this->Form->input('groupName', array('label' => 'Groupe'));
				echo $this->Form->input('phone', array('label' => 'Téléphone'));
				echo $this->Form->input('work', array('label' => 'Tél. Travail'));
				echo $this->Form->input('fax', array('label' => 'Fax'));
				echo $this->Form->input('email', array('label' => 'Courriel'));
				echo $this->Form->input('note', array('label' => 'Notes'));
				?>
				<?php echo $this->Form->end(__('Submit')); ?>
				<?php echo $this->Form->postLink(__('Supprimer cette fiche'), array('action' => 'delete', $this->Form->value('Customer.id')), null, __('Êtes-vous sûr de vouloir supprimer cette fiche ?', $this->Form->value('Customer.id'))); ?>
				<?php echo $this->Html->link(__('Liste des clients'), array('action' => 'index')); ?>
			</div>
		</div>
	</div>
</div>
