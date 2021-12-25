<?php

namespace App\Controllers;

use Core\Controller;
use Core\Formatter;
use Core\FlashMessage;
use Core\Pagination;
use App\Models\Category;

class CategoryController extends Controller
{
  public function __construct()
  {
    parent::__construct();

    if (!$this->auth->isLoggedIn() || !$this->auth->isAdmin()) {
      $this->view->redirect('/');
    }

    $this->modelCategory = new Category();
  }

  public function index(): void
  {
    $page = $this->body->get('page', 1);
    $this->view->categories = $this->modelCategory->getListPaginate($page);
    $this->view->currentPage = $page;
    $this->view->totalPage = Pagination::getTotalPages($this->modelCategory->getCount());
    $this->view->title = 'Danh sách danh mục';
    $this->view->render('admin.category.index');
  }


  public function create(): void
  {
    $this->view->categories = $this->modelCategory->getListParentCategory();
    $this->view->title = 'Tạo danh mục';
    $this->view->render('admin.category.create');
  }


  public function store(): void
  {
    $title = $this->body->post('title');
    $description = $this->body->post('description');
    $parrent_id = (int) $this->body->post('parent_id');

    $this->validator->name('title')->value($title)->label('Tên danh mục')->string()->minLen(2)->required();

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/category/create');
    }

    $slug = Formatter::slugify($title);
    $rowCount = $this->modelCategory->save([$title, $description, $slug, $parrent_id]);

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Tạo danh mục thành công', FlashMessage::FLASH_SUCCESS);
    } else {
      $this->view->createFlashMsg('error', 'Tạo danh mục không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/category');
  }

  public function show(int $id): void
  {
    $category = $this->modelCategory->findById($id);

    if ($category == null) {
      $this->view->notFound('Danh mục không tồn tại');
    }
    $this->view->category = $category;
    $this->view->title = 'Chi tiết danh mục';
    $this->view->render('admin.category.detail');
  }

  public function edit(int $id): void
  {
    $category = $this->modelCategory->findById($id);

    if ($category == null) {
      $this->view->notFound('Danh mục không tồn tại');
    }

    $this->view->categories = $this->modelCategory->getListParentCategory();
    $this->view->category = $category;
    $this->view->render('admin.category.edit');
  }

  public function update(int $id): void
  {
    $category = $this->modelCategory->findById($id);

    if ($category == null) {
      $this->view->notFound('Danh mục không tồn tại');
    }

    $title = $this->body->post('title');
    $description = $this->body->post('description');
    $parrent_id = (int) $this->body->post('parent_id');

    $this->validator->name('title')->value($title)->label('Tên danh mục')->string()->minLen(2)->required();

    if (!$this->validator->isValid()) {
      $this->session->set($this->view->validation(), $this->validator->getErrors());
      $this->view->redirect('/admin/category/' . $id . '/edit');
    }

    $rowCount = $this->modelCategory->update([$title, $description, $parrent_id, $id]);

    if ($rowCount > 0) {
      $this->view->createFlashMsg('success', 'Cập nhật danh mục thành công', FlashMessage::FLASH_SUCCESS);
    } else if ($rowCount == -1) {
      $this->view->createFlashMsg('error', 'Cập nhật danh mục không thành công',  FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/category');
  }

  public function destroy(int $id): void
  {
    $isDeleted = $this->modelCategory->remove($id) > 0;

    if ($isDeleted) {
      $this->view->createFlashMsg('success', 'Xoá danh mục thành công', FlashMessage::FLASH_SUCCESS);
    } else {
      $this->view->createFlashMsg('error', 'Xoá danh mục không thành công', FlashMessage::FLASH_ERROR);
    }
    $this->view->redirect('/admin/category');
  }
}
