<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Anonymous
 */

get_header();
$description = get_field("single_description");
?>

    <main id="primary" class="site-main single-page container">

		<?php
		while ( have_posts() ) :
			the_post();
            ?>
            <div class="content-single-page">
                <div class="row">
                    <div class="single-content col-12">
                        <div class="single-wrapper">
                            <div class="banner">
                                <div class="single-title">
                                <h1><?php the_title()?></h1>
                                </div>
                                <div class="date">
                                    <p><?php echo get_the_date( 'd-m-Y' ); ?>
                                    <span>- by Hoa Binh Hotel</span></p>
                                </div>
                            </div>
                            <div class="single-description">
                                <p><?php echo $description ?></p>
                            </div>
                            <div class="inner-content">
                                <?php
                                the_content();
                                ?>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <?php
			

		endwhile; // End of the loop.
		?>

    </main>
    <!-- #main -->
    <div class="related-post">
        <?php  related_posts() ?>
    </div>

<?php
// get_sidebar();
get_footer();