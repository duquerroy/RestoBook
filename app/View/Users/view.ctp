<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="users view popupevent">
			<h2><?php echo __('Utilisateur'); ?></h2>
			<ul class='clearfix back'>
				<li class="tit"><?php echo __('Nom :'); ?></li>
				<li> <?php echo h($user['User']['username']); ?> &nbsp; </li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('Crée le :'); ?></li>
				<li> <?php echo h($user['User']['created']); ?> &nbsp; </li>
			</ul>
			<br>
			<?php echo $this->Html->link(__('Modifier Utilisateur'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Supprimer Utilisateur'), array('action' => 'delete', $user['User']['id']), null, __('Êtes-vous sür de vouloir supprimer cet utilisateur ?', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Liste des Utilisateurs'), array('action' => 'index')); ?>
			<?php echo $this->Html->link(__('Nouvel Utilisateur'), array('action' => 'add')); ?>
		</div>
	</div>
</div>
