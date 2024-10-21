<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Anonymous
 */

get_header();
?>

	<main id="primary" class="site-main site-main-single">
		
			<?php if ( have_posts() ) : ?>
				<div class="container">
					<header class="page-header page-header-archive">
						<?php
							// Display category title
							echo '<h1 class="category-title">';
							single_cat_title();
							echo '</h1>';

							// Display category description if available
							$category_description = category_description();
							if ( ! empty( $category_description ) ) {
								echo '<div class="category-description">' . $category_description . '</div>';
							}
						?>
					</header>
					<div class="row archive-wrapper">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
							$url_thumbnail = get_the_post_thumbnail_url();
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							?>
							<article class="col-lg-4 col-md-6 col-12 post-item" id="post-<?php esc_attr(the_ID()); ?>" <?php post_class(); ?>>
								<div class="entry-image">
									<?php if ($url_thumbnail) : ?>
										<div class="post-thumbnail">
											<a href="<?php the_permalink() ?>" class="cct-image-wrapper">
												<img src="<?php echo $url_thumbnail ?>" alt="<?php the_title(); ?>"/>
											</a>
										</div>
									<?php endif; ?>
									<div class="inner">
										<div class="entry-title">
											<h1><?php echo the_title(); ?></h1>
										</div>
										<div class="entry-summary">
											<?php the_excerpt(); ?>
										</div>
										<div class="readmore-block">
											<a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>" class="entry-readmore">
												<?php echo esc_html__('Xem thêm', 'cct'); ?>
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M13.3333 5L20 12M20 12L13.3333 19M20 12L4 12" stroke="#353535" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
											</a>

										</div>
									</div>
								</div>
							</article>
						<?php
					endwhile;
					?>
					</div>
				</div>
				<div class="custom-pagination-content">
					<div class="container">
						<div class="custom-pagination">
							<?php echo custom_pagination(); ?>
						</div>
					</div>
				</div>
				
				<?php

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
