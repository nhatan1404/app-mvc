<?php

namespace App\Models;

use Core\Model;
use Core\Pagination;
use PDOException;

class Coupon extends Model
{
  public function getCount()
  {
    $query = 'select count(id) as total from coupons';
    $data = $this->selectQuery($query)[0];
    return $data->total;
  }

  public function getAll(): array
  {
    $query = 'select * from coupons';
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
    return $this->selectQuery("select * from coupons limit $start, $limit");
  }

  public function findById($id)
  {
    $query = 'select * from coupons where id = ?';
    try {
      $data = $this->selectQuery($query, [$id]);
      return count($data) != 0 ? $data[0] : null;
    } catch (PDOException $ex) {
      return null;
    }
  }

  public function save(array $category): int
  {
    $query = 'insert into coupons(code, type, value, status) values (?, ?, ?, ?)';
    try {
      return $this->updateQuery($query, $category);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function update(array $category): int
  {
    $query = 'update coupons set code = ?, type = ?, value = ? , status = ? where id = ?';
    try {
      return $this->updateQuery($query, $category);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function remove($id): int
  {
    $query = 'delete from coupons where id = ?';
    try {
      return $this->updateQuery($query, [$id]);
    } catch (PDOException $ex) {
      return -1;
    }
  }
}
