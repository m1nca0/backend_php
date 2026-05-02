<?php 
require_once "BaseSintTwigController.php";

class SearchController extends BaseSintTwigController{
  public $template = "search.twig";

  public function getContext(): array
  {
    $context = parent::getContext();

    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $title = isset($_GET['title']) ? $_GET['title'] : '';
    $description = isset($_GET['des$description']) ? $_GET['des$description'] : '';

    $sql = <<<EOL
SELECT id, title, description
FROM synthesizers
WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
  AND (:type = '' OR type like CONCAT('%', :type, '%'))
  AND (:description = '' OR description like CONCAT('%', :description, '%'))
EOL;

    $query = $this->pdo->prepare($sql);
    $query->bindValue("title", $title);
    $query->bindValue("type", $type);
    $query->bindValue("description", $description);
    $query->execute();

    $context['objects'] = $query->fetchAll();
    return $context;
  }
}