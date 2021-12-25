<?php if ($this->issetFlash('success') || $this->issetFlash('error')) { ?>
  <div class="row">
    <div class="col-lg-10 mx-auto">
      <?php (($this->issetFlash('success') ? $this->flashMsg('success') : $this->flashMsg('error'))) ?>
    </div>
  </div>
<?php }  ?>
<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <div class="card-header py-3">
        <h6 class="mt-2 font-weight-bold text-primary float-left">Sửa Tài Khoản</h6>
        <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modalChangePass"><i class="fas fa-lock mr-1"></i> Sửa Mật Khẩu</a>
      </div>
      <div class="card-body">
        <form method="post" action="<?php echo $this->helper->createUrl('admin/user/' . $this->user->id . '/update') ?>" enctype='multipart/form-data'>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputLastname" class="col-form-label">Họ: </label>
                <input class="form-control" type="text" id="inputLastname" name="lastname" placeholder="Nhập họ" value="<?php echo $this->user->lastname ?>" />
                <?php $this->displayError('lastname') ?>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputFirstname" class="col-form-label">Tên: </label>
                <input class="form-control" type="text" id="inputFirstname" name="firstname" placeholder="Nhập tên" value="<?php echo $this->user->firstname ?>" />
                <?php $this->displayError('firstname') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputEmail" class="col-form-label">Email: </label>
                <input class="form-control" type="email" id="inputEmail" name="email" placeholder="Nhập email" value="<?php echo $this->user->email ?>" />
                <?php $this->displayError('email') ?>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputTelephone" class="col-form-label">Điện Thoại: </label>
                <input class="form-control" type="text" id="inputTelephone" name="telephone" placeholder="Nhập số điện thoại" value="<?php echo $this->user->telephone ?>" />
                <?php $this->displayError('telephone') ?>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputAvatar" class="col-form-label">Ảnh đại diện: </label>
            <input id="inputAvatar" class="form-control" type="file" oninput="imgReview.src=window.URL.createObjectURL(this.files[0])" name="avatar"  />
            <?php $this->displayError('avatar') ?>
            <img id="imgReview" style="margin-top:15px;max-height:100px;" src="<?php echo $this->helper->createUrlImg($this->user->avatar) ?>">
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputRole">Chức vụ: <span class="text-danger">*</span></label>
                <select name="role" id="inputRole" class="form-control">
                  <option value="">Chọn chức vụ</option>
                  <option value="admin" <?php echo $this->user->role == 'admin' ? ' selected' : '' ?>>Admin</option>
                  <option value="customer" <?php echo $this->user->role == 'customer' ? ' selected' : '' ?>>Khách Hàng</option>
                </select>
                <?php $this->displayError('role') ?>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputStatus">Trạng thái: <span class="text-danger">*</span></label>
                <select name="status" id="inputStatus" class="form-control">
                  <option value="">Chọn trạng thái</option>
                  <option value="active" <?php echo $this->user->status == 'active' ? ' selected' : '' ?>>Hoạt động</option>
                  <option value="inactive" <?php echo $this->user->role == 'inactive' ? ' selected' : '' ?>>Không hoạt động</option>
                </select>
                <?php $this->displayError('status') ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputAddress" class="col-form-label">Địa chỉ: </label>
                <input class="form-control" type="text" id="inputAddress" name="address" placeholder="Nhập địa chỉ" value="<?php echo $this->user->address ?>" />
                <?php $this->displayError('address') ?>
              </div>
            </div>
            <div class="col mt-2">
              <div class="form-group">
                <label for="inputProvince">Tỉnh: <span class="text-danger">*</span></label>
                <select name="province" id="inputProvince" class="form-control">
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
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputDistrict">Thành phố/quận: <span class="text-danger">*</span></label>
                <select name="district" id="inputDistrict" class="form-control">
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
            <div class="col">
              <div class="form-group">
                <label for="inputWard">Phường/Xã: <span class="text-danger">*</span></label>
                <select name="ward" id="inputWard" class="form-control">
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
          </div>
          <div class="form-group mb-3">
            <button class="btn btn-success" type="submit">Cập nhật</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalChangePass" tabindex="-1" role="dialog" aria-labelledby="modalChangePass" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Đổi Mật Khẩu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo $this->helper->createUrl('admin/user/' . $this->user->id . '/change-password') ?>">
        <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mật khẩu:</label>
            <input type="password" class="form-control" name="password-modal">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Nhập lại mật khẩu:</label>
            <input type="password" class="form-control" name="repassword-modal">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
          <button type="submit" class="btn btn-primary">Cập nhật</button>
      </form>
    </div>
  </div>
</div>
</div>