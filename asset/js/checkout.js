
(function ($) {
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
            textListProduct += 'Tên sản phẩm: ' + item?.name + '(' + 'Số lượng: ' + item?.count + ', ' + 'Giá: ' + item?.price + '), ';
        })
    }
    $('#productCheckout').val(textListProduct);
    $(document).on('wpcf7mailsent', function(event) {
        var formId = event.detail.contactFormId;
        console.log('Form ID: ' + formId);
        // if (formId == '148') {
        //     var url = new URL(window.location.href);
        //     url.searchParams.set('isConfirm', 'true');
        //     window.history.pushState({}, '', url);
        //     location.reload();
        // }
    });
}(jQuery));