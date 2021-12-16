<?php

namespace Core;

class Pagination
{
  public static function getStart(int $total, int $currentPage): int
  {
    $totalPage = self::getTotalPages($total);

    if (!is_numeric($currentPage) || $currentPage < 1) {
      $currentPage = 1;
    }

    if ($currentPage > $totalPage) {
      $currentPage = $totalPage;
    }

    $start = ($currentPage - 1) * NUMBER_PER_PAGE;
    return $start;
  }

  public static function getTotalPages(int $total): int
  {
    if ($total <= 0) return 1;
    return ceil($total / NUMBER_PER_PAGE);
  }
}
