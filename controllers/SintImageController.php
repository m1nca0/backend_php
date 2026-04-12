<?php

require_once "SintController.php";

class SintImageController extends SintController
{
  public $template = "object_image.twig";

  public function getContext(): array
  {
    $context = parent::getContext();
    $context['is_image'] = true;
    $context['image_url'] = '/images/serum.jpg';

    return $context;
  }
}
