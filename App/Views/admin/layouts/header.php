<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Nhật An">

  <title><?php echo $this->title ?? APP_NAME ?></title>

  <link href="https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="<?php echo $this->helper->createUrl('public/admin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->helper->createUrl('public/admin/images/favicon/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $this->helper->createUrl('public/admin/images/favicon/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->helper->createUrl('public/admin/images/favicon/favicon-16x16.png') ?>">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo APP_URL . '/admin'; ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DASHBOARD</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $this->helper->createUrl('admin') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        SHOP
      </div>

      <!-- Nav Itemm - Category Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $this->helper->createUrl('admin/product') ?>">
          <i class="fas fa-shopping-cart"></i>
          <span>Sản Phẩm</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $this->helper->createUrl('admin/category') ?>">
          <i class="far fa-list-alt"></i>
          <span>Danh Mục Sản Phẩm</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $this->helper->createUrl('admin/order') ?>">
          <i class="fas fa-cart-arrow-down"></i>
          <span>Đơn Đặt Hàng</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $this->helper->createUrl('admin/coupon') ?>">
          <i class="fas fa-file-invoice-dollar"></i>
          <span>Mã Giảm Giá</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $this->helper->createUrl('admin/user') ?>">
          <i class="fas fa-user"></i>
          <span>Tài Khoản</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nhật An</span>
                <img class="img-profile rounded-circle" src="<?php echo $this->helper->createUrlImg($this->helper->auth->getUser()->avatar) ?>" alt>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo $this->helper->createUrl('admin/user/' . $this->helper->auth->id()) ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Thông tin
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Đăng xuất
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->