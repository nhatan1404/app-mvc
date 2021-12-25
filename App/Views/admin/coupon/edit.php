<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Sửa Mã Giảm Giá</h5>
      <div class="card-body">
        <form method="post" action="<?php echo $this->helper->createUrl('admin/coupon/' . $this->coupon->id . '/update') ?>">
          <div class="form-group">
            <label for="inputCode" class="col-form-label">Mã: </label>
            <input class="form-control" type="text" id="inputCode" name="code" placeholder="Nhập mã" value="<?php echo $this->coupon->code ?>" />
            <?php $this->displayError('code') ?>
          </div>

          <div class="form-group">
            <label for="inputType">Loại: <span class="text-danger">*</span></label>
            <select name="type" id="inputType" class="form-control">
              <option value="">Chọn loại</option>
              <option value="fixed" <?php echo $this->coupon->type ==  'fixed' ? ' selected'  : '' ?>>Giá tiền</option>
              <option value="percent" <?php echo $this->coupon->type ==  'percent' ? ' selected'  : '' ?>>Phần trăm</option>
            </select>
            <?php $this->displayError('type') ?>
          </div>

          <div class="form-group">
            <label for="inputValue" class="col-form-label">Giá trị: </label>
            <input class="form-control" type="number" id="inputValue" name="value" placeholder="Nhập giá trị" value="<?php echo $this->coupon->value ?>" />
            <?php $this->displayError('value') ?>
          </div>

          <div class="form-group">
            <label for="inputStatus">Trạng thái: <span class="text-danger">*</span></label>
            <select name="status" id="inputStatus" class="form-control">
              <option value="">Chọn trạng thái</option>
              <option value="active" <?php echo $this->coupon->status ==  'active' ? ' selected'  : '' ?>>Còn hiệu lực</option>
              <option value="inactive" <?php echo $this->coupon->status ==  'inactive' ? ' selected'  : '' ?>>Hết hạn</option>
            </select>
            <?php $this->displayError('status') ?>
          </div>
          <div class="form-group mb-3">
            <button class="btn btn-success" type="submit">Cập nhật</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>