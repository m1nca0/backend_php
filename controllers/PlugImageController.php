<?php
require_once "PlugController.php";

class PlugImageController extends PlugController{
  public $template = "object_image.twig";

  public function getContext(): array
  {
    $context = parent::getContext();
    $context['image_url'] = '/images/reverb.jpg';
    $context['is_image'] = true;

    return $context;
  }
}