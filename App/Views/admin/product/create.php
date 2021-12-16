<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Tạo Sản Phẩm</h5>
      <div class="card-body">
        <form method="post" action="<?php echo APP_URL . '/admin/product/store' ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputTitle" class="col-form-label">Tiêu đề: </label>
            <input class="form-control" type="text" id="inputTitle" name="title" placeholder="Nhập tiêu đề" value="" />
            <?php $this->displayError('title') ?>
          </div>

          <div class="form-group">
            <label for="inputDescription" class="col-form-label"> Mô tả: </label>
            <textarea class="form-control" id="inputDescription" name="description" placeholder="Nhập mô tả" rows=5></textarea>
            <?php $this->displayError('description') ?>
          </div>

          <div class="form-group">
            <label for="inputDiscount" class="col-form-label">Chiết khấu(%): </label>
            <input class="form-control" type="number" id="inputDiscount" name="discount" placeholder="Nhập chiết khấu" value="0" min=0 max=100 />
            <?php $this->displayError('discount') ?>
          </div>

          <div class="form-group">
            <label for="inputQuantity" class="col-form-label">Số lượng: </label>
            <input class="form-control" type="number" id="inputQuantity" name="quantity" placeholder="Nhập số lượng" value="" min=0 max=9223372036854775807 />
            <?php $this->displayError('quantity') ?>
          </div>

          <div class="form-group">
            <label for="inputCategory_id">Danh mục: <span class="text-danger">*</span></label>
            <select name="category_id" id="inputCategory_id" class="form-control">
              <option value="">Chọn danh mục</option>
              <?php
              foreach ($this->categories as $parent) { ?>
                <optgroup label="<?php echo $parent->title ?>">
                  <?php foreach ($parent->child as $child) { ?>
                    <option value='<?php echo $child->id ?>'><?php echo $child->title ?></option>
                  <?php } ?>
                </optgroup>
              <?php
              } ?>
            </select>
            <?php $this->displayError('category_id') ?>
          </div>

          <div class="form-group">
            <label for="inputPrice" class="col-form-label">Giá: </label>
            <input class="form-control" type="number" id="inputPrice" name="price" placeholder="Nhập giá" value="" min=0 max=9223372036854775807 />
            <?php $this->displayError('price') ?>
          </div>

          <div class="form-group">
            <label for="inputImages" class="col-form-label">Ảnh: </label>
            <input class="form-control" id="inputImage" name="images" oninput="imgReview.src=window.URL.createObjectURL(this.files[0])" type="file">
            <?php $this->displayError('images') ?>
            <img class="img-fluid img-thumbnail mt-3" id="imgReview" style="max-width: 200px" />
          </div>

          <div class="form-group">
            <label for="inputStatus">Trạng thái: <span class="text-danger">*</span></label>
            <select name="status" id="inputStatus" class="form-control">
              <option value="">Chọn trạng thái</option>
              <option value="active">Hiển thị</option>
              <option value="inactive">Ẩn</option>
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