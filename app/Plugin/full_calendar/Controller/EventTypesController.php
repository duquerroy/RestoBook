<?php
/*
 * Controllers/EventTypesController.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */

class EventTypesController extends FullCalendarAppController {

	public $helpers = array('Js');
	var $name = 'EventTypes';

        var $paginate = array(
            'limit' => 15,
            'order' => array ('lft'=>'asc')
        );

	function index() {
		$this->EventType->recursive = 0;
		$tout = $this->paginate();

		// Appel fonction dans bootstrap.php
		$totArray = CapaSalles($tout);


		$this->set('eventTypes', $this->paginate());
		$this->set('parent', $this->EventType->find('list'));
		$this->set('eventTypesTree', $this->EventType->generateTreeList(null, null, null, '--'));
 		$this->set('totArray', $totArray);


	}

	function view($id = null) {
		$this->EventType->recursive = 2;
		if(!$id) {
			$this->Session->setFlash(__('Invalid event type', true));
			$this->redirect(array('action' => 'index'));
		}
		$parent = $this->EventType->getParentNode($id);
		($parent == array() )? $papa = '' : $papa = $parent['EventType']['name'];
		$this->set('nameparent', $papa);

		$date = new DateTime();
		$this->set('date', $date);

		$this->set('eventType', $this->EventType->findById($id));

		$modele = ClassRegistry::init('Customer');
		$this->set('customers', $modele->find('list'));
		$this->set('eventTypes', $this->EventType->generateTreeList(null, null, null, '--'));


	}

