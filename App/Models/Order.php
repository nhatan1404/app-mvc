<?php

namespace App\Models;

use Core\Model;
use Core\Pagination;

class Order extends Model
{

  public function getCount()
  {
    $query = 'select count(id) as total from orders';
    $data = $this->selectQuery($query)[0];
    return $data->total;
  }

  public function getAll(): array
  {
    $query = 'select * from orders';
    try {
      return $this->selectQuery($query);
    } catch (\PDOException $ex) {
      return [];
    }
  }
  public function getListPaginate($page)
  {
    $total = $this->getCount();
    $start = Pagination::getStart($total, $page);
    $limit = NUMBER_PER_PAGE;
    return $this->selectQuery("select * from orders limit $start, $limit");
  }

  public function getLastestOrder($userId)
  {
    $query = 'select * from orders where user_id = ? order by id desc limit 1';
    try {
      $data  = $this->selectQuery($query, [$userId]);
      return count($data) != 0 ? $data[0] : null;
    } catch (\PDOException $ex) {
      return null;
    }
  }

  public function getListOrderByUserId($userId)
  {
    $query = 'select * from orders where user_id = ? order by id desc';
    try {
      return $this->selectQuery($query, [$userId]);
    } catch (\PDOException $ex) {
      return [];
    }
  }

  public function findById(int $id)
  {
    $query = 'select orders.*, count(order_details.product_id) as count from orders join order_details on orders.id = order_details.order_id where orders.id = ?';
    try {
      $data = $this->selectQuery($query, [$id]);
      return count($data) != 0 ? $data[0] : null;
    } catch (\PDOException $ex) {
      return null;
    }
  }

  public function save(array $data): int
  {
    $params = $this->createBindParams($data);
    $query = "insert into orders(order_number, firstname, lastname, address, telephone, email, note, total, status, user_id) values($params)";
    try {
      return $this->updateQuery($query, $data);
    } catch (\PDOException $ex) {
      return -1;
    }
  }

  public function update(array $data): int
  {
    $query = "update orders set status = ?, note = ? where id = ?";
    try {
      return $this->updateQuery($query, $data);
    } catch (\PDOException $ex) {
      var_dump($ex);
      die();
      return -1;
    }
  }
}
