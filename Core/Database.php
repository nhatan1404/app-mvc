<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
  private static $connection = null;

  public function __construct()
  {
    if (!$this->isConnected()) {
      $this->connect();
    }
  }

  private function isConnected()
  {
    return static::$connection instanceof PDO;
  }

  private function connect()
  {
    try {
      static::$connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
      static::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      static::$connection->exec('SET NAMES UTF8');
    } catch (PDOException $ex) {
      die($ex->getMessage());
    }
  }

  public function getConnection()
  {
    return static::$connection;
  }
}