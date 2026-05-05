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
SELECT synthesizers.id, synthesizers.title, synthesizers.description
FROM synthesizers JOIN types on synthesizers.type_id = types.id
WHERE (:title = '' OR synthesizers.title like CONCAT('%', :title, '%'))
  AND (:type = '' OR types.type like CONCAT('%', :type, '%'))
  AND (:description = '' OR synthesizers.description like CONCAT('%', :description, '%'))
EOL;

    $query = $this->pdo->prepare($sql);
    $query->bindValue("title", $title);
    $query->bindValue("type", $type);
    $query->bindValue("description", $description);
    $query->execute();
    
    $query = $this->pdo->query("SELECT DISTINCT type FROM types order by 1");
    $types = $query->fetchAll();
    $context['types'] = $types;
    $context['objects'] = $query->fetchAll();
    return $context;
  }
}