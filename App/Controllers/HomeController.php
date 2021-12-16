<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Helpers\Util;
use Core\Pagination;

class HomeController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->modelProduct = new Product();
    $this->modelCategory = new Category();
    $this->modelAddress = new Address();
    $this->modelCart = new Cart();
    $this->modelOrder = new Order();
    $this->modelOrderItem = new OrderItem();
  }

  public function index()
  {
    $page = $this->body->get('page', 1);
    $categoryId = $this->body->get('category', -1);
    $category = $this->modelCategory->findById($categoryId);
    if ($category == null) {
      $products = $this->modelProduct->getListPaginate($page);
    } else {
    }
    $this->view->products = $products;
    $this->view->render('site.home.index');
  }

  public function getListByAjax()
  {
    $page = $this->body->get('page', 1);
    $products = $this->modelProduct->getListPaginate($page);
    $totalPage = Pagination::getTotalPages($this->modelProduct->getCount());
    $html = $this->view->helper->mapToHtml($products);
    return $this->view->json(['currentPage' => (int)$page, 'totalPage' => $totalPage, 'html' => $html]);
  }

  public function detailProduct($slug)
  {
    $params = explode('.', $slug);
    $id = end($params);
    $product = $this->modelProduct->findDetailById($id);
    if ($product == null) {
      $this->view->notFound('Sản phẩm không tồn tại');
      return;
    }
    $this->view->product = $product;
    $this->view->title = $product->title;
    $this->view->render('site.product.detail');
  }

  public function detailCategory($slug)
  {
    $params = explode('.', $slug);
    $id = end($params);
    $category = $this->modelCategory->findById($id);
    if ($category == null) {
      $this->view->notFound('Danh mục không tồn tại');
      return;
    }
    $page = (int) $this->body->get('page', 1);
    $sort = $this->body->get('sort', 'new');
    $products = $this->modelProduct->getListByCatId($id, $page, $sort);
    $totalProduct = $this->modelProduct->getCountByCatId($id);
    $this->view->products = $products;
    $this->view->currentPage = $page;
    $this->view->totalPage = Pagination::getTotalPages($totalProduct);
    $this->view->countProduct = $totalProduct;
    $this->view->categoryTitle = $category->title;
    $this->view->title = $category->title;
    $this->view->render('site.product.list');
  }

  public function about()
  {
    echo '<br />Day la about';
  }

  public function profile()
  {
    if (!$this->auth->isLoggedIn()) {
      $this->view->redirect('/');
      exit;
    }
    $this->view->title = 'Thông tin tài khoản';
    $this->view->render('site.user.profile');
  }

  public function cart()
  {
    if (!$this->auth->isLoggedIn()) {
      $this->view->redirect('/login');
      exit;
    }
    $cart = $this->modelCart->findCartByUserId($this->auth->id());
    if ($cart !== null) {
      $cart->items = $this->modelCart->findItemsByCartId($cart->id);
    }
    $this->view->cart = $cart;
    $this->view->title = 'Giỏ Hàng';
    $this->view->render('site.user.cart');
  }

  public function checkout()
  {
    if (!$this->auth->isLoggedIn()) {
      $this->view->redirect('/login');
      exit;
    }
    $cart = $this->modelCart->findCartByUserId($this->auth->id());
    if ($cart == null) {
      $this->view->redirect('/cart');
    }
    $cart->items = $this->modelCart->findItemsByCartId($cart->id);
    $this->view->cart = $cart;
    $this->view->address = $this->modelAddress->getAddressById($this->auth->getUser()->address_id)[0];
    $this->view->title = 'Thanh Toán';
    $this->view->render('site.user.checkout');
  }

  public function handleCheckout()
  {
    $cart = $this->modelCart->findCartByUserId($this->auth->id());
    if ($cart == null) {
      $this->view->json(['message' => 'Giỏ hàng trống', 'type' => 'cart-empty'], 400);
      return;
    }

    $fullAddress = $this->body->post('address') . ", " .
      $this->body->post('ward') . ", " .
      $this->body->post('district') . ", " .
      $this->body->post('province');

    $countOrder = $this->modelOrder->getCount();
    $orderNumber = Util::generateOrderNumber($countOrder);
    $firstname = $this->body->post('firstname');
    $lastname = $this->body->post('lastname');
    $telephone = $this->body->post('telephone');
    $email = $this->body->post('email');
    $note = $this->body->post('note', '');
    $status = 'new';

    $this->modelOrder->save(
      [
        $orderNumber,
        $firstname,
        $lastname,
        $fullAddress,
        $telephone,
        $email,
        $note,
        $cart->total,
        $status,
        $this->auth->id()
      ]
    );
    $cartItems = $this->modelCart->findItemsByCartId($cart->id);
    $order = $this->modelOrder->getLastestOrder($this->auth->id());

    foreach ($cartItems as $item) {
      $this->modelOrderItem->save([
        $order->id,
        $item->product_id,
        $item->quantity,
        $item->quantity * $item->product_price,
      ]);
    }
    $this->modelCart->updateCart(['inactive', $cart->id]);
    $this->session->set('order-success', true);
    $this->view->json(['message' => 'Đặt hàng thành công'], 200);
  }

  public function orderSuccess()
  {
    if ($this->session->has('order-success')) {
      $this->session->remove('order-success');
      $this->view->title = 'Đặt Hàng Thành Công';
      $this->view->render('site.order.success');
    } else {
      $this->view->redirect('/order');
    }
  }

  public function orderList()
  {
    $orders = $this->modelOrder->getListOrderByUserId($this->auth->id());
    if (count($orders) > 0) {
      foreach ($orders as $order) {
        $order->titles = $this->modelOrderItem->getListProductTitle($order->id);
      }
    }
    $this->view->orders = $orders;
    $this->view->title = 'Danh Sách Đơn Đặt Hàng';
    $this->view->render('site.order.list');
  }

  public function orderDetail($id)
  {
    $order =  $this->modelOrder->findById($id);
    if ($order != null) {
      $order->items = $this->modelOrderItem->getListByOrderId($order->id);
    }
    $this->view->order = $order;
    $this->view->title = 'Chi Tiết Đơn Đặt Hàng';
    $this->view->render('site.order.detail');
  }
}
