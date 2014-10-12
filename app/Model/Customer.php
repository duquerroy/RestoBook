<?php
App::uses('AppModel', 'Model');
/**
 * Customer Model
 *
 */
class Customer extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'lastName';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lastName' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'required' => false,
				'allowEmpty' => false,
			),
		),
		'email' => array(
			'courriel' => array(
				'rule' => array('email'),
				'message' => 'Veuillez remplir un courriel valide',
				'required' => false,
				'allowEmpty' => true,
			),
		),
		'phone' => array(
			'phone' => array(
				'rule' => array('phone'),
				'message' => 'Veuillez remplir un numéro de téléphone valide (xxx xxx xxxx)',
				'required' => false,
				'allowEmpty' => true,
			),
		),
		'work' => array(
			'work' => array(
				'rule' => array('phone'),
				'message' => 'Veuillez remplir un numéro de téléphone valide (xxx xxx xxxx)',
				'required' => false,
				'allowEmpty' => true,
			),
		),
		'fax' => array(
			'fax' => array(
				'rule' => array('phone'),
				'message' => 'Veuillez remplir un numéro de fax valide (xxx xxx xxxx)',
				'required' => false,
				'allowEmpty' => true,
			),
		),
	);


	var $hasMany = array(
		'Event' => array(
			'className' => 'FullCalendar.Event',
			'foreignKey' => 'customer_id',
			'dependent' => false,
		)
	);

}
