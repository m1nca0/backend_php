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
    $type = $_POST['type'];
    $info = $_POST['info'];
    
    // вытащил значения из $_FILES
    $tmp_name = $_FILES['image']['tmp_name'];
    $name =  $_FILES['image']['name'];

    // используем функцию которая проверяет
    // что файл действительно был загружен через POST запрос
    // и если это так, то переносит его в указанное во втором аргументе место
    move_uploaded_file($tmp_name, "../public/media/$name");


    $sql = <<<EOL
INSERT INTO synthesizers(title, description, type, info, image)
VALUES(:title, :description, :type, :info, '')
EOL;


    $query = $this->pdo->prepare($sql);

    $query->bindValue("title", $title);
    $query->bindValue("description", $description);
    $query->bindValue("type", $type);
    $query->bindValue("info", $info);


    // $query->execute();

    // $context['message'] = 'Вы успешно создали объект';
    // $context['id'] = $this->pdo->lastInsertId();

    $this->get($context);
  }
}
