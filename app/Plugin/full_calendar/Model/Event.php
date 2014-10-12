<?php
/*
 * Model/Event.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */

class Event extends FullCalendarAppModel {
	var $name = 'Event';
	var $displayField = 'customer_id';

	/**
	 * beforeSave callback
	 *
	 * @param $options array
	 * @return boolean
	 */
		public function afterSave($created, $options = array()) {

			$nbrClients = $this->data['Event']['size_adulte'] +$this->data['Event']['size_enfant'] +$this->data['Event']['size_3ans'];
			$sanNbre = Configure::read('__nbre_client_mail');
			$courriel = Configure::read('__Courriel');
			// Envoie courriel si nombre client >= 15 (par defaut) à la création
			if ($created) {
				// debug($san['Setting']['setting']);die();

				// Nbre de clients
				if ($nbrClients >= $sanNbre) {
					App::uses('CakeEmail','Network/Email');
					$Email = new CakeEmail();
					$Email->config('test');
					$Email->from(array('gilles.duquerroy@alfazone.ca' => 'HotelRestoBooking.com'))
					    ->to($courriel)
					    ->subject('Réservation > '.$sanNbre)
					    ->send('Bonjour, vous avez une réservation supérieure à '.$sanNbre.' clients avec '.$nbrClients.' clients<br/>date :'.$this->data['Event']['start']);
					// debug($Email);die();
				}
			} else {
				// Envoie de courriel à la modification de réservation si 'oui' dans les settings
				$send_mail = Configure::read('__send_mail');
				if ($send_mail == 'oui') {
					if ($nbrClients >= $sanNbre) {
						App::uses('CakeEmail','Network/Email');
						$Email = new CakeEmail();
						$Email->config('test');
						$Email->from(array('gilles.duquerroy@alfazone.ca' => 'HotelRestoBooking.com'))
						    ->to($courriel)
						    ->subject('Réservation > '.$sanNbre)
						    ->send('Bonjour, vous avez une réservation supérieure à '.$sanNbre.' clients avec '.$nbrClients.' clients<br/>date :'.$this->data['Event']['start']);
						// debug($Email);die();
					}
				}


			}
		}

		public function beforeSave($options = array() ) {
			//ajoute une heure si heure end = heure start
			$deb = new DateTime($this->data['Event']['start']);
			$fin = new DateTime($this->data['Event']['end']);
			// debug($this->data);die();

			$diff=$fin->diff($deb);
			// debug($diff);
			if ((($diff->i ==0) && ($diff->h ==0)) || ($diff->invert == 0)) {

				$date = new DateTime($this->data['Event']['start']);
				$date->modify("+ 1 hours");

				$this->data['Event']['end'] = $date->format('Y-m-d H:i');
			}

			//si AllDay = 1 mettre heure start à 00:00 et end à 23:59
			if ($this->data['Event']['all_day'] == 1) {
				$deb->setTime(00, 00);
				$fin->setTime(23, 59);

				$this->data['Event']['start'] = $deb->format('Y-m-d H:i');
				$this->data['Event']['end'] = $fin->format('Y-m-d H:i');
			}




			return true;
		}



