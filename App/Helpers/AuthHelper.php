<?php

namespace App\Helpers;

use App\Models\Auth;
use Core\Cookie;
use Core\Session;

class AuthHelper
{
  private $isLogged = false;
  private $user = null;

  public function __construct()
  {
    $this->session = new Session();
    $this->cookie = new Cookie();
    $this->modelAuth = new Auth();
    $this->isLogged = $this->checkValid();
  }

  public function isLoggedIn()
  {
    return $this->isLogged;
  }

  public function id()
  {
    return $this->user->id ?? null;
  }

  public function getUser()
  {
    return $this->user;
  }

  public function getFullName()
  {
    return $this->user->lastname . ' ' . $this->user->firstname ?? null;
  }

  public function isAdmin()
  {
    return $this->user->role == 'admin';
  }

  private function checkValid(): bool
  {
    if ($this->cookie->has('auth')) {
      $token = $this->cookie->get('auth');
    } elseif ($this->session->has('auth')) {
      $token = $this->session->get('auth');
    } else {
      $token = '';
    }

    $user = $this->modelAuth->getUserByToken($token);
    if (count($user) > 0) {
      $this->user = $user[0];
    }
    return $user != null;
  }
}
