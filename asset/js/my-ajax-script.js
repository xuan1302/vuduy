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
}(jQuery));