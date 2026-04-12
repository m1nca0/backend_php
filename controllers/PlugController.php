<?php

require_once "TwigBaseController.php";

class PlugController extends TwigBaseController
{
  public $title = "Плагины";
  public $template = "object.twig";

  public function getContext(): array
  {
    $context = parent::getContext();
    $context['url_title'] = "plug";
    return $context;
  }
}
