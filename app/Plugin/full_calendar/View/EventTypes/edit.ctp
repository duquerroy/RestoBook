<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div class="eventTypes form">
			<div class="input-group">
				<?php echo $this->Form->create('EventType'); ?>
				<legend><?php echo __('Modification salle'); ?></legend>
				<?php
				$this->Form->inputDefaults(array('class' => 'form-control'));
				echo $this->Form->input('name', array('label' => 'Nom'));
				echo $this->Form->input('id');
				// Selection de couleurs, voir fullcalendar.css:279
				$colour = array('Blue', 'Green', 'Red', 'Pink', 'Purple', 'Orange', 'Black', 'Brown', 'Maroon', 'Grey', 'Gold', 'Chocolate', 'Aquamarine', 'BlueViolet','Brown', 'BurlyWood', 'CadetBlue', 'Chartreuse', 'Chocolate', 'Coral', 'CornflowerBlue', 'Cornsilk', 'Crimson', 'Cyan', 'DarkBlue', 'DarkCyan', 'DarkGoldenRod', 'DarkGray', 'DarkGreen', 'DarkKhaki', 'DarkMagenta', 'DarkOliveGreen', 'DarkOrange', 'DarkOrchid', 'DarkRed', 'DarkSalmon', 'DarkSeaGreen', 'DarkSlateBlue', 'DarkSlateGray', 'DarkTurquoise', 'DarkViolet', 'DeepPink', 'DeepSkyBlue', 'DimGray', 'DodgerBlue', 'FireBrick', 'FloralWhite');
				foreach ($colour as $k) {
					 $colourOptions[] = array('value' => $k, 'name' => $k,	'class' => $k);
				}

				echo $this->Form->input('color', array(
		      		'options' => $colourOptions,
		      		'empty' => '(choisissez)',
		      		'label' => 'Couleur'
		 		 ));

				echo $this->Form->input('capacity', array('label' => 'Capacité'));
				// echo $this->Form->input('month_from');
				// echo $this->Form->input('month_to');
				echo $this->Form->input('parent_id', array (
					'options' => $parent
					));
				echo $this->Form->end(__('Envoyer'));
				?>
			</div>
		</div>
	</div>
</div>