<?php
require_once "BaseSintTwigController.php";

class SintObjectEditController extends BaseSintTwigController
{
  public $template = "sint_create.twig";
  public function getContext(): array
  {
    $context = parent::getContext();
    $id = $this->params['id'];

    $sql = <<<EOL
SELECT * FROM synthesizers WHERE id = :id
EOL;
    $query = $this->pdo->prepare($sql);

    $query->bindValue("id", $id);
    $query->execute();

    $data = $query->fetch();
    $query = $this->pdo->query("SELECT * FROM types order by 1");
    $types = $query->fetchAll();
    $context['edit'] = true;
    $context['types'] = $types;
    $context['object'] = $data;

    return $context;
  }


  public function post(array $context)
  {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $type_id = $_POST['type_id'];
    $info = $_POST['info'];
    $id = $_POST['id'];

    $image = isset($_POST['image']) ? ($_POST['image']) : '';

    $tmp_name = $_FILES['image']['tmp_name'];
    $name =  $_FILES['image']['name'];

    move_uploaded_file($tmp_name, "../public/media/$name");
    $image_url = "/media/$name";
    if ($image_url != "/media/") {
      $sql = <<<EOL
UPDATE synthesizers SET title = :title, description = :description, type_id = :type_id, info = :info, image = :image WHERE id = :id
EOL;
    $query = $this->pdo->prepare($sql);

    $query->bindValue("title", $title);
    $query->bindValue("description", $description);
    $query->bindValue("type_id", $type_id, PDO::PARAM_INT);
    $query->bindValue("info", $info);
    $query->bindValue("image", $image_url);
    $query->bindValue("id", $id, PDO::PARAM_INT);
    } else {
      $sql = <<<EOL
UPDATE synthesizers SET title = :title, description = :description, type_id = :type_id, info = :info  WHERE id = :id
EOL;
    $query = $this->pdo->prepare($sql);

    $query->bindValue("title", $title);
    $query->bindValue("description", $description);
    $query->bindValue("type_id", $type_id, PDO::PARAM_INT);
    $query->bindValue("info", $info);
    $query->bindValue("id", $id, PDO::PARAM_INT);
    }

    $query->execute();

    $query = $this->pdo->query("SELECT DISTINCT type FROM types order by 1");
    $types = $query->fetchAll();
    $context['types'] = $types;

    $context['message'] = 'Вы успешно изменили объект';
    $context['id'] = $this->pdo->lastInsertId();

    $this->get($context);
  }
}
