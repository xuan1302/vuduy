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
    wp_enqueue_style('responsive-css' , THEME_URL . 'asset/css/responsive.css');
    wp_enqueue_style('aboutus-css' , THEME_URL . 'asset/css/about-us.css');
    wp_enqueue_style('product-css' , THEME_URL . 'asset/css/product.css');

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
         register_nav_menus( array(
             'main-menu-mobile'   => esc_html__( 'Menu mobile', 'SSls' ),
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
            'meta_query' => [
                [
                    'key'     => 'product_best_salling',
                    'value'   => 1,
                    'compare' => '=', // So sánh bằng
                ],
            ],
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

add_filter('woocommerce_product_tabs', 'custom_product_tabs_policy');
function custom_product_tabs_policy($tabs) {
    // Thêm tab mới
    $tabs['custom_tab_policy'] = array(
        'title'    => __('Chính Sách', 'text-domain'),
        'priority' => 50,
        'callback' => 'custom_product_tab_policy_content'
    );

    return $tabs;
}

function custom_product_tab_policy_content() {
    echo get_field('tab_policy_content');
}

add_filter('woocommerce_product_tabs', 'custom_product_tabs_preserve');
function custom_product_tabs_preserve($tabs) {
    // Thêm tab mới
    $tabs['custom_tab_preserve'] = array(
        'title'    => __('Bảo quản', 'text-domain'),
        'priority' => 60,
        'callback' => 'custom_product_tab_preserve_content'
    );

    return $tabs;
}
function custom_product_tab_preserve_content() {
    echo get_field('tab_preserve_content');
}
function allow_empty_price_add_to_cart($is_purchasable, $product) {
    if ($product->get_price() === '') {
        $is_purchasable = true;
    }
    return $is_purchasable;
}
add_filter('woocommerce_is_purchasable', 'allow_empty_price_add_to_cart', 10, 2);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );


if ( !function_exists( 'related_product' ) ) {
    function  related_product() {
        // Get the current product
        global $product;

        // Get the terms related to the current product
        $product_cats = wp_get_post_terms($product->get_id(), 'product_cat');
        if (!empty($product_cats) && !is_wp_error($product_cats)) {
            $product_cat_ids = [];
            foreach ($product_cats as $product_cat) {
                $product_cat_ids[] = $product_cat->term_id;
            }

            // Set up the query arguments
            $args = array(
                'post_type'           => 'product',
                'posts_per_page'      => 4, // Adjust the number of products displayed as needed
                'post__not_in'        => array($product->get_id()), // Exclude the current product
                'tax_query'           => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'term_id',
                        'terms'    => $product_cat_ids,
                        'operator' => 'IN',
                    ),
                ),
            );

            // Create a custom query
            $related_products = new WP_Query($args);

            // Check if products are found
            if ($related_products->have_posts()) {
                echo '<div class="related-products">';
                echo '<h2>Sản phẩm cùng loại</h2>';
                echo '<div class="products-grid">'; // Add a wrapper for the product items

                while ($related_products->have_posts()) {
                    $related_products->the_post();
                    wc_get_template_part('content', 'product'); // Load the product template
                }

                echo '</div>'; // Close the products grid
                echo '</div>'; // Close the related products section
            }

            // Restore original Post Data
            wp_reset_postdata();
        }
    }
}

add_filter( 'woocommerce_product_categories_widget_dropdown_args', 'wpsites_product_cat_widget' );

function wpsites_product_cat_widget( $args ) {
global $wp_query;

$args = array(
    'hierarchical' => 0,
    'hide_empty' => 0,
    'parent' => 11,
    'taxonomy' => 'product_cat',
    'selected' => isset( $wp_query->query_vars['product_cat'] ) ? $wp_query->query_vars['product_cat'] : '',
    );

return $args;
}

if ( !function_exists( 'custom_pagination' ) ) {

    function custom_pagination() {

        global $wp_query;
        $total = $wp_query->max_num_pages;
        $big = 99999; // need an unlikely integer
        if( $total > 1 )  {
            if( !$current_page = get_query_var('paged') )
                $current_page = 1;
            if( get_option('permalink_structure') ) {
                $format = 'page/%#%/';
            } else {
                $format = '&paged=%#%';
            }
            
            // Generate pagination links as an array
            $pagination_links = paginate_links(array(
                'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'		=> $format,
                'current'		=> max( 1, get_query_var('paged') ),
                'total' 		=> $total,
                'mid_size'		=> 3,
                'type' 			=> 'array', // Get the links as an array
                'prev_text'  => __('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M10.6667 19L4 12M4 12L10.6667 5M4 12L20 12" stroke="#353535" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg> Trước'),
                'next_text'  => __('Sau <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M13.3333 5L20 12M20 12L13.3333 19M20 12L4 12" stroke="#353535" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>'),
            ));

            // Check if pagination links are available
            if ( is_array( $pagination_links ) ) {
                echo '<ul class="pagination">';

                // Display the prev link - always show it, but disable if on the first page
                if ( $current_page > 1 ) {
                    // If not on the first page, show active prev link
                    echo "<li class='prev-page'><a href='" . get_pagenum_link( $current_page - 1 ) . "'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'><path d='M10.6667 19L4 12M4 12L10.6667 5M4 12L20 12' stroke='#353535' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/></svg> Trước</a></li>";
                } else {
                    // On the first page, show disabled prev link
                    echo "<li class='prev-page disabled'><span><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'><path d='M10.6667 19L4 12M4 12L10.6667 5M4 12L20 12' stroke='#353535' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/></svg> Trước</span></li>";
                }

                // Group the page numbers in a separate div
                echo '<li><div class="page-number-group">';
                foreach ( $pagination_links as $link ) {
                    if ( strpos( $link, 'prev' ) === false && strpos( $link, 'next' ) === false ) {
                        echo "$link";
                    }
                }
                echo '</div></li>';

                // Display the next link - always show it, but disable if on the last page
                if ( $current_page < $total ) {
                    // If not on the last page, show active next link
                    echo "<li class='next-page'><a href='" . get_pagenum_link( $current_page + 1 ) . "'>Sau <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'><path d='M13.3333 5L20 12M20 12L13.3333 19M20 12L4 12' stroke='#353535' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/></svg></a></li>";
                } else {
                    // On the last page, show disabled next link
                    echo "<li class='next-page disabled'><span>Sau <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'><path d='M13.3333 5L20 12M20 12L13.3333 19M20 12L4 12' stroke='#353535' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/></svg></span></li>";
                }

                echo '</ul>';
            }
        }
    }
}
