<?php

namespace App\Controllers;

use Core\Controller;
use Core\Pagination;
use Core\FlashMessage;
use App\Models\User;
use App\Models\Address;

class UserController extends Controller
{
  private $modelUser;

  public function __construct()
  {
    parent::__construct();
    if (!$this->auth->isLoggedIn() || !$this->auth->isAdmin()) {
      $this->view->redirect('/');
      exit;
    }
    $this->modelUser = new User();
    $this->modelAddress = new Address();
  }

  public function index()
  {
    $page = $this->body->get('page', 1);
    $this->view->users = $this->modelUser->getListPaginate($page);
    $this->view->currentPage = $page;
    $this->view->totalPage = Pagination::getTotalPages($this->modelUser->getCount());
    $this->view->title = 'Danh sách tài khoản';
    $this->view->render('admin.user.index');
  }


  public function create()
  {
    $this->view->title = 'Tạo tài khoản';
    $this->view->render('admin.user.create');
  }


  public function store()
  {
    $firstname = $this->body->post('firstname');
    $lastname = $this->body->post('lastname');
    $password = $this->body->post('password');
    $repassword = $this->body->post('repassword');
    $email = $this->body->post('email');
    $telephone = $this->body->post('telephone');
    $avatar = $this->body->file('avatar');
    $role = $this->body->post('role');
    $status = $this->body->post('status');
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
    $this->validator->name('avatar')->file($avatar)->label('Ảnh đại diện')->required();
    $this->validator->name('role')->value($role)->label('Chức vụ')->string()->required();
    $this->validator->name('status')->value($status)->label('Trạng thái')->string()->required();
    $this->validator->name('address')->value($address)->label('Địa chỉ')->string()->required();
    $this->validator->name('province')->value($province)->label('Tỉnh')->string()->required();
    $this->validator->name('district')->value($district)->label('Thành phố/quận')->string()->required();
    $this->validator->name('ward')->value($ward)->label('Phường/xã')->string()->required();

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/user/create');
    }

    $address_id = $this->modelAddress->save([$address, $province, $district, $ward]);
    // $rowCount = $this->modelUser->save([$firstname, $lastname, $password, $avatar, $address_id, $email, $telephone, $role, $status]);

    if (1 > 0) {
      $this->view->createFlashMsg('success', 'Tạo tài khoản thành công', FlashMessage::FLASH_SUCCESS);
    } else {
      $this->view->createFlashMsg('error', 'Tạo tài khoản không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/user');
  }

  public function show($id): void
  {
    $user = $this->modelUser->findById($id);
    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
      return;
    }
    $this->view->user = $user;
    $this->view->title = 'Chi tiết tài khoản';
    $this->view->render('admin.user.detail');
  }

  public function edit($id): void
  {
    $user = $this->modelUser->findById($id);
    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
      return;
    }
    $this->view->user = $user;
    $this->view->render('admin.user.edit');
  }

  public function update($id)
  {
    $code = $this->body->post('code');
    $type = $this->body->post('type');
    $value = $this->body->post('value');
    $status = $this->body->post('status');
    $rowCount = $this->modelUser->update([$code, $type, $value, $status, $id]);

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/user/' . $id . '/edit');
    }

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Cập nhật tài khoản thành công', FlashMessage::FLASH_SUCCESS);
    } else if ($rowCount == -1) {
      $this->view->createFlashMsg('error', 'Cập nhật tài khoản không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/user');
  }

  public function destroy($id)
  {
    $isDeleted = $this->modelUser->remove($id) > 0;
    if ($isDeleted) {
      $this->view->createFlashMsg('success', 'Xoá tài khoản thành công', FlashMessage::FLASH_SUCCESS);
    } else {
      $this->view->createFlashMsg('error', 'Xoá tài khoản không thành công', FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/user');
  }
}
