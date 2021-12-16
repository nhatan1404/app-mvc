<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Ogani Template">
  <meta name="keywords" content="Ogani, unica, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $this->title ?? APP_NAME ?></title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="<?php echo APP_URL . '/public/site/css' ?>/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo APP_URL . '/public/site/css' ?>/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo APP_URL . '/public/site/css' ?>/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="<?php echo APP_URL . '/public/site/css' ?>/nice-select.css" type="text/css">
  <link rel="stylesheet" href="<?php echo APP_URL . '/public/site/css' ?>/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo APP_URL . '/public/site/css' ?>/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo APP_URL . '/public/site/css' ?>/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo APP_URL . '/public/site/css' ?>/notyf.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo APP_URL . '/public/site/css' ?>/style.css" type="text/css">
  <link rel="stylesheet" href="<?php echo APP_URL . '/public/site/css' ?>/custom.css" type="text/css">
</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>

  <!-- Humberger Begin -->
  <div class="humberger__menu__overlay"></div>
  <div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
      <a href="<?php echo $this->helper->createUrl() ?>"><img src="<?php echo $this->helper->createUrl('public/site/images/logo.png') ?>" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
      <ul>
        <li><a href="<?php echo $this->helper->createUrl('cart') ?>"><i class="fa fa-shopping-bag"></i> <span class="cart_count"><?php echo ($this->helper->getCartCount() ?? 0) ?></span></a></li>
      </ul>
    </div>
    <div class="humberger__menu__widget">
      <?php if ($this->helper->auth->isLoggedIn() && $this->helper->auth->isAdmin()) {  ?>
        <div class="header__top__right__auth mr-2">
          <a href="<?php echo $this->helper->createUrl('admin') ?>">
            <i class="fa fa-tachometer"></i>
            Dashboard
          </a>
        </div>
      <?php } ?>
      <div class="header__top__right__auth">
        <a href="<?php echo $this->helper->auth->isLoggedIn() ? $this->helper->createUrl('profile') : $this->helper->createUrl('login') ?>">
          <i class="fa fa-user"></i>
          <?php echo $this->helper->auth->isLoggedIn() ? $this->helper->auth->getFullName() : 'Đăng Nhập' ?>
        </a>
      </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
      <ul>
        <li class="active"><a href="<?php echo $this->helper->createUrl() ?>">Trang Chủ</a></li>
        <li><a href="<?php echo $this->helper->createUrl('products') ?>">Sản Phẩm</a></li>
        <li><a href="<?php echo $this->helper->createUrl('about') ?>">Giới Thiệu</a></li>
        <li><a href="<?php echo $this->helper->createUrl('contact') ?>">Liên Hệ</a></li>
      </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-linkedin"></i></a>
      <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
      <ul>
        <li><i class="fa fa-envelope"></i> nhatan@gmail.com</li>
        <li>Giao hàng miễn phí cho tất cả đơn hàng từ 200.000 vnđ</li>
      </ul>
    </div>
  </div>
  <!-- Humberger End -->

  <!-- Header Section Begin -->
  <header class="header">
    <div class="header__top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="header__top__left">
              <ul>
                <li><i class="fa fa-envelope"></i> nhatan@gmail.com</li>
                <li>Giao hàng miễn phí cho tất cả đơn hàng từ 200.000 vnđ</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="header__top__right">
              <div class="header__top__right__social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-pinterest-p"></i></a>
              </div>
              <?php if ($this->helper->auth->isLoggedIn() && $this->helper->auth->isAdmin()) {  ?>
                <div class="header__top__right__auth mr-2">
                  <a href="<?php echo $this->helper->createUrl('admin') ?>">
                    <i class="fa fa-tachometer"></i>
                    Dashboard
                  </a>
                </div>
              <?php } ?>
              <div class="header__top__right__auth">
                <a href="<?php echo $this->helper->auth->isLoggedIn() ? $this->helper->createUrl('profile') : $this->helper->createUrl('login') ?>">
                  <i class="fa fa-user"></i>
                  <?php echo $this->helper->auth->isLoggedIn() ? $this->helper->auth->getFullName() : 'Đăng Nhập' ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="header__logo">
            <a href="<?php echo $this->helper->createUrl() ?>"><img src="<?php echo $this->helper->createUrl('public/site/images/logo.png') ?>" alt=""></a>
          </div>
        </div>
        <div class="col-lg-6">
          <nav class="header__menu">
            <ul>
              <li class="active"><a href="<?php echo $this->helper->createUrl() ?>">Trang Chủ</a></li>
              <li><a href="<?php echo $this->helper->createUrl('products') ?>">Sản Phẩm</a></li>
              <li><a href="<?php echo $this->helper->createUrl('about') ?>">Giới Thiệu</a></li>
              <li><a href="<?php echo $this->helper->createUrl('contact') ?>">Liên Hệ</a></li>
            </ul>
          </nav>
        </div>
        <div class="col-lg-3">
          <div class="header__cart">
            <ul>
              <li><a href="<?php echo $this->helper->createUrl('cart') ?>"><i class="fa fa-shopping-bag"></i> <span class="cart_count"><?php echo ($this->helper->getCartCount() ?? 0) ?></span></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="humberger__open">
        <i class="fa fa-bars"></i>
      </div>
    </div>
  </header>
  <!-- Header Section End -->


  <!-- Hero Section Begin -->
  <section class="hero hero-normal">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="hero__categories">
            <div class="hero__categories__all">
              <i class="fa fa-bars"></i>
              <span>Tất Cả Danh Mục</span>
            </div>
            <ul>
              <?php foreach ($this->helper->getListAllCategory() as $category) { ?>
                <li><a href="<?php echo $this->helper->createSlug('category', $category->id, $category->slug) ?>"><?php echo $category->title ?></a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="hero__search">
            <div class="hero__search__form">
              <form action="<?php echo $this->helper->createUrl('search') ?>">
                <input type="text" placeholder="Nhập từ khoá">
                <button type="submit" class="site-btn">Tìm</button>
              </form>
            </div>
            <div class="hero__search__phone">
              <div class="hero__search__phone__icon">
                <i class="fa fa-phone"></i>
              </div>
              <div class="hero__search__phone__text">
                <h5>0901234567</h5>
                <span>Hỗ trợ 24/7</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section End -->