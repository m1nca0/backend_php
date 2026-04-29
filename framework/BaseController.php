<?php
abstract class BaseController
{
  public PDO $pdo;

  public function setPDO(PDO $pdo)
  {
    $this->pdo = $pdo;
  }
  public function getContext(): array
  {
    return [];
  }
  public array $params; // добавил поле

  // добавил сеттер
  public function setParams(array $params)
  {
    $this->params = $params;
  }
  abstract public function get();
}
