<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card">
        <div class="card-header">
          <h5 class="mt-2 font-weight-bold text-primary float-left">Mã Giảm Giá
          </h5>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="col-sm-3">#</th>
                <th class="col-sm-9">Thông tin</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>ID</td>
                <td><?php echo $this->coupon->id ?></td>
              </tr>
              <tr>
                <td>Mã</td>
                <td><?php echo $this->coupon->code ?></td>
              </tr>

              <tr>
                <td>Loại</td>
                <td><?php echo $this->coupon->type == 'fixed' ? 'Giá tiền' : 'Phần trăm' ?></td>
              </tr>
              <tr>
                <td>Giá trị</td>
                <td><?php echo $this->coupon->type == 'fixed' ? $this->helper->formatCurrency($this->coupon->value) . 'đ' : $this->coupon->value . '%' ?></td>
              </tr>
              <tr>
                <td>Trạng thái</td>
                <td><?php echo $this->coupon->status == 'active' ? 'Còn hiệu lực' : 'Hết hạn' ?></td>
              </tr>
              <tr>
                <td>Ngày tạo</td>
                <td><?php echo $this->helper->formatDate($this->coupon->created_at) ?></td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td><?php echo $this->helper->formatDate($this->coupon->updated_at) ?></td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <a href="<?php echo $this->helper->createUrl('admin/coupon/' . $this->coupon->id . '/edit') ?>" class="btn btn-success mr-2"><i class="fas fa-edit"></i>
            Sửa</a>
          <form method="POST" action="<?php echo $this->helper->createUrl('admin/coupon/' . $this->coupon->id . '/delete') ?>">
            <button class="btn btn-danger btnDelete" data-id="19" data-toggle="tooltip" data-placement="bottom" title="Xoá"><i class="fas fa-trash-alt"> Xoá</i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>