<?php

namespace Core;

class Loader
{
  private $controllers = [];

  public function __construct()
  {
  }

  private function isHasController(string $key): bool
  {
    return array_key_exists($key, $this->controllers);
  }

  private function addController(string $controller): void
  {
    $class = new $controller();
    $this->controllers[$controller] = $class;
  }

  private function getControllerName(string $controller): string
  {
    $controller = 'App\\Controllers\\' . ucfirst($controller);
    return str_replace('/', '\\', $controller);
  }

  public function getController(string $controller)
  {
    $controller = $this->getControllerName($controller);
    if (!$this->isHasController($controller)) {
      $this->addController($controller);
    }

    return $this->controllers[$controller];
  }

  public function loadAction(string $controller, string $method, array $arguments = []): void
  {
    $class = $this->getController($controller);
    if (class_exists(get_class($class)) && method_exists($class, $method))
      call_user_func_array([$class, $method], $arguments);
    else die('Class hoặc Method không tồn tại');
  }
}
