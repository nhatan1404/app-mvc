<?php

namespace Core;

use App\Helpers\ViewHelper;

class View
{
  private $errors = null;
  private $validator = 'errors-validation';

  public function __construct()
  {
    $this->request = new Request();
    $this->helper = new ViewHelper();
    $this->session = new Session();
    if ($this->session->has('errors-validation')) {
      $this->errors = $this->session->get('errors-validation');
      $this->session->remove('errors-validation');
    }
  }

  public function validation()
  {
    return $this->validator;
  }

  private function getPath($path)
  {
    return str_replace('.', '/', $path);
  }

  public function getUrl(bool $hasQuery = false): string
  {
    $query = $hasQuery &&  $this->request->getQuery() != '' ? '?' . $this->request->getQuery() : '';
    return APP_URL . $this->request->getUrl() . $query;
  }

  // public function bindQuery($name, $value): void
  // {
  //   $url = $this->getUrl(true);
  //   $query = explode('?', $url);
  //   $query = end($query);
  //   if ($query == $this->getUrl()) return;

  //   $position = strpos($url, $name, strpos($url, '?'));
  //   var_dump($query);

  //   $lastUrl = '';
  //   var_dump(substr($url, $position, strlen($name)+1));
  // }

  public function render(string $path, bool $isIncludeLayout = true)
  {
    $file = $this->getPath($path);
    $pathArray = explode('/', $file);
    $subPath = $pathArray[0] == APP_URL_ADMIN ? APP_URL_ADMIN : APP_URL_SITE;

    if ($isIncludeLayout) {
      require APP_ROOT . '/App/Views/' . $subPath . '/layouts/header.php';
      require APP_ROOT . '/App/Views/' . $file . '.php';
      require APP_ROOT . '/App/Views/' . $subPath . '/layouts/footer.php';
    } else {
      require APP_ROOT . '/App/Views/' . $file . '.php';
    }
  }

  public function json($data, $statusCode = 200): void
  {
    header('Content-type: application/json');
    http_response_code($statusCode);
    echo json_encode($data);
  }

  public function redirect(string $path): void
  {
    header('Location: ' . APP_URL . $path);
    exit;
  }

  public function createFlashMsg(string $name, string $message, string $type): void
  {
    FlashMessage::create($name, $message, $type);
  }

  public function flashMsg(string $name): void
  {
    FlashMessage::flash($name);
  }

  public function issetFlash(string $name): bool
  {
    return isset($_SESSION[FlashMessage::FLASH][$name]);
  }

  public function displayError(string $name): void
  {
    if (!empty($this->errors)) {
      if (array_key_exists($name, $this->errors)) {
        $msg = $this->errors[$name];
        echo "<span class='text-danger'>$msg</span>";
        unset($this->errors[$name]);
      }
    }
  }

  public function isLocalImage(string $path): bool
  {
    $pattern = '/' . str_replace('/', '\/', PATH_IMAGES) . '/i';
    return preg_match($pattern, $path) && strpos($path, 'http') == false;
  }

  public function notFound(string $msg = null): void
  {
    $this->title = 'Trang không tồn tại';
    $this->msg = $msg;
    $this->render('error.404', false);
  }
}
