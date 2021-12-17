<?php

namespace Core;

use Core\Database;

class Model
{
  protected $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  protected function selectQuery(string $query, array $params = []): array
  {
    $stm = $this->db->getConnection()->prepare($query);
    $stm->execute($params);
    $data = $stm->fetchAll();
    return $data;
  }

  protected function updateQuery(string $query, array $params = [], bool $isGetLastId = false): int
  {
    $stm = $this->db->getConnection()->prepare($query);
    $stm->execute($params);
    return !$isGetLastId ? $stm->rowCount() : $this->db->getConnection()->lastInsertId();
  }

  protected function createBindParams(array $data): string
  {
    return str_repeat('?, ',  count($data) - 1) . '?';
  }
}
