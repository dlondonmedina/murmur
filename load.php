<?php
/**
* AutoLoader for Murmur Includes all required classes
*/

// get config file
require(dirname(__FILE__, 3) . '/murmur/config.php');

// Load classes
function model_autoloader($class_name) {
    require(WEB_ROOT . 'models/' . $class_name . '.class.php');
}
function controller_autoloader($class_name) {
    require(WEB_ROOT . 'controllers/' . $class_name . '.class.php');
}
function view_autoloader($class_name) {
  require(WEB_ROOT . 'views/' . $class_name . '.class.php');
}
spl_autoload_register("model_autoloader");
spl_autoload_register("controller_autoloader");
spl_autoload_register("view_autoloader");
