<?php

namespace App\Helpers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Address;
use Core\Session;

class ViewHelper
{
  public function __construct()
  {
    $this->modelCategory = new Category();
    $this->modelProduct = new Product();
    $this->modelCart = new Cart();
    $this->modelAddress = new Address();
    $this->auth = new AuthHelper();
    $this->session = new Session();
  }

  public function getListParentCategory()
  {
    return $this->modelCategory->getListParentCategory();
  }

  public function getListAllCategory()
  {
    return $this->modelCategory->getAll();
  }

  public function getCartCount(): int
  {
    if (!$this->auth->isLoggedIn()) return 0;
    return $this->modelCart->findCartByUserId($this->auth->id())->count ?? 0;
  }

  public function getListProvinces()
  {
    return $this->modelAddress->getListProvinces();
  }

  public function getListDistricts(string $provinceId): array
  {
    return $this->modelAddress->getListDistricts($provinceId);
  }

  public function getListWards(string $districtId): array
  {
    return $this->modelAddress->getListWards($districtId);
  }

  public function getRelatedProduct(int $limit)
  {
    return $this->modelProduct->getListRelated($limit);
  }

  public function getLastestProduct(int $limit)
  {
    return $this->modelProduct->getListLastest($limit);
  }

  public function getLastestDiscountProduct(int $limit)
  {
    return $this->modelProduct->getListLastestDiscount($limit);
  }

  public function formatCurrency(float $currency): string
  {
    return number_format($currency, 0, ',', '.');
  }

  public function formatDate(string $date, string $format = 'd/m/Y'): string
  {
    return date_format(date_create($date), $format);
  }

  public function createSlug(string $name, int $id, string $slug): string
  {
    return APP_URL . '/' . $name . '/' . $slug . '.' . $id;
  }

  public function createUrl(string $path  = '')
  {
    return APP_URL . '/' . $path;
  }

  public function createUrlImg(string $url): string
  {
    return $this->isLocalImage($url) ? $this->createUrl($url) : $url;
  }

  public function isLocalImage(string $path): bool
  {
    $pattern = '/' . str_replace('/', '\/', PATH_IMAGES) . '/i';
    return preg_match($pattern, $path) && strpos($path, 'http') == false;
  }

  public function mapToHtml($data): string
  {
    $html = '';
    foreach ($data as $product) {
      $urlImg =  $this->isLocalImage($product->images) ? APP_URL . '/' . $product->images : $product->images;
      $slug = $this->createSlug('product', $product->id, $product->slug);
      $productPrice = $this->formatCurrency($product->price);

      $html .= sprintf(
        "<div class='col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat'>
        <div class='featured__item'>
          <div class='featured__item__pic set-bg' data-setbg='%s'>
            <ul class='featured__item__pic__hover'>
              <li><a href='javascript:void(0)' onclick='addCart(%s)'><i class='fa fa-shopping-cart'></i></a></li>
            </ul>
          </div>
          <div class='featured__item__text'>
            <h6><a href='%s'>%s</a></h6>
            <h5>%sđ</h5>
          </div>
        </div>
      </div>",
        $urlImg,
        $product->id,
        $slug,
        $product->title,
        $productPrice
      );
    }
    return $html;
  }

  public function displayStatusOrder(string $status): string
  {
    switch ($status) {
      case 'new':
        return '<span class="badge badge-secondary">Mới</span>';
      case 'accepted':
        return '<span class="badge badge-primary">Đã xác nhận</span>';
      case 'delivering':
        return '<span class="badge badge-info">Đang vận chuyển</span>';
      case 'cancel':
        return '<span class="badge badge-danger">Đã huỷ</span>';
      default:
        return '<span class="badge badge-success">Hoàn thành</span>';
    }
  }

  public function displayStatusProgress(string $status, int $position): string
  {
    $dataStatus = ['new', 'accepted', 'delivering', 'cancel', 'done'];
    if ($status == 'cancel') return 'step-cancel';
    return array_search($status, $dataStatus) >= $position ? 'active' : 'ádkalsd';
  }
}
