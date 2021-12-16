<div class="container-xl px-4">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <!-- Basic registration form-->
      <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
        <div class="card-header cart-empty justify-content-center">
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
                </div>
              </div>
              <div class="col-md-6">
                <!-- Form Group (first name)-->
                <div class="mb-3">
                  <label class="small mb-1" for="inputFirstName">Tên: </label>
                  <input class="form-control " id="inputFirstName" name="firstname" type="text" placeholder="Nhập tên" value="" required autocomplete="firstname" autofocus />
                </div>
              </div>
            </div>
            <!-- Form Group (email address)            -->
            <div class="row gx-3">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="small mb-1" for="inputEmailAddress">Email: </label>
                  <input class="form-control " id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Nhập email" value="" required autocomplete="email" autofocus />
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="small mb-1" for="inputTelephone">Số Điện Thoại: </label>
                  <input class="form-control " id="inputTelephone" name="telephone" type="text" placeholder="Nhập số điện thoại" value="" required autocomplete="email" autofocus />
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
                </div>
              </div>
              <div class="col-md-6">
                <!-- Form Group (confirm password)-->
                <div class="mb-3">
                  <label class="small mb-1" for="inputConfirmPassword">Mật Khẩu:</label>
                  <input class="form-control" id="inputConfirmPassword" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required autocomplete="new-password" />
                </div>
              </div>
            </div>

            <div class="row gx-3">
              <div class="col-md-6">
                <!-- Form Group (password)-->
                <div class="mb-3">
                  <label class="small mb-1" for="inputAddress">Địa Chỉ: </label>
                  <input class="form-control " id="inputAddress" type="text" name="address" placeholder="Nhập địa chỉ" required />
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
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="small d-block" for="ward">Phường/Xã:</label>
                  <select name="ward" id="ward" class="mb-3 w-100" required>
                    <option value="">Chọn phường xã</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- Form Group (create account submit)-->
            <div class="text-center">
              <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit">Đăng Ký</button>
            </div>
          </form>
        </div>
        <div class="card-footer text-center">
          <div class="small"><a href="https://nhatan.ga/user/login">Đã có tài khoản? Đăng nhập</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>