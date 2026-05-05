<?php
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/SearchController.php";  
require_once "../controllers/SintObjectCreateController.php";
require_once "../controllers/SintTypeCreateController.php";  
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
$router->add("/synthesizers/(?P<id>\d+)?show=image", ObjectController::class); 
$router->add("/synthesizers/(?P<id>\d+)?show=info", ObjectController::class); 
$router->add("/synthesizers/(?P<id>\d+)", ObjectController::class); 
$router->add("/search", SearchController::class);
$router->add("/synthesizers/create", SintObjectCreateController::class);
$router->add("/synthesizers/createtype", SintTypeCreateController::class);
$router->get_or_default(Controller404::class);
