<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array('DebugKit.Toolbar', 'Session', 'Auth');
	// public $components = array('DebugKit.Toolbar', 'Session', 'Auth', 'Security' => array ('csrfUseOnce' => false, 'csrfExpires' => '+30 minutes', 'blackHoleCallback' => 'blackhole'));

	function beforeFilter(){
	   $this->fetchSettings();
	   // met le nom du resto dans la variable title
	   $titleContent = Configure::read('__name_resto');
	   $this->set('title_for_layout', $titleContent);
	   $dateStartCalend = Configure::read('__date');
	   // prends l'heure d'ouverture du resto pour la passer au calendar
	   // $dateStartCalend = substr($dateStartCalend,1,1);
	   $this->set('dateStartCalend', $dateStartCalend);
	}

	/* Fonction qui permet de charger les settings
	pour retrouver un setting -> $var = Configure::read('__Courriel') */
	function fetchSettings(){
	   //Loading model on the fly
		$settings = ClassRegistry::init('Setting');
		// $this->loadModel('Setting');
		// $settings = new Setting();
		//Fetching All params
		$settings_array = $settings->find('all');
		foreach($settings_array as $key=>$value){
		  Configure::write("__".$value['Setting']['key'], $value['Setting']['value']);
		  // debug($val['Setting']['key']);die();
		}
	}





	// public $components = array(
 //        'Session',
 //        'Auth' => array(
 //            'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
 //            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
 //        )
 //    );

 //    public function beforeFilter() {
 //        $this->Auth->allow('index', 'view');
 //    }

	// public function blackhole($type){
	// 	return $this->redirect('/');
	// }

}
