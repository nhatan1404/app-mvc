<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Sửa Danh Mục</h5>
      <div class="card-body">
        <form method="post" action="<?php echo APP_URL . '/admin/category/' . $this->category->id . '/update' ?>">
          <div class="form-group">
            <label for="inputTitle" class="col-form-label">Tiêu đề: </label>
            <input class="form-control" type="text" id="inputTitle" name="title" placeholder="Nhập tiêu đề" value="<?php echo $this->category->title ?>" />
            <?php $this->displayError('title') ?>
          </div>

          <div class="form-group">
            <label for="inputDescription" class="col-form-label"> Mô tả: </label>
            <textarea class="form-control" id="inputDescription" name="description" placeholder="Nhập mô tả"><?php echo $this->category->description; ?></textarea>
          </div>

          <div class="form-group">
            <label for="inputParent_id">Danh mục cha: <span class="text-danger">*</span></label>
            <select name="parent_id" id="inputParent_id" class="form-control">
              <option value="">Chọn danh mục cha</option>
              <?php
              foreach ($this->categories as $category) { ?>
                <option value='<?php echo $category->id ?>' <?php echo $category->id == $this->category->parent_id ? ' selected' : '' ?>><?php echo $category->title ?></option>
              <?php
              } ?>
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