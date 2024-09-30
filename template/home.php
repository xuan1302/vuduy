<?php
//Template Name: Home
get_header();
$home_slide = get_field( "home_slide" );
$list_item_slide_bottom = get_field( "list_item_slide_bottom" );
$category_post = get_field( "category_post" );
$category_duan = get_field( "category_duan" );
$list_service = get_field( "list_service" );
$title_service = get_field( "title_service" );
$subtitle_servcice = get_field( "subtitle_servcice" );
$image_service = get_field( "image_service" );
$title_process = get_field( "title_process" );
$subtitle_process = get_field( "subtitle_process" );
$list_process = get_field( "list_process" );
$title_aboutus = get_field( "title_aboutus" );
$content_aboutus = get_field( "content_aboutus" );
$link_aboutus = get_field( "link_aboutus" );
$image_aboutus_1 = get_field( "image_aboutus_1" );
$image_aboutus_2 = get_field( "image_aboutus_2" );
$cat_title = get_field( "cat_title" );
$content_cat = get_field( "content_cat" );
$link_cat = get_field( "link_cat" );
$cats_product_home = get_field( "cats_product_home" );
$danh_muc_thi_cong_tieu_bieu = get_field( "danh_muc_thi_cong_tieu_bieu" );
$danh_muc_san_pham_ban_chay = get_field( "danh_muc_san_pham_ban_chay" );
$product_cat_aboutus = get_field( "product_cat_aboutus" );
$title_product_aboutus = get_field( "title_product_aboutus" );
$content_product_aboutus = get_field( "content_product_aboutus" );
$link_product_aboutus = get_field( "link_product_aboutus" );
$link_all_thi_cong_tieu_bieu = get_field( "link_all_thi_cong_tieu_bieu" );
$link_san_pham_ban_chay = get_field( "link_san_pham_ban_chay" );
$link_bai_viet_su_kien = get_field( "link_bai_viet_su_kien" );
$link_cong_trinh_du_an_thi_cong = get_field( "link_cong_trinh_du_an_thi_cong" );

$args_post = array(
    'category__in' => array(implode(",", $category_post)), // Danh sách ID của các category
    'posts_per_page' => 3,
    'post_status' => 'publish',
);
$myposts_query = get_posts( $args_post );

