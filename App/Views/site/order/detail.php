<div class="container">
  <div class="row">
    <div class="col-md-12 mx-auto py-5">
      <article class="card">
        <header class="card-header bg-green text-uppercase"> Chi Tiết Đơn Đặt Hàng </header>
        <div class="card-body">
          <article class="card">
            <div class="card-body row">
              <div class="col"> <strong>Mã đơn</strong> <br><?php echo $this->order->order_number ?>
              </div>
              <div class="col"> <strong>Ngày giao hàng dự kiến:</strong> <br>14/04/2022 </div>
              <div class="col"> <strong>Trạng Thái:</strong> <br>
                <?php echo $this->helper->displayStatusOrder($this->order->status) ?>
              </div>
              <div class="col"> <strong>Mã vận chuyển #:</strong> <br> BD045903594059 </div>
            </div>
          </article>
          <div class="track">
            <div class="step <?php echo $this->helper->displayStatusProgress($this->order->status, 0) ?>">
              <span class="icon"> <i class="fa fa-check"></i>
              </span> <span class="text">Đang Chờ Xác Nhận</span>
            </div>
            <div class="step <?php echo $this->helper->displayStatusProgress($this->order->status, 1) ?>">
              <span class="icon"> <i class="fa fa-user"></i>
              </span> <span class="text">Đã Xác Nhận</span>
            </div>
            <div class="step <?php echo $this->helper->displayStatusProgress($this->order->status, 2) ?>">
              <span class="icon"> <i class="fa fa-truck"></i>
              </span> <span class="text"> Đang Vận Chuyển</span>
            </div>
            <div class="step <?php echo $this->helper->displayStatusProgress($this->order->status, 3) ?>">
              <span class="icon"> <i class="fa fa-box"></i>
              </span> <span class="text"><?php $this->order->status == 'cancel' ? 'Huỷ' : 'Đã Giao Hàng' ?></span>
            </div>
          </div>
          <hr>
          <ul class="row">
            <?php foreach ($this->order->items as $item) { ?>
              <li class="col-md-4">
                <figure class="itemside mb-3">
                  <div class="aside"><img src="<?php echo $this->helper->createUrlImg($item->product_images) ?>" class="img-sm border">
                  </div>
                  <figcaption class="info align-self-center">
                    <p class="title"><?php echo $item->product_title ?></p>
                    <p class="text-muted mt-1 mb-1">
                      <?php echo $this->helper->formatCurrency($item->price * $item->quantity) ?> đ</span>
                    <p class="text-muted mt-1 mb-1">Số lượng: <?php echo $item->quantity ?></span>
                  </figcaption>
                </figure>
              </li>
            <?php } ?>
          </ul>
          <hr> <a href="<?php echo $this->helper->createUrl('order') ?>" class="btn btn-success bg-green text-white"> <i class="fa fa-chevron-left mr-2"></i>Quay lại</a>
        </div>
      </article>
    </div>
  </div>
</div>