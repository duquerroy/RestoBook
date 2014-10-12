<?php
/**
 * ReservationFixture
 *
 */
class ReservationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'resDate' => array('type' => 'date', 'null' => false, 'default' => null),
		'resTime' => array('type' => 'time', 'null' => false, 'default' => '00:00:00'),
		'notes' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'special_clause' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'size_adulte' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'size_enfant' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'size_3ans' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'hotel_room' => array('type' => 'string', 'null' => false, 'length' => 12, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'block_until' => array('type' => 'time', 'null' => true, 'default' => null),
		'nbTables' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 3),
		'id_customer' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'id_room' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'id_username' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_reservations_customers' => array('column' => 'id_customer', 'unique' => 0),
			'fk_reservations_rooms' => array('column' => 'id_room', 'unique' => 0),
			'fk_reservation_users' => array('column' => 'id_username', 'unique' => 0)
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
			'resDate' => '2014-04-10',
			'resTime' => '03:11:16',
			'notes' => 'Lorem ipsum dolor sit amet',
			'special_clause' => 'Lorem ipsum dolor sit amet',
			'size_adulte' => 1,
			'size_enfant' => 1,
			'size_3ans' => 1,
			'hotel_room' => 'Lorem ipsu',
			'block_until' => '03:11:16',
			'nbTables' => 1,
			'id_customer' => 1,
			'id_room' => 1,
			'id_username' => 1
		),
	);

}
