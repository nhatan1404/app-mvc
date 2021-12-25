<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h5>Đơn Đặt Hàng
        <span>
          <a href="<?php echo $this->helper->createUrl('admin/order/' . $this->order->id . '/edit') ?>" class=" btn btn-sm btn-warning shadow-sm float-right mr-2">
            <i class="fas fa-edit mr-1"></i>Sửa</a>
        </span>
      </h5>
    </div>
    <div class="card-body">
      <section class="confirmation_part section_padding">
        <div class="order_boxes">
          <div class="row">
            <div class="col-lg-6 col-lx-4">
              <div class="order-info">
                <h4 class="text-center pb-4" style="text-transform: uppercase;">Thông Tin Đơn Hàng
                </h4>
                <table class="table">
                  <tr class="">
                    <td>Mã đơn</td>
                    <td> : <?php echo $this->order->order_number ?></td>
                  </tr>
                  <tr>
                    <td>Ngày tạo đơn</td>
                    <td> : <?php echo $this->helper->formatDate($this->order->created_at, 'd/m/Y - H:m') ?></td>
                  </tr>
                  <tr>
                    <td>Số lượng sản phẩm</td>
                    <td> : <?php echo $this->order->count ?> sản phẩm</td>
                  </tr>
                  <tr>
                    <td>Order Status</td>
                    <td> : <?php echo $this->helper->displayStatusOrder($this->order->status) ?></td>
                  </tr>

                  <tr>
                    <td>Giảm giá</td>
                    <td> : 0đ</td>
                  </tr>
                  <tr>
                    <td>Tổng số tiền</td>
                    <td> : <?php echo $this->helper->formatCurrency($this->order->total) ?>đ</td>
                  </tr>
                  <tr>
                    <td>Ghi chú</td>
                    <td> : <?php echo $this->order->note == '' ? 'Không có' : $this->order->note ?></td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="col-lg-6 col-lx-4">
              <div class="shipping-info">
                <h4 class="text-center pb-4" style="text-transform: uppercase;">Thông Tin Vận Chuyển
                </h4>
                <table class="table">
                  <tr class="">
                    <td>Họ tên: </td>
                    <td> : <?php echo $this->order->lastname . ' ' . $this->order->firstname ?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td> : <?php echo $this->order->email ?></td>
                  </tr>
                  <tr>
                    <td>Số điện thoại</td>
                    <td> : <?php echo $this->order->telephone ?></td>
                  </tr>
                  <tr>
                    <td>Địa chỉ</td>
                    <td> : <?php echo $this->order->address ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <div class="card shadow my-4">
    <div class="card-header py-3">
      <h6 class="mt-2 font-weight-bold text-primary float-left">Danh sách sản phẩm</h6>
    </div>
    <div class="card-body">
      <?php if (count($this->products) > 0) {
      ?>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableCategory" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Danh Mục</th>
                <th>Số Lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($this->products as $product) { ?>
                <tr>
                  <td><?php echo $product->product_id ?> </td>
                  <td>
                    <img src="<?php echo $this->helper->createUrlImg($product->product_images) ?>" class="img-fluid zoom" style="max-width:80px" alt="<?php echo $product->title ?>">
                  </td>
                  <td><?php echo $product->product_title ?></td>
                  <td><?php echo $product->category ?></td>
                  <td class='text-center'><?php echo $product->quantity ?></td>
                  <td><?php echo $this->helper->formatCurrency($product->product_price) ?> đ</td>
                  <td><?php echo $this->helper->formatCurrency($product->product_price * $product->quantity) ?> đ</td>
                  </td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
      <?php } else { ?>
        <h6 class="text-center">Danh sách trống.</h6>
      <?php } ?>
    </div>
  </div>
</div>