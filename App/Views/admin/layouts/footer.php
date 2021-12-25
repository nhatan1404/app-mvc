</div>
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; <?php echo Date('Y') ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bạn có muốn đăng xuất không?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
        <form method="post" action="<?php echo $this->helper->createUrl('logout') ?>">
          <input type="hidden" name="logout" value="true" />
          <button type="submit" class="btn btn-danger">Đăng xuất</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  const __apiURL = '<?php echo $this->helper->createUrl() ?>';
</script>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo $this->helper->createUrl('public/admin/js/jquery.min.js') ?>"></script>
<script src="<?php echo $this->helper->createUrl('public/admin/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo $this->helper->createUrl('public/admin/js/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo $this->helper->createUrl('public/admin/js/sb-admin-2.min.js') ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo $this->helper->createUrl('public/admin/js/main.js') ?>"></script>

</body>

</html>