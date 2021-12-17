<?php

namespace App\Models;

use Core\Model;

class OrderItem extends Model
{

  public function save(array $data): int
  {
    $params = $this->createBindParams($data);
    $query = "insert into order_details(order_id, product_id, quantity, price) values($params)";
    try {
      return $this->updateQuery($query, $data);
    } catch (\PDOException $ex) {
      return -1;
    }
  }

  public function getListByOrderId($orderId): array
  {
    $query = 'select order_details.*, products.title as product_title, products.images as product_images ,products.price as product_price, categories.title as category
    from order_details left join products on order_details.product_id = products.id left join categories on categories.id = products.category_id  where order_id = ?';
    try {
      return $this->selectQuery($query, [$orderId]);
    } catch (\PDOException $ex) {
      return null;
    }
  }

  public function getListProductTitle($orderId): array
  {
    $query = 'select title from order_details join products on order_details.product_id = products.id where order_id = ?';
    try {
      return $this->selectQuery($query, [$orderId]);
    } catch (\PDOException $ex) {
      return null;
    }
  }
}
