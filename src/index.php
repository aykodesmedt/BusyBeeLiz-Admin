<?php
session_start();
ini_set('display_errors', true);
error_reporting(E_ALL);

$routes = array(
  'home' => array(
    'controller' => 'Artikels',
    'action' => 'index'
  ),
  'contact' => array(
    'controller' => 'Artikels',
    'action' => 'contact'
  ),
  'producten' => array(
    'controller' => 'Artikels',
    'action' => 'producten'
  ),
  'dames' => array(
    'controller' => 'Artikels',
    'action' => 'dames'
  ),
  'heren' => array(
    'controller' => 'Artikels',
    'action' => 'heren'
  ),
  'kinderen' => array(
    'controller' => 'Artikels',
    'action' => 'kinderen'
  ),
  'cadeaus' => array(
    'controller' => 'Artikels',
    'action' => 'cadeaus'
  ),
  'detail' => array(
    'controller' => 'Artikels',
    'action' => 'detail'
  ),
  'stoffen' => array(
    'controller' => 'Stoffen',
    'action' => 'stoffen'
  ),
  'editStof' => array(
    'controller' => 'Stoffen',
    'action' => 'editStof'
  ),
  'patronen' => array(
    'controller' => 'Patronen',
    'action' => 'patronen'
  ),
  'editPatroon' => array(
    'controller' => 'Patronen',
    'action' => 'editPatroon'
  ),
  'fournituren' => array(
    'controller' => 'Fournituren',
    'action' => 'fournituren'
  ),
  'editFournituur' => array(
    'controller' => 'Fournituren',
    'action' => 'editFournituur'
  )

);

if(empty($_GET['page'])) {
  $_GET['page'] = 'home';
}
if(empty($routes[$_GET['page']])) {
  header('Location: index.php');
  exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once __DIR__ . '/controller/' . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();
