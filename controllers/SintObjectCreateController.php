<?php
require_once "BaseSintTwigController.php";

class SintObjectCreateController extends BaseSintTwigController
{
  public $template = "sint_create.twig";
  public function get(array $context)
  {
    echo $_SERVER['REQUEST_METHOD'];

    parent::get($context);
  }
  public function post(array $context)
  {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $type_id = $_POST['type_id'];
    $info = $_POST['info'];

    $tmp_name = $_FILES['image']['tmp_name'];
    $name =  $_FILES['image']['name'];

    move_uploaded_file($tmp_name, "../public/media/$name");
    $image_url = "/media/$name";

    $sql = <<<EOL
INSERT INTO synthesizers(title, description, type_id, info, image)
VALUES(:title, :description, :type_id, :info, :image_url)
EOL;


    $query = $this->pdo->prepare($sql);

    $query->bindValue("title", $title);
    $query->bindValue("description", $description);
    $query->bindValue("type_id", $type_id, PDO::PARAM_INT);
    $query->bindValue("info", $info);
    $query->bindValue("image_url", $image_url);

    $query->execute();

    $query = $this->pdo->query("SELECT DISTINCT type FROM types order by 1");
    $types = $query->fetchAll();
    $context['types'] = $types;

    $context['message'] = 'Вы успешно создали объект';
    $context['id'] = $this->pdo->lastInsertId();

    $this->get($context);
  }
}
