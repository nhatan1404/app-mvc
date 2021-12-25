<?php

use Core\Loader;
use Core\Request;
use Core\Router;

class Application
{
  public $router;

  public function __construct()
  {
    $this->loadClass();
    $this->loader = new Loader();
    $this->request = new Request();
    $this->router = new Router($this->request);
  }

  private function loadClass()
  {
    spl_autoload_register(function ($className) {
      $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
      $path = './' . $className . '.php';
      if (!file_exists($path)) {
        die('Class không tồn tại');
      }
      require_once $path;
    });
  }

  public function run()
  {
    list($controller, $method, $arguments) = $this->router->getRoute();
    $this->loader->loadAction($controller, $method, $arguments);
  }
}
