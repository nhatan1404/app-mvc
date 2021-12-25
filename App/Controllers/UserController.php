<?php

namespace App\Controllers;

use Core\Controller;
use Core\Pagination;
use Core\FlashMessage;
use App\Models\User;
use App\Models\Address;

class UserController extends Controller
{
  public function __construct()
  {
    parent::__construct();

    if (!$this->auth->isLoggedIn() || !$this->auth->isAdmin()) {
      $this->view->redirect('/');
    }

    $this->modelUser = new User();
    $this->modelAddress = new Address();
  }

  public function index(): void
  {
    $page = $this->body->get('page', 1);
    $this->view->users = $this->modelUser->getListPaginate($page);
    $this->view->currentPage = $page;
    $this->view->totalPage = Pagination::getTotalPages($this->modelUser->getCount());
    $this->view->title = 'Danh sách tài khoản';
    $this->view->render('admin.user.index');
  }


  public function create(): void
  {
    $this->view->title = 'Tạo tài khoản';
    $this->view->render('admin.user.create');
  }


  public function store(): void
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

    $this->validator->name('firstname')->value($firstname)->label('Tên')->string()->minLen(1)->required();
    $this->validator->name('lastname')->value($lastname)->label('Họ')->string()->minLen(1)->required();
    $this->validator->name('password')->value($password)->label('Mật khẩu')->string()->equal($repassword)->minLen(8)->required();
    $this->validator->name('repassword')->value($repassword)->label('Mật khẩu xác nhận')->string()->equal($password)->minLen(8)->required();
    $this->validator->name('email')->value($email)->label('Email')->string()->email()->required();
    $this->validator->name('telephone')->value($telephone)->label('Số điện thoại')->string()->phone()->required();
    // $this->validator->name('avatar')->file($avatar)->label('Ảnh đại diện')->required();
    $this->validator->name('role')->value($role)->label('Chức vụ')->string()->required();
    $this->validator->name('status')->value($status)->label('Trạng thái')->string()->required();
    $this->validator->name('address')->value($address)->label('Địa chỉ')->string()->required();
    $this->validator->name('province')->value($province)->label('Tỉnh')->string()->required();
    $this->validator->name('district')->value($district)->label('Thành phố/quận')->string()->required();
    $this->validator->name('ward')->value($ward)->label('Phường/xã')->string()->required();

    $user = $this->modelUser->findByEmail($email);

