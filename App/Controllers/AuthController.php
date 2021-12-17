<?php

namespace App\Controllers;

use Core\Controller;
use Core\FlashMessage;
use Core\Hash;
use App\Models\Auth;
use App\Models\User;
use App\Models\Address;

class AuthController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->modelAuth = new Auth();
    $this->modelUser = new User();
    $this->modelAddress = new Address();
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

    $this->validator->name('email')->value($email)->string()->email()->required();
    $this->validator->name('password')->value($password)->string()->required();

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/login');
    }

    $errors = [
      'email' => 'Sai tài khoản hoặc mật khẩu',
      'password' => 'Sai tài khoản hoặc mật khẩu'
    ];

    $user = $this->modelAuth->findDetailLogin($email);
    if ($user == null) {
      $this->session->set($this->view->validation(), $errors);
      $this->view->redirect('/login');
    } else {
      $isVerified =  password_verify($password, $user->password);
      if ($isVerified) {
        $token = Hash::uuidv4();
        $this->modelAuth->updateToken($user->id, $token);

        if ($remember) {
          $this->cookie->has('auth') ?: $this->cookie->remove('auth');
          $this->cookie->set('auth', $token);
        } else {
          $this->session->set('auth', $token);
        }
        $this->view->redirect('/');
      } else {
        $this->session->set($this->view->validation(), $errors);
        $this->view->redirect('/login');
      }
    }
  }

  public function handleRegister()
  {
    $firstname = $this->body->post('firstname');
    $lastname = $this->body->post('lastname');
    $password = $this->body->post('password');
    $repassword = $this->body->post('repassword');
    $email = $this->body->post('email');
    $telephone = $this->body->post('telephone');
    $avatar = DEFAULT_IMAGE_AVATAR;
    $role = 'customer';
    $status = 'active';
    $address = $this->body->post('address');
    $province = $this->body->post('province');
    $district = $this->body->post('district');
    $ward = $this->body->post('ward');
    $this->validator->name('firstname')->value($firstname)->label('Tên')->string()->required();
    $this->validator->name('lastname')->value($lastname)->label('Họ')->string()->required();
    $this->validator->name('password')->value($password)->label('Mật khẩu')->string()->equal($repassword)->required();
    $this->validator->name('repassword')->value($repassword)->label('Mật khẩu xác nhận')->string()->equal($password)->required();
    $this->validator->name('email')->value($email)->label('Email')->string()->email()->required();
    $this->validator->name('telephone')->value($telephone)->label('Số điện thoại')->string()->phone()->required();
    $this->validator->name('address')->value($address)->label('Địa chỉ')->string()->required();
    $this->validator->name('province')->value($province)->label('Tỉnh')->string()->required();
    $this->validator->name('district')->value($district)->label('Thành phố/quận')->string()->required();
    $this->validator->name('ward')->value($ward)->label('Phường/xã')->string()->required();

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/register');
    }
    $password = password_hash($password, PASSWORD_DEFAULT);

    $address_id = $this->modelAddress->save([$address, $province, $district, $ward]);

    $rowCount = $this->modelUser->save([$firstname, $lastname, $password, $avatar, $address_id, $email, $telephone, $role, $status]);
    if ($rowCount > 0) {
      $this->session->set('register-success', true);
      $this->view->redirect('/register-success');
    } else {
      $this->view->createFlashMsg('error', 'Tạo tài khoản không thành công',  FlashMessage::FLASH_ERROR);
      $this->view->redirect('/register');
    }
  }

  public function registerSuccess()
  {
    if ($this->session->has('register-success')) {
      $this->session->remove('register-success');
      $this->view->title = 'Đăng Ký Thành Công';
      $this->view->render('site.user.register-success');
    } else {
      $this->view->redirect('/login');
    }
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
