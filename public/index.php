{# php -S localhost:3000 -t public #}
<?php
require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);
$url = $_SERVER["REQUEST_URI"];
$title = "";
$template = "";
$context = [];

if ($url == "/") {
  $title = "Главная";
  $template = "main.twig";
} elseif (preg_match("#^/sint#", $url)) {
  $title = "Синтезаторы";
  $template = "sint.twig";
} elseif (preg_match("#^/plug#", $url)) {
  $title = "Плагины";
  $template = "plug.twig";
}

echo $twig->render($template, [
    "title" => $title
]);