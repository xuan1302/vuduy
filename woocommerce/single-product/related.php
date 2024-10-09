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
	?>
	<div class="related-products-container">
	<?php
	if ( $heading ) :
		?>
		<div class="related_title_contain d-flex justify-content-between">
			<h2><?php echo esc_html( $heading ); ?></h2>
			<?php
			if ( ! empty( $product_cats ) && ! is_wp_error( $product_cats ) ) {
				foreach ( $product_cats as $cat_id ) {
					// Get the category link
					$category_link = get_term_link( $cat_id, 'product_cat' );
					if ( ! is_wp_error( $category_link ) ) {?>
						<a href="<?php echo $category_link; ?>">Xem toàn bộ <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M13.3333 5L20 12M20 12L13.3333 19M20 12L4 12" stroke="#353535" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</a>
					<?php }
				}
			}
			?>
		</div>
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
						<?php
							if ( $related_product->get_price() ) {
								if ( $related_product->is_on_sale() ) {
									// Display the sale price (promotional price) first
									echo '<span class="sale-price">' . wc_price( $related_product->get_sale_price() ) . '</span>';
							
									// Display the regular price (strikethrough for visual indication of discount)
									echo ' <span class="regular-price-del" style="text-decoration: line-through;">' . wc_price( $related_product->get_regular_price() ) . '</span>';
								} else {
									// If not on sale, just display the regular price
									echo ' <span class="regular-price">' . wc_price( $related_product->get_regular_price() ) . '</span>';
								}
							} else {
								// Display the related product description if no price is set, with safe HTML output
								echo '<div class="custom-product-description">';
								echo wp_kses_post( $related_product->get_description() );
								echo '</div>';
							}
							?>
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
	?>
	</div>
	<?php
endif;

wp_reset_postdata();
?>
