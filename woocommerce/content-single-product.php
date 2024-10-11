<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>


<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="custom-product-wrapper">

			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>
			<div class="summary entry-summary">
				<?php echo '<h1 class="custom-product-title entry-title">' . $product->get_name() . '</h1>';?>
				<?php if ( $product->get_sku() ) {
        			echo '<p class="product-sku">Mã sản phẩm: <span>' . $product->get_sku() . '</span></p>';
    			}?>
				<?php
				 	if ($product->get_price() === '') {
						echo '<p class="contact-price">Giá liên hệ</p>';
					}
					else{?>
						<div class="custom-product-price">
							<?php
							if ( $product->is_on_sale() ) {
								// Display the sale price (promotional price) first
								echo '<span class="sale-price">' . wc_price( $product->get_sale_price() ) . '</span>';
						
								// Display the regular price (strikethrough for visual indication of discount)
								echo ' <span class="regular-price-del" style="text-decoration: line-through;">' . wc_price( $product->get_regular_price() ) . '</span>';
							} else {
								// If not on sale, just display the regular price
								echo ' <span class="regular-price">' . wc_price( $product->get_regular_price() ) . '</span>';
							}?>
						</div>
						<?php
					}
				?>
				<?php
					$excerpt = $product->get_short_description();
					if ( !empty( $excerpt ) ) {
						echo '<div class="product-excerpt"> <p>' . $excerpt . '</p> </div>';
					}

				?>
				<?php  woocommerce_template_single_add_to_cart(); ?>
				
				<div class="custom-contact-btn">
					<a href="<?php echo get_field('link_contact_consulting', 'option') ?>" target="_blank">liên hệ nhận tư vấn</a>
				</div>
				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
	</div>
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */

	do_action( 'woocommerce_after_single_product_summary' );
	// echo related_product();
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
