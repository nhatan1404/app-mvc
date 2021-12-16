<?php

namespace Core;

use Closure;
use Core\Request;

abstract class MethodHttp
{
  const GET = 'GET';
  const POST = 'POST';
}

class Router
{
  private $routes = [];
  private $request;
  private $notFound;

  private const PATTERN_ID = '([\d]+)';
  private const PATTERN_STRING = '([\w-]+)';
  private const PATTERN_SLUG =  '([\w-]+\.\d+)';


  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function setNotFound(string $action): void
  {
    $this->notFound = $action;
  }

  public function add(string $url, string $action, $method = MethodHttp::GET): void
  {
    $route = [
      'url' => $url,
      'action' => $this->getAction($action),
      'method' => $method,
      'pattern' => $this->getPattern($url),
    ];

    $this->routes[] = $route;
  }

  public function get(string $url, string $action): void
  {
    $this->add($url, $action, MethodHttp::GET);
  }

  public function post(string $url, string $action): void
  {
    $this->add($url, $action, MethodHttp::POST);
  }

  public function getRoute()
  {
    foreach ($this->routes as $route) {
      if ($this->isMatching($route['pattern']) && $this->isMatchingMethod($route['method'])) {
        $arguments = $this->getArgumentsFrom($route['pattern']);
        list($controller, $method) = explode('@', $route['action']);
        return [$controller, $method, $arguments];
      }
    }

    list($controller, $method) = explode('@', $this->notFound);
    return [$controller, $method, []];
  }

  private function isMatching(string $pattern): bool
  {
    return preg_match($pattern, $this->request->getUrl());
  }

  private function isMatchingMethod(string $method): bool
  {
    return $method == $this->request->getMethod();
  }

  private function getArgumentsFrom(string $pattern): array
  {
    preg_match($pattern, $this->request->getUrl(), $matches);
    array_shift($matches);
    return $matches;
  }

  private function getAction(string $action): string
  {
    $action = str_replace('/', '\\', $action);
    return strpos($action, '@') !== false ? $action : $action . '@index';
  }

  private function getPattern(string $url): string
  {
    $pattern = '#^';
    $pattern .= str_replace(
      [':id', ':slug', ':string'],
      [self::PATTERN_ID, self::PATTERN_SLUG, self::PATTERN_STRING],
      $url
    );
    $pattern .= '$#';
    return $pattern;
  }
}
