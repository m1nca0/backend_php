<?php

class SetWelcomeController extends BaseController
{
  public function get(array $context)
  {
    $_SESSION['welcome_message'] = $_SERVER["URL"];
    if(!isset ($_SESSION['messages'])){
      $_SESSION['messages'] = [];
    }
    array_push($_SESSION['messages'], $_SERVER["URL"]);
    $url = $_SERVER['HTTP_REFERER'];
    header("Location: $url");
    exit;
  }
}
