<section class="breadcrumb-section set-bg" data-setbg="<?php echo $this->helper->createUrl('public/site/images/breadcrumb.jpg') ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Thanh Toán</h2>
          <div class="breadcrumb__option">
            <a href="<?php echo $this->helper->createUrl() ?>">Trang Chủ</a>
            <span>Thanh Toán</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
  <div class="container">
    <div class="checkout__form">
      <h4>Chi Tiết Hoá Đơn</h4>
      <form action="#">
        <div class="row">
          <div class="col-lg-8 col-md-6">
            <div class="row">
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>Họ<span>*</span></p>
                  <input type="text" name="lastname" value="<?php echo $this->helper->auth->getUser()->lastname ?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>Tên<span>*</span></p>
                  <input type="text" name="firstname" value="<?php echo $this->helper->auth->getUser()->firstname ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>Số điện thoại<span>*</span></p>
                  <input type="text" name="telephone" value="<?php echo $this->helper->auth->getUser()->telephone ?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>Email<span>*</span></p>
                  <input name="email" type="text" value="<?php echo $this->helper->auth->getUser()->email ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>Địa chỉ<span>*</span></p>
                  <input type="text" name="address" class="checkout__input__add" value="<?php echo $this->address->address ?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>Tỉnh<span>*</span></p>
                  <select name="province" id="province" class="mb-3 w-100" required>
                    <option value="">Chọn tỉnh</option>
                    <?php foreach ($this->helper->getListProvinces() as $province) {
                    ?>
                      <option value="<?php echo $province->code ?>" <?php echo $province->code == $this->address->province_id  ? ' selected' : '' ?>><?php echo $province->name_with_type; ?></option>
                    <?php
                    } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>Thành phố/quận:<span>*</span></p>
                  <select name="district" id="district" class="mb-3 w-100" required>
                    <option value="">Chọn thành phố/quận</option>
                    <?php foreach ($this->helper->getListDistricts($this->address->province_id) as $district) {
                    ?>
                      <option value="<?php echo $district->code ?>" <?php echo $district->code == $this->address->district_id  ? ' selected' : '' ?>><?php echo $district->name_with_type; ?></option>
                    <?php
                    } ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="checkout__input">
                  <p>Phường/Xã:<span>*</span></p>
                  <select name="ward" id="ward" class="mb-3 w-100" required>
                    <option value="">Chọn phường xã</option>
                    <?php foreach ($this->helper->getListWards($this->address->district_id) as $ward) {
                    ?>
                      <option value="<?php echo $ward->code ?>" <?php echo $ward->code == $this->address->ward_id  ? ' selected' : '' ?>><?php echo $ward->name_with_type; ?></option>
                    <?php
                    } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="checkout__input">
              <p>Ghi chú:</p>
              <textarea class="form-control" name="note"></textarea>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="checkout__order">
              <h4>Đơn hàng của bạn</h4>
              <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>
              <ul>
                <?php foreach ($this->cart->items as $item) { ?>
                  <li><?php echo $item->product_title ?> <span> <?php echo $this->helper->formatCurrency($item->quantity * $item->product_price) ?? 0  ?> đ</span></li>
                <?php } ?>
              </ul>
              <div class="checkout__order__subtotal">Tổng tiền sản phẩm <span><?php echo $this->helper->formatCurrency($this->cart->total ?? 0) ?> đ</span></div>
              <div class="checkout__order__total">Tổng tiền <span><?php echo $this->helper->formatCurrency($this->cart->total ?? 0) ?> đ</span></div>
              <button id="handleOrder" type="button" class="site-btn">Đặt Hàng</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- Checkout Section End -->