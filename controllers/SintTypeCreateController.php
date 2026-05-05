<?php
require_once "BaseSintTwigController.php";

class SintTypeCreateController extends BaseSintTwigController
{
  public $template = "sint_create_type.twig";
  public function get(array $context)
  {
    echo $_SERVER['REQUEST_METHOD'];

    parent::get($context);
  }
  public function post(array $context)
  {

    $title = $_POST['title'];

    // вытащил значения из $_FILES
    $tmp_name = $_FILES['image']['tmp_name'];
    $name =  $_FILES['image']['name'];

    // используем функцию которая проверяет
    // что файл действительно был загружен через POST запрос
    // и если это так, то переносит его в указанное во втором аргументе место
    move_uploaded_file($tmp_name, "../public/media/$name");
    $image_url = "/media/$name";

    $sql = <<<EOL
INSERT INTO types(title, image)
VALUES(:title, :image_url)
EOL;


    $query = $this->pdo->prepare($sql);

    $query->bindValue("title", $title);
    $query->bindValue("image_url", $image_url);

    $query->execute();

    $context['message'] = 'Вы успешно создали объект';
    $context['id'] = $this->pdo->lastInsertId();

    $this->get($context);
  }
}
