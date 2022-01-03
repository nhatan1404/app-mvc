<?php

namespace App\Controllers;

use Core\Controller;
use Core\FlashMessage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
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
    $this->modelUser = new User();
    $this->modelOrderItem = new OrderItem();
  }

  public function index(): void
  {
    $page = $this->body->get('page', 1);
    $products = $this->modelProduct->getListPaginate($page);
    $this->view->products = $products;
    $this->view->render('site.home.index');
  }

  public function getListByAjax(): void
  {
    $page = (int) $this->body->get('page', 1);
    $products = $this->modelProduct->getListPaginate($page);
    $totalPage = Pagination::getTotalPages($this->modelProduct->getCount());
    $html = $this->view->helper->mapToHtml($products);
    $this->view->json(['currentPage' => (int)$page, 'totalPage' => $totalPage, 'html' => $html]);
  }

  public function getAllProduct(): void
  {
    $page = (int) $this->body->get('page', 1);
    $sort = $this->body->get('sort', 'new');
    $products = $this->modelProduct->getListPaginate($page, $sort);
    $totalProduct = $this->modelProduct->getCount();
    $this->view->products = $products;
    $this->view->currentPage = $page;
    $this->view->totalPage = Pagination::getTotalPages($totalProduct);
    $this->view->countProduct = $totalProduct;
    $this->view->title = 'Tất cả sản phẩm';
    $this->view->render('site.product.list-all');
  }

  public function searchProduct(): void
  {
    $page = (int) $this->body->get('page', 1);
    $sort = $this->body->get('sort', 'new');
    $keyword = $this->body->get('keyword');
    $keyword = trim(htmlspecialchars($keyword));
    $products = $this->modelProduct->getListSearch($page, $keyword, $sort);
    $totalProduct = $this->modelProduct->getCountSearch($keyword);
    $this->view->products = $products;
    $this->view->currentPage = $page;
    $this->view->totalPage = Pagination::getTotalPages($totalProduct);
    $this->view->countProduct = $totalProduct;
    $this->view->title = 'Tìm kiếm sản phẩm - ' . $keyword;
    $this->view->render('site.product.list-search');
  }

  public function detailProduct(string $slug): void
  {
    $params = explode('.', $slug);
    $id = (int) end($params);
    $product = $this->modelProduct->findDetailById($id);

    if ($product == null) {
      $this->view->notFound('Sản phẩm không tồn tại');
    }

    $this->view->product = $product;
    $this->view->title = $product->title;
    $this->view->render('site.product.detail');
  }

  public function detailCategory(string $slug): void
  {
    $params = explode('.', $slug);
    $id = (int) end($params);
    $category = $this->modelCategory->findById($id);

    if ($category == null) {
      $this->view->notFound('Danh mục không tồn tại');
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
    $this->view->render('site.product.list-by-category');
  }

  public function about(): void
  {
    $this->view->title = 'Giới thiệu';
    $this->view->render('site.home.about');
  }

  public function contact(): void
  {
    $this->view->title = 'Liên hệ';
    $this->view->render('site.home.contact');
  }

  public function profile(): void
  {
    if (!$this->auth->isLoggedIn()) {
      $this->view->redirect('/');
    }

    $user = $this->modelUser->findById($this->auth->id());

    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
    }

    $this->view->user = $user;
    $this->view->title = 'Thông tin tài khoản';
    $this->view->render('site.user.profile');
  }

  public function updateProfile(): void
  {
    if (!$this->auth->isLoggedIn()) {
      $this->view->redirect('/');
    }

    $user = $this->modelUser->findById($this->auth->id());

    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
    }

    $firstname = $this->body->post('firstname');
    $lastname = $this->body->post('lastname');
    $email = $this->body->post('email');
    $telephone = $this->body->post('telephone');
    $address = $this->body->post('address');
    $province = $this->body->post('province');
    $district = $this->body->post('district');
    $ward = $this->body->post('ward');

    $this->validator->name('firstname')->value($firstname)->label('Tên')->string()->required();
    $this->validator->name('lastname')->value($lastname)->label('Họ')->string()->required();
    $this->validator->name('email')->value($email)->label('Email')->string()->email()->required();
    $this->validator->name('telephone')->value($telephone)->label('Số điện thoại')->string()->phone()->required();
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
      $this->view->redirect('/profile');
    }

    $rowCountUser = $this->modelUser->updateProfile([$firstname, $lastname, $email, $telephone, $this->auth->id()]);
    $rowCountAddress = $this->modelAddress->update([$address, $province, $district, $ward, (int)$user->address_id]);

    if ($rowCountUser > 0 || $rowCountAddress > 0) {
      $this->view->createFlashMsg('success', 'Cập nhật tài khoản thành công', FlashMessage::FLASH_SUCCESS);
    } else if ($rowCountUser == -1 || $rowCountAddress == -1) {
      $this->view->createFlashMsg('error', 'Cập nhật tài khoản không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/profile');
  }

  public function updatePassword(int $id): void
  {
    $user = $this->modelUser->findById($id);

    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
    }

    $oldpassword = $this->body->post('oldpassword');
    $password = $this->body->post('password-modal');
    $repassword = $this->body->post('repassword-modal');

    $this->validator->name('oldpassword')->value($oldpassword)->label('Mật khẩu hiện tại')->string()->required();
    $this->validator->name('password')->value($password)->label('Mật khẩu')->string()->equal($repassword)->minLen(8)->required();
    $this->validator->name('repassword')->value($repassword)->label('Mật khẩu xác nhận')->string()->equal($password)->minLen(8)->required();

    if (!$this->validator->isValid()) {
      $message = ($this->validator->hasError('oldpassword') ?  $this->validator->getError('oldpassword') :  'Mật khẩu không khớp hoặc không đủ 8 ký tự');
      $this->view->createFlashMsg('error', $message, FlashMessage::FLASH_ERROR);
      $this->view->redirect('/profile');
    }

    $isVerified = password_verify($oldpassword, $user->password);

    if (!$isVerified) {
      $this->view->createFlashMsg('error', 'Mật khẩu hiện tại không chính xác', FlashMessage::FLASH_ERROR);
      $this->view->redirect('/profile');
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $rowCount = $this->modelUser->updatePassword([$password, $id]);

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Đổi mật khẩu tài khoản thành công', FlashMessage::FLASH_SUCCESS);
    } else if ($rowCount == -1) {
      $this->view->createFlashMsg('error', 'Đổi mật khẩu tài khoản không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/profile');
  }

  public function updateAvatar(int $id): void
  {
    $user = $this->modelUser->findById($id);
    if ($user == null) {
      $this->view->notFound('Tài khoản không tồn tại');
    }

    $avatar = $this->body->file('avatar');

    $this->validator->name('avatar')->file($avatar)->label('Ảnh đại diện')->image()->required();

    if (!$this->validator->isValid()) {
      $this->view->createFlashMsg('error', $this->validator->getError('avatar'), FlashMessage::FLASH_ERROR);
      $this->view->redirect('/profile');
    }

    $avatar = $this->body->upload('avatar');
    $rowCount = $this->modelUser->updateAvatar([$avatar, $id]);

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Đổi ảnh đại diện thành công', FlashMessage::FLASH_SUCCESS);
    } else if ($rowCount == -1) {
      if (!$this->body->isEmptyFile('avatar')) {
        unlink($avatar);
      }
      $this->view->createFlashMsg('error', 'Đổi ảnh đại diện không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/profile');
  }

  public function cart(): void
  {
    if (!$this->auth->isLoggedIn()) {
      $this->view->redirect('/login');
    }

    $cart = $this->modelCart->findCartByUserId($this->auth->id());

    if ($cart !== null) {
      $cart->items = $this->modelCart->findItemsByCartId($cart->id);
    }

    $this->view->cart = $cart;
    $this->view->title = 'Giỏ Hàng';
    $this->view->render('site.user.cart');
  }

  public function checkout(): void
  {
    if (!$this->auth->isLoggedIn()) {
      $this->view->redirect('/login');
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

  public function handleCheckout(): void
  {
    if (!$this->auth->isLoggedIn()) {
      http_response_code(401);
      die();
    }

    $cart = $this->modelCart->findCartByUserId($this->auth->id());

    if ($cart == null) {
      $this->view->json(['message' => 'Giỏ hàng trống', 'type' => 'cart-empty'], 400);
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

    $this->modelOrder->save([
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
    ]);
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

  public function orderSuccess(): void
  {
    if (!$this->auth->isLoggedIn()) {
      $this->view->redirect('/login');
    }
    if ($this->session->has('order-success')) {
      $this->session->remove('order-success');
      $this->view->title = 'Đặt Hàng Thành Công';
      $this->view->render('site.order.success');
    } else {
      $this->view->redirect('/order');
    }
  }

  public function orderList(): void
  {
    if (!$this->auth->isLoggedIn()) {
      $this->view->redirect('/login');
    }

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

  public function orderDetail(int $id): void
  {
    if (!$this->auth->isLoggedIn()) {
      $this->view->redirect('/login');
    }

    $order =  $this->modelOrder->findById($id);

    if ($order != null) {
      $order->items = $this->modelOrderItem->getListByOrderId($order->id);
    }

    $this->view->order = $order;
    $this->view->title = 'Chi Tiết Đơn Đặt Hàng';
    $this->view->render('site.order.detail');
  }
}
