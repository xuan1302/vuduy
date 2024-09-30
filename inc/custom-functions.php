<?php
define( 'THEME_VERSION', '1.2' );
define( 'HOME_URL', trailingslashit( home_url() ) );
define( 'THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'THEME_URL', trailingslashit( get_template_directory_uri() ) );

function vts_custom_jquery() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://code.jquery.com/jquery-2.2.4.min.js"), false);
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'vts_custom_jquery');
function xxx_scripts() {
    wp_enqueue_style('bootstrap-css' , THEME_URL . 'asset/css/bootstrap.min.css');
    wp_enqueue_style('swiper-css' , THEME_URL . 'asset/css/swiper.min.css');
    wp_enqueue_style('aos-css' , THEME_URL . 'asset/css/aos.css');
    wp_enqueue_style('style-css' , THEME_URL . 'asset/css/style.css');
    wp_enqueue_style('responsive-css' , THEME_URL . 'asset/css/reponsive.css');

    wp_enqueue_script( 'boostrap-js', get_template_directory_uri() . '/asset/js/bootstrap.min.js', array( ), THEME_VERSION, true );
    wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/asset/js/swiper-bundle.min.js', array( ), THEME_VERSION, true );
    wp_enqueue_script( 'aos-js', get_template_directory_uri() . '/asset/js/aos.js', array( ), THEME_VERSION, true );
    wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/asset/js/custom.js', array( ), THEME_VERSION, true );
        wp_enqueue_script( 'common-js', get_template_directory_uri() . '/asset/js/common.js', array( ), THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'xxx_scripts',10 );


 if ( ! function_exists( 'ssls_setup' ) ) :
     function ssls_setup() {
         register_nav_menus( array(
             'main-menu'   => esc_html__( 'Menu Main', 'SSls' ),
         ) );
         register_nav_menus( array(
             'footer-menu'   => esc_html__( 'Menu Footer', 'SSls' ),
         ) );
         register_nav_menus( array(
             'footer-menu-copyright'   => esc_html__( 'Menu Footer Copyright', 'SSls' ),
         ) );
     }
 endif;
 add_action( 'after_setup_theme', 'ssls_setup' );

add_image_size( 'blog-thumbnail', 416,271, true );
add_image_size( 'blog-thumbnail_1', 636,710, true );
add_image_size( 'blog-thumbnail_2', 636,343, true );



if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
    
}

function search_filter_woocommerce( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        // Chỉ tìm kiếm trong sản phẩm
        $query->set( 'post_type', 'product' );
    }
}
add_action( 'pre_get_posts', 'search_filter_woocommerce' );


function enqueue_custom_ajax_script() {
    wp_enqueue_script( 'my-ajax-script', get_template_directory_uri() . '/asset/js/my-ajax-script.js', array('jquery'), null, true );

    wp_localize_script( 'my-ajax-script', 'ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_ajax_script' );

// san pham cong trinh thi cong
add_action( 'wp_ajax_action_get_product_thi_cong', 'handle_get_product_thi_cong' );
add_action( 'wp_ajax_nopriv_action_get_product_thi_cong', 'handle_get_product_thi_cong' );

function handle_get_product_thi_cong()
{
    $category_id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';

    if ($category_id) {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 8,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $category_id,
                ),
            ),
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) : $query->the_post();
                $product = wc_get_product( get_the_ID() );
                $product_date = get_the_date( 'Y-m-d', get_the_ID() ); // Lấy ngày đăng sản phẩm
                $today = date('Y-m-d');
                $days_since_published = (strtotime($today) - strtotime($product_date)) / (60 * 60 * 24);
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
                echo '<div class="des">' . wp_trim_words( get_the_excerpt(), 12, '...' ) . '</div>'; // Mô tả ngắn
                echo '</div>';
                echo '</div>';
                echo '</div>';
            endwhile;
        } else {
            echo 'Không có sản phẩm nào trong danh mục này.';
        }

        wp_reset_postdata(); // Khôi phục lại post data ban đầu

    } else {
        echo 'Không có dữ liệu.';
    }

    wp_die();
}

// san pham ban chay
add_action( 'wp_ajax_action_get_product_san_pha_ban_chay', 'handle_get_product_san_pham_ban_chay' );
add_action( 'wp_ajax_nopriv_action_get_product_san_pha_ban_chay', 'handle_get_product_san_pham_ban_chay' );

function handle_get_product_san_pham_ban_chay() {
    $category_id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';

    if ($category_id) {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 8,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $category_id,
                ),
            ),
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
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
                echo '</div>';
            endwhile;
        } else {
            echo 'Không có sản phẩm nào trong danh mục này.';
        }

        wp_reset_postdata(); // Khôi phục lại post data ban đầu

    } else {
        echo 'Không có dữ liệu.';
    }

    wp_die();
}

