    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="<?php echo $this->helper->createUrl('public/site/images/breadcrumb.jpg') ?>">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
              <h2>Sản Phẩm</h2>
              <div class="breadcrumb__option">
                <a href="<?php echo $this->helper->createUrl() ?>">Trang Chủ</a>
                <a href="<?php echo $this->helper->createSlug('category', $this->product->category_id, $this->product->category_slug) ?>"><?php echo $this->product->category_title ?></a>
                <span><?php echo $this->product->title ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="product__details__pic">
              <div class="product__details__pic__item">
                <img class="product__details__pic__item--large" src="<?php echo $this->isLocalImage($this->product->images) ?  $this->helper->createUrl($this->product->images) : $this->product->images ?>" alt="">
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="product__details__text">
              <h3><?php echo $this->product->title ?></h3>
              <div class="product__details__price"><?php echo $this->helper->formatCurrency($this->product->price) ?>đ</div>
              <p><?php echo substr($this->product->description, 0, 250) ?>...</p>
              <div class="product__details__quantity">
                <div class="quantity">
                  <div class="pro-qty">
                    <input type="text" value="1">
                  </div>
                </div>
              </div>
              <a href="javascript:void(0)" onclick="addCart(<?php echo $this->product->id ?>)" class="primary-btn">Thêm Vào Giỏ Hàng</a>
              <ul>
                <li><b>Số lượng</b> <span><?php echo $this->product->quantity ?> sản phẩm có sẵn</span></li>
                <li><b>Chia sẻ</b>
                  <div class="share">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="product__details__tab">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Mô tả</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                  <div class="product__details__tab__desc">
                    <h6>Thông tin sản phẩm</h6>
                    <p><?php echo $this->product->description ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title related__product__title">
              <h2>Sản Phẩm Ngẫu Nhiên</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <?php
          foreach ($this->helper->getRelatedProduct(4) as $product) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="<?php echo $this->helper->createUrlImg($product->images) ?>">
                  <ul class="product__item__pic__hover">
                    <li><a href="javascript:void(0)" onclick="addCart(<?php echo $product->id ?>)"><i class="fa fa-shopping-cart"></i></a></li>
                  </ul>
                </div>
                <div class="product__item__text">
                  <h6><a href="<?php echo $this->helper->createSlug('product', $product->id, $product->slug) ?>"><?php echo $product->title ?></a></h6>
                  <h5><?php echo $this->helper->formatCurrency($product->price) ?>đ</h5>
                </div>
              </div>
            </div>
          <?php
          } ?>
        </div>
      </div>
    </section>
    <!-- Related Product Section End -->