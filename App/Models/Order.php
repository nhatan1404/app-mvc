<?php

namespace App\Models;

use Core\Model;

class Order extends Model
{

  public function getCount()
  {
    $query = 'select count(id) as total from orders';
    $data = $this->selectQuery($query)[0];
    return $data->total;
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
    $query = 'select * from orders where id = ?';
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
    $query = "update orders set status = ?, note = ? where id = ?)";
    try {
      return $this->updateQuery($query, $data);
    } catch (\PDOException $ex) {
      return -1;
    }
  }
}
