<?php

namespace App\Controllers;

use Core\Controller;

class ErrorController extends Controller
{
  public function notFound()
  {
    $this->view->render('error.404', false);
  }
}
