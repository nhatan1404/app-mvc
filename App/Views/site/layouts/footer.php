 <!-- Footer Section Begin -->
 <footer class="footer spad">
   <div class="container">
     <div class="row">
       <div class="col-lg-3 col-md-6 col-sm-6">
         <div class="footer__about">
           <div class="footer__about__logo">
             <a href=""><img src="<?php echo $this->helper->createUrlImg('public/site/images/logo.png') ?>" alt=""></a>
           </div>
           <ul>
             <li>Địa chỉ: 180 Cao Lỗ, Phường 4, Quận 8, TP. Hồ Chí Minh</li>
             <li>Số điện thoại: +84951234567</li>
             <li>Email: DH51804249@student.stu.edu.vn</li>
           </ul>
         </div>
       </div>
       <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
         <div class="footer__widget">
           <h6>Liên Kết</h6>
           <ul>
             <li><a href="<?php echo $this->helper->createUrl('about') ?>">Giới thiệu</a></li>
             <li><a href="<?php echo $this->helper->createUrl('') ?>">Về cửa hàng của chúng tôi</a></li>
             <li><a href="<?php echo $this->helper->createUrl('') ?>">Thông tin giao hàng</a></li>
             <li><a href="<?php echo $this->helper->createUrl('') ?>">Chính sách bảo mật</a></li>
           </ul>
           <ul>
             <li><a href="<?php echo $this->helper->createUrl('') ?>">Thông tin</a></li>
             <li><a href="<?php echo $this->helper->createUrl('') ?>">Dịch vụ của chúng tôi</a></li>
             <li><a href="<?php echo $this->helper->createUrl('') ?>">Dự án</a></li>
             <li><a href="<?php echo $this->helper->createUrl('') ?>">Liên hệ</a></li>
           </ul>
         </div>
       </div>
       <div class="col-lg-4 col-md-12">
         <div class="footer__widget">
           <h6>Tham gia bản tin của chúng tôi ngay bây giờ</h6>
           <p>Nhận cập nhật qua email về cửa hàng mới nhất của chúng tôi và các ưu đãi đặc biệt.</p>
           <form action="<?php echo $this->helper->createUrl('') ?>">
             <input type="text" placeholder="Nhập email">
             <button type="submit" class="site-btn">Theo dõi</button>
           </form>
           <div class="footer__widget__social">
             <a href="<?php echo $this->helper->createUrl('') ?>"><i class="fa fa-facebook"></i></a>
             <a href="<?php echo $this->helper->createUrl('') ?>"><i class="fa fa-instagram"></i></a>
             <a href="<?php echo $this->helper->createUrl('') ?>"><i class="fa fa-twitter"></i></a>
             <a href="<?php echo $this->helper->createUrl('') ?>"><i class="fa fa-pinterest"></i></a>
           </div>
         </div>
       </div>
     </div>
     <div class="row">
       <div class="col-lg-12">
         <div class="footer__copyright">
           <div class="footer__copyright__text">
             <p>
               <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
               Copyright &copy;<script>
                 document.write(new Date().getFullYear());
               </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
               <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
             </p>
           </div>
           <div class="footer__copyright__payment"><img src="<?php echo $this->helper->createUrlImg('public/site/images/payment-item.png') ?>" alt="payment"></div>
         </div>
       </div>
     </div>
   </div>
 </footer>
 <!-- Footer Section End -->

 <!-- Js Plugins -->
 <script>
   const __apiURL = '<?php echo $this->helper->createUrl('') ?>';
 </script>
 <script src="<?php echo $this->helper->createUrl('public/site/js/jquery-3.3.1.min.js') ?>"></script>
 <script src="<?php echo $this->helper->createUrl('public/site/js/bootstrap.min.js') ?>"></script>
 <script src="<?php echo $this->helper->createUrl('public/site/js/jquery.nice-select.min.js') ?>"></script>
 <script src="<?php echo $this->helper->createUrl('public/site/js/jquery-ui.min.js') ?>"></script>
 <script src="<?php echo $this->helper->createUrl('public/site/js/jquery.slicknav.js') ?>"></script>
 <script src="<?php echo $this->helper->createUrl('public/site/js/mixitup.min.js') ?>"></script>
 <script src="<?php echo $this->helper->createUrl('public/site/js/owl.carousel.min.js') ?>"></script>
 <script src="<?php echo $this->helper->createUrl('public/site/js/notyf.min.js') ?>"></script>
 <script src="<?php echo $this->helper->createUrl('public/site/js/main.js') ?>"></script>
 <script src="<?php echo $this->helper->createUrl('public/site/js/custom.js') ?>"></script>


 </body>

 </html>