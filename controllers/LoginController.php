<?php

class LoginController extends BaseSintTwigController
{
  public $template = "login.twig";
  public $title = "Страница входа";
  public function post(array $context)
  {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM users WHERE username = :login AND password = :password;";

    $query = $this->pdo->prepare($sql);

    $query->bindValue("login", $login);
    $query->bindValue("password", $password);
    $query->execute();

    $valid_user = $query->fetch();

    if (!($valid_user === false)) {
      $_SESSION["is_logged"] = true;
      header("Location: /");
    } else $_SESSION["is_logged"] = false;
  }
}
