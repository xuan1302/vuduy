(function ($) {
  // ajax woo cong trinh thi cong
  ajaxGetDataProductThiCong();
  $('.tab-thi-cong li').on('click', function(e) {
    e.preventDefault();
    const id = $(this).data('id');
    $(this).addClass('active').siblings().removeClass('active');
    ajaxGetDataProductThiCong(id)
  });

  function ajaxGetDataProductThiCong(id = ''){
    const idFilter = $('.tab-thi-cong li:nth-child(1)').data('id');
    $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'action_get_product_thi_cong',
        id: id ? id : idFilter // Lấy dữ liệu từ input
      },
      success: function(response) {
        $('#content-product-tab-thi-cong').html(response);
      },
      error: function(xhr, status, error) {
        console.log('Error: ' + error);
      }
    });
  }


  // ajax woo san pham ban chay

  ajaxGetDataProductSanPhamBanChay();
  $('.tab-san-pham-chay li').on('click', function(e) {
    e.preventDefault();
    const id = $(this).data('id');
    $(this).addClass('active').siblings().removeClass('active');
    ajaxGetDataProductSanPhamBanChay(id)
  });

  function ajaxGetDataProductSanPhamBanChay(id = ''){
    const idFilter = $('.tab-san-pham-chay li:nth-child(1)').data('id');
    $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'action_get_product_san_pha_ban_chay',
        id: id ? id : idFilter // Lấy dữ liệu từ input
      },
      success: function(response) {
        $('#content-product-tab-san-pham-chay').html(response);
      },
      error: function(xhr, status, error) {
        console.log('Error: ' + error);
      }
    });
  }


  //remove item card
  $('.list-product-checkout .icon-remove').click(function(){
    const id = $(this).data('id');
    $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'action_remove_product_from_mini_card',
        id: id
      },
      success: function(response) {
        if(response?.success) {
          $('#cart-' + id).remove(); // Xóa sản phẩm khỏi DOM
          $('#cart-count').text(response.data.cart_count);
          let notification = $('#success-message');
          if (notification.length === 0) {
            notification = $('<div id="success-message"></div>');
            $('body').append(notification);
          }
          notification.text('Sản phẩm đã được xóa khỏi giỏ hàng.').fadeIn().delay(3000).fadeOut();
        } else {
          let notification = $('#error-message');
          if (notification.length === 0) {
            notification = $('<div id="error-message"></div>');
            $('body').append(notification);
          }
          notification.text('Thất bại. Xin vui lòng thử lại.').fadeIn().delay(3000).fadeOut();
        }
      },
      error: function(xhr, status, error) {
        console.log('Error: ' + error);
      }
    });
  });

  $('.increase').click(function() {
    const id = $(this).data('id');
    const price = $(this).siblings('.price').val();
    var input = $(this).siblings('.numberInput');
    var currentValue = parseInt(input.val());
    input.val(currentValue + 1);
    $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'action_update_total_product_by_id',
        id: id,
        count: currentValue + 1,
        price
      },
      success: function(response) {
        if(response.success) {
          $('#cart-' + id + ' .right-content .provisional .value').html(response.data.total);
          $('#cart-count').text(response.data.cart_count);
          updateListProduct();
        }
      },
      error: function(xhr, status, error) {
        console.log('Error: ' + error);
      }
    });
  });

  $('.decrease').click(function() {
    const id = $(this).data('id');
    const price = $(this).siblings('.price').val();
    var input = $(this).siblings('.numberInput');
    var currentValue = parseInt(input.val());
    if (currentValue > 1) {
      input.val(currentValue - 1);

      $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'action_update_total_product_by_id',
          id: id,
          count: currentValue  - 1,
          price
        },
        success: function(response) {
          if(response.success) {
            $('#cart-count').text(response.data.cart_count);
            $('#cart-' + id + ' .right-content .provisional .value').html(response.data.total);
            updateListProduct();
          }
        },
        error: function(xhr, status, error) {
          console.log('Error: ' + error);
        }
      });
    }
  });

  function updateListProduct() {
    const listProduct = [];
    let textListProduct = '';
    $('.list-product-checkout .item').each(function(){
      const name = $(this).find('.title').text();
      const price = $(this).find('.price .value').text();
      const count = $(this).find('#countProduct').val();
      listProduct.push(
          {
            name,
            price,
            count: count || '1'
          }
      );
    });
    if(listProduct.length > 0) {
      listProduct.map(item => {
        console.log(item)
        textListProduct += 'Tên sản phẩm: ' + item?.name + '(' + 'Số lượng: ' + item?.count + ', ' + 'Giá: ' + item?.price + '), ';
      })
    }
    $('#productCheckout').val(textListProduct);
  }
}(jQuery));