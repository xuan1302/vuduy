<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Anonymous
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
		<?php if ( is_product_category() ) { ?>
			<div class="entry-content archive-product-contain">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<div class="archive-wrapper row">
					<div class="col-xl-3 col-12">
						<div class="product-category__title">
							<h1>DANH MỤC</h1>
						</div>
						<?php 
						if ( is_product_category() ) {
			
							$product_categories = get_terms( 'product_cat', array(
								'orderby'    => 'name',
								'order'      => 'ASC',
								'hide_empty' => true, // Set to false if you want to include empty categories
							) );

							if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) {
								echo '<ul class="product-categories">';
								
								foreach ( $product_categories as $category ) {
									// Get the current category ID
									$current_category_id = get_queried_object_id();

									// Check if this category is the active one
									$active_class = ( $category->term_id == $current_category_id ) ? 'active' : '';

									// Display the category with the active class (if it's active)
									echo '<li class="' . esc_attr( $active_class ) . '">';
									echo '<a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a>';
									echo '</li>';
								}

								echo '</ul>';
							}
						}
						?>
					</div>
					<div class="col-xl-9 col-12">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'anonymous' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<?php anonymous_post_thumbnail(); ?>
			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'anonymous' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->
		<?php } ?>
			


</article><!-- #post-<?php the_ID(); ?> -->
