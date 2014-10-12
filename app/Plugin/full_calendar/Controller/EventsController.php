<?php
/*
 * Controller/EventsController.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */

class EventsController extends FullCalendarAppController {

	// public $components = array('RequestHandler');


	public $helpers = array('Js');
	var $name = 'Events';

    var $paginate = array(
        'limit' => 150000
    );

    function index() {

		$this->Event->recursive = 1;
		$this->set('events', $this->paginate());
		$this->set('eventTypes', $this->Event->EventType->generateTreeList(null, null, null, '--'));
		$this->set('users', $this->Event->User->find('list'));
		$this->set('customers', $this->Event->Customer->find('list'));
	}

	function today($id=null) {

		$this->Event->recursive = 1;

		if (isset($id)&&($id == 7)) {
			$date = new DateTime(); $datef = (new DateTime())->modify('+7 day'); $date1 = new DateTime(); $datef1 = (new DateTime())->modify('+7 day'); $date2 = new DateTime(); $datef2 = (new DateTime())->modify('+7 day');
		} else {
			if (isset($id)&&($id == 1)) {
				$date = new DateTime('tomorrow'); $datef = new DateTime('tomorrow'); $date1 = new DateTime('tomorrow'); $datef1 = new DateTime('tomorrow'); $date2 = new DateTime('tomorrow'); $datef2 = new DateTime('tomorrow');
			} else {
				$date = new DateTime(); $datef = new DateTime(); $date1 = new DateTime(); $datef1 = new DateTime(); $date2 = new DateTime(); $datef2 = new DateTime();
			}
		}

		$dateB = Configure::read('__date');
		$dateBf = Configure::read('__datef');
		$dateB1 = Configure::read('__date1');
		$dateBf1 = Configure::read('__datef1');
		$dateB2 = Configure::read('__date2');
		$dateBf2 = Configure::read('__datef2');


		$date->setTime(substr($dateB, 0,2), substr($dateB, -2));
		$datef->setTime(substr($dateBf, 0,2), substr($dateBf, -2));
		$date1->setTime(substr($dateB1, 0,2), substr($dateB1, -2));
		$datef1->setTime(substr($dateBf1, 0,2), substr($dateBf1, -2));
		$date2->setTime(substr($dateB2, 0,2), substr($dateB2, -2));
		$datef2->setTime(substr($dateBf2, 0,2), substr($dateBf2, -2));
 // debug($datef2);die();

		// $this->Event->virtualFields = array('total_adu' => 'sum(size_adulte)', 'total_enf' => 'sum(size_enfant)', 'total_3ans' => 'sum(size_3ans)');
		$this->Event->virtualFields = array('timstart' => 'time(start)');
		$today = $this->Event->find('all', array(
				'conditions' => array(
					'start >=' => $date->format('Y-m-d H:i'),
					'start <=' => $datef->format('Y-m-d H:i'),
					'timstart >=' => $date->format('H:i'),
					'timstart <=' => $datef->format('H:i'),
					'all_day =' => 0
					),
				'order' => array('start' => 'asc')
			));
		$today1 = $this->Event->find('all', array(
				'conditions' => array(
					'start >=' => $date1->format('Y-m-d H:i'),
					'start <=' => $datef1->format('Y-m-d H:i'),
					'timstart >=' => $date1->format('H:i'),
					'timstart <=' => $datef1->format('H:i'),
					'all_day =' => 0
					),
				'order' => array('start' => 'asc')
			));

		$today2 = $this->Event->find('all', array(
				'conditions' => array(
					'start >=' => $date2->format('Y-m-d H:i'),
					'start <=' => $datef2->format('Y-m-d H:i'),
					'timstart >=' => $date2->format('H:i'),
					'timstart <=' => $datef2->format('H:i'),
					'all_day =' => 0
					),
				'order' => array('start' => 'asc')
			));
		$today3 = $this->Event->find('all', array(
				'conditions' => array(
					'start >=' => $date->format('Y-m-d H:i'),
					'end <=' => $datef2->format('Y-m-d H:i'),
					'all_day =' => 1
					),
				'order' => array('start' => 'asc')
			));

		$this->set('events', $today);
		$this->set('events1', $today1);
		$this->set('events2', $today2);
		$this->set('events3', $today3);
		$this->set('date', $date);
		$this->set('datef', $datef);
		$this->set('id', $id);

		$this->set('eventTypes', $this->Event->EventType->generateTreeList(null, null, null, '--'));
		$this->set('users', $this->Event->User->find('list'));
		$this->set('customers', $this->Event->Customer->find('list'));
	}

