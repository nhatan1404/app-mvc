<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Tạo Tài Khoản</h5>
      <div class="card-body">
        <form method="post" action="<?php echo $this->helper->createUrl('admin/user/store') ?>" enctype='multipart/form-data'>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputLastname" class="col-form-label">Họ: </label>
                <input class="form-control" type="text" id="inputLastname" name="lastname" placeholder="Nhập họ" value="" />
                <?php $this->displayError('lastname') ?>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputFirstname" class="col-form-label">Tên: </label>
                <input class="form-control" type="text" id="inputFirstname" name="firstname" placeholder="Nhập tên" value="" />
                <?php $this->displayError('firstname') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputEmail" class="col-form-label">Email: </label>
                <input class="form-control" type="email" id="inputEmail" name="email" placeholder="Nhập email" value="" />
                <?php $this->displayError('email') ?>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputTelephone" class="col-form-label">Điện Thoại: </label>
                <input class="form-control" type="text" id="inputTelephone" name="telephone" placeholder="Nhập số điện thoại" value="" />
                <?php $this->displayError('telephone') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputPassword" class="col-form-label">Mật khẩu: </label>
                <input class="form-control" type="password" id="inputPassword" name="password" placeholder="Nhập mật khẩu" value="" />
                <?php $this->displayError('password') ?>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputRepassword" class="col-form-label">Xác nhận mật khẩu: </label>
                <input class="form-control" type="password" id="inputRepassword" name="repassword" placeholder="Nhập lại mật khẩu" value="" />
                <?php $this->displayError('repassword') ?>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputAvatar" class="col-form-label">Ảnh đại diện: </label>
            <input id="inputAvatar" class="form-control" type="file" oninput="imgReview.src=window.URL.createObjectURL(this.files[0])" name="avatar" />
            <?php $this->displayError('avatar') ?>
            <img id="imgReview" style="margin-top:15px;max-height:100px;">
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputRole">Chức vụ: <span class="text-danger">*</span></label>
                <select name="role" id="inputRole" class="form-control">
                  <option value="">Chọn chức vụ</option>
                  <option value="admin">Admin</option>
                  <option value="customer">Khách Hàng</option>
                </select>
                <?php $this->displayError('role') ?>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputStatus">Trạng thái: <span class="text-danger">*</span></label>
                <select name="status" id="inputStatus" class="form-control">
                  <option value="">Chọn trạng thái</option>
                  <option value="active">Hoạt động</option>
                  <option value="inactive">Không hoạt động</option>
                </select>
                <?php $this->displayError('status') ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputAddress" class="col-form-label">Địa chỉ: </label>
                <input class="form-control" type="text" id="inputAddress" name="address" placeholder="Nhập địa chỉ" value="" />
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
                    <option value="<?php echo $province->code ?>"><?php echo $province->name_with_type; ?></option>
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
                </select>
                <?php $this->displayError('district') ?>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputWard">Phường/Xã: <span class="text-danger">*</span></label>
                <select name="ward" id="inputWard" class="form-control">
                  <option value="">Chọn phường/xã</option>
                </select>
                <?php $this->displayError('ward') ?>
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <button class="btn btn-success" type="submit">Tạo</button>
            <button type="reset" class="btn btn-warning">Xoá</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>