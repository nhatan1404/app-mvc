    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="<?php echo $this->helper->createUrl('public/site/images/breadcrumb.jpg') ?>">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
              <h2>Giỏ Hàng</h2>
              <div class="breadcrumb__option">
                <a href="<?php echo $this->helper->createUrl() ?>">Trang Chủ</a>
                <span>Giỏ Hàng</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <?php if ($this->cart != null && count($this->cart->items) > 0) { ?>
              <div class="shoping__cart__table">
                <table>
                  <thead>
                    <tr>
                      <th class="shoping__product">Sản Phẩm</th>
                      <th>Giá</th>
                      <th>Số Lượng</th>
                      <th>Tổng</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($this->cart->items as $item) { ?>
                      <tr data-row="<?php echo $item->id ?>">
                        <td class="shoping__cart__item">
                          <img class="img-fluid" style="max-width: 100px" src="<?php echo $this->isLocalImage($item->product_images) ? APP_URL . '/' . $item->product_images : $item->product_images ?>" alt="<?php echo $item->product_title ?>">
                          <h5><?php echo $item->product_title ?></h5>
                        </td>
                        <td class="shoping__cart__price">
                          <?php echo $this->helper->formatCurrency($item->product_price) ?> đ
                        </td>
                        <td class="shoping__cart__quantity">
                          <div class="quantity">
                            <div class="pro-qty">
                              <input type="text" data-id="<?php echo $item->id ?>" onkeyup="updateCart(event, <?php echo $item->id ?>)" oninput="updateCart(event, <?php echo $item->id ?>)" value="<?php echo $item->quantity ?>">
                            </div>
                          </div>
                        </td>
                        <td data-price="<?php echo $item->id ?>" class="shoping__cart__total">
                          <?php echo $this->helper->formatCurrency($item->quantity * $item->product_price) ?? 0  ?> đ
                        </td>
                        <td class="shoping__cart__item__close">
                          <span class="icon_close" onclick="removeCart(<?php echo $item->id ?>)"></span>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="shoping__cart__btns">
              <a href="<?php echo $this->helper->createUrl('products') ?>" class="primary-btn cart-btn">Tiếp Tục Mua</a>
              <!-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                Cập nhật</a> -->
            </div>
          </div>
          <div class="col-lg-6">
            <div class="shoping__continue">
              <div class="shoping__discount">
                <h5>Mã Giảm Giá</h5>
                <form action="#">
                  <input type="text" name="coupon" placeholder="Nhập mã giảm giá">
                  <button type="submit" class="site-btn">Áp Dụng</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="shoping__checkout">
              <h5>Tổng tiền hàng: <span id="subtotal"><?php echo $this->helper->formatCurrency($this->cart->total ?? 0) ?> đ</span></h5>
              <ul>
                <li>Giảm Giá <span>0 đ</span></li>
                <li>Tổng Tiền <span id="total_currency_cart"><?php echo $this->helper->formatCurrency($this->cart->total ?? 0) ?> đ</span></li>
              </ul>
              <a href="<?php echo $this->helper->createUrl('checkout') ?>" class="primary-btn">Thanh Toán</a>
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
                <h1 class="h2">Giỏ Hàng Của Bạn Còn Trống</h1>
                <p>Trước khi tiến hành thanh toán, bạn phải thêm một số sản phẩm vào giỏ hàng của mình. Bạn sẽ tìm thấy rất nhiều sản phẩm thú vị trên trang "Sản phẩm" của chúng tôi.</p>
              </div>
              <a class="btn bg-green btn-lg" href="<?php echo $this->helper->createUrl('products') ?>">Mua Ngay</a>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
    </section>
    <!-- Shoping Cart Section End -->