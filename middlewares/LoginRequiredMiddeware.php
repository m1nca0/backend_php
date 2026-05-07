<?php

class LoginRequiredMiddeware extends BaseMiddleware
{
  public function apply(BaseController $controller, array $context)
  {
    $user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
    $password = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';

    $sql = "SELECT id FROM users WHERE username = :user AND password = :password;";

    $query = $controller->pdo->prepare($sql);

    $query->bindValue("user", $user);
    $query->bindValue("password", $password);
    $query->execute();

    $valid_user = $query->fetch();

    if ($valid_user === false) {
      header('WWW-Authenticate: Basic realm="synthesizers"');
      http_response_code(401);
      exit;
    }
  }
}
