<?php

namespace App\Models;

use Core\Model;
use Core\Pagination;
use PDOException;
use stdClass;

class Product extends Model
{
  public function getCount()
  {
    $query = 'select count(id) as total from products';
    $data = $this->selectQuery($query)[0];
    return $data->total;
  }

  public function getCountByCatId($id)
  {
    $category = $this->selectQuery("select parent_id from categories where id = ? limit 1", [$id])[0];
    $query = 'select count(id) as total from products where category_id = ?';
    $params = [$id];
    if ($category->parent_id == null) {
      $childIds = array_map(
        function (stdClass $value): int {
          return $value->id;
        },
        $this->getListChildCatId($id)
      );
      $valueIn = $this->createBindParams($childIds);
      $query = "select count(id) as total from products where category_id in ($valueIn)";
      $params = $childIds;
    }
    $data = $this->selectQuery($query, $params)[0];
    return $data->total;
  }

  public function getAll(): array
  {
    $query = 'select products.*, categories.title as category from products left join categories on products.category_id = categories.id order by products.id desc';
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
    return $this->selectQuery("select products.*, categories.title as category from products left join categories on products.category_id = categories.id order by products.id desc limit $start, $limit");
  }

  public function getListByCatId($id, $page, $sort = 'new')
  {
    $total = $this->getCountByCatId($id);
    $start = Pagination::getStart($total, $page);
    $limit = NUMBER_PER_PAGE;
    $category = $this->selectQuery("select parent_id from categories where id = ? limit 1", [$id])[0];
    $orderBy = $this->orderBy($sort);
    $query = "select products.*, categories.title as category from products left join categories on products.category_id = categories.id where products.category_id = ? $orderBy limit $start, $limit";
    $params = [$id];
    if ($category->parent_id == null) {
      $childIds = array_map(
        function (stdClass $value): int {
          return $value->id;
        },
        $this->getListChildCatId($id)
      );
      $valueIn = $this->createBindParams($childIds);
      $query = "select products.*, categories.title as category from products left join categories on products.category_id = categories.id where products.category_id in ($valueIn) $orderBy limit $start, $limit";
      $params = $childIds;
    }
    return $this->selectQuery($query, $params);
  }

  private function getListChildCatId($id)
  {
    $query = 'select id from categories where parent_id = ?';
    return $this->selectQuery($query, [$id]);
  }

  public function findById($id)
  {
    $query = 'select * from products where id = ?';
    try {
      $data = $this->selectQuery($query, [$id]);
      return count($data) != 0 ? $data[0] : null;
    } catch (PDOException $ex) {
      return null;
    }
  }

  public function findDetailById($id)
  {
    $query = 'select products.*, categories.title as category_title, categories.id as category_id, categories.slug as category_slug  
    from products left join categories on products.category_id = categories.id where products.id = ?';
    try {
      $data = $this->selectQuery($query, [$id]);
      return count($data) != 0 ? $data[0] : null;
    } catch (PDOException $ex) {
      return null;
    }
  }

  public function getListRelated(int $limit)
  {
    $query = "select products.*, categories.title as category from products left join categories on products.category_id = categories.id order by rand() limit 0, $limit";
    return $this->selectQuery($query);
  }

  public function getListLastest(int $limit)
  {
    $query = "select products.*, categories.title as category from products left join categories on products.category_id = categories.id order by id desc limit 0, $limit";
    return $this->selectQuery($query);
  }

  public function getListLastestDiscount(int $limit)
  {
    $query = "select products.*, categories.title as category from products left join categories on products.category_id = categories.id where products.discount > 0 order by id desc limit 0, $limit";
    return $this->selectQuery($query);
  }

  public function save(array $product): int
  {
    $query = 'insert into products(title, description, quantity, status, slug, images, price, discount, category_id) values (?, ?, ?, ?, ?, ?, ?, ?, ?)';
    try {
      return $this->updateQuery($query, $product);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function update(array $product): int
  {
    $query = 'update products set title = ?, description = ?, quantity = ?, status = ?, images = ?, sold = ?, price = ?, discount = ?, category_id = ? where id = ?';
    try {
      return $this->updateQuery($query, $product);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function remove($id): int
  {
    $query = 'delete from products where id = ?';
    try {
      return $this->updateQuery($query, [$id]);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  private function orderBy(string $key): string
  {
    $orderBy = [
      'new' => 'order by products.id desc',
      'old' => 'order by products.id asc',
      'lowPrice' => 'order by products.price asc',
      'highPrice' => 'order by products.price desc'
    ];
    return isset($orderBy[$key]) ? $orderBy[$key] : $orderBy['new'];
  }
}
