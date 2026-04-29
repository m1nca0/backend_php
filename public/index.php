<?php
require_once '../vendor/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/PlugController.php";
require_once "../controllers/PlugImageController.php";
require_once "../controllers/PlugInfoController.php";
require_once "../controllers/SintController.php";
require_once "../controllers/SintImageController.php";
require_once "../controllers/SintInfoController.php";
require_once "../controllers/Controller404.php";
$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader, [
    "debug" => true 
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());


$url = $_SERVER["REQUEST_URI"];
$title = "";
$template = "";
$context = [];

$controller = new Controller404($twig);

$pdo = new PDO("mysql:host=127.0.0.1;dbname=music_plugins;charset=utf8", "root", "root");

if ($url == "/") {
  $controller = new MainController($twig);
} elseif (preg_match("#^/plug/image#", $url)) {
  $controller = new PlugImageController($twig);
} elseif (preg_match("#^/plug/info#", $url)) {
  $controller = new PlugInfoController($twig);
} elseif (preg_match("#^/plug#", $url)) {
  $controller = new PlugController($twig);
} elseif (preg_match("#^/sint/image#", $url)) {
  $controller = new SintImageController($twig);
} elseif (preg_match("#^/sint/info#", $url)) {
  $controller = new SintInfoController($twig);
} elseif (preg_match("#^/sint#", $url)) {
  $controller = new SintController($twig);
}

if ($controller) {
  $controller->setPDO($pdo);
  $controller->get();
}
