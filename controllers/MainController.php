<?php
require_once "BaseSintTwigController.php";

class MainController extends BaseSintTwigController
{
  public $template = "main.twig";
  public $title = "Главная";
  public function getContext(): array
  {
    $context = parent::getContext();
    if(isset($_GET['type'])){
      $query = $this->pdo->prepare("SELECT synthesizers.* FROM synthesizers JOIN types ON synthesizers.type_id = types.id WHERE types.type = :type");
      $query->bindValue("type", $_GET['type']);
      $query->execute();
    }
    else {
      $query = $this->pdo->query("SELECT * FROM synthesizers");
    }
    

    $context['synthesizers'] = $query->fetchAll();

    return $context;
  }
}
