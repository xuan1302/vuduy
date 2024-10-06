<?php
//Template Name: Dich vu thi cong san xuat
get_header();
$banner = get_field( "banner" );
$title = get_field( "title" );
$subtitle = get_field( "subtitle" );
$product_cat_list = get_field( "product_cat_list" );

?>
    <div class="template-dich-vu-thi-cong-san-xuat">
        <div class="content-dich-vu-thi-cong-san-xuat">
            <div class="banner" style="background-image: url(<?php echo $banner['url'];?>)"></div>
            <div class="container">
                <div class="title-top">
                    <h3><?php echo $title; ?></h3>
                    <div class="des"><?php echo $subtitle; ?></div>
                </div>
                <?php
                    if ($product_cat_list) { ?>
                        <div class="list-cat-service">
                            <?php
                                foreach ($product_cat_list as $item ){
                                    $category_id = $item['cat'];
                                    $category = get_term($category_id, 'product_cat');
                                    $args = array(
                                        'post_type' => 'product',
                                        'posts_per_page' => 4, // Số lượng sản phẩm muốn hiển thị
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'field'    => 'term_id',
                                                'terms'    => $category_id,
                                            ),
                                        ),
                                    );
                                    $query = new WP_Query( $args );
                                    ?>
                                    <div class="item-cat">
                                        <div class="title">
                                            <h3 class="title-cat"><?php echo $category->name; ?></h3>
                                            <a class="link-all-cs" href="<?php echo get_term_link($category); ?>">Xem toàn bộ
                                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-mt-right.svg" alt="">
                                            </a>
                                        </div>
                                        <?php
                                        if ( $query->have_posts() ) { ?>
                                            <div class="list-product-ser list-product-custom">
                                                <?php
                                                     while ( $query->have_posts() ) : $query->the_post();
                                                         $product = wc_get_product( get_the_ID() );
                                                         $product_date = get_the_date( 'Y-m-d', get_the_ID() ); // Lấy ngày đăng sản phẩm
                                                         $today = date('Y-m-d');
                                                         $days_since_published = (strtotime($today) - strtotime($product_date)) / (60 * 60 * 24);
                                                         $regular_price = $product->get_regular_price(); // Lấy giá gốc
                                                         $sale_price = $product->get_sale_price(); // Lấy giá sale (nếu có)
                                                     ?>
                                                         <div class="product-custom">
                                                            <div class="product-thumbnail">
                                                              <div class="link-product-custom">
                                                              <a class="link-detail" href="<?php echo get_the_permalink(); ?>">Xem chi tiết</a>
                                                              <a class="link-tu-van" href="<?php echo get_the_permalink(); ?>">Nhận tư vấn</a>
                                                              </div>
                                                                 <?php
                                                                 if ( $days_since_published <= 30 || $product->is_on_sale() ) {
                                                                     echo '<div class="badge-product">';
                                                                     if($days_since_published <= 30) {
                                                                         echo '<div class="new-product"> New</div>';
                                                                     }
                                                                     if($product->is_on_sale()) {
                                                                         echo '<div class="product-sale">Sale</div>';
                                                                     }
                                                                     echo '</div>';
                                                                 }
                                                                 echo woocommerce_get_product_thumbnail();
                                                                 ?>
                                                         </div>
                                                            <div class="product-box">
                                                                <h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title() ?></a></h2>
                                                                <div class="des"><?php echo wp_trim_words( get_the_excerpt(), 12, '...' ) ?></div>
                                                             </div>
                                                         </div>
                                                        <?php
                                                     endwhile;
                                                ?>
                                            </div>
                                            <a class="link-all-cs link-all-mobile" href="<?php echo get_term_link($category); ?>">Xem toàn bộ
                                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-mt-right.svg" alt="">
                                            </a>
                                            <hr>
                                        <?php }
                                        ?>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
    </div>
<?php get_footer();