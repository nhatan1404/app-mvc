<?php

namespace Core;

class UploadFile
{
  private $file = [];
  private $fileName;
  private $nameOnly;
  private $extension;
  private $mimeType;
  private $tempFile;
  private $size;
  private $error;
  private $allowedImageExtensions = ['gif', 'jpg', 'jpeg', 'png', 'webp'];

  public function __construct($input)
  {
    $this->getFileInfo($input);
  }

  private function getFileInfo($input)
  {
    if (empty($_FILES[$input]) || $_FILES[$input]["error"] != 0) {
      return;
    }

    $file = $_FILES[$input];

    $this->error = $file['error'];

    if ($this->error != UPLOAD_ERR_OK) {
      return;
    }

    $this->file = $file;

    $this->fileName = $this->file['name'];

    $fileNameInfo = pathinfo($this->fileName);

    $this->nameOnly = $fileNameInfo['basename'];

    $this->extension = strtolower($fileNameInfo['extension']);

    $this->mimeType = $this->file['type'];

    $this->tempFile = $this->file['tmp_name'];

    $this->size = $this->file['size'];
  }

  public function exists()
  {
    return !empty($this->file);
  }

  public function getFileName()
  {
    return $this->fileName;
  }

  public function getNameOnly()
  {
    return $this->nameOnly;
  }

  public function getExtension()
  {
    return $this->extension;
  }

  public function getMimeType()
  {
    return $this->mimeType;
  }

  public function getSize()
  {
    return $this->size;
  }

  public function isImage()
  {
    return strpos($this->mimeType, 'image/') === 0 &&
      in_array($this->extension, $this->allowedImageExtensions);
  }

  public function moveTo($target = PATH_IMAGES, $newFileName = null)
  {
    $fileName = $newFileName ?: uniqid();

    $fileName .= '.' . $this->extension;

    if (!is_dir($target)) {
      mkdir($target, 0777, true);
    }

    $uploadedFilePath = APP_ROOT . '/' . rtrim($target, '/') . '/' . $fileName;

    move_uploaded_file($this->tempFile, $uploadedFilePath);

    return $fileName;
  }
}