	function add() {
		if (!empty($this->data)) {
			$this->EventType->create();
			if ($this->EventType->save($this->data)) {
				$this->Session->setFlash(__('The event type has been saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event type could not be saved. Please, try again.', true), 'error');
			}
		}
	$this->set('parent', array('Choisissez') + $this->EventType->generateTreeList(array(
		'parent_id' => 0
		), null, null, '--',1));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid event type', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {

			if ($this->EventType->save($this->data)) {
				$this->Session->setFlash(__('The event type has been saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event type could not be saved. Please, try again.', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EventType->read(null, $id);
		}
	$this->set('parent',  array('Choisissez') + $this->EventType->generateTreeList(array(
		'parent_id' => 0
		), null, null, '--',1));

	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for event type', true), 'error');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EventType->delete($id)) {
			$this->Session->setFlash(__('Event type deleted', true), 'success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Event type was not deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}





	// public function getByCategory() {

	// 	$tout = $this->paginate();

	// 	foreach ($tout as $key => $value) {
	// 		// Prends l'id et la capacité de la salle en cours
	// 		$idEvent = $value['EventType']['id'];
	// 		$idCapa = $value['EventType']['capacity'];
	// 		// Cherche les enfants de la salle en cours
	// 		$childs = $this->EventType->children($idEvent);

	// 		$totCapa = 0;
	// 		foreach ($childs as $child => $childValue) {
	// 			// Fait le total de capacité des salles enfants
	// 			$totCapa = $totCapa + $childValue['EventType']['capacity'];
	// 		}
	// 		// Ajoute la capacité de la salle en cours au total de capacité
	// 		$totCapa = $totCapa + $idCapa;
	// 		//crée un jolie tableau [id][capacité]
	// 		$totArray[$idEvent] = $totCapa;
	// 	}
	// 	$eventypeid = $this->request->data['Event']['event_type_id'];
	// 	$this->set('totArray',$totArray[$eventypeid]);
	// 	$this->layout = 'ajax';
	// }




	/**
	* $id -> id de la réservation en cours si on est en édition de réservation
	* Affiche les salles avec capacités dans le select EventEventTypeId dans /events/add
	*/
	public function calcPlaceFree() {
		$nbrClients = array();

		// id de la salle en cours
		if (isset($_SESSION['idroom']) ) {
			$idroom= $_SESSION['idroom'];
			$_SESSION['idroom'] = '';
			// debug($idroom);
		}

		if (isset($_SESSION['startCalend']) ) {
			// récupère les dates envoyées par le calendar pour les drag&drop
			$start = $this->Session->read('startCalend');
			$end = $this->Session->read('endCalend');
			$id = $this->Session->read('idCalend');
			// debug($id);
			//$this->Session->delete('startCalend');
			$this->Session->delete('endCalend');
			$this->Session->delete('idCalend');
		}else{

			//recupere l'heure et la date envoyé par le select start
			$start = $this->request->data['Event']['start'];
			$end = $this->request->data['Event']['end'];
			// $room = $this->request->data['Event']['event_type_id'];
			isset($this->request->data['Event']['id'])? $id = $this->request->data['Event']['id'] : $id = null;
		}
		// debug($start);
		// debug($this->request->data['Event']['id']);

		// Si id existe, on désactive le block_room et le block_resto dans la base
		if (isset($this->request->data['Event']['id'])){
			$this->EventType->Event->updateAll(
					array ('Event.block_resto' => 0),
					array ('Event.id =' => $this->request->data['Event']['id'])
				);
			$this->EventType->Event->updateAll(
					array ('Event.block_room' => 0),
					array ('Event.id =' => $this->request->data['Event']['id'])
				);
		}

		//récupère les réservations qui correspondent à l'heure choisie
		$events = $this->EventType->Event->find('all', array(
			'conditions' => array(
				'start <=' => $end,
				'end >' => $start,
				// 'start <' => $end,
				'Event.id !=' => $id
				)
			));
		// debug($events);
		// debug($start);
		// debug($end);
		//salles qui correspondent array ex. ((int) 0 => '16')
		$salles = Hash::extract($events, '{n}.Event.event_type_id');
		// debug($salles);

		//cherche nbre de clients par salle
		foreach ($salles as $key => $value) {

			$eventssalles = $this->EventType->Event->find('all', array(
			'conditions' => array(
				'start <=' => $end,
				'end >' => $start,
				'event_type_id' => $value
				)
			// 'group' => array('Event.event_type_id')
			));
		// debug($eventssalles);
			//Nbre de client par salle
			//array ex. ((int) 16 => (int) 3)
			$nbrClients[$value] = Hash::apply($eventssalles, '{n}.Event.size_adulte', 'array_sum') + Hash::apply($eventssalles, '{n}.Event.size_enfant', 'array_sum') + Hash::apply($eventssalles, '{n}.Event.size_3ans', 'array_sum');
		}
		// debug($nbrClients);

		//calcul places totales salles
		$this->EventType->recursive = 0;
		$tout = $this->paginate();
		// debug($tout);
		// Appel fonction dans bootstrap.php
		$retour = CapaSallesLive($nbrClients, $tout);
		$totArray = $retour['totArray'];

		//met $totArray  et $salleParent en session
		$this->Session->write('totArray', $retour['totArray']);
		$this->Session->write('salleParent', $retour['salleParent']);
		// debug($totArray);die();

		//combine nom des salles et capacité et capacité cumulé pour affichage dans le select
		$salles =  $this->EventType->generateTreeList(null, null, null, '--');
		// debug($salles);
		$compteur = 0;
		foreach ($totArray as $key => $value) {
			// Appel fonction blockRestoFind dans bootstrap pour checker si le resto est bloqué
			// et disabled les options dans le select
			// N'appelle pas si block_resto = 1, ça veut dire qu'on est en train de modifier une fiche
			// qui bloc le resto, donc on donne la possibilité de débloquer et de choisir une salle

			$name = $salles[$key].' '.$tout[$compteur]['EventType']['capacity'].' => '.$value;


			// Appel fonction blockRoomFind dans bootstrap pour checker les salles bloquées
			// et disabled les options dans le select
			$bloc= blockRoomFind($start, $end, $key);
			if ($bloc) {

				if ((isset($idroom)) && ($key == $idroom)) {
				$salles[$key] = array(
					'value' => $key,
					'name' => $name,
					'selected' => 'selected'
					);
				} else {
				$salles[$key] = array(
					'value' => $key,
					'name' => $name
					);
				}
			} else {
				// sinon on disabled les salles bloquées sauf si on est en édition d'une réservation avec salle bloquée
				if ( (isset($this->request->data['Event']['id']) ) && ( $key == $idroom ) && ( $this->request->data['Event']['block_room'] == 1) ) {

				} else {
					$salles[$key] = array(
						'value' => $key,
						'name' => $name,
						'disabled' => 'disabled'
						);
				}

			}

		$compteur++;
		}



		//si l'appel vient de Events/update, pour les drag & drop du calendar
		if (isset($_SESSION['startCalend']) ) {
			$this->autoRender = false;
			$this->Session->write('salles', $salles);
			$this->Session->delete('startCalend');

		} else {
			// debug($salles);
			$this->set('eventType',array('choix') + $salles);
			$this->Session->write('salles', $salles);
			$this->layout = 'ajax';

		}

		// AffichRoom($salles);
	}


	/**
	 * Affiche  les salles avec capacité dans le div 'placeHaut' dans events/add
	 */
	public function AffichRoom() {
		$salles = $_SESSION['salles'];
		$start = $this->request->data['Event']['start'];
		$end = $this->request->data['Event']['end'];
		$this->set('eventType',$salles);
		$this->set('end',$end);
		$this->set('start',$start);
		$this->layout = 'ajax';
	}

	//modal quand on selectionne une salle
	public function roomChoice() {

		$this->autoRender = false;
		// $this->layout = 'ajax';

		// Salle choisie
		$id = $this->request->data['Event']['event_type_id'];

		// debug($this->EventType->childCount($id));
		// si pas d'enfant... pas de problème, on fait la réservation sinon appel ajax vue room_choice.ctp
		// ($this->EventType->childCount($id) == 0)? $this->autoRender = false : $this->layout = 'ajax';



	}


}
?>
