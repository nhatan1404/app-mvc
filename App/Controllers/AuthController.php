<?php

namespace App\Controllers;

use Core\Controller;
use Core\Hash;
use App\Models\Auth;

class AuthController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->modelAuth = new Auth();
  }

  public function login()
  {
    if ($this->auth->isLoggedIn()) {
      $this->view->redirect('/');
      exit;
    }
    $this->view->title = 'Đăng Nhập';
    $this->view->render('site.user.login');
  }

  public function register()
  {
    if ($this->auth->isLoggedIn()) {
      $this->view->redirect('/');
      exit;
    }
    $this->view->title = 'Đăng Ký';
    $this->view->render('site.user.register');
  }

  public function handleLogin()
  {
    if ($this->auth->isLoggedIn()) {
      $this->view->redirect('/');
      exit;
    }
    $email = $this->body->post('email');
    $password = $this->body->post('password');
    $remember = $this->body->post('remember', false);

    $user = $this->modelAuth->findDetailLogin($email);
    if ($user == null) {
      $this->view->errors = 'Sai tài khoản hoặc mật khẩu';
    } else {
      $isVerified =  password_verify($password, $user->password);
      if ($isVerified) {
        $token = Hash::uuidv4();
        $this->modelAuth->updateToken($user->id, $token);

        if ($remember) {
          $this->cookie->set('auth', $token);
        } else {
          $this->session->set('auth', $token);
        }
        $this->view->redirect('/');
      } else {
        $this->view->errors = 'Sai tài khoản hoặc mật khẩu';
        $this->view->render('site.user.login');
      }
    }
  }

  public function handleRegister()
  {
    $firstname = $this->body->post('firstname');
    $lastname = $this->body->post('lastname');
    $password = $this->body->post('password');
    $repassword = $this->body->post('password_confirmation');
    $province = $this->body->post('province');
    $district = $this->body->post('district');
    $ward = $this->body->post('ward');
    $email = $this->body->post('email');
    $telephone = $this->body->post('telephone');
    $role = 'customer';
    $status = 'active';
    $password = password_hash($password, PASSWORD_DEFAULT);

    // $address_id = $this->model
    // $rowCount = $this->modelUser->save([
    //   $firstname,
    //   $lastname,
    //   $password,
    //   $avatar,
    //   $address_id,
    //   $email,
    //   $telephone,
    //   $role,
    //   $status,
    // ]);
  }

  public function handleLogout()
  {
    if ($this->body->post('logout', false)) {
      $this->session->destroy();
      $this->cookie->destroy();
    }
    return $this->view->redirect('/');
  }
}
