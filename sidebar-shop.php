<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Anonymous
 */

if ( ! is_active_sidebar('woocommerce_sidebar_product') ) {
	return;
}
?>

<aside id="secondary" class="widget-area shop-sidebar">
    <?php if ( is_active_sidebar( 'woocommerce_sidebar_product' ) ) : ?>
        <?php dynamic_sidebar( 'woocommerce_sidebar_product' ); ?>
    <?php endif; ?>
</aside>
