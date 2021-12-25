<?php

namespace Core;

class Validation
{
  private const TYPE_STRING = 'string';
  private const TYPE_NUMBER = 'number';
  private const TYPE_FILE = 'file';
  private const TYPE_BOOL = 'boolean';

  private $errors = array();

  public function __construct()
  {
  }

  public function label(string $label): self
  {
    $this->label = $label;
    return $this;
  }

  public function name(string $name): self
  {
    $this->name = $name;
    $this->label = ucfirst($name);
    return $this;
  }

  public function value($value): self
  {
    $this->value = $value;
    return $this;
  }

  public function file($file): self
  {
    $this->file = $file;
    $this->type = self::TYPE_FILE;
    return $this;
  }

  public function bool(string $msg = null): self
  {
    if (!is_bool($this->value)) {
      $this->errors[$this->name] = $msg ?? $this->label . ' phải là boolean';
    } else {
      $this->type = self::TYPE_BOOL;
    }
    return $this;
  }

  public function string(string $msg = null): self
  {
    if (!is_string($this->value)) {
      $this->errors[$this->name] = $msg ?? $this->label . ' phải là chuỗi';
    } else {
      $this->type = self::TYPE_STRING;
    }
    return $this;
  }

  public function number(string $msg = null): self
  {
    if (!is_numeric($this->value)) {
      $this->errors[$this->name] =  $msg ?? $this->label . ' phải là số';
    } else {
      $this->type = self::TYPE_NUMBER;
    }
    return $this;
  }

  public function default($value): self
  {
    $this->value = $value;
    return $this;
  }

  public function required(string $msg = null): self
  {
    $isNonEmpty = true;
    switch ($this->type) {
      case self::TYPE_FILE:
        if ($this->file == null) $isNonEmpty = false;
        break;
      case self::TYPE_BOOL:
        if ($this->value == null || !is_bool($this->value)) $isNonEmpty = false;
        break;
      case self::TYPE_NUMBER:
        if ($this->value == '') $isNonEmpty = false;
        break;
      case self::TYPE_STRING:
        if ($this->value == '' || $this->value == null) $isNonEmpty = false;
        break;
    }
    if (!$isNonEmpty) $this->errors[$this->name] =  $msg ?? $this->label . ' không được bỏ trống';
    return $this;
  }

  public function equal($value, string $msg = null): self
  {
    if ($this->value != $value) {
      $this->errors[$this->name] = $msg ?? $this->label . ' không trùng khớp';
    }
    return $this;
  }

  public function minLen(int $length, string $msg = null): self
  {
    if (is_string($this->value) && strlen($this->value) < $length) {
      $this->errors[$this->name] =  $msg ?? $this->label . ' phải lớn hơn ' . $length . ' kí tự';
    }
    return $this;
  }

  public function maxLen(int $length, string $msg = null): self
  {
    if (is_string($this->value) && strlen($this->value) > $length) {
      $this->errors[$this->name] =  $msg ?? $this->label . ' phải nhỏ hơn ' . $length . ' kí tự';
    }
    return $this;
  }

  public function min(int $length, string $msg = null): self
  {
    if (is_numeric($this->value) && $this->value < $length) {
      $this->errors[$this->name] = $msg ?? $this->label . ' phải lớn hơn ' . $length;
    }
    return $this;
  }

  public function max(int $length, string $msg = null): self
  {
    if (is_numeric($this->value) && $this->value > $length) {
      $this->errors[$this->name] = $msg ?? $this->label . ' phải nhỏ hơn ' . $length;
    }
    return $this;
  }

  public function email(string $msg = null): self
  {
    if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
      $this->errors[$this->name] = $msg ?? $this->label . ' không hợp lệ';
    }
    return $this;
  }

  public function phone(string $msg = null): self
  {
    $pattern = '/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/';
    if (is_string($this->value) && !preg_match($pattern, $this->value)) {
      $this->errors[$this->name] = $msg ?? $this->label . ' không hợp lệ';
    }
    return $this;
  }

  public function isValid(): bool
  {
    return empty($this->errors);
  }

  public function getErrors(): array
  {
    return $this->errors;
  }

  public function getError(string $key): string
  {
    return  $this->errors[$key] ?? '';
  }

  public function setError(string $key, string $value): void
  {
    $this->errors[$key] = $value;
  }

  public function hasError(string $key): bool
  {
    return array_key_exists($key, $this->errors);
  }
}
