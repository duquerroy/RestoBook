<?php
App::uses('AppModel', 'Model');
/**
 * EventType Model
 *
 * @property Event $Event
 */
class EventType extends AppModel {


public $actsAs = array ( 'Tree' );

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'Ce nom a déjà été choisi.'
			),
		),
		'color' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'capacity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'month_from' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'month_to' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'parent_id' => array(
			'rule'    => 'checkParadox',
			'on'      => 'update',
			'message' => "Une catégorie ne peut pas devenir sa propre fille !"
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'event_type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	/**
	 * Retourne faux si l'id est égal au nouvel id parent
	 *
	 * @param array $data Données à valider, en provenance du formulaire.
	 * @return boolean Faux si id == parent_id, vrai sinon.
	 */
	function checkParadox($data)
	{
		if (isset($this->data[$this->alias]['id']))
		{
			return $data['parent_id'] != $this->data[$this->alias]['id'];
		}
		return true;
	}

	



}
