<?php

require_once "PlugController.php";

class PlugInfoController extends PlugController{
  public $template = "plug_info.twig";

  public function getContext(): array
  {
    $context = parent::getContext();

    $context['is_info'] = true;

    return $context;
  }
}