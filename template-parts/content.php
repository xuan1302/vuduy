<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Anonymous
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( 'post' === get_post_type() ) { ?>
        <div class="single-page container">
            <div class="content-single-page">
                <div class="row">
                    <div class="single-content col-12">
                        <div class="single-wrapper">
                            <div class="banner">
                                <div class="single-title">
                                    <h1><?php the_title(); ?></h1>
                                </div>
                                <div class="date">
                                    <p><?php echo get_the_date( 'd-m-Y' ); ?>
                                    <span>- by Vu Duy Company</span></p>
                                </div>
                            </div>
                            <div class="single-description">
                                <p><?php echo $description; ?></p>
                            </div>
                            <div class="inner-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="related-post">
            <?php related_posts(); ?>
        </div>

    <?php } else { ?>
        <div class="entry-content">
            <?php
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'anonymous' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );
            ?>
        </div><!-- .entry-content -->
    <?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->
