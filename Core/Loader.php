<?php

namespace Core;

class Loader
{
  private $controllers = [];

  public function __construct()
  {
  }

  public function getController($name)
  {
    return $this->controllers[$name];
  }

  public function isHasController($name): bool
  {
    return array_key_exists($name, $this->controllers);
  }

  public function addController($controller): void
  {
    $class = new $controller();
    $this->controllers[$controller] = $class;
  }

  public function getControllerName($controller): string
  {
    $controller = 'App\\Controllers\\' . ucfirst($controller);
    return str_replace('/', '\\', $controller);
  }

  public function getModel($name): string
  {
    return $this->models[$name];
  }

  public function loadAction($controller, $method, $arguments = []): mixed
  {
    $class = $this->controller($controller);
    return call_user_func_array([$class, $method], $arguments);
  }

  public function controller($controller)
  {
    $controller = $this->getControllerName($controller);
    if (!$this->isHasController($controller)) {
      $this->addController($controller);
    }

    return $this->getController($controller);
  }
}
