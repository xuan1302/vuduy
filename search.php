<?php
get_header(); // Gọi phần header của trang

if ( have_posts() ) : ?>
    <header class="page-header">
        <h1 class="page-title">
            <?php
            /* Hiển thị tiêu đề trang kết quả tìm kiếm */
            printf( esc_html__( 'Kết quả tìm kiếm cho: %s', 'your-theme-textdomain' ), '<span>' . get_search_query() . '</span>' );
            ?>
        </h1>
    </header>

    <?php
    /* Bắt đầu vòng lặp kết quả tìm kiếm */
    while ( have_posts() ) : the_post();

        if ( 'product' === get_post_type() ) {
            wc_get_template_part( 'content', 'product' ); // Sử dụng template WooCommerce để hiển thị sản phẩm
        }

    endwhile;

    /* Hiển thị pagination nếu có nhiều kết quả */
    the_posts_navigation();

else : ?>

    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Không tìm thấy kết quả nào', 'your-theme-textdomain' ); ?></h1>
    </header>

    <div class="no-results">
        <p><?php esc_html_e( 'Không có kết quả phù hợp với từ khóa tìm kiếm của bạn. Hãy thử lại với từ khóa khác.', 'your-theme-textdomain' ); ?></p>
    </div>

<?php
endif;

get_footer(); // Gọi phần footer của trang