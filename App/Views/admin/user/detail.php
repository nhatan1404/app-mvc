<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card">
        <div class="card-header">
          <h5 class="mt-2 font-weight-bold text-primary float-left">Tài Khoản
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
                <td><?php echo $this->user->id ?></td>
              </tr>
              <tr>
                <td>Ảnh đại diện</td>
                <td><img class="img-thumbnail" style="width: 144px" src="<?php echo $this->helper->createUrlImg($this->user->avatar) ?>" />
                </td>
              </tr>
              <tr>
                <td>Họ</td>
                <td><?php echo $this->user->lastname ?></td>
              </tr>
              <tr>
                <td>Tên</td>
                <td><?php echo $this->user->firstname ?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><?php echo $this->user->email ?></td>
              </tr>
              <tr>
                <td>Số điện thoại</td>
                <td><?php echo $this->user->telephone ?></td>
              </tr>
              <tr>
                <td>Địa chỉ</td>
                <td><?php echo $this->user->address ?></td>
              </tr>
              <tr>
                <td>Vai trò</td>
                <td><?php echo $this->user->role == 'admin' ? 'Admin' : 'Khách hàng' ?></td>
              </tr>
              <tr>
                <td>Trạng thái</td>
                <td><?php echo $this->user->status == 'active' ? 'Hoạt động' : 'Khoá' ?></td>
              </tr>
              <tr>
                <td>Ngày tạo</td>
                <td><?php echo $this->helper->formatDate($this->user->created_at) ?></td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td><?php echo $this->helper->formatDate($this->user->updated_at) ?></td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <a href="<?php echo $this->helper->createUrl('admin/user/' . $this->user->id . '/edit') ?>" class="btn btn-success mr-2"><i class="fas fa-edit"></i>
            Sửa</a>
          <form method="POST" action="<?php echo $this->helper->createUrl('admin/user/' . $this->user->id . '/delete') ?>">
            <button class="btn btn-danger btnDelete" data-id="19" data-toggle="tooltip" data-placement="bottom" title="Xoá"><i class="fas fa-trash-alt"> Xoá</i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>