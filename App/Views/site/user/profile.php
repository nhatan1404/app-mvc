<?php
$user = $this->user;
?>
<div class="container">
  <div class="row">
    <div class="col-md-3 ">
      <div class="card mb-3">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            <form method="post" action="<?php echo $this->helper->createUrl('profile/' . $this->user->id . '/change-avatar') ?>" enctype="multipart/form-data">
              <label for="inputAvatar">
                <img id="imgReview" src="<?php echo $this->helper->createUrlImg($this->user->avatar) ?>" alt="Avatar" class="rounded-circle" width="150">
              </label>
              <input id="inputAvatar" type="file" name="avatar" style="display: none" oninput="imgReview.src=window.URL.createObjectURL(this.files[0])" />
              <div class="mt-3">
                <h4><?php echo $this->user->lastname . ' ' . $this->user->firstname ?></h4>
                <p class="text-muted font-size-sm"><?php echo $this->user->email ?></p>
                <button id='btn-avatar' class="btn btn-outline-success" type="submit" disabled>Đổi Ảnh Đại Diện</button>
              </div>
            </form>
          </div>
        </div>
      </div>
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
            <?php if ($this->issetFlash('success') || $this->issetFlash('error')) { ?>
              <div class="col-lg-12 mx-auto">
                <?php (($this->issetFlash('success') ? $this->flashMsg('success') : $this->flashMsg('error'))) ?>
              </div>
            <?php }  ?>
            <div class="col-md-12 d-flex justify-content-between mb-4">
              <h4>Thông Tin Tài Khoản</h4>
              <button class="btn btn-outline-success" data-toggle="modal" data-target="#modalChangePass">Đổi Mật Khẩu</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <form method="post" action="<?php echo $this->helper->createUrl('profile') ?>">
                <div class="form-group row">
                  <label for="name" class="col-4 col-form-label">Họ</label>
                  <div class="col-8">
                    <input id="lastname" name="lastname" placeholder="Họ" class="form-control here" type="text" value="<?php echo $user->lastname ?>">
                    <?php $this->displayError('lastname') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="lastname" class="col-4 col-form-label">Tên</label>
                  <div class="col-8">
                    <input id="firstname" name="firstname" placeholder="Tên" class="form-control here" type="text" value="<?php echo $user->firstname ?>">
                    <?php $this->displayError('firstname') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-4 col-form-label">Email</label>
                  <div class="col-8">
                    <input id="email" name="email" placeholder="Nhập email" class="form-control here" required="required" type="email" value="<?php echo $user->email ?>">
                    <?php $this->displayError('email') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="telephone" class="col-4 col-form-label">Số điện thoại</label>
                  <div class="col-8">
                    <input id="telephone" name="telephone" placeholder="Nhập số điện thoại" class="form-control here" required="required" type="text" value="<?php echo $user->telephone ?>">
                    <?php $this->displayError('telephone') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputAddress" class="col-4 col-form-label">Địa chỉ</label>
                  <div class="col-8">
                    <input id="inputAddress" name="address" placeholder="Nhập địa chỉ" class="form-control here" required="required" type="text" value="<?php echo $user->address ?>">
                    <?php $this->displayError('address') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="province" class="col-4 col-form-label">Tỉnh:</label>
                  <div class="col-8">
                    <select name="province" id="province" class="w-100">
                      <option value="">Chọn tỉnh</option>
                      <?php foreach ($this->helper->getListProvinces() as $province) {
                      ?>
                        <option value="<?php echo $province->code ?>" <?php echo $province->code == $this->user->province_id  ? ' selected' : '' ?>><?php echo $province->name_with_type; ?></option>
                      <?php
                      } ?>
                    </select>
                    <?php $this->displayError('province') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label or="district" class="col-4 col-form-label">Thành phố/quận:</label>
                  <div class="col-8">
                    <select name="district" id="district" class="w-100">
                      <option value="">Chọn thành phố/quận</option>
                      <?php foreach ($this->helper->getListDistricts($this->user->province_id) as $district) {
                      ?>
                        <option value="<?php echo $district->code ?>" <?php echo $district->code == $this->user->district_id  ? ' selected' : '' ?>><?php echo $district->name_with_type; ?></option>
                      <?php
                      } ?>
                    </select>
                    <?php $this->displayError('district') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="ward" class="col-4 col-form-label">Phường/Xã:</label>
                  <div class="col-8">
                    <select name="ward" id="ward" class="w-100">
                      <option value="">Chọn phường/xã</option>
                      <?php foreach ($this->helper->getListWards($this->user->district_id) as $ward) {
                      ?>
                        <option value="<?php echo $ward->code ?>" <?php echo $ward->code == $this->user->ward_id  ? ' selected' : '' ?>><?php echo $ward->name_with_type; ?></option>
                      <?php
                      } ?>
                    </select>
                    <?php $this->displayError('ward') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-success bg-green">Cập Nhật</button>
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
<!-- Modal Logout -->
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
          <button type="submit" class="btn btn-danger">Đăng xuất</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Change Password -->
<div class="modal fade" id="modalChangePass" tabindex="-1" role="dialog" aria-labelledby="modalChangePass" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Đổi Mật Khẩu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo $this->helper->createUrl('profile/' . $this->user->id . '/change-password') ?>">
        <div class="modal-body">
          <div class="form-group">
            <label for="oldpassword" class="col-form-label">Mật khẩu hiện tại:</label>
            <input id="oldpassword" type="password" class="form-control" name="oldpassword">
          </div>
          <div class="form-group">
            <label for="passoword" class="col-form-label">Mật khẩu:</label>
            <input id="password" type="password" class="form-control" name="password-modal">
          </div>
          <div class="form-group">
            <label for="repassoword" for="message-text" class="col-form-label">Nhập lại mật khẩu:</label>
            <input id="repassoword" type="password" class="form-control" name="repassword-modal">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
          <button type="submit" class="btn btn-success bg-green">Cập nhật</button>
      </form>
    </div>
  </div>
</div>
</div>