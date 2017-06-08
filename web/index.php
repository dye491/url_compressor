<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 08.06.2017
 * Time: 9:57
 */

$query = ltrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app');

require_once ROOT . '/vendor/libs/functions.php';

spl_autoload_register(function ($class) {
    $file = ROOT . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

$controller = new app\controllers\MainController();
$action = $query ? 'view' : 'index';
$action = 'action' . ucfirst($action);

if (method_exists($controller, $action)) {
    session_start();
    $controller->$action();
}
