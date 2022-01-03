<?php

namespace App\Models;

use Core\Model;

class Auth extends Model
{
  public function findDetailLogin($email)
  {
    $query = "select id, email, password from users where email = ? and status = 'active'";
    try {
      $data = $this->selectQuery($query, [$email]);
      return count($data) != 0 ? $data[0] : null;
    } catch (\PDOException $ex) {
      return null;
    }
  }

  public function updateToken(int $id, string $token)
  {
    $query = 'update users set remember_token = ? where id = ?';
    try {
      return $this->updateQuery($query, [$token, $id]);
    } catch (\PDOException $ex) {
      return -1;
    }
  }

  public function getUserByToken(string $token)
  {
    $query = 'select * from users where remember_token = ?';
    try {
      return $this->selectQuery($query, [$token]);
    } catch (\PDOException $ex) {
      return null;
    }
  }
}
