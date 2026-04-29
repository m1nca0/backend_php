<?php

// require_once "TwigBaseController.php";

class SintController extends TwigBaseController
{
  public $title = "Синтезаторы";
  public $template = "object.twig";

  public function getContext(): array
  {
    $context = parent::getContext();
    $context['url_title'] = "sint";
    return $context;
  }
}
