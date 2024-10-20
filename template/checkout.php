<?php
//Template Name: Checkout
get_header();
$form = get_field( "form" );
$caution = get_field( "caution" );
$link_shopping = get_field( "link_shopping" );
$cart_items = WC()->cart->get_cart();
?>
    <div class="template-checkout">
        <div class="process-checkout">
            <div class="item-process active">
                <span class="process-number">1</span>
                <span class="title">Điền thông tin liên hệ</span>
            </div>
            <div class="item-process">
                <span class="process-number">2</span>
                <span class="title">Xác nhận thông tin</span>
            </div>
            <div class="item-process">
                <span class="process-number">3</span>
                <span class="title">Nhận liên hệ từ chúng tôi</span>
            </div>
        </div>
        <?php
            if(isset($_GET['isConfirm'])) { ?>
                <div class="content-confirm">
                    <div class="icon">
                        <img src="<?php bloginfo('template_url'); ?>/asset/icons/img-confirm-info.svg" alt="">
                    </div>
                    <h4>Đơn hàng của bạn đã được xác nhận!</h4>
                    <h5>Xin vui lòng đợi, chúng tôi sẽ sớm liên hệ với bạn trong thời gian sớm nhất.</h5>
                    <div class="action-btn">
                        <a class="link-home" href="<?php echo home_url(); ?>">
                            <img src="<?php bloginfo('template_url'); ?>/asset/icons/icon-home.svg" alt="">
                            Về trang chủ</a>
                        <a class="link-shopping" href="<?php echo $link_shopping; ?>">Tiếp tục mua sắm
                            <img src="<?php bloginfo('template_url'); ?>/asset/icons/icon-shop.svg" alt="">
                        </a>
                    </div>
                </div>
            <?php } else { ?>
                <h2 class="title-process-checkout">Đặt hàng</h2>
                <div class="container">
                    <div class="content-checkout-custom">
                        <div class="content-left">
                            <?php
                                if ($cart_items) {
                                    $currency = get_woocommerce_currency(); // Lấy tiền tệ hiện tạ
                                    ?>
                                    <div class="product-checkout">
                                        <h5 class="title-pr-checkout">Thông tin đơn hàng</h5>
                                        <div class="list-product-checkout">
                                            <?php
                                                foreach ($cart_items as $cart_item_key => $item) {
                                                    $product_id = $item['product_id'];
                                                    $quantity = $item['quantity'];
                                                    $product = wc_get_product($product_id);
                                                    $price = $product->get_price();
                                                    $formatted_price = wc_price($price); // Định dạng giá
                                                    // Lấy ID ảnh đại diện
                                                    $thumbnail_id = $product->get_image_id();
                                                    // Lấy URL ảnh đại diện
                                                    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'thumbnail')[0];
                                                    $total_value = wc_price((int)$price * $quantity);
//                                                    var_dump($cart_item_key);
                                                    ?>
                                                    <div class="item" id="cart-<?php echo $cart_item_key; ?>">
                                                        <div class="images">
                                                            <div class="icon-remove" data-id="<?php echo $cart_item_key; ?>">
                                                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-remove.svg" alt="">
                                                            </div>
                                                            <img width="300" height="300" src="<?php echo $thumbnail_url; ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async" loading="lazy">
                                                        </div>
                                                        <div class="right-content">
                                                            <h3 class="title"><?php echo $product->get_name(); ?></h3>
                                                            <div class="price">
                                                                <span>Giá</span>
                                                                <span class="value"><?php echo ($price) ? $formatted_price : 'Liên hệ' ?></span>
                                                            </div>
                                                            <?php
                                                                if($price) { ?>
                                                                    <div class="count">
                                                                        <span>Số lượng</span>
                                                                        <div class="input-group">
                                                                            <button class="decrease" type="button" data-id="<?php echo $cart_item_key; ?>">
                                                                                <img src="<?php bloginfo('template_url'); ?>/asset/icons/-.svg" alt="">
                                                                            </button>
                                                                            <input disabled="" id="countProduct" name="count" type="number" class="numberInput numberInputReset" value="<?php echo $quantity?>">
                                                                            <input type="hidden" class="price" name="price" value="<?php echo $price ?>">
                                                                            <button class="increase" type="button" data-id="<?php echo $cart_item_key; ?>">
                                                                                <img src="<?php bloginfo('template_url'); ?>/asset/icons/+.svg" alt="">
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="provisional">
                                                                        <span>Tạm tính</span>
                                                                        <span class="value"><?php echo $total_value; ?></span>
                                                                    </div>
                                                                <?php }
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php }
                                            ?>
                                        </div>
                                    </div>
                                <?php }
                            ?>
                            <div class="notifi">
                                <div class="icon">
                                    <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/gg_check-o.svg" alt="">
                                </div>
                                <div class="text">
                                    Đơn hàng của bạn sẽ được xác nhận sau khi điền đầy đủ Thông tin liên hệ. Chúng tôi sẽ sớm liên hệ với bạn.
                                </div>
                            </div>
                            <?php
                            if($caution) { ?>
                                <div class="caution">
                                    <h4>Lưu ý</h4>
                                    <ul>
                                        <?php
                                        foreach ($caution as $item ){
                                            echo '<li>' .$item['content'] .'</li>';
                                        }
                                        ?>

                                    </ul>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <div class="content-right">
                            <?php echo do_shortcode($form); ?>
                            <a href="#" class="back-checkout">
                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/arrow-left.svg" alt="">
                                Quay lại trang sản phẩm</a>
                        </div>
                    </div>
                </div>
            <?php }
        ?>
    </div>
<?php get_footer();