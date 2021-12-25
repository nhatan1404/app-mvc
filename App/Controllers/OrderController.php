<?php

namespace App\Controllers;

use Core\Controller;
use Core\Pagination;
use Core\FlashMessage;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
  public function __construct()
  {
    parent::__construct();

    if (!$this->auth->isLoggedIn() || !$this->auth->isAdmin()) {
      $this->view->redirect('/');
    }

    $this->modelProduct = new Product();
    $this->modelOrder = new Order();
    $this->modelOrderItem = new OrderItem();
  }

  public function index(): void
  {
    $page = $this->body->get('page', 1);
    $this->view->orders = $this->modelOrder->getListPaginate($page);
    $this->view->currentPage = $page;
    $this->view->totalPage = Pagination::getTotalPages($this->modelOrder->getCount());
    $this->view->title = 'Danh sách đơn đặt hàng';
    $this->view->render('admin.order.index');
  }

  public function show(int $id): void
  {
    $order = $this->modelOrder->findById($id);

    if ($order == null) {
      $this->view->notFound('Đơn đặt hàng không tồn tại');
    }

    $this->view->order = $order;
    $this->view->products = $this->modelOrderItem->getListByOrderId($order->id);
    $this->view->title = 'Chi tiết đơn đặt hàng';
    $this->view->render('admin.order.detail');
  }

  public function edit(int $id): void
  {
    $order = $this->modelOrder->findById($id);

    if ($order == null) {
      $this->view->notFound('Đơn đặt hàng không tồn tại');
    }

    $this->view->order = $order;
    $this->view->render('admin.order.edit');
  }

  public function update(int $id): void
  {
    $order = $this->modelOrder->findById($id);

    if ($order == null) {
      $this->view->notFound('Đơn đặt hàng không tồn tại');
    }

    $status = $this->body->post('status');
    $note = $this->body->post('note');

    $this->validator->name('status')->label('Trạng thái')->value($status)->string()->required();
    $this->validator->name('note')->label('Ghi chú')->value($note)->string();

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/order/' . $id . '/edit');
    }

    $items  = $this->modelOrderItem->getListByOrderId($order->id);
    if ($status == 'delivering') {
      foreach ($items as $item) {
        $this->modelProduct->updateQuantity($item->product_quantity - $item->quantity, $item->product_id);
        $this->modelProduct->updateSold($item->product_sold + $item->quantity, $item->product_id);
      }
    }

    if (($order->status == 'delivering') && $status == 'cancel') {
      foreach ($items as $item) {
        $this->modelProduct->updateQuantity($item->product_quantity + $item->quantity, $item->product_id);
        $this->modelProduct->updateSold($item->product_sold - $item->quantity, $item->product_id);
      }
    }

    $rowCount = $this->modelOrder->update([$status, $note, $id]);

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Cập nhật đơn đặt hàng thành công', FlashMessage::FLASH_SUCCESS);
    } else if ($rowCount == -1) {
      $this->view->createFlashMsg('error', 'Cập nhật đơn đặt hàng không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/order');
  }
}
