<?php

// echo $this->Form->radio('eventTypes.Id', 'eventTypes');
 echo $this->Form->input('Event.event_type_id', array(
 			'options' => $eventType,
			'label' => array(
				'text' => 'Salle :'
   	 			)));
// echo $this->Form->input('Event.event_type_id', array(
// 		'label' => false,
// 		'type' => 'radio',
// 		'inline' => false,
// 		'div' => false,
// 		'options' => $eventType,
// 		'separator'=>'<br>',
// 		'legend' => 'Salles'
// 		// 'default' => 1,
// 	));


// echo $this->Form->radio('Event.event_type_id', $eventType, array(
// 	'separator' => '<br>'
// 	));

?>