<?php

namespace App\Helpers;

class Util
{
  public static function generateOrderNumber(int $lastId)
  {
    return '#' . str_pad($lastId + 1, 10, "0", STR_PAD_LEFT);
  }
}
