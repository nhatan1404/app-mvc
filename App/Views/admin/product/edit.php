<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Tạo Sản Phẩm</h5>
      <div class="card-body">
        <form method="post" action="<?php echo $this->helper->createUrl('/admin/product/' . $this->product->id . '/update') ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputTitle" class="col-form-label">Tiêu đề: </label>
            <input class="form-control" type="text" id="inputTitle" name="title" placeholder="Nhập tiêu đề" value="<?php echo $this->product->title ?>" />
          </div>

          <div class="form-group">
            <label for="inputDescription" class="col-form-label"> Mô tả: </label>
            <textarea class="form-control" id="inputDescription" name="description" placeholder="Nhập mô tả" rows=5><?php echo $this->product->description ?></textarea>
          </div>


          <div class="form-group">
            <label for="inputDiscount" class="col-form-label">Chiết khấu(%): </label>
            <input class="form-control" type="number" id="inputDiscount" name="discount" placeholder="Nhập chiết khấu" value="<?php echo $this->product->discount ?>" min=0 max=100 />
          </div>

          <div class="form-group">
            <label for="inputQuantity" class="col-form-label">Số lượng: </label>
            <input class="form-control" type="number" id="inputQuantity" name="quantity" placeholder="Nhập số lượng" value="<?php echo $this->product->quantity ?>" />
          </div>

          <div class="form-group">
            <label for="inputCategory_id">Danh mục: <span class="text-danger">*</span></label>
            <select name="category_id" id="inputCategory_id" class="form-control">
              <option value="">Chọn danh mục</option>
              <?php
              foreach ($this->categories as $parent) { ?>
                <optgroup label="<?php echo $parent->title ?>">
                  <?php foreach ($parent->child as $child) { ?>
                    <option value='<?php echo $child->id ?>' <?php echo $child->id == $this->product->category_id ? ' selected' : '' ?>><?php echo $child->title ?></option>
                  <?php } ?>
                </optgroup>
              <?php
              } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="inputPrice" class="col-form-label">Giá: </label>
            <input class="form-control" type="number" id="inputPrice" name="price" placeholder="Nhập giá" value="<?php echo $this->product->price ?>" />
          </div>

          <div class="form-group">
            <label for="inputImages" class="col-form-label">Ảnh: </label>
            <input class="form-control" id="inputImage" name="images" oninput="imgReview.src=window.URL.createObjectURL(this.files[0])" type="file">
            <img id="imgReview" src="<?php echo $this->helper->createUrlImg($this->product->images) ?>" class="mt-3 img-fluid img-thumbnail" style="max-width: 200px" />
          </div>

          <div class="form-group">
            <label for="inputStatus">Trạng thái: <span class="text-danger">*</span></label>
            <select name="status" id="inputStatus" class="form-control">
              <option value="">Chọn trạng thái</option>
              <option value="active" <?php echo $this->product->status ==  'active' ? ' selected'  : '' ?>>Hiển thị</option>
              <option value="inactive" <?php echo $this->product->status ==  'inactive' ? ' selected'  : '' ?>>Ẩn</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <button class="btn btn-success" type="submit">Cập nhật</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>