	function dashboard(){
		$this->Event->recursive = 1;

		for ($i=0; $i < 3; $i++) {
			switch ($i) {
				case '0':
				$date = new DateTime(); $datef = new DateTime(); $date1 = new DateTime(); $datef1 = new DateTime(); $date2 = new DateTime(); $datef2 = new DateTime();
				break;
				case '1':
				$date = new DateTime('tomorrow'); $datef = new DateTime('tomorrow'); $date1 = new DateTime('tomorrow'); $datef1 = new DateTime('tomorrow'); $date2 = new DateTime('tomorrow'); $datef2 = new DateTime('tomorrow');
				break;
				case '2':
				$date = new DateTime(); $datef = (new DateTime())->modify('+7 day'); $date1 = new DateTime(); $datef1 = (new DateTime())->modify('+7 day'); $date2 = new DateTime(); $datef2 = (new DateTime())->modify('+7 day');
				break;
			}

			$dateB = Configure::read('__date');
			$dateBf = Configure::read('__datef');
			$dateB1 = Configure::read('__date1');
			$dateBf1 = Configure::read('__datef1');
			$dateB2 = Configure::read('__date2');
			$dateBf2 = Configure::read('__datef2');


			$date->setTime(substr($dateB, 0,2), substr($dateB, -2));
			$datef->setTime(substr($dateBf, 0,2), substr($dateBf, -2));
			$date1->setTime(substr($dateB1, 0,2), substr($dateB1, -2));
			$datef1->setTime(substr($dateBf1, 0,2), substr($dateBf1, -2));
			$date2->setTime(substr($dateB2, 0,2), substr($dateB2, -2));
			$datef2->setTime(substr($dateBf2, 0,2), substr($dateBf2, -2));

			$this->Event->virtualFields = array('timstart' => 'time(start)', 'datestart' => 'date(start)');
			${'todayDej'.$i} = $this->Event->find('all', array(
					'conditions' => array(
						'start >=' => $date->format('Y-m-d H:i'),
						'start <=' => $datef->format('Y-m-d H:i'),
						'timstart >=' => $date->format('H:i'),
						'timstart <=' => $datef->format('H:i'),
						'all_day =' => 0
						),
					'order' => array('start' => 'asc')
				));
			${'todayDin'.$i} = $this->Event->find('all', array(
					'conditions' => array(
						'start >=' => $date1->format('Y-m-d H:i'),
						'start <=' => $datef1->format('Y-m-d H:i'),
						'timstart >=' => $date1->format('H:i'),
						'timstart <=' => $datef1->format('H:i'),
						'all_day =' => 0
						),
					'order' => array('start' => 'asc')
				));

			${'todaySou'.$i} = $this->Event->find('all', array(
					'conditions' => array(
						'start >=' => $date2->format('Y-m-d H:i'),
						'start <=' => $datef2->format('Y-m-d H:i'),
						'timstart >=' => $date2->format('H:i'),
						'timstart <=' => $datef2->format('H:i'),
						'all_day =' => 0
						),
					'order' => array('start' => 'asc')
				));
			${'todayJou'.$i} = $this->Event->find('all', array(
					'conditions' => array(
						'datestart >=' => $date->format('Y-m-d'),
						'end <=' => $datef2->format('Y-m-d H:i'),
						'all_day =' => 1
						),
					'order' => array('start' => 'asc')
				));
			$this->set('eventsDej'.$i, ${'todayDej'.$i});
			$this->set('eventsDin'.$i, ${'todayDin'.$i});
			$this->set('eventsSou'.$i, ${'todaySou'.$i});
			$this->set('eventsJou'.$i, ${'todayJou'.$i});
		}


		$this->set('date', $date);
		$this->set('datef', $datef);

		// $this->set('eventTypes', $this->Event->EventType->generateTreeList(null, null, null, '--'));
		// $this->set('users', $this->Event->User->find('list'));

		//permet d'avoir lastname et firstname dans le select
        $customers = $this->Event->Customer->find('all',array('fields' => array('Customer.firstName','Customer.lastName','Customer.id')));
		$customer_list = Hash::combine( $customers,
			'{n}.Customer.id',
			array ('%s %s', '{n}.Customer.lastName', '{n}.Customer.firstName' )
			);

		$this->set('customers', array('choix') + $customer_list);
		// $this->set('customers', array('choix') + $this->Event->Customer->find('list'));


		$this->set('nbrClientBase', $this->Event->Customer->find('count'));
		$this->set('nbrSalles', $this->Event->EventType->find('count'));



		//-*-*-* Charts -*-*-*

		$date = new DateTime();

		// Mois actuel
		$nbJourMois = (mktime( 0, 0, 0, $date->format('m'), 1, $date->format('Y') ));
		$nbJourMois = date("t",$nbJourMois);

		$numMoisNow = $date->format('m') + 1;
		$numYearNow = $date->format('Y') - 1;
		$tab = array();

		$numMoisNow = $numMoisNow + 0 ; //pour avoir un entier

		for ($i=0; $i < 12; $i++) {
			if ($numMoisNow == 13) {$numMoisNow = 1; $numYearNow++;}

			$debMois = $date->format($numYearNow.'-'.$numMoisNow.'-01 00:00:00');
			$finMois = $date->format($numYearNow.'-'.$numMoisNow.'-'.$nbJourMois.' 23:59:59');

			$mois = $this->Event->find('all', array(
						'conditions' => array(
							'start >=' => $debMois,
							'start <=' => $finMois,
							)
					));

			${'nbrClient'.$i} = 0;
			foreach ($mois as $event):
					$nb =  $event['Event']['size_adulte'] + $event['Event']['size_enfant'] + $event['Event']['size_3ans'];
					${'nbrClient'.$i} = ${'nbrClient'.$i} + $nb;
			endforeach;

			$dateSt = new DateTime($debMois);
			$numMoisSt = $dateSt->getTimestamp()*1000;
			// debug( $numMoisSt);

			// switch ($numMoisNow) {
			// 	case '1': $numMoisSt = 'Jan'; break; case '2': $numMoisSt = 'Fév'; break; case '3': $numMoisSt = 'Mar'; break; case '4': $numMoisSt = 'Avr'; break; case '5': $numMoisSt = 'Mai'; break; case '6': $numMoisSt = 'Juin'; break; case '7': $numMoisSt = 'Juil'; break; case '8': $numMoisSt = 'Août'; break; case '9': $numMoisSt = 'Sep'; break; case '10': $numMoisSt = 'Oct'; break; case '11': $numMoisSt = 'Nov'; break; case '12': $numMoisSt = 'Déc'; break;
			// }

			${'tabMm'.$i} = array($numMoisSt, ${'nbrClient'.$i});

			$tab = array_merge($tab , array(${'tabMm'.$i}));

			$numMoisNow = $numMoisNow + 1;
		}



		$tab = json_encode($tab);
		$this->set('tab', $tab);
		// debug($tab);


	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('event', $this->Event->read(null, $id));
	}


