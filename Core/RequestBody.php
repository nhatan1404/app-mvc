<?php

namespace Core;

use Core\UploadFile;

class RequestBody
{
  public function __construct()
  {
  }

  public function get($key, $defaultValue = null)
  {
    return isset($_GET[$key]) ? $_GET[$key] : $defaultValue;
  }

  public function post($key, $defaultValue = null)
  {
    return isset($_POST[$key]) ? $_POST[$key] : $defaultValue;
  }

  public function file(string $key)
  {
    return $this->isEmptyFile($key) ? null : $_FILES[$key];
  }

  public function isEmptyFile($name)
  {
    return  $_FILES[$name]["error"] == 4;
  }

  public function upload($name)
  {
    $file = new UploadFile($name);
    if ($file->getSize() <= DEFAULT_SIZE_LIMIT_UPLOAD) {
      return PATH_IMAGES . '/' . $file->moveTo();
    }
    return DEFAULT_IMAGE_PRODUCT;
  }
}
