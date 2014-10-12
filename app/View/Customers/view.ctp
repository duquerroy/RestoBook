<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="customers view popupevent">
			<h2><?php echo __('Client'); ?></h2>
			<!-- <ul class='clearfix back'> -->
				<!-- <li class="tit"><?php //echo __('Id Customer'); ?></li> -->
				<!-- <li> <?php //echo h($customer['Customer']['id']); ?> &nbsp;</li> -->
			<!-- </ul> -->
			<ul class='clearfix'>
				<li class="tit"><?php echo __('Nom'); ?></li>
				<li> <?php echo h($customer['Customer']['lastName']); ?> &nbsp;</li>
			</ul><ul class='clearfix back'>
				<li class="tit"><?php echo __('Prénom'); ?></li>
				<li> <?php echo h($customer['Customer']['firstName']); ?> &nbsp;</li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('Groupe'); ?></li>
				<li> <?php echo h($customer['Customer']['groupName']); ?> &nbsp;</li>
			</ul><ul class='clearfix back'>
				<li class="tit"><?php echo __('Téléphone'); ?></li>
				<li> <?php echo h($customer['Customer']['phone']); ?> &nbsp;</li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('Travail'); ?></li>
				<li> <?php echo h($customer['Customer']['work']); ?> &nbsp;</li>
			</ul><ul class='clearfix back'>
				<li class="tit"><?php echo __('Fax'); ?></li>
				<li> <?php echo h($customer['Customer']['fax']); ?> &nbsp;</li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('Courriel'); ?></li>
				<li> <?php echo h($customer['Customer']['email']); ?> &nbsp;</li>
			</ul><ul class='clearfix back'>
				<li class="tit"><?php echo __('Notes'); ?></li>
				<li> <?php echo h($customer['Customer']['note']); ?> &nbsp;</li>
			</ul>
			<br>
			<?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $customer['Customer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete Customer'), array('action' => 'delete', $customer['Customer']['id']), null, __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?>
			<?php echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?>
			<?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?>
		</div>
	</div>
</div>
