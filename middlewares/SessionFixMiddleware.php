<?php

class SessionFixMiddleware extends BaseMiddleware
{
  public function apply(BaseController $controller, array $context)
  {
    if(!isset ($_SESSION['urls'])){
      $_SESSION['urls'] = [];
    }
    array_push($_SESSION['urls'], $_SERVER["REQUEST_URI"]);
    $context['urls'] = $_SESSION['urls'];
  }
}
