<?php

namespace App\Controllers;

use Core\Controller;
use Core\Pagination;
use Core\FlashMessage;
use App\Models\Coupon;

class CouponController extends Controller
{

  public function __construct()
  {
    parent::__construct();

    if (!$this->auth->isLoggedIn() || !$this->auth->isAdmin()) {
      $this->view->redirect('/');
    }

    $this->modelCoupon = new Coupon();
  }

  public function index(): void
  {
    $page = $this->body->get('page', 1);
    $this->view->coupons = $this->modelCoupon->getListPaginate($page);
    $this->view->currentPage = $page;
    $this->view->totalPage = Pagination::getTotalPages($this->modelCoupon->getCount());
    $this->view->title = 'Danh sách mã giảm giá';
    $this->view->render('admin.coupon.index');
  }


  public function create(): void
  {
    $this->view->title = 'Tạo mã giảm giá';
    $this->view->render('admin.coupon.create');
  }


  public function store(): void
  {
    $code = $this->body->post('code');
    $type = $this->body->post('type');
    $value = $this->body->post('value');
    $status = $this->body->post('status');

    $this->validator->name('code')->label('Mã')->value($code)->string()->minLen(5)->required();
    $this->validator->name('type')->label('Loại')->value($type)->string()->required();
    if ($type == 'percent') {
      $this->validator->name('value')->label('Giá trị')->value($value)->number()->min(0)->max(100)->required();
    } else {
      $this->validator->name('value')->label('Giá trị')->value($value)->number()->min(0)->required();
    }
    $this->validator->name('status')->label('Trạng thái')->value($status)->string()->required();

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/coupon/create');
    }

    $rowCount = $this->modelCoupon->save([$code, $type, $value, $status]);

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Tạo mã giảm giá thành công', FlashMessage::FLASH_SUCCESS);
    } else {
      $this->view->createFlashMsg('error', 'Tạo mã giảm giá không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/coupon');
  }

  public function show(int $id): void
  {
    $coupon = $this->modelCoupon->findById($id);

    if ($coupon == null) {
      $this->view->notFound('Mã giảm giá không tồn tại');
      return;
    }

    $this->view->coupon = $coupon;
    $this->view->title = 'Chi tiết mã giảm giá';
    $this->view->render('admin.coupon.detail');
  }

  public function edit(int $id): void
  {
    $coupon = $this->modelCoupon->findById($id);

    if ($coupon == null) {
      $this->view->notFound('Mã giảm giá không tồn tại');
    }

    $this->view->coupon = $coupon;
    $this->view->render('admin.coupon.edit');
  }

  public function update(int $id)
  {
    $code = $this->body->post('code');
    $type = $this->body->post('type');
    $value = $this->body->post('value');
    $status = $this->body->post('status');

    $this->validator->name('code')->label('Mã')->value($code)->string()->minLen(5)->required();
    $this->validator->name('type')->label('Loại')->value($type)->string()->required();
    if ($type == 'percent') {
      $this->validator->name('value')->label('Giá trị')->value($value)->number()->min(0)->max(100)->required();
    } else {
      $this->validator->name('value')->label('Giá trị')->value($value)->number()->min(0)->required();
    }
    $this->validator->name('status')->label('Trạng thái')->value($status)->string()->required();

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/coupon/' . $id . '/edit');
    }

    $rowCount = $this->modelCoupon->update([$code, $type, $value, $status, $id]);

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Cập nhật mã giảm giá thành công', FlashMessage::FLASH_SUCCESS);
    } else if ($rowCount == -1) {
      $this->view->createFlashMsg('error', 'Cập nhật mã giảm giá không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/coupon');
  }

  public function destroy(int $id)
  {
    $isDeleted = $this->modelCoupon->remove($id) > 0;

    if ($isDeleted) {
      $this->view->createFlashMsg('success', 'Xoá mã giảm giá thành công', FlashMessage::FLASH_SUCCESS);
    } else {
      $this->view->createFlashMsg('error', 'Xoá mã giảm giá không thành công', FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/coupon');
  }
}
