<?php
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader);


$url = $_SERVER["REQUEST_URI"];
$title = "";
$template = "";
$context = [];
if ($url == "/") {
  $template = "main.twig";
  $title = "Главная";

  $context['menu_items'] = [
    [
      "title" => "Плагины",
      "url_title" => "plug"
    ],
    [
      "title" => "Синтезаторы",
      "url_title" => "sint"
    ]
  ];
} elseif (preg_match("#^/plug#", $url)) {
  $template = "object.twig";
  $title = "Плагины";
  $context['url_title'] = "plug";

  $is_image = $url == "/plug/image";
  $is_info = $url == "/plug/info";

  $context['is_info'] = $is_info;
  $context['is_image'] = $is_image;

  if($is_image){
    $template = "object_image.twig";
    $context['image_url'] = '/images/reverb.jpg';
  } elseif($is_info){
    $template = "plug_info.twig";
  }
} elseif (preg_match("#^/sint#", $url)) {
  $template = "object.twig";
  $title = "Синтезаторы";
  $context['url_title'] = "sint";

  $is_image = $url == "/sint/image";
  $is_info = $url == "/sint/info";

  $context['is_info'] = $is_info;
  $context['is_image'] = $is_image;


  if($is_image){
    $template = "object_image.twig";
    $context['image_url'] = '/images/serum.jpg';
  }
  elseif($is_info){
    $template = "sint_info.twig";
  }
}

$context['title'] = $title;

echo $twig->render($template, $context);
