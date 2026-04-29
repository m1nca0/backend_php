<?php
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/PlugController.php";
require_once "../controllers/PlugImageController.php";
require_once "../controllers/PlugInfoController.php";
require_once "../controllers/SintController.php";
require_once "../controllers/SintImageController.php";
require_once "../controllers/SintInfoController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/ObjectController.php"; 
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

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/plug", PlugController::class);
$router->add("/synthesizers/(\d+)", ObjectController::class); 
$router->get_or_default(Controller404::class);
