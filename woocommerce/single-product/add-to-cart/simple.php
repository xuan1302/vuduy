<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );
		if ($product->get_price()){?>
			<div class="custom-quantity-wrapper">
				<label for="quantity_<?php echo esc_attr( uniqid() ); ?>">Số lượng</label>
				<button type="button" class="quantity-minus">−</button>
				<?php
				woocommerce_quantity_input(
					array(
						'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
						'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
						'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
						'classes'     => ['custom-quantity-input'], // Adding custom class
					)
				);
				?>
				<button type="button" class="quantity-plus">+</button>
			</div>

		<?php }
		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>">
			<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<path d="M2.40039 2.24273C1.98618 2.24273 1.65039 2.57852 1.65039 2.99273C1.65039 3.40694 1.98618 3.74273 2.40039 3.74273V2.24273ZM4.69293 2.99273L5.41685 2.79667C5.3283 2.46974 5.03163 2.24273 4.69293 2.24273V2.99273ZM8.4183 16.748L7.69438 16.944C7.79208 17.3048 8.14047 17.5385 8.51133 17.4922L8.4183 16.748ZM19.881 15.3151L19.974 16.0593C20.2925 16.0195 20.5504 15.7814 20.6154 15.4671L19.881 15.3151ZM21.6004 7.00467L22.3348 7.15662C22.3805 6.93574 22.3244 6.70601 22.182 6.5311C22.0395 6.35619 21.826 6.25467 21.6004 6.25467V7.00467ZM5.77949 7.00467L5.05557 7.20073L5.77949 7.00467ZM2.40039 3.74273H4.69293V2.24273H2.40039V3.74273ZM8.51133 17.4922L19.974 16.0593L19.788 14.5709L8.32527 16.0037L8.51133 17.4922ZM20.6154 15.4671L22.3348 7.15662L20.8659 6.85272L19.1465 15.1632L20.6154 15.4671ZM3.96901 3.18879L5.05557 7.20073L6.50341 6.80861L5.41685 2.79667L3.96901 3.18879ZM5.05557 7.20073L7.69438 16.944L9.14222 16.5519L6.50341 6.80861L5.05557 7.20073ZM21.6004 6.25467H5.77949V7.75467H21.6004V6.25467ZM11.2504 20.5C11.2504 20.9142 10.9146 21.25 10.5004 21.25V22.75C11.743 22.75 12.7504 21.7426 12.7504 20.5H11.2504ZM10.5004 21.25C10.0862 21.25 9.75039 20.9142 9.75039 20.5H8.25039C8.25039 21.7426 9.25775 22.75 10.5004 22.75V21.25ZM9.75039 20.5C9.75039 20.0858 10.0862 19.75 10.5004 19.75V18.25C9.25775 18.25 8.25039 19.2574 8.25039 20.5H9.75039ZM10.5004 19.75C10.9146 19.75 11.2504 20.0858 11.2504 20.5H12.7504C12.7504 19.2574 11.743 18.25 10.5004 18.25V19.75ZM19.2504 20.5C19.2504 20.9142 18.9146 21.25 18.5004 21.25V22.75C19.743 22.75 20.7504 21.7426 20.7504 20.5H19.2504ZM18.5004 21.25C18.0862 21.25 17.7504 20.9142 17.7504 20.5H16.2504C16.2504 21.7426 17.2578 22.75 18.5004 22.75V21.25ZM17.7504 20.5C17.7504 20.0858 18.0862 19.75 18.5004 19.75V18.25C17.2578 18.25 16.2504 19.2574 16.2504 20.5H17.7504ZM18.5004 19.75C18.9146 19.75 19.2504 20.0858 19.2504 20.5H20.7504C20.7504 19.2574 19.743 18.25 18.5004 18.25V19.75Z" fill="white"/>
			</svg>
		</button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