	var $validate = array(
		'customer_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			)
		),
		'start' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'validate' => array(
				'rule'    => array('datetime', 'ymd'),
		        'message' => 'Merci de rentrer une date valide.'
		    )
		),
		'end' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'validate' => array(
				'rule'    => array('datetime', 'ymd'),
		        'message' => 'Merci de rentrer une date valide.'
		    )
		),
		'size_adulte' => array(
			'notempty' => array(
				'rule' => array('notempty')
				),
			'supzero' => array(
				'rule' => array ('comparison', '>', 0),
				'message' => 'Le nombre de client ne peut être inferieur à 1.'
				),
			'salleFull' => array(
            	'rule'    => array('salleFull'),
            	'message' => 'Il ne reste plus assez de place dans la salle choisie.'
       			),
			'blockRoom' => array(
            	'rule'    => array('blockRoom'),
            	'message' => 'La salle est bloquée pour cette période.'
       			),
			'blockResto' => array(
            	'rule'    => array('blockResto'),
            	'message' => 'Le restaurant est bloqué pour cette période.'
       			)
		),
		'block_resto' => array(
			'selc' => array (
				'rule' => array('selcBlockResto'),
				'message' => 'Impossible de bloquer le restaurant, des réservations sont déjà en cours'
				)
		),
		'block_room' => array(
			'selc' => array (
				'rule' => array('selcBlockRoom'),
				'message' => 'Impossible de bloquer la salle, des réservations sont déjà en cours'
				)
		)
	);

	var $belongsTo = array(
		'EventType' => array(
			'className' => 'FullCalendar.EventType',
			'foreignKey' => 'event_type_id'
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id'

		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	Public function salleFull($check) {
        	///combien de clients ?
			$nbrClients = $this->data['Event']['size_adulte'] +$this->data['Event']['size_enfant'] +$this->data['Event']['size_3ans'];

			//si data['Event']['event_type_id'] est défini
			if ( (isset($this->data['Event']['event_type_id'])) && ($this->data['Event']['event_type_id'] !=0 ) ) {
				//quelle salle choisie ?
				$salleChoice = $this->data['Event']['event_type_id'];

				//nbre de places restantes dans la salle choisie
				$totArray = $_SESSION['totArray'];
				$salleParent = $_SESSION['salleParent'];

				$nbreReste = $salleParent[$salleChoice];

				// demande à bloquer une salle parent ?
				if ($this->data['Event']['block_room'] == 1) {
					if ($this->EventType->childCount($salleChoice) > 0) {

						$restant = $totArray[$salleChoice];
						$placeReste = $restant - $nbrClients ;
						if ($placeReste < 0) {
							return false;
						} else {
							return true;
						}
					}

				}

				//calcul place restante dans la salle
				$placeReste = $nbreReste - $nbrClients ;

				if ($placeReste < 0) {
					// check dans les salles enfants si pas de place dans salle choisie
					if ($this->EventType->childCount($salleChoice) > 0) {
						$enf = $this->EventType->children($salleChoice);
						// liste salles enfants
						foreach ($enf as $key => $value) {
							$idEnfant = $value['EventType']['id'];

							// Vérif si salle bloquée
							$start = $this->data['Event']['start'];
							$end = $this->data['Event']['end'];
							if (blockRoomFind($start, $end, $idEnfant)) {

								// Capacité restante de la salle
								$capaRest = $totArray[$idEnfant];
								if ($capaRest - $nbrClients >= 0) {
									$this->data['Event']['event_type_id']=$idEnfant;
									// debug($this->data);
									return true;
								}
							}
						}
					}
					return false;
				} else {
					return true;
				}
			} else {
			return false;
			}
    }

    Public function blockRoom($check) {
			//quelle salle choisie ?
			$salleChoice = $this->data['Event']['event_type_id'];
			//date start
			$start = $this->data['Event']['start'];
			$end = $this->data['Event']['end'];
			$id = $this->data['Event']['id'];

			// Appel fonction dans le bootstrap.php, vérifie si la salle est bloquée pour cette période
			return blockRoomFind($start, $end, $salleChoice, $id);

    }
	Public function blockResto($check) {
			//date start
			$start = $this->data['Event']['start'];
			$id = $this->data['Event']['id'];

			// Appel fonction dans le bootstrap.php, vérifie si la resto est bloquée pour cette période
			return blockRestoFind($start, $id);

    }

	Public function selcBlockResto($check) {
		// vérifie s'il existe déjà des réservations pour cette date
		if ($this->data['Event']['block_resto'] == 1) {
			//date start
			$start = $this->data['Event']['start'];
			$id = $this->data['Event']['id'];

			// Appel fonction dans le bootstrap.php, vérifie si des réservation existent déjà pour cette date
			return selcBlockRestoFind($start, $id);
		} else {
			return true;
		}
	}

	Public function selcBlockRoom($check) {
		// vérifie s'il existe déjà des réservations pour cette date
		if ($this->data['Event']['block_room'] == 1) {
			//date start
			$start = $this->data['Event']['start'];
			$end = $this->data['Event']['end'];
			$id = $this->data['Event']['id'];
			$event_type_id = $this->data['Event']['event_type_id'];

			// Appel fonction dans le bootstrap.php, vérifie si des réservation existent déjà pour cette date
			return selcBlockRoomFind($start, $end,  $id, $event_type_id);
		} else {
			return true;
		}
	}

}
?>
