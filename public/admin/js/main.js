$(document).ready(function () {
  $('input, select, textarea').focus(function () {
    const msg = $(this).next();
    msg.hide('slow', function () {});
    //$(this).next().siblings('.text-danger').hide();
  });

  $('.btnDelete').click(function (e) {
    const form = $(this).closest('form');
    e.preventDefault();
    Swal.fire({
      title: 'Bạn có muốn xoá?',
      text: 'Sau khi xóa, bạn sẽ không thể khôi phục dữ liệu này!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Xác nhận',
      cancelButtonText: 'Huỷ',
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });

  setTimeout(function () {
    $('.alert').slideUp();
  }, 3000);
});

$('#inputProvince').change(function () {
  const id = $(this).find('option:selected').val();
  $.ajax({
    headers: {
      HTTP_X_REQUESTED_WITH: 'XMLHttpRequest',
    },
    type: 'post',
    data: {
      province: id,
    },
    url: `${__apiURL}address/district`,
    success: function (data) {
      const { districts } = data;
      const districtSelect = $('#inputDistrict');
      districtSelect.empty();

      const wardSelect = $('#inputWard');
      wardSelect.empty();

      districtSelect.append('<option value="">Chọn thành phố/quận</option>');

      wardSelect.append('<option value="">Chọn phường/xã</option>');

      districts.forEach((district) => {
        districtSelect.append(
          `<option value="${district.code}">${district.name_with_type}</option>`,
        );
      });
    },
    error: function (error) {
      notyf.open({
        type: 'error',
        message: 'Không thể lấy danh sách thành phố/quận!',
        duration: 3000,
      });
    },
  });
});

$('#inputDistrict').change(function () {
  const id = $(this).find('option:selected').val();
  $.ajax({
    headers: {
      HTTP_X_REQUESTED_WITH: 'XMLHttpRequest',
    },
    type: 'post',
    data: {
      ward: id,
    },
    url: `${__apiURL}address/ward`,
    success: function (data) {
      const { wards } = data;
      const wardSelect = $('#inputWard');
      wardSelect.empty();
      wardSelect.append('<option value="">Chọn phường/xã</option>');

      wards.forEach((ward) => {
        wardSelect.append(
          `<option value="${ward.code}">${ward.name_with_type}</option>`,
        );
      });
    },
    error: function (error) {
      if (error.status === 401) {
        window.location.href = '/login';
        return;
      }
      notyf.open({
        type: 'error',
        message: 'Không thể lấy danh sách thành phường/xã!',
        duration: 3000,
      });
    },
  });
});
