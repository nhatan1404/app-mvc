<?php

namespace App\Controllers;

use Core\Controller;
use Core\Formatter;
use Core\FlashMessage;
use Core\Pagination;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
  private $modelProduct;

  public function __construct()
  {
    parent::__construct();
    if (!$this->auth->isLoggedIn() || !$this->auth->isAdmin()) {
      $this->view->redirect('/');
      exit;
    }
    $this->modelProduct = new Product();
    $this->modelCategory = new Category();
  }

  public function index()
  {
    $page = $this->body->get('page', 1);
    $this->view->products = $this->modelProduct->getListPaginate($page);
    $this->view->currentPage = $page;
    $this->view->totalPage = Pagination::getTotalPages($this->modelProduct->getCount());
    $this->view->title = 'Danh sách sản phẩm';
    $this->view->render('admin.product.index');
  }


  public function create()
  {
    $parentCat = $this->modelCategory->getListParentCategory();
    foreach ($parentCat as $parent) {
      $parent->child = $this->modelCategory->getListChildByParentId($parent->id);
    }
    $this->view->categories = $parentCat;
    $this->view->title = 'Tạo sản phẩm';
    $this->view->render('admin.product.create');
  }


  public function store()
  {
    $title = $this->body->post('title');
    $description = $this->body->post('description');
    $quantity = $this->body->post('quantity');
    $status = $this->body->post('status');
    $price = $this->body->post('price');
    $discount = (int) $this->body->post('discount');
    $images = $this->body->file('images');
    $category_id =  $this->body->post('category_id');
    $this->validator->name('title')->label('Tên sản phẩm')->value($title)->string()->required();
    $this->validator->name('description')->label('Loại')->value($description)->string()->required();
    $this->validator->name('quantity')->label('Số lượng')->value($quantity)->number()->required();
    $this->validator->name('status')->label('Trạng thái')->value($status)->string()->required();
    $this->validator->name('price')->label('Giá')->value($price)->number()->required();
    $this->validator->name('discount')->label('Chiết khấu')->value($discount)->default(0)->number()->min(0)->max(100)->required();
    $this->validator->name('images')->label('Ảnh')->file($images)->required();
    $this->validator->name('category_id')->label('Danh mục')->value($category_id)->number()->required();
    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/product/create');
    }

    $images = $this->body->upload('images');

    $slug = Formatter::slugify($title);
    $rowCount = $this->modelProduct->save([$title, $description, (int)$quantity, $status, $slug, $images, (int)$price, (int)$discount, (int)$category_id]);

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Tạo sản phẩm thành công', FlashMessage::FLASH_SUCCESS);
    } else {
      unlink($images);
      $this->view->createFlashMsg('error', 'Tạo sản phẩm không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/product');
  }

  public function show($id): void
  {
    $product = $this->modelProduct->findById($id);
    if ($product == null) {
      $this->view->notFound('Sản phẩm không tồn tại');
      return;
    }
    $this->view->product = $product;
    $this->view->title = 'Chi tiết sản phẩm';
    $this->view->render('admin.product.detail');
  }

  public function edit($id): void
  {
    $product = $this->modelProduct->findById($id);
    if ($product == null) {
      $this->view->notFound('Sản phẩm không tồn tại');
      return;
    }
    $parentCat = $this->modelCategory->getListParentCategory();
    foreach ($parentCat as $parent) {
      $parent->child = $this->modelCategory->getListChildByParentId($parent->id);
    }
    $this->view->categories = $parentCat;
    $this->view->product = $product;
    $this->view->render('admin.product.edit');
  }

  public function update($id)
  {
    $product = $this->modelProduct->findById($id);
    if ($product == null) {
      $this->view->notFound('Sản phẩm không tồn tại');
      return;
    }
    $title = $this->body->post('title');
    $description = $this->body->post('description');
    $quantity = (int) $this->body->post('quantity');
    $status = $this->body->post('status');
    $price = (int) $this->body->post('price');
    $sold = (int) $this->body->post('sold');
    $discount = (int) $this->body->post('discount');
    $images = $this->body->file('images');
    $category_id = (int) $this->body->post('category_id');
    $this->validator->name('title')->label('Tên sản phẩm')->value($title)->string()->required();
    $this->validator->name('description')->label('Loại')->value($description)->string()->required();
    $this->validator->name('quantity')->label('Số lượng')->value($quantity)->number()->required();
    $this->validator->name('status')->label('Trạng thái')->value($status)->string()->required();
    $this->validator->name('price')->label('Giá')->value($price)->number()->required();
    $this->validator->name('discount')->label('Chiết khấu')->value($discount)->default(0)->number()->min(0)->max(100)->required();
    //$this->validator->name('images')->label('Ảnh')->file($images)->required();
    $this->validator->name('category_id')->label('Danh mục')->value($category_id)->number()->required();

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/product/' . $id . '/edit');
    }

    if ($images == null) {
      $images = $product->images;
    } else {
      $images = $this->body->upload('images');
    }

    $rowCount = $this->modelProduct->update([$title, $description, $quantity, $status, $images, $sold, $price, $discount, $category_id, $product->id]);

    if ($rowCount > 0) {
      if (!$this->body->isEmptyFile('images')) {
        if ($this->view->isLocalImage($product->images) && file_exists($product->images)) {
          unlink($product->images);
        }
      }
      $this->view->createFlashMsg('success', 'Cập nhật sản phẩm thành công', FlashMessage::FLASH_SUCCESS);
    } else if ($rowCount == -1) {
      if (!$this->body->isEmptyFile('images')) {
        unlink($images);
      }
      $this->view->createFlashMsg('error', 'Cập nhật sản phẩm không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/product');
  }

  public function destroy(int $id)
  {
    $product = $this->modelProduct->findById($id);
    if ($product == null) {
      $this->view->notFound('Sản phẩm không tồn tại');
      return;
    }
    $isDeleted = $this->modelProduct->remove($id) > 0;
    if ($isDeleted) {
      if ($this->view->isLocalImage($product->images) && file_exists($product->images)) {
        unlink($product->images);
      }
      $this->view->createFlashMsg('success', 'Xoá sản phẩm thành công', FlashMessage::FLASH_SUCCESS);
    } else {
      $this->view->createFlashMsg('error', 'Xoá sản phẩm không thành công', FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/product');
  }
}
