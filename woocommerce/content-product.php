<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	// Get the product post date
	$post_date = get_the_date( 'Y-m-d', $product->get_id() );
	$current_date = date( 'Y-m-d' );
	$date_diff = ( strtotime( $current_date ) - strtotime( $post_date ) ) / ( 60 * 60 * 24 ); // Difference in days

	// Display "New" label if the product is less than 30 days old
	if ( $date_diff <= 30 ) {
		echo '<span class="new-tag">New</span>';
	}
	if($product->is_on_sale()) {
		echo '<span class="product-sale">Sale</span>';
	}

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );
	if ( $product->get_price() ) {
		if ( $product->is_on_sale() ) {
			// Display the sale price (promotional price) first
			echo '<span class="sale-price">' . wc_price( $product->get_sale_price() ) . '</span>';
	
			// Display the regular price (strikethrough for visual indication of discount)
			echo ' <span class="regular-price-del" style="text-decoration: line-through;">' . wc_price( $product->get_regular_price() ) . '</span>';
		} else {
			// If not on sale, just display the regular price
			echo ' <span class="regular-price">' . wc_price( $product->get_regular_price() ) . '</span>';
		}
    } else {
        // Display the full product description if there is no price
        echo '<div class="woocommerce-product-details__full-description">';
        echo apply_filters( 'the_content', $post->post_content );  // Displays full product description
        echo '</div>';
    }
	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
