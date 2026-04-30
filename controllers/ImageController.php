<?php

class ImageController extends TwigBaseController
{
  public $template = "image.twig";

  public function getContext(): array
  {
    $context = parent::getContext();
    $query = $this->pdo->prepare("SELECT description, id, title, image FROM synthesizers WHERE id= :my_id");
  
    $query->bindValue("my_id", $this->params['id']);
    $query->execute();

  
    $data = $query->fetch();
    $context['image'] = $data['image'];
    $context['title'] = $data['title'];
    $context['description'] = $data['description'];
    $context['id'] = $data['id'];

    return $context;
  }
}
