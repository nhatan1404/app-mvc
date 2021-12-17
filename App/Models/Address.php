<?php

namespace App\Models;

use Core\Model;
use PDOException;

class Address extends Model
{
  public function getAddressById(int $id)
  {
    $query = 'select * from address where id = ?';
    return $this->selectQuery($query, [$id]);
  }

  public function getListProvinces(): array
  {
    $query = 'select * from provinces';
    return $this->selectQuery($query);
  }

  public function getListDistricts(string $provinceId)
  {
    $query = 'select * from districts where parent_code = ?';
    return $this->selectQuery($query, [$provinceId]);
  }

  public function getListWards(string $districtId): array
  {
    $query = 'select * from wards where parent_code = ?';
    return $this->selectQuery($query, [$districtId]);
  }

  public function save(array $data): int
  {
    $params = $this->createBindParams($data);
    $query  = "insert into address(address, province_id, district_id, ward_id) values ($params)";
    try {
      return $this->updateQuery($query, $data, true);
    } catch (PDOException $ex) {
      return -1;
    }
  }

  public function update(array $data): int
  {
    $query  = "update address set address = ?, province_id = ?, district_id = ?, ward_id = ? where id = ?";
    try {
      return $this->updateQuery($query, $data);
    } catch (PDOException $ex) {
      return -1;
    }
  }
}
