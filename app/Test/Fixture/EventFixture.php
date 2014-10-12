<?php
/**
 * EventFixture
 *
 */
class EventFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'active' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 1),
		'start' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'end' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'all_day' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1),
		'notes' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'special_clause' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'size_adulte' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'size_enfant' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'size_3ans' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'hotel_room' => array('type' => 'string', 'null' => false, 'length' => 12, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'block_until' => array('type' => 'time', 'null' => true, 'default' => null),
		'nb_tables' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 3),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'event_type_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'status' => array('type' => 'string', 'null' => false, 'default' => 'confirmé', 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'date', 'null' => true, 'default' => null),
		'modified' => array('type' => 'date', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'customers_id' => array('column' => 'customer_id', 'unique' => 0),
			'rooms_id' => array('column' => 'event_type_id', 'unique' => 0),
			'users_id' => array('column' => 'user_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'active' => 1,
			'start' => '2014-04-28 15:03:15',
			'end' => '2014-04-28 15:03:15',
			'all_day' => 1,
			'notes' => 'Lorem ipsum dolor sit amet',
			'special_clause' => 'Lorem ipsum dolor sit amet',
			'size_adulte' => 1,
			'size_enfant' => 1,
			'size_3ans' => 1,
			'hotel_room' => 'Lorem ipsu',
			'block_until' => '15:03:15',
			'nb_tables' => 1,
			'customer_id' => 1,
			'event_type_id' => 1,
			'user_id' => 1,
			'status' => 'Lorem ipsum dolor ',
			'created' => '2014-04-28',
			'modified' => '2014-04-28'
		),
	);

}
