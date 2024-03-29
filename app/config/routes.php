<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */



/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	//Router::connect('/', array('controller' => 'pages', 'action' => 'top'));
	//Router::connect('/', array('controller' => 'children', 'action' => 'index'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */

    $agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    if (!empty($agent) && (preg_match("/Android/", $agent))) {
        Router::connect('/', array('controller' => 'pages', 'action' => 'display'));
    } else {
        Router::connect('/', array('controller' => 'articles', 'action' => 'top'));
    }

	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	//Router::connect('/ap/*/:id', array('controller' => 'contents', 'action' => '"index"' ));
	//Router::connect('/ap/:line/:id', array('controller' => 'contents', 'action' => 'view' ));
	//Router::connect('/ap/:line/:id/*', array('controller' => 'contents', 'action' => 'view' ));

?>
