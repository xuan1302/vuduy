<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
if ( $related_products ) : 

	// Get current product categories
	$product_cats = wp_get_post_terms( $product->get_id(), 'product_cat', array( 'fields' => 'ids' ) );

	$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Sản phẩm cùng loại', 'woocommerce' ) );

	if ( $heading ) :
		?>
		<h2><?php echo esc_html( $heading ); ?></h2>
		<?php
	endif;

	// Filter related products based on category
	$related_by_category = array_filter( $related_products, function( $related_product ) use ( $product_cats ) {
		$related_cats = wp_get_post_terms( $related_product->get_id(), 'product_cat', array( 'fields' => 'ids' ) );
		return array_intersect( $related_cats, $product_cats );
	});

	// Check if we have filtered related products
	if ( $related_by_category ) :
		woocommerce_product_loop_start();
		?>
		<div class="row">
			<?php foreach ( $related_by_category as $related_product ) : ?>

				<?php
				$post_object = get_post( $related_product->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object );
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
		<?php
		woocommerce_product_loop_end();
	else :
		?>
		<p><?php _e( 'No related products found in the same category.', 'woocommerce' ); ?></p>
		<?php
	endif;
endif;

wp_reset_postdata();
?>
