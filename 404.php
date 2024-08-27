<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Anonymous
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<section class="page_404">
		  <div class="container">
		    <div class="row"> 
			    <div class="col-sm-12 ">
				    <div class="col-sm-10 col-sm-offset-1  text-center">
					    <div class="four_zero_four_bg">
					      <h1 class="text-center ">404</h1>
					    </div>
					    <div class="contant_box_404">
						    <h3 class="h2"> Look like you're lost </h3>
					    
					    	<p>the page you are looking for not avaible!</p>
					    
					    	<a href="<?php echo home_url(); ?>" class="link_404">Go to Home</a>
			  			</div>
		   		 	</div>
		    	</div>
		    </div>
		  </div>
		</section>

	</main><!-- #main -->

<?php
get_footer();
