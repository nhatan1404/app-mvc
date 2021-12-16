<?php
$user = $this->helper->auth->getUser();
?>
<div class="container">
  <div class="row">
    <div class="col-md-3 ">
      <div class="list-group ">
        <?php if ($this->helper->auth->isLoggedIn() && $this->helper->auth->isAdmin()) {  ?>
          <a href="<?php echo $this->helper->createUrl('admin') ?>" class="list-group-item list-group-item-action">Dashboard</a>
        <?php } ?>
        <a href="<?php echo $this->helper->createUrl('profile') ?>" class="list-group-item list-group-item-action">Thông tin tài khoản</a>
        <a href="<?php echo $this->helper->createUrl('order') ?>" class="list-group-item list-group-item-action">Đơn đặt hàng</a>
        <a href="<?php echo $this->helper->createUrl('cart') ?>" class="list-group-item list-group-item-action">Giỏ hàng</a>
        <a href="javascript:void(0)" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalLogout">Đăng Xuất</a>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <h4>Thông Tin Tài Khoản</h4>
              <hr>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <form>
                <div class="form-group row">
                  <label for="username" class="col-4 col-form-label">User Name*</label>
                  <div class="col-8">
                    <input id="username" name="username" placeholder="Username" class="form-control here" required="required" type="text">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-4 col-form-label">Họ</label>
                  <div class="col-8">
                    <input id="lastname" name="lastname" placeholder="Họ" class="form-control here" type="text" value="<?php echo $user->lastname ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="lastname" class="col-4 col-form-label">Tên</label>
                  <div class="col-8">
                    <input id="firstname" name="firstname" placeholder="Tên" class="form-control here" type="text" value="<?php echo $user->firstname ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="text" class="col-4 col-form-label">Nick Name*</label>
                  <div class="col-8">
                    <input id="text" name="text" placeholder="Nick Name" class="form-control here" required="required" type="text">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="select" class="col-4 col-form-label">Display Name public as</label>
                  <div class="col-8">
                    <select id="select" name="select" class="custom-select">
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-4 col-form-label">Email*</label>
                  <div class="col-8">
                    <input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="text">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="website" class="col-4 col-form-label">Website</label>
                  <div class="col-8">
                    <input id="website" name="website" placeholder="website" class="form-control here" type="text">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="publicinfo" class="col-4 col-form-label">Public Info</label>
                  <div class="col-8">
                    <textarea id="publicinfo" name="publicinfo" cols="40" rows="4" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="newpass" class="col-4 col-form-label">New Password</label>
                  <div class="col-8">
                    <input id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="text">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalLogout" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Xác nhận</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bạn có muốn đăng xuất không?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
        <form method="post" action="<?php echo $this->helper->createUrl('logout') ?>">
          <input type="hidden" name="logout" value="true" />
          <button type="submit" class="btn btn-primary">Đăng xuất</button>
        </form>
      </div>
    </div>
  </div>
</div>