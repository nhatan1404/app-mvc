<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
  public function __construct()
  {
    parent::__construct();

    if (!$this->auth->isLoggedIn() || !$this->auth->isAdmin()) {
      $this->view->redirect('/');
    }

    $this->modelProduct = new Product();
    $this->modelCategory = new Category();
    $this->modelOrder = new Order();
    $this->modelCoupon = new Coupon();
    $this->modelUser = new User();
  }

  public function index(): void
  {
    $this->view->countCategory = $this->modelCategory->getCount();
    $this->view->countProduct = $this->modelProduct->getCount();
    $this->view->countOrder = $this->modelOrder->getCount();
    $this->view->countUser = $this->modelUser->getCount();
    $this->view->countCoupon = $this->modelCoupon->getCount();
    $this->view->render('admin.home.index');
  }
}