    if ($user != null) {
     $this->validator->setError('email', 'Emal không có sẵn');
    }

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/user/create');
    }

    if ($avatar == null) {
      $avatar = DEFAULT_IMAGE_AVATAR;
    } else {
      $avatar = $this->body->upload('avatar');
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $address_id = $this->modelAddress->save([$address, $province, $district, $ward]);
    $rowCount = $this->modelUser->save([
      $firstname,
      $lastname,
      $password,
      $avatar,
      $address_id,
      $email,
      $telephone,
      $role,
      $status
    ]);

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Tạo tài khoản thành công', FlashMessage::FLASH_SUCCESS);
    } else {
      if (!$this->body->isEmptyFile('avatar')) {
        unlink($avatar);
      }
      $this->view->createFlashMsg('error', 'Tạo tài khoản không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/user');
  }

  public function show(int $id): void
  {
    $user = $this->modelUser->findById($id);

    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
    }

    $this->view->user = $user;
    $this->view->title = 'Chi tiết tài khoản';
    $this->view->render('admin.user.detail');
  }

  public function edit(int $id): void
  {
    $user = $this->modelUser->findById($id);

    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
    }

    $this->view->user = $user;
    $this->view->title = 'Sửa Tài Khoản';
    $this->view->render('admin.user.edit');
  }

  public function update(int $id): void
  {
    $user = $this->modelUser->findById($id);

    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
    }

    $firstname = $this->body->post('firstname');
    $lastname = $this->body->post('lastname');
    $email = $this->body->post('email');
    $telephone = $this->body->post('telephone');
    $avatar = $this->body->file('avatar');
    $role = $this->body->post('role');
    $status = $this->body->post('status');
    $address = $this->body->post('address');
    $province = $this->body->post('province');
    $district = $this->body->post('district');
    $ward = $this->body->post('ward');

    $this->validator->name('firstname')->value($firstname)->label('Tên')->string()->minLen(1)->required();
    $this->validator->name('lastname')->value($lastname)->label('Họ')->string()->minLen(1)->required();
    $this->validator->name('email')->value($email)->label('Email')->string()->email()->required();
    $this->validator->name('telephone')->value($telephone)->label('Số điện thoại')->string()->phone()->required();
    //$this->validator->name('avatar')->file($avatar)->label('Ảnh đại diện')->required();
    $this->validator->name('role')->value($role)->label('Chức vụ')->string()->required();
    $this->validator->name('status')->value($status)->label('Trạng thái')->string()->required();
    $this->validator->name('address')->value($address)->label('Địa chỉ')->string()->required();
    $this->validator->name('province')->value($province)->label('Tỉnh')->string()->required();
    $this->validator->name('district')->value($district)->label('Thành phố/quận')->string()->required();
    $this->validator->name('ward')->value($ward)->label('Phường/xã')->string()->required();

    $checkUser = $this->modelUser->findByEmail($email);

    if ($user != null && $user->id != $checkUser->id) {
     $this->validator->setError('email', 'Emal không có sẵn');
    }

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/user/' . $id . '/edit');
    }

    if ($avatar == null) {
      $avatar =  $user->avatar;
    } else {
      $avatar = $this->body->upload('avatar');
    }

    $rowCountUser = $this->modelUser->update([
      $firstname,
      $lastname,
      $avatar,
      $email,
      $telephone,
      $role,
      $status,
      $id
    ]);
    $rowCountAddress = $this->modelAddress->update([
      $address,
      $province,
      $district,
      $ward,
      $user->address_id
    ]);

    if ($rowCountUser > 0 || $rowCountAddress > 0) {
      if ($this->view->isLocalImage($user->avatar) && file_exists($user->avatar)) {
        unlink($user->avatar);
      }
      $this->view->createFlashMsg('success', 'Cập nhật tài khoản thành công', FlashMessage::FLASH_SUCCESS);
    } else if ($rowCountUser == -1 || $rowCountAddress == -1) {
      if ($rowCountUser == -1 && !$this->body->isEmptyFile('avatar')) {
        unlink($avatar);
      }
      $this->view->createFlashMsg('error', 'Cập nhật tài khoản không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/user');
  }

  public function destroy(int $id): void
  {
    $user = $this->modelUser->findById($id);

    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
      return;
    }

    $isDeleted = $this->modelUser->remove($id) > 0;

    if ($isDeleted) {
      if ($this->view->isLocalImage($user->avatar) && file_exists($user->avatar)) {
        unlink($user->avatar);
      }
      $this->view->createFlashMsg('success', 'Xoá tài khoản thành công', FlashMessage::FLASH_SUCCESS);
    } else {
      $this->view->createFlashMsg('error', 'Xoá tài khoản không thành công', FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/user');
  }

  public function updatePassword(int $id): void
  {
    $user = $this->modelUser->findById($id);

    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
    }

    $password = $this->body->post('password-modal');
    $repassword = $this->body->post('repassword-modal');

    $this->validator->name('password')->value($password)->label('Mật khẩu')->string()->equal($repassword)->minLen(8)->required();
    $this->validator->name('repassword')->value($repassword)->label('Mật khẩu xác nhận')->string()->equal($password)->minLen(8)->required();

    if (!$this->validator->isValid()) {
      $this->view->createFlashMsg('error', 'Mật khẩu không khớp hoặc không đủ 8 ký tự', FlashMessage::FLASH_ERROR);
      $this->view->redirect('/admin/user/' . $id . '/edit');
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $rowCount = $this->modelUser->updatePassword([$password, $id]);

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Đổi mật khẩu tài khoản thành công', FlashMessage::FLASH_SUCCESS);
    } else if ($rowCount == -1) {
      $this->view->createFlashMsg('error', 'Đổi mật khẩu tài khoản không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/user/' . $id . '/edit');
  }
}
