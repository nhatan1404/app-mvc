    <!-- Featured Section Begin -->
    <section class="featured spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Sản Phẩm</h2>
            </div>
            <div class="featured__controls">
              <ul>
                <li class="active" data-filter="*">Tất cả</li>
                <?php foreach ($this->helper->getListParentCategory() as $category) { ?>
                  <li data-filter=".oranges"><?php echo $category->title ?></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="row featured__filter" id="product-list">
          <?php
          foreach ($this->products as $product) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
              <div class="featured__item">
                <div class="featured__item__pic set-bg" data-setbg="<?php echo $this->isLocalImage($product->images) ? APP_URL . '/' . $product->images : $product->images ?>">
                  <ul class="featured__item__pic__hover">
                    <li><a href="javascript:void(0)" onclick="addCart(<?php echo $product->id ?>)"><i class="fa fa-shopping-cart"></i></a></li>
                  </ul>
                </div>
                <div class="featured__item__text">
                  <h6><a href="<?php echo $this->helper->createSlug('product', $product->id, $product->slug) ?>"><?php echo $product->title ?></a></h6>
                  <h5><?php echo $this->helper->formatCurrency($product->price) ?>đ</h5>
                </div>
              </div>
            </div>
          <?php
          } ?>
        </div>
      </div>
      <div class="text-center"><button class="btn btn-lg btn-more" id="see-more">Xem Thêm</button></div>
    </section>
    <!-- Featured Section End -->