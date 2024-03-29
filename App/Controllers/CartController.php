<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    if (!$this->auth->isLoggedIn()) {
      http_response_code(401);
      die();
    }
    $this->modelCart = new Cart();
    $this->modelProduct = new Product();
  }

  public function addCart(): void
  {
    $productId = $this->body->post('product_id');
    $quantity = $this->body->post('quantity');
    $product = $this->modelProduct->findById($productId);

    if ($product == null) {
      $this->view->json(['message' => 'Không tìm thấy sản phẩm'], 400);
    }

    $this->validator->name('quantity')->value($quantity)->label('Số lượng')->number()->min(1)->required();

    if (!$this->validator->isValid()) {
      $this->view->json(['message' => $this->validator->getError('quantity')], 400);
    }

    $cart = $this->modelCart->findCartByUserId($this->auth->id());

    if ($quantity > $product->quantity) {
      $this->view->json(
        [
          'message' => 'Số lượng đặt hàng không được lớn hơn số lượng trong kho',
          'type' => 'quantity'
        ],
        400
      );
    }

    if ($cart != null) {
      $item = $this->modelCart->findItem([$cart->id, $product->id]);

      if ($item) {
        $newQuantity =  $item->quantity + $quantity;
        $rowCount = $this->modelCart->updateQuantityItem([$newQuantity, $item->id]);

        if ($rowCount > 0) {
          $this->view->json([
            'message' => 'Thêm vào giỏ hàng thành công',
            'count' => $cart->count + 1,
            'isUpdate' => true
          ], 200);
        } else {
          $this->view->json(['message' => 'Có lỗi xảy ra'], 400);
        }
      } else {
        $rowCount = $this->modelCart->saveItem([
          $cart->id,
          $product->id,
          $quantity
        ]);

        if ($rowCount > 0) {
          $this->view->json([
            'message' => 'Thêm vào giỏ hàng thành công',
            'count' => $cart->count + 1,
            'isUpdate' => true
          ], 200);
        } else {
          $this->view->json(['message' => 'Có lỗi xảy ra'], 400);
        }
      }
    } else {
      $this->modelCart->save([
        $this->auth->id(),
        'active'
      ]);

      $cart = $this->modelCart->findCartByUserId($this->auth->id());
      $rowCount = $this->modelCart->saveItem([
        $cart->id,
        $product->id,
        $quantity
      ]);

      if ($rowCount > 0) {
        $this->view->json([
          'message' => 'Thêm vào giỏ hàng thành công',
          'count' => 1,
          'isUpdate' => true
        ], 200);
      } else {
        $this->view->json(['message' => 'Có lỗi xảy ra'], 400);
      }
    }
  }

  public function updateCart(): void
  {
    $itemId = $this->body->post('item_id');
    $item = $this->modelCart->findItemById($itemId);
    $quantity = $this->body->post('quantity');

    $this->validator->name('quantity')->value($quantity)->label('Số lượng')->number()->min(1)->required();

    if (!$this->validator->isValid()) {
      $this->view->json(['message' => $this->validator->getError('quantity')], 400);
    }

    if ($item == null) {
      $this->view->json(['message' => 'Không tìm thấy chi tiết đơn hàng'], 404);
    }

    if ($quantity > $item->product_quantity) {
      $this->view->json([
        'message' => 'Số lượng đặt hàng không được lớn hơn số lượng trong kho',
        'type' => 'quantity'
      ], 400);
    }

    $rowCount = $this->modelCart->updateQuantityItem([
      $quantity,
      $item->id
    ]);

    if ($rowCount > 0) {
      $total_item = $quantity * $item->product_price;
      $cart = $this->modelCart->findCartByUserId($this->auth->id());

      $this->view->json([
        'message' => 'Cập nhập giỏ hàng thành công',
        'count' => $cart->count,
        'total_item' => $total_item,
        'total' => $cart->total
      ], 200);
    } else {
      $this->view->json(['message' => 'Không tìm thấy sản phẩm'], 404);
    }
  }

  public function removeCart(): void
  {
    $itemId = $this->body->post('item_id');
    $rowCount = $this->modelCart->removeItemById($itemId);

    if ($rowCount > 0) {
      $cart = $this->modelCart->findCartByUserId($this->auth->id());

      $this->view->json([
        'message' => 'Xoá sản phẩm khỏi giỏ hàng thành công',
        'total' => $cart->total
      ], 200);
    } else {
      $this->view->json(['message' => 'Không tìm thấy sản phẩm', $itemId], 404);
    }
  }
}
