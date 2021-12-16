<?php

namespace App\Controllers;

use Core\Controller;

class DashboardController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    if (!$this->auth->isLoggedIn() || !$this->auth->isAdmin()) {
      $this->view->redirect('/');
      exit;
    }
  }

  public function index()
  {
    $this->view->render('admin.home.index');
  }
}
