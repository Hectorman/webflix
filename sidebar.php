<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Webflix
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

			<div id="tm-left-section" class="uk-width-medium-3-10 uk-width-large-2-10 uk-hidden-small">
                <div class="uk-panel">
                    <ul class="uk-nav  uk-nav-side uk-nav-parent-icon uk-margin-bottom" data-uk-nav="">
                        <li class="uk-active"><a href="<?php home_url(); ?>">Categorías</a></li>

						<?php 

							$args = array( 
								'taxonomy' => 'categoria_pelicula',
								'title_li' => ''
							);

							echo wp_list_categories($args); 
						
						?>

                        <li class="uk-nav-divider"></li>
                    </ul>
                </div>
            </div>
