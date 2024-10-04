<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Sản phẩm cùng loại', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<?php woocommerce_product_loop_start(); ?>
			<div class="row">
				<?php foreach ( $related_products as $related_product ) : ?>

						<?php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
						?>
							<div class="custom-related-product-item col-12 col-xl-3">
								<div class="custom-product-image">
									<a href="<?php echo esc_url( get_permalink( $related_product->get_id() ) );?>">
										<?php echo $related_product->get_image(); ?>
									</a>
								</div>
								<div class="custom-product-details">
									<a href="<?php echo esc_url( get_permalink( $related_product->get_id() ) ); ?>" class="button add-to-cart-button">
										<h3 class="woocommerce-loop-product__title"><?php echo esc_html( $related_product->get_name() ); ?></h3>
									</a>
									<div class="woocommerce-loop-product__description">
										<?php echo wp_kses_post( $related_product->get_description() ); ?>
									</div>
								</div>
							</div>
		
				<?php endforeach; ?>
			</div>
		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;

wp_reset_postdata();
