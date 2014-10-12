<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 */
class CustomersController extends AppController {

	public $helpers = array('Js', 'Html');
/**
 * Components
 *
 * @var array
 */
	// public $components = array('Paginator');

	var $paginate = array(
        'limit' => 15000
    );

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Customer->recursive = 0;
		$this->set('customers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
		$this->set('customer', $this->Customer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		// $this->layout = 'ajax';
		 // debug($this->request);
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {
				$this->Customer->create();

				if ($this->Customer->save($this->request->data)) {
					 $id = $this->Customer->find('first', array('order' => array('Customer.id' => 'desc')));
					 $id = $id['Customer']['id'];

					 // Met l'id en session pour le retrouver dans events/add
					$this->Session->write('idCustomer', $id);

					$this->Session->setFlash(__('Le client est enregistré.'), 'success');
					return $this->redirect(
			            array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'add')
			        );
				} else {
					$this->Session->setFlash(__('Le client n\'a pas pu être sauvegardé.'), 'error');
					return $this->redirect(
			            array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'add')
			        );
				}
			}
		}
	}

	public function addover() {
		$this->layout = 'ajax';
		 // debug($this->request);
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {
				$this->Customer->create();

				if ($this->Customer->save($this->request->data)) {
					 $id = $this->Customer->find('first', array('order' => array('Customer.id' => 'desc')));
					 $id = $id['Customer']['id'];

					 // Met l'id en session pour le retrouver dans events/add
					 $this->Session->write('idCustomer', $id);

					$this->Session->setFlash(__('Le client est enregistré.'), 'success');
					return $this->redirect(
			            array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'add')
			        );
				} else {
					$this->Session->setFlash(__('Le client n\'a pas pu être sauvegardé.'), 'error');
					return $this->redirect(
			            array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'add')
			        );
				}
			}
		}
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Invalid customer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			// debug($this->request->data);die();
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('Le client a été modifié.'), 'success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Le client n\'a pas pu être sauvegardé.'), 'error');
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
			$this->request->data = $this->Customer->find('first', $options);
		}
	}

	// Édition des champs Customers en Ajax
	public function editAjax($id = null) {
		$this->layout = 'ajax';
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Invalid customer'));
		}
		if ($this->request->is(array('ajax'))) {
			// Mets en forme les valeurs dans l'array request->data
			$this->request->data['id'] = $id;
			$this->request->data += array( $this->request->data['name'] => $this->request->data['value'] );
			unset($this->request->data['pk']);
			unset($this->request->data['name']);
			unset($this->request->data['value']);
			$this->request->data = array( 'Customer' => $this->request->data);
			// debug($this->request->data);
			if ($this->Customer->save($this->request->data)) {
				$this->set('mess', 'Fiche client modifiée.');
				$this->set('sansa', true);
				// return $this->redirect(array('action' => 'index'));
			} else {
				$this->autoRender = false;
				//$this->set('Impossible de modifier la fiche, vérifier les informations.');
				//$this->set('sansa', false);
				$this->response->statusCode(500);
				// return $this->redirect(array('action' => 'index'));
			}
		} else {
			// $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
			// $this->request->data = $this->Customer->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Customer->delete()) {
			$this->Session->setFlash(__('Le client a été supprimé.'), 'success');
		} else {
			$this->Session->setFlash(__('Le client n\a pas pu être supprimer, veuillez re-essayer.'), 'error');
		}
		return $this->redirect(array('action' => 'index'));
	}



	public function getCustomers() {
		$id = $this->request->data['Event']['customer_id'];

		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
		$this->set('customer', $this->Customer->find('first', $options));

		$date = new DateTime();
		$optionsReserv = array('conditions' => array('customer_id' => $id, 'start >=' => $date->format('Y-m-d')));
		$this->set('reserv', $this->Customer->Event->find('all', $optionsReserv));



		$this->layout = 'ajax';
	}




}
