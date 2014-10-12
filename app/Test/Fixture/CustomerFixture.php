<?php
/**
 * CustomerFixture
 *
 */
class CustomerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'Id_Customer' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'LastName' => array('type' => 'string', 'null' => false, 'length' => 60, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'FirstName' => array('type' => 'string', 'null' => false, 'length' => 60, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'GroupName' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'Phone' => array('type' => 'string', 'null' => false, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'Work' => array('type' => 'string', 'null' => false, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'Fax' => array('type' => 'string', 'null' => false, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'Email' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'Note' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id_Customer', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'Id_Customer' => 1,
			'LastName' => 'Lorem ipsum dolor sit amet',
			'FirstName' => 'Lorem ipsum dolor sit amet',
			'GroupName' => 'Lorem ipsum dolor sit amet',
			'Phone' => 'Lorem ipsum dolor sit a',
			'Work' => 'Lorem ipsum dolor sit a',
			'Fax' => 'Lorem ipsum dolor sit a',
			'Email' => 'Lorem ipsum dolor sit amet',
			'Note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