$args_duan = array(
    'category__in' => array(implode(",", $category_duan)), // Danh sách ID của các category
    'posts_per_page' => 3,
    'post_status' => 'publish',
);
$myposts_query_duan = get_posts( $args_duan );
?>
    <div class="template-home-custom">
        <?php
        if($home_slide) { ?>
        <div class="home-slide"
        >
            <div class="swiper slide-home">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($home_slide as $value) { ?>
                        <div class="swiper-slide item-slide">
                            <div class="img-slider-bg" style="background-image: url(<?php echo $value['image']['url']; ?>)"></div>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="swiper-pagination-slide-home"></div>
            </div>
        </div>
        <?php }

        if($list_item_slide_bottom) { ?>
            <div class="list-item-bt-slide">
                <div class="container">
                    <div class="content-bt-slide">
                        <?php 
                            foreach ($list_item_slide_bottom as $item) { ?>
                                <div class="item">
                                    <div class="icon"><img src="<?php echo $item['image']['url']; ?>" alt=""></div>
                                    <div class="title"><?php echo $item['title']; ?></div>
                                    <div class="des"><?php echo $item['subtitle']; ?></div>
                                </div>
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="category-home">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <div class="ct-cat-home">
                            <h4><?php echo $cat_title; ?></h4>  
                            <div class="des"><?php echo $content_cat; ?></div>
                            <a href="<?php echo $link_cat; ?>" class="link-cat hover-see-more">
                                Xem thêm
                                <img class="icon icon-black" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-mt-right.svg" alt="">
                                <img class="icon icon-white" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-right-w.svg" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="list-cat-loop">
                            <?php
                                foreach ($cats_product_home as $item) { ?>
                                    <div class="item">
                                        <a href="<?php echo $item['link']; ?>" class="a-box">
                                            <h3><?php echo $item['title']; ?></h3>
                                            <img class="img-p" src="<?php echo $item['image']['url']; ?>" alt="">
                                            <a class="link-c" href="<?php echo $item['link']; ?>"><span>Xem thêm</span><img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-right-cicle.svg" alt=""></a>
                                        </a>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            if($danh_muc_thi_cong_tieu_bieu) { ?>
                <div class="list-tab-thi-cong-tieu-bieu">
                    <div class="container">
                        <h5 class="title-t text-center">Hạng mục thi công tiêu biểu</h5>
                        <div class="tab-title">
                            <ul class="tab-thi-cong">
                                <?php
                                $i = 0;
                                foreach ($danh_muc_thi_cong_tieu_bieu as $item) {
                                    $i++;
                                    $category = get_term( $item['cat'][0], 'product_cat' );
                                    ?>
                                    <li class="<?php echo ($i == 1) ? 'active' : ''; ?>" data-id="<?php echo $item['cat'][0]; ?>"><?php echo $i === 1 ? 'Tất cả' : $category->name; ?></li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                        <div id="content-product-tab-thi-cong" class="list-product-custom"></div>
                        <div class="text-center">
                            <a href="<?php echo $link_all_thi_cong_tieu_bieu; ?>" class="link-all hover-see-more">
                                Xem tất cả
                                <img class="icon-w" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-right-w.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            <?php }
        ?>
        
        <div class="about-us">
            <div class="image-1" style="background-image: url(<?php echo $image_aboutus_1['url']; ?>)"></div>
            <div class="image-2" style="background-image: url(<?php echo $image_aboutus_2['url']; ?>)"></div>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="left-about">
                            <h5 class="title"><?php echo $title_aboutus; ?></h5>
                            <div class="des"><?php echo $content_aboutus; ?></div>
                            <a href="<?php echo $link_aboutus; ?>" class="link-about">Về chúng tôi <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-mt-right.svg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-6"></div>
                </div>
            </div>
        </div>

        <?php
            if($product_cat_aboutus) { ?>
                <div class="product-aboutus">
                    <div class="container">
                        <div class="ct-top">
                            <h5><?php echo $title_product_aboutus; ?></h5>
                            <div class="des">
                                <?php echo $content_product_aboutus; ?>
                            </div>
                        </div>
                        <div class="list-product-abous">
                                <?php
                                foreach ($product_cat_aboutus as $item) { ?>
                                    <div class="item">
                                        <a href="<?php echo $item['link']; ?>">
                                            <h3><?php echo $item['title']; ?></h3>
                                            <img class="img-p" src="<?php echo $item['image']['url']; ?>" alt="">
                                            <a class="link-c" href="<?php echo $item['link']; ?>"><span>Xem thêm</span><img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-right-cicle.svg" alt=""></a>
                                        </a>
                                    </div>
                                <?php }
                                ?>
                        </div>
                        <div class="text-center div-link">
                            <a class="hover-see-more" href="<?php echo $link_product_aboutus; ?>">Xem tất cả <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-mt-right.svg" alt=""></a>
                        </div>
                    </div>
                </div>
            <?php }
        ?>

        <?php
            if ($danh_muc_san_pham_ban_chay) { ?>
                <div class="list-tab-san-pham-ban-chay">
                    <div class="container">
                        <h5 class="title-t text-center">Sản phẩm bán chạy</h5>
                        <ul class="tab-san-pham-chay">
                            <?php
                                $i = 0;
                                foreach ($danh_muc_san_pham_ban_chay as $item) {
                                    $i++;
                                    ?>
                                    <li class="<?php echo ($i == 1) ? 'active' : ''; ?>" data-id="<?php echo $item['cat'][0]; ?>"><?php echo $i === 1 ? 'Tất cả' : $category->name; ?></li>
                                <?php }
                            ?>
                        </ul>
                        <div id="content-product-tab-san-pham-chay" class="list-product-custom"></div>
                        <div class="text-center">
                            <a href="<?php echo $link_san_pham_ban_chay; ?>" class="link-all hover-see-more">Xem tất cả <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-right-w.svg" alt=""></a>
                        </div>
                    </div>
                </div>
            <?php }
        ?>

        <div class="home-process">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="content-process-top text-center">
                            <h3><?php echo $title_process; ?></h3>
                            <div class="des"><?php echo $subtitle_process; ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="content-process">
                            <?php
                                foreach ($list_process as $item) { ?>
                                    <div class="item-process">
                                        <div class="icon">
                                            <img class="item-init" src="<?php echo $item['icon']['url']; ?>" alt="">
                                            <img class="item-hover" src="<?php echo $item['icon_hover']['url']; ?>" alt="">
                                        </div>
                                        <div class="title"><?php echo $item['title']; ?></div>
                                        <div class="des"><?php echo $item['des']; ?></div>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="home-service">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="left-service">
                            <h4 class="title"><?php echo $title_service; ?></h4>
                            <div class="sub-title"><?php echo $subtitle_servcice; ?></div>
                            <div class="list-service">
                                <?php
                                    foreach ($list_service as $item) { ?>
                                        <div class="item-ser">
                                            <div class="icon">
                                                <img src="<?php echo $item['icon']['url']; ?>" alt="">
                                            </div>
                                            <div class="content-ser">
                                                <h5><?php echo $item['title']; ?></h5>
                                                <div class="des"><?php echo $item['des']; ?></div>
                                            </div>
                                        </div>
                                    <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-service">
                            <img src="<?php echo $image_service['url']; ?>" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <?php
        if ($category_duan) { ?>
            <div class="home-post-duan">
                <div class="title-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="ct">
                                    <h3>Các công trình, dự án đã thi công</h3>
                                    <a class="a-hover-border" href="<?php echo $link_cong_trinh_du_an_thi_cong; ?>">Xem tất cả <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-mt-right.svg" alt=""></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="content-home-post-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 item">
                                <div class="img">
                                    <a href="<?php echo get_permalink($myposts_query_duan[0]->ID); ?>">
                                        <?php
                                        echo get_the_post_thumbnail($myposts_query_duan[0]->ID,'blog-thumbnail_1');
                                        ?>
                                        <h5 class="title"><?php echo get_the_title( $myposts_query_duan[1]->ID );?></h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 item item-2">
                                <div class="item-group">
                                    <div class="img">
                                        <a href="<?php echo get_permalink($myposts_query_duan[1]->ID); ?>">
                                            <?php
                                            echo get_the_post_thumbnail($myposts_query_duan[1]->ID,'blog-thumbnail_2');
                                            ?>
                                            <h5 class="title"><?php echo get_the_title( $myposts_query_duan[1]->ID );?></h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="item-group">
                                    <div class="img">
                                        <a href="<?php echo get_permalink($myposts_query_duan[2]->ID); ?>">
                                            <?php
                                            echo get_the_post_thumbnail($myposts_query_duan[2]->ID,'blog-thumbnail_2');
                                            ?>
                                            <h5 class="title"><?php echo get_the_title( $myposts_query_duan[1]->ID );?></h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }

        if($category_post) { ?>
            <div class="home-post-sk">
                <div class="">
                    <div class="title-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ct">
                                        <h3>Bài viết và sự kiện</h3>
                                        <a class="a-hover-border" href="<?php echo $link_bai_viet_su_kien; ?>">Xem tất cả <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-mt-right.svg" alt=""></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="content-home-post">
                        <div class="container">
                            <div class="row">
                                <?php
                                foreach ($myposts_query as $item) { ?>
                                    <div class="col-md-4 item">
                                        <div class="img">
                                            <a href="<?php echo get_permalink($item->ID); ?>">
                                                <?php
                                                echo get_the_post_thumbnail($item->ID,'blog-thumbnail');
                                                ?>
                                            </a>
                                        </div>
                                        <div class="content">
                                            <a href="<?php echo get_permalink($item->ID); ?>">
                                                <h4 class="title-post"><?php echo get_the_title($item->ID); ?></h4>
                                            </a>
                                            <div class="description"><?php echo wp_trim_words(get_post_field('post_content', $item->ID), 20, '...'); ?></div>
                                            <a href="<?php echo get_permalink($item->ID); ?>" class="action-arrow-right-blue a-hover-border">Xem chi tiết <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-mt-right.svg" alt=""></a>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
<?php get_footer();