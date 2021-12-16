<?php
// app
define('APP_NAME', 'Website bán rau củ quả');
define('APP_URL', getBaseUrl() . '/app-mvc');
define('APP_URL_SITE', 'site');
define('APP_URL_ADMIN', 'admin');

// database
define('DB_HOST', 'localhost:3306');
define('DB_NAME', 'app-mvc');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

// pagination
define('NUMBER_PER_PAGE', 12);

// path views
define('VIEW_PATH_ADMIN', 'admin');
define('VIEW_PATH_SITE', 'site');

// storage
define('APP_ROOT', getcwd());
define('PATH_IMAGES', 'public/images');

define('DEFAULT_SIZE_LIMIT_UPLOAD', 5000000);
define('DEFAULT_IMAGE_PRODUCT', 'public/images/default/product.png');

session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');


function getBaseUrl()
{
  if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
  else
    $url = "http://";
  $url .= $_SERVER['HTTP_HOST'];

  return $url;
}
