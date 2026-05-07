<?php

class SetWelcomeController extends BaseController{
  public function get(array $context)
  {
    $url = $_SERVER['HTTP_ACCEPT'];
    header("Location: $url");
    exit;
  }
}