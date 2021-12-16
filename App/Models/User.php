<?php

namespace App\Models;

use Core\Model;
use Core\Pagination;
use PDOException;

class User extends Model
{
  public function getCount()
  {
    $query = 'select count(id) as total from users';
    $data = $this->selectQuery($query)[0];
    return $data->total;
  }

  public function getAll(): array
  {
    $query = 'select * from users';
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
    return $this->selectQuery("select * from users limit $start, $limit");
  }

  public function findById($id)
  {
    $query = 'select * from users where id = ?';
    try {
      $data = $this->selectQuery($query, [$id]);
      return count($data) != 0 ? $data[0] : null;
    } catch (PDOException $ex) {
      return null;
    }
  }

  public function save(array $user): int
  {
    $params = $this->createBindParams($user);
    $query = "insert into users(firstname, lastname, password, avatar, address_id, email, telephone, role, status)
              values ($params)";
    try {
      return $this->updateQuery($query, $user);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function update(array $user): int
  {
    $query = 'update users set fistname = ?, lastname = ?, avatar = ?, email = ?, telephone = ? role = ?, status = ? where id = ?';
    try {
      return $this->updateQuery($query, $user);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function remove($id): int
  {
    $query = 'delete from users where id = ?';
    try {
      return $this->updateQuery($query, [$id]);
    } catch (PDOException $ex) {
      return -1;
    }
  }
}