	public function viewover($id = null) {
		$this->layout = 'ajax';
		// debug($this->request);
		$this->set('event', $this->Event->read(null, $id));
		// if ($this->request->is('post')) {
		// 	if (!empty($this->request->data)) {
		// 		$this->Customer->create();

		// 		if ($this->Customer->save($this->request->data)) {
		// 			 $id = $this->Customer->find('first', array('order' => array('Customer.id' => 'desc')));
		// 			 $id = $id['Customer']['id'];

		// 			$this->Session->setFlash(__('Le client est enregistré.'), 'success');
		// 			return $this->redirect(
		// 	            array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'add/'.$id)
		// 	        );
		// 		} else {
		// 			$this->Session->setFlash(__('Le client n\'a pas pu être sauvegardé.'), 'error');
		// 			return $this->redirect(
		// 	            array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'add')
		// 	        );
		// 		}
		// 	}
		// }
	}

	function add($id = null) {
		if (!empty($this->data)) {
			if ($this->Event->save($this->data)) {
				$this->Session->setFlash(__('La réservation est enregistrée', true), 'success');

				$this->redirect(array('controller' => 'full_calendar', 'action' => 'index'));
			} else {
				$salleChoice = $this->data['Event']['event_type_id'];
				$block_resto = $this->data['Event']['block_resto'];
				//Vérif le choix de la salle ici car select est construit en ajax et ne passe pas dans la vérification du model
				if (($salleChoice == 0) && ($block_resto == 0) ){
					$this->Session->setFlash(__('Veuillez choisir une salle.', true), 'error');
					} else {
						if (($salleChoice == 0) && ($block_resto == 1) ){
							$this->Session->setFlash(__('Même si vous souhaitez bloquer le restaurant merci de choisir une salle tout de même.', true), 'error');
						} else {
						$this->Session->setFlash(__('La réservation n\'a pas pu être enregistrée, veuillez recommencer.'), 'error');
					}
				}
			}
		}

		if ((empty($this->data)) && (isset($id)) ) {
			$this->data = $this->Event->read(null, $id);
		}

		// $this->set('eventType', $salle);
		$this->set('users', $this->Event->User->find('list'));

		//permet d'avoir lastname et firstname dans le select
        $customers = $this->Event->Customer->find('all',array('fields' => array('Customer.firstName','Customer.lastName','Customer.id')));
		$customer_list = Hash::combine( $customers,
			'{n}.Customer.id',
			array ('%s %s', '{n}.Customer.lastName', '{n}.Customer.firstName' )
			);

		$this->set('customers', $customer_list);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Event->save($this->data)) {
				$this->Session->setFlash(__('La réservation est enregistrée', true), 'success');
				$this->redirect(array('controller' => 'full_calendar', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('La réservation n\'a pas pu être enregistrée, veuillez recommencer.', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Event->read(null, $id);
		}
		$this->set('eventTypes', $this->Event->EventType->find('list'));
		$this->set('users', $this->Event->User->find('list'));
		$this->set('customers', $this->Event->Customer->find('list'));

	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for event', true), 'error');
			$this->redirect(array('controller' => 'full_calendar', 'action' => 'index'));
		}
		if ($this->Event->delete($id)) {
			$this->Session->setFlash(__('Réservation supprimée', true), 'success');
			$this->redirect(array('controller' => 'full_calendar', 'action' => 'index'));
		}
		$this->Session->setFlash(__('La réservation n\'a pas pu être supprimée', true), 'error');
		$this->redirect(array('controller' => 'full_calendar', 'action' => 'index'));
	}





    // The feed action is called from "webroot/js/ready.js" to get the list of events (JSON)
	function feed($id=null) {
		$this->layout = "ajax";
		$vars = $this->params['url'];
		$conditions = array(
			'conditions' => array(
				'UNIX_TIMESTAMP(start) >=' => $vars['start'],
				'UNIX_TIMESTAMP(start) <=' => $vars['end']
			),
			'order' => array(
				'start ASC'),
		);
		$events = $this->Event->find('all', $conditions);
		foreach($events as $event) {
		// debug($event);
			if($event['Event']['all_day'] == 1) {
				$allday = true;
				$end = $event['Event']['start'];
			} else {
				$allday = false;
				$end = $event['Event']['end'];
			}
			$nbr = $event['Event']['size_adulte'] + $event['Event']['size_enfant'] + $event['Event']['size_3ans'];
			$data[] = array(
					'id' => $event['Event']['id'],
					'title'=>$event['Customer']['lastName']." ".$event['Customer']['firstName'],
					'start'=>$event['Event']['start'],
					'end' => $end,
					'allDay' => $allday,
					'url' => Router::url('/') . 'full_calendar/events/add/'.$event['Event']['id'],
					'details' => $event['Event']['special_clause']." ".$event['EventType']['name']." ".$nbr,
					'className' => $event['EventType']['color']
			);
		}
		$this->set("json", json_encode($data));
	}






	// The update action is called from "webroot/js/ready.js" to update date/time when an event is dragged or resized
	function update() {
		// $this->autoRender = false;
		// $this->layout = "ajax";
		$vars = $this->params['url'];
		$this->Event->id = $vars['id'];
		isset($vars['allday'])? $allday = $vars['allday'] : $allday = 0;

		//cherche nbr de client pour cette reservation
		$nbrClient = $this->Event->find('all', array(
				'conditions' => array(
					'Event.id' => $vars['id']
					)
			));
		$nbrClients = $nbrClient['0']['Event']['size_adulte'] + $nbrClient['0']['Event']['size_enfant'] + $nbrClient['0']['Event']['size_3ans'];

		$start = $vars['start'];
		$this->Session->write('startCalend', $vars['start']);
		$this->Session->write('endCalend', $vars['end']);
		$this->Session->write('idCalend', $vars['id']);

		$_SESSION['idroom'] = $nbrClient['0']['Event']['event_type_id'];
		// $_SESSION['nbrClients'] = $nbrClients;

		echo $this->requestAction('/full_calendar/EventTypes/calcPlaceFree/');


		$this->data = array(
					'id' => $vars['id'],
					'start' => $vars['start'],
					'end'=>  $vars['end'],
					'all_day' => $allday,
					'size_adulte' => $nbrClient['0']['Event']['size_adulte'],
					'size_enfant' => $nbrClient['0']['Event']['size_enfant'],
					'size_3ans' => $nbrClient['0']['Event']['size_3ans'],
					'event_type_id' => $nbrClient['0']['Event']['event_type_id'],
					'block_room' => $nbrClient['0']['Event']['block_room'],
					'block_resto' => $nbrClient['0']['Event']['block_resto']
					);
		// $this->Event->save($this->data);
		// debug($this->data);

		if (!empty($this->data)) {
			if ($this->Event->save($this->data)) {
				// $this->roomChoice();
				// $this->Session->setFlash(__('The event has been saved'));
				$this->layout = "ajax";
				$this->set('mess', 'Événement modifié.');
				$this->set('sansa', 1);
				// debug($this->layout);
				// $this->redirect(array('controller' => 'full_calendar', 'action' => 'index'));

			} else {
				$this->layout = "ajax";
				$this->set('mess', 'Impossible de placer cet événement.');
				$this->set('sansa', 0);
				// $this->Session->setFlash(__('The event could not be saved. Please, try again.', true));
				// $this->autoRender = false;
				// $this->redirect(array('controller' => 'full_calendar', 'action' => 'index'));
			}
		}
	}


	// Change le status confirmé / prévu en cliquant dessus
	function changeStatus($id){
		$this->autoRender = false;
		// $this->Event->recursive = -1;
		$winter = $this->Event->find('first', array(
					'conditions' => array(
						'Event.id =' => $id
						),
				));
		// debug($this->data);
		if ($winter['Event']['status'] == 'Prévu' ) {
			$this->Event->updateAll(
				array ('Event.status' => "'Confirmé'"),
				array ('Event.id =' => $winter['Event']['id'])
			);
		} else {
			$this->Event->updateAll(
				array ('Event.status' => "'Prévu'"),
				array ('Event.id =' => $winter['Event']['id'])
			);
		}
		// $this->layout = 'ajax';
	}

}
?>
