<?php

namespace App\Models;

use Core\Model;
use PDOException;

class Cart extends Model
{
  public function save(array $data): int
  {
    $params = $this->createBindParams($data);
    $query = "insert into carts(user_id, status) values ($params)";
    try {
      return $this->updateQuery($query, $data);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function saveItem(array $data): int
  {
    $params = $this->createBindParams($data);
    $query = "insert into cart_items(cart_id, product_id, quantity) values ($params)";
    try {
      return $this->updateQuery($query, $data);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function findCartByUserId(int $userId)
  {
    $query = "select id, user_id, count, total from carts where user_id = ? and status = 'active'";
    try {
      $data =  $this->selectQuery($query, [$userId]);
      return count($data) != 0 ? $data[0] : null;
    } catch (PDOException $ex) {
      return null;
    }
  }

  public function findItemsByCartId(int $cartId): array
  {
    $query = "select cart_items.*, products.title as product_title, products.images as product_images ,products.price as product_price 
    from cart_items left join products on cart_items.product_id = products.id where cart_id = ?";
    try {
      return $this->selectQuery($query, [$cartId]);
    } catch (PDOException $ex) {
      return null;
    }
  }

  public function findItem(array $data)
  {
    $query = "select * from cart_items where cart_id = ? and product_id = ?";
    try {
      $data =  $this->selectQuery($query, $data);
      return count($data) != 0 ? $data[0] : null;
    } catch (PDOException $ex) {
      return null;
    }
  }

  public function findItemById($itemId)
  {
    $query = "select cart_items.*, products.title as product_title, products.images as product_images ,products.price as product_price ,products.quantity as product_quantity 
    from cart_items left join products on cart_items.product_id = products.id where cart_items.id = ?";
    try {
      $data =  $this->selectQuery($query, [$itemId]);
      return count($data) != 0 ? $data[0] : null;
    } catch (PDOException $ex) {
      return null;
    }
  }

  public function updateQuantityItem(array $data): int
  {
    $query = "update cart_items set quantity = ? where id = ? ";
    try {
      return $this->updateQuery($query, $data);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function updateCart(array $data): int
  {
    $query = "update carts set status = ? where id = ? ";
    try {
      return $this->updateQuery($query, $data);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function removeItemById(int $itemId)
  {
    $query = 'delete from cart_items where id = ?';
    try {
      return $this->updateQuery($query, [$itemId]);
    } catch (PDOException $ex) {
      return -1;
    }
  }
}
