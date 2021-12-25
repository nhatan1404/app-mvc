<?php

namespace Core;

class Session
{
  public function __construct()
  {
  }

  public function start()
  {
    if (!session_id()) {
      session_start();
    }
  }

  public function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public function get($key, $default = null)
  {
    return $this->has($key) ? $_SESSION[$key] : $default;
  }

  public function has($key)
  {
    return isset($_SESSION[$key]);
  }

  public function remove($key)
  {
    unset($_SESSION[$key]);
  }

  public function pull($key)
  {
    $value = $this->get($key);
    $this->remove($key);
    return $value;
  }

  public function getAll()
  {
    return $_SESSION;
  }

  public function destroy()
  {
    session_destroy();
    unset($_SESSION);
  }
}
