<?php

use lithium\net\http\Router;
use lithium\core\Environment;

Router::connect('/pages/{:args}', 'Pages::view');

if (!Environment::is('production')) {
	Router::connect('/test/{:args}', array('controller' => 'lithium\test\Controller'));
	Router::connect('/test', array('controller' => 'lithium\test\Controller'));
}

/**
 * These are the same, one is shortcut:
 * 
 * Router::connect('/', 'Urls::index');
 * Router::connect('/', array('controller' => 'Urls', 'action' => 'index')));
 * 
 */
Router::connect('/', 'Urls::index');
Router::connect('/{:shortcode}', array('Urls::logs'));
Router::connect('/{:shortcode}/admin', array('Urls::admin'));
Router::connect('/{:shortcode}/edit', array('Urls::edit'));
Router::connect('/{:shortcode}/delete', array('Urls::delete'));

Router::connect('/new', 'Urls::add');

//Router::connect('/{:controller}/{:action}/{:id:\d+}.{:type}', array('id' => null));
//Router::connect('/{:controller}/{:action}/{:id:\d+}');
//Router::connect('/{:controller}/{:action}/{:args}');

?>
