<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card">
        <div class="card-header">
          <h5 class="mt-2 font-weight-bold text-primary float-left">Sản Phẩm
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
                <td><?php echo $this->product->id ?></td>
              </tr>
              <tr>
                <td>Ảnh</td>
                <td><img class="img-thumbnail" style="width: 144px" src="<?php echo $this->helper->createUrlImg($this->product->images) ?>" />
                </td>
              </tr>
              <tr>
                <td>Tên sản phẩm</td>
                <td><?php echo $this->product->title ?></td>
              </tr>
              <tr>
                <td>Đường dẫn</td>
                <td><?php echo $this->product->slug ?></td>
              </tr>
              <tr>
                <td>Mô tả</td>
                <td><?php echo $this->product->description ?></td>
              </tr>

              <tr>
                <td>Số lượng</td>
                <td><?php echo $this->product->quantity ?></td>
              </tr>
              <tr>
                <td>Đã bán</td>
                <td><?php echo $this->product->sold ?></td>
              </tr>
              <tr>
                <td>Giá</td>
                <td><?php echo $this->helper->formatCurrency($this->product->price) . 'đ' ?></td>
              </tr>
              <tr>
                <td>Chiết khấu</td>
                <td><?php echo $this->product->discount . '%' ?></td>
              </tr>
              <tr>
                <td>Giá</td>
                <td><?php echo $this->product->category_title ?></td>
              </tr>
              <tr>
                <td>Trạng thái</td>
                <td><?php echo $this->product->status == 'active' ? 'Hiển thị' : 'Ẩn' ?></td>
              </tr>
              <tr>
                <td>Ngày tạo</td>
                <td><?php echo $this->helper->formatDate($this->product->created_at) ?></td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td><?php echo $this->helper->formatDate($this->product->updated_at) ?></td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <a href="<?php echo $this->helper->createUrl('admin/product/' . $this->product->id . '/edit') ?>" class="btn btn-success mr-2"><i class="fas fa-edit"></i>
            Sửa</a>
          <form method="POST" action="<?php echo $this->helper->createUrl('admin/product/' . $this->product->id . '/delete') ?>">
            <button class="btn btn-danger btnDelete" data-id="19" data-toggle="tooltip" data-placement="bottom" title="Xoá"><i class="fas fa-trash-alt"> Xoá</i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>