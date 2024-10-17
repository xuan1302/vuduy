<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Anonymous
 */
if (!defined('ABSPATH')) {
    return;
}
get_header();
$description = get_field("des");
?>

    <main id="primary" class="site-main single-page container">
        <div class="content-single-page">
            <div class="row">
                <div class="single-content col-12">
                    <div class="banner">
                        <div class="category-name">
                            <?php
                            the_category(', ');
                            ?>
                        </div>
                        <div class="single-title">
                           <h1><?php the_title()?></h1>
                        </div>
                        <div class="date">
                            <p><?php echo get_the_date( 'd-m-Y' ); ?>
                            <span>- by Hoa Binh Hotel</span></p>
                        </div>
                    </div>
                    <div class="description-single">
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


    </main>
    <!-- #main -->
    <div class="related-post">
        <?php  related_posts() ?>
    </div>

<?php
// get_sidebar();
get_footer();
