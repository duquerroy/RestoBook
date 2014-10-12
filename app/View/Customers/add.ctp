<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="customers form">
			<div class="input-group">
				<?php echo $this->Form->create('Customer'); ?>
				<legend><?php echo __('Ajout d\'un client'); ?></legend>
				<?php
				$this->Form->inputDefaults(array(
					'class' => 'form-control'));
				echo $this->Form->input('lastName', array('label' => 'Nom'));
				echo $this->Form->input('firstName', array('label' => 'Prénom'));
				echo $this->Form->input('groupName', array('label' => 'Groupe'));
				echo $this->Form->input('phone', array('label' => 'Téléphone'));
				echo $this->Form->input('work', array('label' => 'Tél. Travail'));
				echo $this->Form->input('fax', array('label' => 'Fax'));
				echo $this->Form->input('email', array('label' => 'Courriel'));
				echo $this->Form->input('note', array('label' => 'Notes'));

				echo $this->Form->end('Envoyer');
				?>
			</div>
		</div>
	</div>
</div>



