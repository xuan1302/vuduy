<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Anonymous
 */
$footer_top = get_field( "footer_top", 'option' );
$footer_logo = get_field( "logo_footer", 'option' );
$title_footer_top = get_field( "title_footer_top", 'option' );
$content_footer_top = get_field( "content_footer_top", 'option' );
$link_shopping = get_field( "link_shopping", 'option' );
$link_tu_van = get_field( "link_tu_van", 'option' );
$subtitle_logo = get_field( "subtitle_logo", 'option' );
$address_footer_1 = get_field( "address_footer_1", 'option' );
$address_footer_2 = get_field( "address_footer_2", 'option' );
$hotline_footer = get_field( "hotline_footer", 'option' );
$email_footer = get_field( "email_footer", 'option' );
$web_footer = get_field( "web_footer", 'option' );
$coppy_right = get_field( "web_footer", 'option' );

?>

	<footer id="colophon" class="site-footer">
        <div class="footer-top">
            <div class="container">
                <div class="content-footer-top" style="background-image: url(<?php echo $footer_top['url']; ?>)">
                    <div class="left-footer-top">
                        <div class="title">
                            <?php echo $title_footer_top; ?>
                        </div>
                        <div class="des">
                            <?php echo $content_footer_top; ?>
                        </div>
                    </div>
                    <div class="right-footer-top">
                        <a href="<?php echo $link_shopping; ?>">
                            Mua sắm ngay
                            <img src="<?php bloginfo('template_url'); ?>/asset/icons/icon-shop.svg" alt="">
                        </a>
                        <a href="<?php echo $link_tu_van; ?>">
                            Nhận tư vấn
                            <img src="<?php bloginfo('template_url'); ?>/asset/icons/icon-phone-ring.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo-footer">
                            <img src="<?php echo $footer_logo['url']; ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <h2 class="title-cty">
                            <?php echo $subtitle_logo; ?>
                        </h2>
                        <div class="list-information">
                            <ul>
                                <li>
                                    <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/map-ft.svg" alt="">
                                    <span>Trụ sở: <?php echo $address_footer_1; ?></span>
                                </li>
                                <li>
                                    <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/map-ft.svg" alt="">
                                    <span>Showroom : <?php echo $address_footer_2; ?></span>
                                </li>
                                <li>
                                    <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/phone-ft.svg" alt="">
                                    <span><?php echo $hotline_footer; ?></span>
                                </li>
                                <li>
                                    <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/mail-ft.svg" alt="">
                                    <span><?php echo $email_footer; ?></span>
                                </li>
                                <li>
                                    <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/web-ft.svg" alt="">
                                    <span><?php echo $web_footer; ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <nav id="site-navigation-main-footer" class="header-main-navigation-footer">
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu Footer', 'anonymous' ); ?></button>
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer-menu',
                                    'menu_id'        => 'footer-menu',
                                )
                            );
                            ?>
                        </nav>
                    </div>
                    <div class="col-md-4">
                        <div class="form-search-product form-search-product-footer">
                            <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="Tìm kiếm sản phẩm" value="<?php echo get_search_query(); ?>" name="s" />
                                <button id="btn-submit-woocommerce-product-search" type="submit" value="Tìm kiếm">
                                    <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/search.svg" alt="">
                                </button>
                            </form>
                        </div>
                        <div class="fanpage-fb"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="copyright">
                            <div class="left-cp">
                                <h4><?php echo $coppy_right; ?></h4>
                            </div>
                            <div class="right-cp">
                                <nav id="site-navigation-main-footer-cp" class="header-main-navigation-footer-cp">
                                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu Footer', 'anonymous' ); ?></button>
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'footer-menu-copyright',
                                            'menu_id'        => 'footer-menu-copyright',
                                        )
                                    );
                                    ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
