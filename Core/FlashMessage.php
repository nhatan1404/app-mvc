<?php

namespace Core;

class FlashMessage
{
  public const FLASH = 'FLASH_MESSAGES';
  public const FLASH_ERROR = 'danger';
  public const FLASH_WARNING = 'warning';
  public const FLASH_INFO = 'info';
  public const FLASH_SUCCESS = 'success';

  public static function create(string $name, string $message, string $type)
  {
    if (isset($_SESSION[self::FLASH][$name])) {
      unset($_SESSION[self::FLASH][$name]);
    }
    $_SESSION[self::FLASH][$name] = ['message' => $message, 'type' => $type];
  }

  public static function flash(string $name = '', string $message = '', string $type = '')
  {
    if ($name !== '' && $message !== '' && $type !== '') {
      self::create($name, $message, $type);
    } elseif ($name !== '' && $message === '' && $type === '') {
      self::display($name);
    }
  }

  private static function format(array $flashMessage): string
  {
    return sprintf(
      '<div class="alert-dismissable fade show alert alert-%s"> <button class="close" data-dismiss="alert" aria-label="Close">×</button>%s</div>',
      $flashMessage['type'],
      $flashMessage['message']
    );
  }


  private static function display(string $name): void
  {
    if (!isset($_SESSION[self::FLASH][$name])) {
      return;
    }
    $message = $_SESSION[self::FLASH][$name];

    unset($_SESSION[self::FLASH][$name]);

    echo self::format($message);
  }
}
