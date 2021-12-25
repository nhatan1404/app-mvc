<div class="container-fluid">
  <div class="card shadow mb-4">
    <?php if ($this->issetFlash('success') || $this->issetFlash('error')) { ?>
      <div class="row">
        <div class="col-md-12">
          <?php (($this->issetFlash('success') ? $this->flashMsg('success') : $this->flashMsg('error'))) ?>
        </div>
      </div>
    <?php }  ?>
    <div class="card-header py-3">
      <h6 class="mt-2 font-weight-bold text-primary float-left">Danh sách đơn đặt hàng</h6>
    </div>
    <div class="card-body">
      <?php if (count($this->orders) > 0) {
      ?>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableCategory" width="100%" cellspacing="0">
            <thead>
              <tr>

                <th>ID</th>
                <th>Mã Đơn</th>
                <th>Họ Tên</th>
                <th>Địa Chỉ</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>Trạng Thái</th>
                <th>Tổng</th>
                <th>Ghi chú</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($this->orders as $order) { ?>
                <tr>
                  <td><?php echo $order->id ?></td>
                  <td><?php echo $order->order_number ?></td>
                  <td><?php echo $order->lastname . ' ' . $order->firstname ?></td>
                  <td><?php echo $order->address ?></td>
                  <td><?php echo $order->email ?></td>
                  <td><?php echo $order->telephone ?></td>
                  <td class="text-center"><?php echo $this->helper->displayStatusOrder($order->status) ?></td>
                  <td><?php echo $this->helper->formatCurrency($order->total) ?> đ</td>
                  <td><?php echo $order->note == '' ? '...' :  $order->note ?></td>
                  <td>
                    <a href="<?php echo $this->helper->createUrl('admin/order/' . $order->id) ?>" class="btn btn-primary btn-circle btn-sm float-left mr-1 btn-action" data-toggle="tooltip" title="Sửa" data-placement="bottom">
                      <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="<?php echo $this->helper->createUrl('admin/order/' . $order->id . '/edit') ?>" class="btn btn-warning btn-circle btn-sm float-left mr-1 btn-action" data-toggle="tooltip" title="Sửa" data-placement="bottom">
                      <i class="fas fa-edit"></i>
                    </a>
                  </td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
        <?php if (isset($this->totalPage) && isset($this->currentPage) && $this->totalPage != 1) { ?>
          <span class="float-right">
            <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
              <ul class="pagination">
                <li class="paginate_button page-item previous <?php echo ($this->currentPage < 2 ? ' disabled' :  '') ?>" id="dataTable_previous"><a href="<?php echo $this->bindQuery('page', ($this->currentPage > 2 ? $this->currentPage - 1 :  1)) ?>" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link"><i class="fa fa-chevron-left"></i></a></li>
                <?php for ($i = 1; $i <= $this->totalPage; $i++) {
                ?>
                  <li class="paginate_button page-item <?php echo ($this->currentPage == $i ? ' active' : '') ?>"><a href="<?php echo $this->bindQuery('page', $i) ?>" aria-controls="dataTable" data-dt-idx="<?php echo $i ?>" tabindex="0" class="page-link"><?php echo $i ?></a></li>
                <?php
                } ?>
                <li class="paginate_button page-item next <?php echo ($this->currentPage < $this->totalPage ? '' :  ' disabled') ?>" id="dataTable_next"><a href="<?php echo $this->bindQuery('page', ($this->currentPage < $this->totalPage ? $this->currentPage + 1 :  $this->totalPage)) ?>" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link"><i class="fa fa-chevron-right"></i></a></li>
              </ul>
            </div>
          </span>
        <?php }
      } else { ?>
        <h6 class="text-center">Danh sách trống.</h6>
      <?php } ?>
    </div>
  </div>
</div>