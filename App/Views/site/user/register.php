<div class="container-xl px-4">
  <?php if ($this->issetFlash('error')) { ?>
    <div class="row">
      <div class="col-md-10 mx-auto">
        <?php $this->flashMsg('error') ?>
      </div>
    </div>
  <?php }  ?>
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <!-- Basic registration form-->
      <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
        <div class="card-header bg-green text-white justify-content-center">
          <h3 class="fw-light mb-0" style="text-transform: uppercase;">Đăng Ký</h3>
        </div>
        <div class="card-body">
          <!-- Registration form-->
          <form method="POST" action="<?php echo $this->helper->createUrl('register') ?>">
            <div class="row gx-3">
              <div class="col-md-6">
                <!-- Form Group (last name)-->
                <div class="mb-3">
                  <label class="small mb-1" for="inputLastName">Họ: </label>
                  <input class="form-control " id="inputLastName" name="lastname" type="text" placeholder="Nhập họ" value="" required autocomplete="lastname" autofocus />
                  <?php $this->displayError('lastname') ?>
                </div>
              </div>
              <div class="col-md-6">
                <!-- Form Group (first name)-->
                <div class="mb-3">
                  <label class="small mb-1" for="inputFirstName">Tên: </label>
                  <input class="form-control " id="inputFirstName" name="firstname" type="text" placeholder="Nhập tên" value="" required autocomplete="firstname" autofocus />
                  <?php $this->displayError('firstname') ?>
                </div>
              </div>
            </div>
            <!-- Form Group (email address)            -->
            <div class="row gx-3">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="small mb-1" for="inputEmailAddress">Email: </label>
                  <input class="form-control " id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Nhập email" value="" required autocomplete="email" autofocus />
                  <?php $this->displayError('email') ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="small mb-1" for="inputTelephone">Số Điện Thoại: </label>
                  <input class="form-control " id="inputTelephone" name="telephone" type="text" placeholder="Nhập số điện thoại" value="" required autocomplete="email" autofocus />
                  <?php $this->displayError('telephone') ?>
                </div>
              </div>
            </div>
            <!-- Form Row    -->
            <div class="row gx-3">
              <div class="col-md-6">
                <!-- Form Group (password)-->
                <div class="mb-3">
                  <label class="small mb-1" for="inputPassword">Mật Khẩu: </label>
                  <input class="form-control " id="inputPassword" type="password" name="password" placeholder="Nhập mật khẩu" required autocomplete="new-password" />
                  <?php $this->displayError('password') ?>
                </div>
              </div>
              <div class="col-md-6">
                <!-- Form Group (confirm password)-->
                <div class="mb-3">
                  <label class="small mb-1" for="inputConfirmPassword">Mật Khẩu:</label>
                  <input class="form-control" id="inputConfirmPassword" type="password" name="repassword" placeholder="Nhập lại mật khẩu" required autocomplete="new-password" />
                  <?php $this->displayError('repassword') ?>
                </div>
              </div>
            </div>

            <div class="row gx-3">
              <div class="col-md-6">
                <!-- Form Group (password)-->
                <div class="mb-3">
                  <label class="small mb-1" for="inputAddress">Địa Chỉ: </label>
                  <input class="form-control " id="inputAddress" type="text" name="address" placeholder="Nhập địa chỉ" required />
                  <?php $this->displayError('address') ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="small d-block" for="province">Tỉnh:</label>
                  <select name="province" id="province" class="mb-3 w-100" required>
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

            <div class="row gx-3">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="small d-block" for="district">Thành phố/quận:</label>
                  <select name="district" id="district" class="mb-3 w-100" required>
                    <option value="">Chọn thành phố/quận</option>
                  </select>
                  <?php $this->displayError('district') ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="small d-block" for="ward">Phường/Xã:</label>
                  <select name="ward" id="ward" class="mb-3 w-100" required>
                    <option value="">Chọn phường xã</option>
                  </select>
                  <?php $this->displayError('ward') ?>
                </div>
              </div>
            </div>
            <!-- Form Group (create account submit)-->
            <div class="text-center">
              <button class="btn btn-success bg-green  pl-5 pr-5" type="submit">Đăng Ký</button>
            </div>
          </form>
        </div>
        <div class="card-footer text-center">
          <div class="small"><a href="<?php echo $this->helper->createUrl('login') ?>">Đã có tài khoản? Đăng nhập</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .small a {
    font-size: 14px;
    font-weight: 600;
    color: #7fad39;
  }

  .small a:hover {
    color: #000;
  }
</style>