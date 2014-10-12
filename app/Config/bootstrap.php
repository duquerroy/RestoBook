<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */

/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
CakePlugin::loadAll();
/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));


	// Calcul le nombre de place dans les salles sans prendre en compte les réservations
	// pour affichage de la listes des salles
	function CapaSalles($tout) {
		$modele = ClassRegistry::init('EventType');

		foreach ($tout as $key => $value) {
			// Prends l'id et la capacité de la salle en cours
			$idEvent = $value['EventType']['id'];
			$idCapa = $value['EventType']['capacity'];
			// Cherche les enfants de la salle en cours
			$childs = $modele->children($idEvent);

			$totCapa = 0;
			foreach ($childs as $child => $childValue) {
				// Fait le total de capacité des salles enfants
				$totCapa = $totCapa + $childValue['EventType']['capacity'];
			}
			// Ajoute la capacité de la salle en cours au total de capacité
			$totCapa = $totCapa + $idCapa;
			//crée un jolie tableau [id][capacité]
			$totArray[$idEvent] = $totCapa;

		}
		return $totArray;
	}



	//calcul places totales salles
	function CapaSallesLive($nbrClients, $tout) {
		$modele = ClassRegistry::init('EventType');

		foreach ($tout as $key => $value) {
			// Prends l'id et la capacité de la salle en cours
			$idEvent = $value['EventType']['id'];

			// soustrait places déjà prises si besoin
			if (isset($nbrClients[$idEvent])) {
				$idCapa = $value['EventType']['capacity']- $nbrClients[$idEvent];
			} else {
				$idCapa = $value['EventType']['capacity'];
			}
			//Tableau des capacités des salles parents sans les enfants
			$salleParent[$idEvent] = $idCapa;

			// Cherche les enfants de la salle en cours
			$childs = $modele->children($idEvent);

			$totCapa = 0;
			foreach ($childs as $child => $childValue) {
				// Fait le total de capacité des salles enfants
				$idChild = $childValue['EventType']['id'];
				// soustrait places déjà prises si besoin
				if (isset($nbrClients[$idChild])) {
					$totCapa += $childValue['EventType']['capacity'] - $nbrClients[$idChild];
				} else {
					$totCapa += $childValue['EventType']['capacity'];
				}

			}
			// Ajoute la capacité de la salle en cours au total de capacité
			$totCapa = $totCapa + $idCapa;
			//crée un jolie tableau [id][capacité]
			$totArray[$idEvent] = $totCapa;
		}
		// debug($totArray);
		// debug($salleParent);
		$retour['totArray']= $totArray;
		$retour['salleParent']= $salleParent;
		return $retour;
	}




	//verifie si une salle est bloquée pour une heure
	function blockRoomFind($start, $end, $salleChoice, $id=null) {

			$modele = ClassRegistry::init('Event');
			$eventssalles = $modele->find('all', array(
				'conditions' => array(
					'start <=' => $end,
					'end >' => $start,
					'block_room' => 1,
					'event_type_id' => $salleChoice,
					'Event.id !=' => $id
					)
			));



			//vérifie si la salle parente est bloquée, dans ce cas, on bloque aussi
			$modeleType = ClassRegistry::init('EventType');
			//est-ce qu'on a un parent ?
			$parent = $modeleType->getParentNode($salleChoice);
			// si oui
			if ( $parent != array() ) {
				//cherche si parent bloqué
				$eventssalles1 = $modele->find('all', array(
					'conditions' => array(
						'start <=' => $end,
						'end >' => $start,
						'block_room' => 1,
						'event_type_id' => $parent['EventType']['id'],
						'Event.id !=' => $id
						)
				));

			}

			if ( (!isset($eventssalles[0])) && (!isset($eventssalles1[0])) ) { return true; } else { return false; }

	}


	//verifie si resto bloqué pour une heure
	function blockRestoFind($start, $id=null) {

			$modele = ClassRegistry::init('Event');

			$eventssalles = $modele->find('all', array(
				'conditions' => array(
					'start <=' => $start,
					'end >' => $start,
					'block_resto' => 1,
					'Event.id !=' => $id
					)
			));
			if (!isset($eventssalles[0])) { return true; } else { return false; }
	}


	// vérifie s'il existe déjà des réservations pour cette date (bloc resto)
	function selcBlockRestoFind($start, $id=null){

			$modele = ClassRegistry::init('Event');
			$eventssalles = $modele->find('all', array(
						'conditions' => array(
							'start <=' => $start,
							'end >' => $start,
							'Event.id !=' => $id
							)
			));
			// debug($eventssalles); die();
			if (!isset($eventssalles[0])) { return true; } else { return false; }
	}


	// vérifie s'il existe déjà des réservations pour cette date (bloc room)
	function selcBlockRoomFind($start, $end, $id=null, $event_type_id){

			$modele = ClassRegistry::init('Event');
			$eventssalles = $modele->find('all', array(
						'conditions' => array(
							'start <=' => $end,
							'end >' => $start,
							'Event.id !=' => $id,
							'event_type_id' => $event_type_id
							)
			));
			// A vérifier pour les salles enfants aussi
			$modele1 = ClassRegistry::init('EventType');
			$childs = $modele1->children($event_type_id);
			foreach ($childs as $key => $value) {
				$id_room = $value['EventType']['id']; 

				$eventssalles1 = $modele->find('all', array(
							'conditions' => array(
								'start <=' => $end,
								'end >' => $start,
								'Event.id !=' => $id,
								'event_type_id' => $id_room
								)
				));
				// dès qu'on en trouve une, on sort
				if (isset($eventssalles1[0])) { return false; }

			}

			if (!isset($eventssalles[0])) { return true; } else { return false; }
	}

