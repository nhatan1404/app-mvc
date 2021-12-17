<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Sửa Đơn Đặt Hàng</h5>
      <div class="card-body">
        <form method="post" action="<?php echo $this->helper->createUrl('admin/order/' . $this->order->id . '/update') ?>">
          <div class="form-group">
            <label for="inputStatus">Trạng thái: <span class="text-danger">*</span></label>
            <select name="status" id="inputStatus" class="form-control">
              <option value="">Chọn trạng thái</option>
              <option value="new" <?php echo $this->order->status == 'new' ? ' selected' : '' ?>>Mới</option>
              <option value="accepted" <?php echo $this->order->status == 'accepted' ? ' selected' : '' ?>>Chấp nhận</option>
              <option value="delivering" <?php echo $this->order->status == 'delivering' ? ' selected' : '' ?>>Đang vận chuyển</option>
              <option value="cancel" <?php echo $this->order->status == 'cancel' ? ' selected' : '' ?>>Huỷ</option>
              <option value="done" <?php echo $this->order->status == 'done' ? ' selected' : '' ?>>Hoàn thành</option>
            </select>
          </div>

          <div class="form-group">
            <label for="inputNote" class="col-form-label">Ghi chú: </label>
            <textarea class="form-control" id="inputNote" name="note" placeholder="Nhập ghi chú"></textarea>
          </div>
          <div class="form-group mb-3">
            <button class="btn btn-success" type="submit">Cập Nhật</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>