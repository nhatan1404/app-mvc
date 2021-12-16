<?php

namespace Core;

use Core\Request;

class Cookie
{
  private $path = '/';

  public function __construct()
  {
    $request = new Request();
    $this->path = dirname($request->get('SCRIPT_NAME')) ?: '/';
  }

  public function set($key, $value, $hours = 1800)
  {
    $expireTime = $hours == -1 ? -1 : time() + $hours * 3600;
    setcookie($key, $value, $expireTime, $this->path, '', false, true);
  }


  public function get($key, $default = null)
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : $default;
  }

  public function has($key)
  {
    return array_key_exists($key, $_COOKIE);
  }

  public function remove($key)
  {
    $this->set($key, null, -1);

    unset($_COOKIE[$key]);
  }

  public function getAll()
  {
    return $_COOKIE;
  }

  public function destroy()
  {
    foreach (array_keys($this->getAll()) as $key) {
      $this->remove($key);
    }

    unset($_COOKIE);
  }
}
