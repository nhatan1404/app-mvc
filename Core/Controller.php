<?php

namespace Core;

use App\Helpers\AuthHelper;

class Controller
{
  public function __construct()
  {
    $this->view = new View();
    $this->validator = new Validation();
    $this->request = new Request();
    $this->body = new RequestBody();
    $this->session = new Session();
    $this->cookie = new Cookie();
    $this->auth = new AuthHelper();
  }
}
