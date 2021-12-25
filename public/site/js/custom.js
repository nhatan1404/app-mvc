(function ($) {
  $('#inputAvatar').change(function () {
    if ($(this).val() == '') {
      $('#btn-avatar').attr('disabled', true);
    } else {
      $('#btn-avatar').attr('disabled', false);
    }
  });
  // Load product
  var pageNumber = 2;
  $('#see-more').click(function () {
    const url = __apiURL;
    $.ajax({
      headers: {
        HTTP_X_REQUESTED_WITH: 'XMLHttpRequest',
      },
      type: 'get',
      url: `${url}index-ajax?page=${pageNumber}`,
      success: function (response) {
        $('#product-list').append(response.html);
        $('.set-bg').each(function () {
          var bg = $(this).data('setbg');
          $(this).css('background-image', 'url(' + bg + ')');
        });
        if (response.totalPage == response.currentPage) {
          $('#see-more').remove();
          return false;
        }
        pageNumber++;
      },
      error: function (error) {
        //console.log(error.responseJSON.message)
      },
    });
  });
})(jQuery);

const notyf = new Notyf({
  position: {
    x: 'right',
    y: 'top',
  },
  types: [
    {
      type: 'info',
      background: '#82ae46',
    },
  ],
  duration: 3000,
});

const formatCurrency = (price) =>
  new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
  }).format(price);

function addCart(id) {
  const cart_count = $('.cart_count');
  const regex = /^\/product\/.*$/g;
  let quantity = 1;
  const path = window.location.pathname;
  if (regex.test(path)) {
    quantity = $('#quantity').val();
  }

  $.ajax({
    headers: {
      HTTP_X_REQUESTED_WITH: 'XMLHttpRequest',
    },
    type: 'post',
    data: {
      product_id: id,
      quantity,
    },
    url: `${__apiURL}cart/add`,
    success: function (response) {
      const { count, isUpdate } = response;
      if (isUpdate) {
        cart_count.each((index, element) => {
          $(element).text(count);
        });
      }
      notyf.open({
        type: 'info',
        message: 'Thêm vào giỏ hàng thành công',
      });

      const path = window.location.pathname.substr(1, 4);
      if (path === 'cart' && count > 0) {
        setTimeout(() => {
          location.reload();
        }, 1500);
      }
    },
    error: function (error) {
      if (error.status && error.status === 401) {
        window.location.href = `${__apiURL}login`;
        return;
      }
      notyf.open({
        type: 'error',
        message: 'Có lỗi xảy ra!',
        duration: 3000,
      });
    },
  });
}

let timeout = null;

function updateCart(event, id, value = null) {
  clearTimeout(timeout);
  timeout = setTimeout(function () {
    const quantity =
      event === null && value !== null ? value : parseInt(event.target.value);
    if (quantity == 0) {
      notyf.open({
        type: 'error',
        message: 'Số lượng phải lớn hơn 0',
        duration: 3000,
      });
      return false;
    }
    $.ajax({
      headers: {
        HTTP_X_REQUESTED_WITH: 'XMLHttpRequest',
      },
      data: {
        item_id: id,
        quantity,
      },
      type: 'post',
      url: `${__apiURL}cart/update`,
      success: function (response) {
        const { total_item, total, message } = response;
        const total_price_item = $(`[data-price="${id}"]`);

        total_price_item.text(formatCurrency(total_item));

        const subtotal_price = $('#subtotal');
        subtotal_price.text(formatCurrency(total));

        const total_price = $('#total_currency_cart');
        total_price.text(formatCurrency(total));

        notyf.open({
          type: 'info',
          message,
        });
      },
      error: function (error) {
        if (error.status && error.status === 401) {
          window.location.href = `${__apiURL}login`;
          return;
        }
        const { type } = error.responseJSON;
        const message =
          type && type == 'quantity'
            ? 'Số lượng lớn hơn số lượng hàng có sẵn'
            : 'Có lỗi xảy ra';
        notyf.open({
          type: 'error',
          message,
          duration: 3000,
        });
        //console.log(error.responseJSON);
      },
    });
  }, 2000);
}

