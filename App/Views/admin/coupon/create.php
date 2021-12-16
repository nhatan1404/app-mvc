<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Tạo Mã Giảm Giá</h5>
      <div class="card-body">
        <form method="post" action="<?php echo APP_URL . '/admin/coupon/store' ?>">
          <div class="form-group">
            <label for="inputCode" class="col-form-label">Mã: </label>
            <input class="form-control" type="text" id="inputCode" name="code" placeholder="Nhập mã" value="" />
            <?php $this->displayError('code') ?>
          </div>

          <div class="form-group">
            <label for="inputType">Loại: <span class="text-danger">*</span></label>
            <select name="type" id="inputType" class="form-control">
              <option value="">Chọn loại</option>
              <option value="fixed">Giá tiền</option>
              <option value="percent">Phần trăm</option>
            </select>
            <?php $this->displayError('type') ?>
          </div>

          <div class="form-group">
            <label for="inputValue" class="col-form-label">Giá trị: </label>
            <input class="form-control" type="number" id="inputValue" name="value" placeholder="Nhập giá trị" value="" min=0 max=9223372036854775807 />
            <?php $this->displayError('value') ?>
          </div>

          <div class="form-group">
            <label for="inputStatus">Trạng thái: <span class="text-danger">*</span></label>
            <select name="status" id="inputStatus" class="form-control">
              <option value="">Chọn trạng thái</option>
              <option value="active">Còn hiệu lực</option>
              <option value="inactive">Hết hạn</option>
            </select>
            <?php $this->displayError('status') ?>
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