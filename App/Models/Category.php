<?php

namespace App\Models;

use Core\Model;
use Core\Pagination;
use PDOException;

class Category extends Model
{
  public function getCount()
  {
    $query = 'select count(id) as total from categories';
    $data = $this->selectQuery($query)[0];
    return $data->total;
  }

  public function getAll(): array
  {
    $query = 'select * from categories';
    try {
      return $this->selectQuery($query);
    } catch (PDOException $ex) {
      return [];
    }
  }

  public function getListPaginate($page)
  {
    $total = $this->getCount();
    $start = Pagination::getStart($total, $page);
    $limit = NUMBER_PER_PAGE;
    return $this->selectQuery("select * from categories limit $start, $limit");
  }

  public function getListParentCategory(): array
  {
    $query = 'select * from categories where parent_id is null';
    try {
      return $this->selectQuery($query);
    } catch (PDOException $ex) {
      return [];
    }
  }

  public function getListChildrenCategory(): array
  {
    $query = 'select * from categories where parent_id is not null';
    try {
      return $this->selectQuery($query);
    } catch (PDOException $ex) {
      return [];
    }
  }

  public function getListChildByParentId($parentId): array
  {
    $query = 'select * from categories where parent_id = ?';
    try {
      return $this->selectQuery($query, [$parentId]);
    } catch (PDOException $ex) {
      return [];
    }
  }

  public function findById($id)
  {
    $query = 'select cat1.*, cat2.title as parent_title 
              from `categories` cat1 
              left join `categories` cat2 
              on cat2.id = cat1.parent_id where cat1.id = ?';
    try {
      $data = $this->selectQuery($query, [$id]);
      return count($data) != 0 ? $data[0] : null;
    } catch (PDOException $ex) {
      return null;
    }
  }

  public function save(array $category): int
  {
    $query = 'insert into categories(title, description, slug, parent_id) values (?, ?, ?, ?)';
    try {
      return $this->updateQuery($query, $category);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function update(array $category): int
  {
    $query = 'update categories set title = ?, description = ?, parent_id = ? where id = ?';
    try {
      return $this->updateQuery($query, $category);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function remove($id): int
  {
    $query = 'delete from categories where id = ?';
    try {
      return $this->updateQuery($query, [$id]);
    } catch (PDOException $ex) {
      return -1;
    }
  }
}
