<?php
get_header(); // Gọi phần header của trang

$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1, // Số sản phẩm muốn lấy
    's' => get_search_query(), // Thay 'tên sản phẩm' bằng tên sản phẩm bạn muốn tìm
);

$query = new WP_Query($args);
?>


<div class="template-search">
    <div class="container">

            <?php
            if ( $query->have_posts() ) { ?>
            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    /* Hiển thị tiêu đề trang kết quả tìm kiếm */
                    printf( esc_html__( 'Kết quả tìm kiếm cho: %s', 'your-theme-textdomain' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
            </header>
            <div class="list-product-custom">
            <?php
                while ( $query->have_posts() ) : $query->the_post();
                    $product = wc_get_product( get_the_ID() );
                    $product_date = get_the_date( 'Y-m-d', get_the_ID() ); // Lấy ngày đăng sản phẩm
                    $today = date('Y-m-d');
                    $days_since_published = (strtotime($today) - strtotime($product_date)) / (60 * 60 * 24);
                    $regular_price = $product->get_regular_price(); // Lấy giá gốc
                    $sale_price = $product->get_sale_price(); // Lấy giá sale (nếu có)
                    echo '<div class="product-custom">';
                    echo '<div class="product-thumbnail">';
                    echo '<div class="link-product-custom">';
                    echo '<a class="link-detail" href="' . get_the_permalink() . '">Xem chi tiết</a>';
                    echo '<a class="link-tu-van" href="' . get_the_permalink() . '">Nhận tư vấn</a>';
                    echo '</div>';
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
                    echo woocommerce_get_product_thumbnail(); // Hình ảnh sản phẩm
                    echo '</div>';
                    echo '<div class="product-box">';
                    echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
                    echo '<div class="price">';
                    if ( !empty( $sale_price ) ) {
                        echo '<div class="price-goc">' . wc_price( $regular_price ). '</div>';
                        echo '<div class="price-sale">' . wc_price( $sale_price ). '</div>';
                    } else {
                        echo '<div class="price-goc">' . wc_price( $regular_price ). '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
//                    echo '</div>';
                endwhile;
                echo '</div>';
            the_posts_navigation();
            } else { ?>
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Không tìm thấy kết quả nào', 'your-theme-textdomain' ); ?></h1>
                </header>

                <div class="no-results">
                    <p><?php esc_html_e( 'Không có kết quả phù hợp với từ khóa tìm kiếm của bạn. Hãy thử lại với từ khóa khác.', 'your-theme-textdomain' ); ?></p>
                </div>
            <?php } ?>
    </div>
</div>

<?php
get_footer(); // Gọi phần footer của trang