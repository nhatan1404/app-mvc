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
      <h6 class="mt-2 font-weight-bold text-primary float-left">Danh sách tài khoản</h6>
      <a href="<?php echo $this->helper->createUrl('admin/user/create') ?>" class="btn btn-success btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Tạo tài khoản"><i class="fas fa-plus"></i> Tạo Mới</a>
    </div>
    <div class="card-body">
      <?php if (count($this->users) > 0) {
      ?>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableCategory" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Họ Tên</th>
                <th>Email</th>
                <th>Ngày Tạo</th>
                <th>Chức Vụ</th>
                <th>Trạng Thái</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($this->users as $user) { ?>
                <tr>
                  <td><?php echo $user->id ?></td>
                  <td><?php echo $user->lastname . ' ' . $user->firstname ?></td>
                  <td><?php echo $user->email ?></td>
                  <td><?php echo $this->helper->formatDate($user->created_at) ?></td>
                  <td><?php echo $user->role == 'admin' ? 'Admin' : 'Khách hàng' ?></td>
                  <td class="text-center"><span class='badge badge-<?php echo $user->status == 'active' ? 'success' : 'danger' ?>'><?php echo $user->status == 'active' ? 'Hoạt động' : 'Khoá' ?></span></td>
                  </td>
                  <td>
                    <a href="<?php echo $this->helper->createUrl('admin/user/' . $user->id) ?>" class="btn btn-primary btn-circle btn-sm float-left mr-1 btn-action" data-toggle="tooltip" title="Sửa" data-placement="bottom">
                      <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="<?php echo $this->helper->createUrl('admin/user/' . $user->id . '/edit') ?>" class="btn btn-warning btn-circle btn-sm float-left mr-1 btn-action" data-toggle="tooltip" title="Sửa" data-placement="bottom">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="<?php echo $this->helper->createUrl('admin/user/' . $user->id . '/delete') ?>">
                      <button class="btn btn-danger btn-circle btn-sm btn-action btnDelete" data-toggle="tooltip" data-placement="bottom" title="Xoá">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
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