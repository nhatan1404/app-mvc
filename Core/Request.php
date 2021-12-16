<?php

namespace Core;

class Request
{
  private  $url;

  private $baseUrl;

  public function get($key)
  {
    return $_SERVER[$key];
  }

  public function __construct()
  {
    $script = dirname($this->get('SCRIPT_NAME'));

    $requestUri = $this->get('REQUEST_URI');

    if (strpos($requestUri, '?') !== false) {
      list($requestUri) = explode('?', $requestUri);
    }

    $this->url = rtrim(preg_replace('#^' . $script . '#', '', $requestUri), '/');

    if (!$this->url) {
      $this->url = '/';
    }

    $this->baseUrl = $this->get('REQUEST_SCHEME') . '://' . $this->get('HTTP_HOST') . $script . '/';
  }

  public function isAjax()
  {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
  }

  public function getMethod(): string
  {
    return $this->get('REQUEST_METHOD');
  }

  public function getBaseUrl(): string
  {
    return $this->baseUrl;
  }

  public function getUrl(): string
  {
    return $this->url;
  }

  public function getQuery()
  {
    return $this->get('QUERY_STRING');
  }
}
