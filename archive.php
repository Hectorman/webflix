<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Webflix
 */

get_header();
?>

	<?php if ( have_posts() ) : ?>

		<div class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">
			<h2>Películas en <?php the_archive_title(); ?></h2>
			<div class="uk-grid">

				<div id="tm-right-section" class="uk-width-large-1-1 uk-width-medium-7-10" data-uk-scrollspy="{cls:'uk-animation-fade', target:'img'}">
					<div class="uk-grid-width-small-1-3 uk-grid-width-medium-1-4 uk-grid-width-large-1-6" data-uk-grid="{gutter: 20}">

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();?>

						<?php get_template_part( 'template-parts/item', get_post_type() ); ?>

					<?php endwhile; ?>
						
					</div>

				</div>
			</div>
		</div>

	<?php 
	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

    <!--     ./ Main Content Section   -->

<?php

get_footer();
