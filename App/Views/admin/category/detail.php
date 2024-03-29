<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card">
        <div class="card-header">
          <h5 class="mt-2 font-weight-bold text-primary float-left">Danh Mục Sản Phẩm
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
                <td><?php echo $this->category->id ?></td>
              </tr>
              <tr>
                <td>Tên danh mục</td>
                <td><?php echo $this->category->title ?></td>
              </tr>

              <tr>
                <td>Đường dẫn</td>
                <td><?php echo $this->category->slug ?></td>
              </tr>
              <tr>
                <td>Mô tả</td>
                <td><?php echo $this->category->description ?? '...' ?></td>
              </tr>
              <tr>
                <td>Danh Mục Cha</td>
                <td><?php echo $this->category->parent_title ?? '...' ?></td>
              </tr>
              <tr>
                <td>Ngày tạo</td>
                <td><?php echo $this->helper->formatDate($this->category->created_at) ?></td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td><?php echo $this->helper->formatDate($this->category->updated_at) ?></td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <a href="<?php echo $this->helper->createUrl('admin/category/' . $this->category->id . '/edit') ?>" class="btn btn-success mr-2"><i class="fas fa-edit"></i>
            Sửa</a>
          <form method="POST" action="<?php echo $this->helper->createUrl('admin/category/' . $this->category->id . '/delete') ?>">
            <button class="btn btn-danger btnDelete" data-id="19" data-toggle="tooltip" data-placement="bottom" title="Xoá"><i class="fas fa-trash-alt"> Xoá</i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>