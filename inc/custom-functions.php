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
    wp_enqueue_style('post-css' , THEME_URL . 'asset/css/post.css');

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

if ( !function_exists( 'related_posts' ) ){
    function  related_posts() {
        $posttype = get_post_type();
        if ( $posttype == 'post' ) {
            $categories = wp_get_post_categories(get_the_id(), array('orderby' => 'parent', ));
            $args = array(
                'cat'                 => $categories,
                'post__not_in'        => array(get_the_id()),
                'showposts'           => 3,
                'ignore_sticky_posts' => 1,
                'orderby'             => 'rand',
            );
        }
        $related_post = new wp_query($args);
        if( $related_post->have_posts() ){
            ?>
            <div class="show-related container-fluid">
                <div class="related-title-block">
                    <div class="related-title">
                        <?php
                        the_category(', ');
                        ?>
                    </div>
                    <?php $posttype = get_post_type();
                    if ( $posttype == 'post' ) {
                        global $post;
                        $categories = wp_get_post_categories(get_the_id(), array('orderby' => 'parent', ));
                        $category_link = get_category_link( $categories[0] );
                        ?>
                        <div class="show-all">
                            <a href="<?php echo esc_url( $category_link ); ?>" title="Category Name">Xem thêm bài viết
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M13.3333 5L20 12M20 12L13.3333 19M20 12L4 12" stroke="#002D4A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
                            </a>
                        </div>

                    <?php } ?>
                </div>
                <div class="related-post-content">
                    <?php while ($related_post->have_posts()){
                        $related_post->the_post();
                        $url_thumbnail = get_the_post_thumbnail_url();
                        global $post;
                        ?>
                        <article class="item" id="post-<?php esc_attr(the_ID()); ?>" <?php post_class(); ?>>
                                <div class="entry-image">
                                    <?php if ($url_thumbnail) : ?>
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink() ?>" class="cct-image-wrapper">
                                                <img src="<?php echo $url_thumbnail ?>" alt="<?php the_title(); ?>"/>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="inner">
                                        <div class="entry-title">
                                            <h1><?php echo the_title(); ?></h1>
                                        </div>
                                        <div class="entry-summary">
								            <?php the_excerpt(); ?>
							            </div>
                                        <div class="readmore-block">
                                            <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>" class="entry-readmore">
                                                <?php echo esc_html__('đọc thêm', 'cct'); ?>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                        </article>
                    <?php } ?>
                </div>
                <?php $posttype = get_post_type();
                if ( $posttype == 'post' ) {
                    global $post;
                    $categories = wp_get_post_categories(get_the_id(), array('orderby' => 'parent', ));
                    $category_link = get_category_link( $categories[0] );
                    ?>
                    <div class="show-all show-all-mobile">
                        <a href="<?php echo esc_url( $category_link ); ?>" title="Category Name">Xem thêm bài viết<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.77 6C5.77 5.58579 6.10579 5.25 6.52 5.25H19C19.4142 5.25 19.75 5.58579 19.75 6V18.48C19.75 18.8942 19.4142 19.23 19 19.23C18.5858 19.23 18.25 18.8942 18.25 18.48V7.81066L6.53033 19.5303C6.23744 19.8232 5.76256 19.8232 5.46967 19.5303C5.17678 19.2374 5.17678 18.7626 5.46967 18.4697L17.1893 6.75H6.52C6.10579 6.75 5.77 6.41421 5.77 6Z" fill="#324894"/>
                            </svg>
                        </a>
                    </div>

                <?php } ?>
            </div>

        <?php   }
        wp_reset_query();
    }
}
// update product card
add_action( 'wp_ajax_action_remove_product_from_mini_card', 'handle_remove_product_from_mini_card' );
add_action( 'wp_ajax_nopriv_action_remove_product_from_mini_card', 'handle_remove_product_from_mini_card' );

function handle_remove_product_from_mini_card() {
    $product_id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';

    if ($product_id) {
        // Kiểm tra xem giỏ hàng có tồn tại không
        if (WC()->cart->get_cart() && isset(WC()->cart->cart_contents[$product_id])) {
            // Xóa sản phẩm khỏi giỏ hàng
            WC()->cart->remove_cart_item($product_id);
            wp_send_json_success(array('cart_count' => WC()->cart->get_cart_contents_count()));
//            return true;
        }
        return false; // Trả về false nếu không thành công
    }

    wp_die();
}

// update count product card
add_action( 'wp_ajax_action_update_total_product_by_id', 'handle_update_total_product_by_id' );
add_action( 'wp_ajax_nopriv_action_update_total_product_by_id', 'handle_update_total_product_by_id' );

function handle_update_total_product_by_id() {
    $product_id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
    $product_count = isset($_POST['count']) ? sanitize_text_field($_POST['count']) : '';
    $product_price = isset($_POST['price']) ? sanitize_text_field($_POST['price']) : '';

    if ($product_id && $product_count) {
        WC()->cart->set_quantity($product_id, $product_count);
        $total = wc_price((int) ($product_price * $product_count));

        wp_send_json_success(
            array(
                'total' => $total,
                'cart_count' => WC()->cart->get_cart_contents_count()
            )
        );
    }

    wp_die();
}

function enqueue_custom_script_for_specific_template() {
    // Kiểm tra nếu trang hiện tại sử dụng template cụ thể
    if (is_page_template('template/checkout.php')) { // Thay 'template-custom.php' bằng tên template của bạn
        wp_enqueue_script( 'checkout-js', get_template_directory_uri() . '/asset/js/checkout.js', array( ), THEME_VERSION, true );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script_for_specific_template');
