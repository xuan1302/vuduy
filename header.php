<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Anonymous
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open();
$logo = get_field('logo', 'option');
$title = get_field('title', 'option');
$hotline_topbar = get_field('phone_topbar', 'option');
$email_topbar = get_field('email_topbar', 'option');
?>

<div id="page" class="site">
    <div class="menu-responsive">
        <div class="icon-close-res-menu">
            <img src="<?php bloginfo('template_url'); ?>/asset/icons/icon-close.svg" alt="">
        </div>

        <div class="content-menu-mobile">
            <nav id="site-navigation-mobile" class="main-navigation-mobile">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'main-menu-mobile',
                        'menu_id'        => 'main-menu-mobile',
                    )
                );
                ?>
            </nav>
            <div class="info-menu-mobile">
                <a href="tel:<?php echo $hotline_topbar; ?>">
                    <img class="icon icon-black" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-phone-1.svg" alt="">
                    <?php echo $hotline_topbar; ?>
                </a>
                <a href="mailto:<?php echo $email_topbar; ?>">
                    <img class="icon icon-black" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-mail-black.svg" alt="">
                    <?php echo $email_topbar; ?>
                </a>
            </div>
        </div>
    </div>
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'anonymous' ); ?></a>
    <div id="topbar">
        <div class="custom-container">
            <div class="content-topbar">
                <div class="left-topbar">
                    <div class="item item-address">
                        <span><?php echo $title; ?></span>
                    </div>
                </div>
                <div class="right-topbar">
                    <div class="item item-hotline">
                        <a href="tel:<?php echo $hotline_topbar; ?>" class="item">
                            <span class="icon">
                                <img src="<?php bloginfo('template_url'); ?>/asset/icons/icon-phone.svg" alt="">
                            </span>
                            <span><?php echo $hotline_topbar; ?></span>
                        </a>
                    </div>
                    <div class="item item-fb">
                        <a href="mailto:<?php echo $email_topbar; ?>" target="_blank" class="item">
                            <span class="icon">
                                <img src="<?php bloginfo('template_url'); ?>/asset/icons/icon-fb.svg" alt="">
                            </span>
                            <span><?php echo $email_topbar; ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header id="masthead" class="site-header">
        <div class="header-top">
            <div id="head-main" class="container header-main">
                <div class="icon-menu-mobile">
                    <img src="<?php bloginfo('template_url'); ?>/asset/icons/icon-menu-bar.svg" alt="">
                </div>
                <div class="left-main item-main">
                    <h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <img src="<?php echo $logo['url']; ?>" alt="">
                        </a>
                    </h1>
                </div>
                <div class="mid-main item-main">
                    <div class="form-search-product">
                        <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="Tìm kiếm sản phẩm" value="<?php echo get_search_query(); ?>" name="s" />
                            <button id="btn-submit-woocommerce-product-search" type="submit" value="Tìm kiếm">
                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/search.svg" alt="">
                            </button>
                        </form>
                    </div>
                </div>
                <div class="right-main item-main">
                    <div class="header-cart">
                        <a class="cart-contents" href="<?php echo home_url('/checkout'); ?>" title="<?php _e( 'Xem giỏ hàng', 'woocommerce' ); ?>">
                        <span class="card-icon">
                            <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-shop.svg" alt="">
                            <span class="card-text">Giỏ hàng</span>
                        </span>
                            <span class="cart-count">(<span id="cart-count"><?php echo WC()->cart->get_cart_contents_count(); // Số lượng sản phẩm trong giỏ hàng ?></span>)
                        </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="main-content-header-bottom">
                    <div class="form-search-product form-search-product-mobile">
                        <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="Tìm kiếm sản phẩm" value="<?php echo get_search_query(); ?>" name="s" />
                            <button id="btn-submit-woocommerce-product-search" type="submit" value="Tìm kiếm">
                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/search.svg" alt="">
                            </button>
                        </form>
                    </div>
                    <nav id="site-navigation-main" class="header-main-navigation">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'main-menu',
                                'menu_id'        => 'main-menu',
                            )
                        );
                        ?>
                    </nav>
                </div>
            </div>
        </div>
        <?php
        if ( !is_home() && !is_front_page() || is_paged() ) { ?>
            <div class="custom-breadcrumb">
                <div class="container">
                    <?php SSls_breadcrumbs(); ?>
                </div>
            </div>
        <?php }
        ?>

    </header>