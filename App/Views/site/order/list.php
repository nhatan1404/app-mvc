    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="<?php echo $this->helper->createUrl('public/site/images/breadcrumb.jpg') ?>">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
              <h2>Đơn Đặt Hàng</h2>
              <div class="breadcrumb__option">
                <a href="<?php echo $this->helper->createUrl() ?>">Trang Chủ</a>
                <span>Đơn Đặt Hàng</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="shoping-cart spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <?php if ($this->orders != null && count($this->orders) > 0) { ?>
              <div class="shoping__cart__table">
                <table>
                  <thead>
                    <tr>
                      <th>Mã Đơn</th>
                      <th class="shoping__product">Sản Phẩm </th>
                      <th>Ngày Đặt</th>
                      <th>Tổng Tiền</th>
                      <th>Trạng Thái</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($this->orders as $order) { ?>
                      <tr data-row="<?php echo $order->id ?>">
                        <td class="pr-3">
                          <h5><?php echo $order->order_number ?></h5>
                        </td>
                        <td class="shoping__cart__item">
                          <?php foreach ($order->titles as $item) { ?>
                            <?php echo $item->title . '<br />' ?>
                          <?php } ?>
                        </td>
                        <td class="shoping__cart__quantity">
                          <?php echo $this->helper->formatDate($order->created_at) ?>
                        </td>
                        <td class=" shoping__cart__price">
                          <?php echo $this->helper->formatCurrency($order->total) ?> đ
                        </td>
                        <td class="shoping__cart__total">
                          <?php echo $this->helper->displayStatusOrder($order->status) ?>
                        </td>
                        <td class="shoping__cart__item__close">
                          <a class="btn bg-green" href="<?php echo $this->helper->createUrl('order/'.$order->id) ?>">Xem</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      <?php } else { ?>
        <div class="d-md-flex align-items-md-center height-100vh--md">
          <div class="container text-center space-2 space-3--lg">
            <div class="w-md-80 w-lg-60 text-center mx-md-auto">
              <div class="mb-5">
                <span class="u-icon u-icon--secondary mb-4">
                  <span class="fa fa-shopping-bag u-icon__inner"></span>
                </span>
                <h1 class="h2">Danh sách đơn đặt hàng của bạn trống</h1>
                <p>Bạn sẽ tìm thấy rất nhiều sản phẩm thú vị trên trang "Sản phẩm" của chúng tôi.</p>
              </div>
              <a class="btn bg-green btn-lg" href="<?php echo $this->helper->createUrl('products') ?>">Mua Ngay</a>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
    </section>