<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Address;

class AddressController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->modelAddress = new Address();
  }

  public function getListDistricts(): void
  {
    $province = $this->body->post('province');
    $districts  = $this->modelAddress->getListDistricts($province);
    $this->view->json(["districts" =>  $districts]);
  }

  public function getListWards(): void
  {
    $district = $this->body->post('ward');
    $wards  = $this->modelAddress->getListWards($district);
    $this->view->json(["wards" => $wards, "code" => $district]);
  }
}