function removeCart(id) {
  const cart_count = $('.cart_count');
  const row = $(`[data-row="${id}"]`);
  if (row.hasClass('disabled')) return;
  row.addClass('fadeOutRightBig disabled');
  $.ajax({
    headers: {
      HTTP_X_REQUESTED_WITH: 'XMLHttpRequest',
    },
    type: 'post',
    data: {
      item_id: id,
    },
    url: `${__apiURL}cart/remove`,
    success: function (response) {
      const { total, message } = response;
      let count = parseInt(cart_count.first().text());
      count = count > 1 ? count - 1 : 0;
      row.fadeOut(400, function () {
        row.remove();
      });
      cart_count.each((index, element) => {
        $(element).empty();
        $(element).text(count);
      });
      const subtotal_price = $('#subtotal');
      subtotal_price.text(formatCurrency(total));

      const total_price = $('#total_currency_cart');
      total_price.text(formatCurrency(total));

      notyf.open({
        type: 'info',
        message,
      });
      if (!total) {
        setTimeout(() => {
          location.reload();
        }, 5500);
      }
    },
    error: function (error) {
      if (error.status && error.status === 401) {
        window.location.href = `${__apiURL}login`;
        return;
      }
      notyf.open({
        type: 'error',
        message: 'Có lỗi xảy ra!',
        duration: 3000,
      });
    },
  });
}

$('#province').change(function () {
  const id = $(this).find('option:selected').val();
  $.ajax({
    headers: {
      HTTP_X_REQUESTED_WITH: 'XMLHttpRequest',
    },
    type: 'post',
    data: {
      province: id,
    },
    url: `${window.location.origin}/app-mvc/address/district`,
    success: function (data) {
      const { districts } = data;
      const districtSelect = $('#district');
      districtSelect.empty();

      const wardSelect = $('#ward');
      wardSelect.empty();

      districtSelect.append('<option value="">Chọn thành phố/quận</option>');

      wardSelect.append('<option value="">Chọn phường/xã</option>');

      districts.forEach((district) => {
        districtSelect.append(
          `<option value="${district.code}">${district.name_with_type}</option>`,
        );
      });
      $('select').niceSelect('destroy');
      $('select').niceSelect();
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

$('#district').change(function () {
  const id = $(this).find('option:selected').val();
  $.ajax({
    headers: {
      HTTP_X_REQUESTED_WITH: 'XMLHttpRequest',
    },
    type: 'post',
    data: {
      ward: id,
    },
    url: `${window.location.origin}/app-mvc/address/ward`,
    success: function (data) {
      const { wards } = data;
      const wardSelect = $('#ward');
      wardSelect.empty();
      wardSelect.append('<option value="">Chọn phường/xã</option>');

      wards.forEach((ward) => {
        wardSelect.append(
          `<option value="${ward.code}">${ward.name_with_type}</option>`,
        );
      });
      $('select').niceSelect('destroy');
      $('select').niceSelect();
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

var proQty = $('.pro-qty');
proQty.prepend('<span class="dec qtybtn">-</span>');
proQty.append('<span class="inc qtybtn">+</span>');
proQty.on('click', '.qtybtn', function () {
  var $button = $(this);
  var oldValue = $button.parent().find('input').val();
  if ($button.hasClass('inc')) {
    var newVal = parseFloat(oldValue) + 1;
  } else {
    // Don't allow decrementing below zero
    if (oldValue > 0) {
      var newVal = parseFloat(oldValue) - 1;
    } else {
      newVal = 0;
    }
  }
  const id = $button.parent().find('input').data('id');
  $button.parent().find('input').val(newVal);
  updateCart(null, id, newVal);
});

$('#handleOrder').click(function () {
  const firstname = $('input[name="firstname"]').val().trim();
  const lastname = $('input[name="lastname"]').val().trim();
  const province = $('#province').find('option:selected').text().trim();
  const district = $('#district').find('option:selected').text().trim();
  const ward = $('#ward').find('option:selected').text().trim();
  const address = $('input[name="address"]').val().trim();
  const telephone = $('input[name="telephone"]').val().trim();
  const email = $('input[name="email"]').val().trim();
  const note = $('textarea[name="note"]').val().trim();
  const data = {
    firstname,
    lastname,
    province,
    district,
    ward,
    address,
    telephone,
    email,
    note,
  };
  $.ajax({
    headers: {
      HTTP_X_REQUESTED_WITH: 'XMLHttpRequest',
    },
    type: 'post',
    data,
    url: `${__apiURL}checkout`,
    success: function () {
      window.location.replace(`${__apiURL}order-success`);
    },
    error: function (error) {
      if (error.responseJSON && error.responseJSON.type == 'cart-empty') {
        notyf.open({
          type: 'error',
          message: 'Giỏ hàng trống',
          duration: 3000,
        });
        setTimeout(function () {
          location.reload();
        }, 3500);
      }
      notyf.open({
        type: 'error',
        message: 'Đặt hàng không thành công.',
        duration: 3000,
      });
    },
  });
});

$(document).ready(function () {
  const query = window.location.search;
  const params = new URLSearchParams(query);
  const sort = params.get('sort');
  if (sort) {
    $('#sort-product').val(sort);
    $('select').niceSelect('destroy');
    $('select').niceSelect();
  }
});
