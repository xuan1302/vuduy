<?php
get_header();
?>

<section class="category-project">
    <div class="archive-contain container">
        <header class="page-header">
            <?php
            // Display category title
            single_cat_title('<h1 class="archive-title">', '</h1>');
            ?>
        </header>
        
        <?php if ( have_posts() ) : ?>
            <div class="content">
                <div class="project-grid">
                    <?php
                    $counter = 0; // Initialize counter

                    /* Start the Loop */
                    while ( have_posts() ) : the_post(); 

                        if ( $counter % 3 === 0 ) : // Open a new group div every 3 posts ?>
                            <div class="post-group">
                        <?php endif; 

                        $url_thumbnail = get_the_post_thumbnail_url();
                        $post_tags = get_the_tags();
                        ?>
                        
                        <article class="project-item <?php if ($counter == 0 || $counter == 5 || $counter == 6) { ?>large<?php }?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="entry-image" style="height: 100%;">
                                    <a href="<?php the_permalink(); ?>" class="entry-readmore">
                                        <?php if ( $url_thumbnail ) : ?>
                                            <div class="post-thumbnail" style="height: 100%;">
                                                <img src="<?php echo esc_url($url_thumbnail); ?>" alt="<?php the_title_attribute(); ?>" />
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="inner">
                                            <div class="entry-tag">
                                                <?php
                                                if ( $post_tags ) {
                                                    foreach( $post_tags as $tag ) {
                                                        echo '<li>' . esc_html( $tag->name ) . '</li>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="entry-title">
                                                <h1><?php the_title(); ?></h1>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        </article>
                        
                        <?php
                        $counter++; // Increment counter
                        if ( $counter % 3 === 0 ) : // Close the group div after 3 posts ?>
                            </div><!-- .post-group -->
                        <?php endif; 
                        
                    endwhile; // End of the loop.

                    if ( $counter % 3 !== 0 ) : // Close any unclosed group div ?>
                        </div><!-- .post-group -->
                    <?php endif; 
                    ?>
                </div><!-- .project-grid -->

                <div class="col-12">
                    <div class="pagination-custom">
                       <?php echo custom_pagination(); ?>
                    </div>
                </div>
            </div><!-- .content -->

        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); // No posts found ?>

        <?php endif; ?>
    </div><!-- .archive-contain -->
</section><!-- #main -->

<?php get_footer(); ?>
