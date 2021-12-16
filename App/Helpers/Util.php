<?php

namespace App\Helpers;

class Util
{
  public static function generateOrderNumber($last_id)
  {
    return '#' . str_pad($last_id + 1, 10, "0", STR_PAD_LEFT);
  }
}
