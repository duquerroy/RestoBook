<?php
/**
 * SettingFixture
 *
 */
class SettingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'key' => 'primary'),
		'display_reserv_format' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'prix_adulte' => array('type' => 'float', 'null' => false, 'default' => null),
		'prix_enfant' => array('type' => 'float', 'null' => false, 'default' => null),
		'tps' => array('type' => 'float', 'null' => false, 'default' => null),
		'tvq' => array('type' => 'float', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'display_reserv_format' => 1,
			'prix_adulte' => 1,
			'prix_enfant' => 1,
			'tps' => 1,
			'tvq' => 1
		),
	);

}
