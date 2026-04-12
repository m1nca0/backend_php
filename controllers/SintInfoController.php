<?php

require_once "SintController.php";

class SintInfoController extends SintController
{
  public $template = "sint_info.twig";

  public function getContext(): array
  {
    $context = parent::getContext();
    $context['is_info'] = true;

    return $context;
  }
}
