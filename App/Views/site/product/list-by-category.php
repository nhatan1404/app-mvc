  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg" data-setbg="<?php echo $this->helper->createUrl('/public/site/images/breadcrumb.jpg') ?>">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="breadcrumb__text">
            <h2><?php echo $this->categoryTitle ?></h2>
            <div class="breadcrumb__option">
              <a href="<?php echo $this->helper->createUrl() ?>">Trang Chủ</a>
              <span>Danh Mục</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->


  <!-- Product Section Begin -->
  <section class="product spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-5">
          <div class="sidebar">
            <div class="sidebar__item">
              <h4>Tất Cả Danh Mục</h4>
              <ul>
                <?php foreach ($this->helper->getListAllCategory() as $category) { ?>
                  <li><a href="<?php echo $this->helper->createSlug('category', $category->id, $category->slug) ?>"><?php echo $category->title ?></a></li>
                <?php } ?>
              </ul>
            </div>
            <div class="sidebar__item">
              <div class="latest-product__text">
                <h4>Sản phẩm mới</h4>
                <div class="latest-product__slider owl-carousel">
                  <?php
                  $list = $this->helper->getLastestProduct(6);
                  foreach ($list as $count => $product) { ?>
                    <?php echo $count == 0 ||  $count % 3 == 0 ? '<div class="latest-prdouct__slider__item">' : '' ?>
                    <a href="<?php echo $this->helper->createSlug('product', $product->id, $product->slug) ?>" class="latest-product__item">
                      <div class="latest-product__item__pic">
                        <img src="<?php echo $this->helper->createUrlImg($product->images) ?>" alt="<?php echo $product->title ?>">
                      </div>

                      <div class="latest-product__item__text">
                        <h6><?php echo $product->title ?></h6>
                        <span><?php echo $this->helper->formatCurrency($product->price) ?>đ</span>
                      </div>
                    </a>
                    <?php echo $count == 2 ||  $count + 1 % 3 == 0 ||  $count + 1 == count($list)  ? '</div>' : '' ?>
                  <?php
                  } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-7">
          <div class="product__discount">
            <div class="section-title product__discount__title">
              <h2>Đang Khuyến Mãi</h2>
            </div>
            <div class="row">
              <div class="product__discount__slider owl-carousel">
                <?php
                foreach ($this->helper->getLastestDiscountProduct(6) as $product) { ?>
                  <div class="col-lg-4">
                    <div class="product__discount__item">
                      <div class="product__discount__item__pic set-bg" data-setbg="<?php echo $this->helper->createUrlImg($product->images) ?>">
                        <div class="product__discount__percent">-<?php echo $product->discount ?>%</div>
                        <ul class="product__item__pic__hover">
                          <li><a href="#"><i class="fa fa-heart"></i></a></li>
                          <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                          <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                      </div>
                      <div class="product__discount__item__text">
                        <h5><a href="<?php echo $this->helper->createSlug('product', $product->id, $product->slug) ?>"><?php echo $product->title ?></a></h5>
                        <div class="product__item__price"><?php echo $this->helper->formatCurrency($product->price - ($product->price * ($product->discount / 100))) ?>đ <span><?php echo $this->helper->formatCurrency($product->price) ?>đ</span></div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="filter__item">
            <div class="row">
              <div class="col-lg-4 col-md-5">
                <div class="filter__sort">
                  <span>Sắp xếp</span>
                  <form method="get" action="<?php echo $this->getUrl() ?>">
                    <select id="sort-product" name="sort" onchange="this.form.submit()">
                      <option value="new">Mới nhất</option>
                      <option value="old">Cũ nhất</option>
                      <option value="sold">Bán chạy</option>
                      <option value="lowPrice">Giá từ thấp đến cao</option>
                      <option value="highPrice">Giá từ cao đến thấp</option>
                    </select>
                  </form>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="filter__found">
                  <h6><span><?php echo $this->countProduct ?></span> sản phẩm</h6>
                </div>
              </div>
              <div class="col-lg-4 col-md-3">
                <div class="filter__option">
                  <span class="icon_grid-2x2"></span>
                  <span class="icon_ul"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <?php
            if ($this->countProduct > 0) {
              foreach ($this->products as $product) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                  <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="<?php echo $this->helper->createUrlImg($product->images) ?>">
                      <ul class="featured__item__pic__hover">
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
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
          <?php if (isset($this->totalPage) && isset($this->currentPage) && $this->totalPage != 1) { ?>
            <div class="float-left">
              <div class="paginate-product">
                <ul class="pagination">
                  <li class="paginate_button page-item previous <?php echo ($this->currentPage < 2 ? ' disabled' :  '') ?>" id="dataTable_previous"><a href="<?php echo $this->bindQuery('page', ($this->currentPage > 2 ? $this->currentPage - 1 :  1)) ?>" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link"><i class="fa fa-chevron-left"></i></a></li>
                  <?php for ($i = 1; $i <= $this->totalPage; $i++) {
                  ?>
                    <li class="paginate_button page-item <?php echo ($this->currentPage == $i ? ' active' : '') ?>"><a href="<?php echo $this->bindQuery('page', $i) ?>" aria-controls="dataTable" data-dt-idx="<?php echo $i ?>" tabindex="0" class="page-link"><?php echo $i ?></a></li>
                  <?php
                  } ?>
                  <li class="paginate_button page-item next <?php echo ($this->currentPage < $this->totalPage ? '' :  ' disabled') ?>" id="dataTable_next"><a href="<?php echo $this->bindQuery('page', ($this->currentPage < $this->totalPage ? $this->currentPage + 1 :  $this->totalPage)) ?>" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link"><i class="fa fa-chevron-right"></i></a></li>
                </ul>
              </div>
            </div>
          <?php }
            } else { ?>
          <h6 class="text-center">Danh sách trống.</h6>
        <?php } ?>
        </div>
      </div>
    </div>
  </section>
  <!-- Product Section End -->