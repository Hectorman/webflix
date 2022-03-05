<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Webflix
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.6/dist/css/autoComplete.min.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'webflix' ); ?></a>

	<!--     start Header Section   -->
    <nav id="tm-topbar" class=" uk-navbar uk-contrast ">
        <div class="uk-container uk-container-center ">
            <ul class="uk-navbar-nav uk-hidden-small">
                <li>
                    <a href="#"><i class="uk-icon-facebook-square uk-icon-small"></i></a>
                </li>
                <li>
                    <a href="#"><i class="uk-icon-twitter-square uk-icon-small"></i></a>
                </li>

                <li>
                    <a href="#"><i class="uk-icon-instagram uk-icon-small"></i></a>
                </li>
                <li>
                    <a href="#"><i class="uk-icon-pinterest uk-icon-small"></i></a>
                </li>

            </ul>
		</div>
    </nav>

	<nav id="tm-header" class="uk-navbar  ">
        <div class="uk-container uk-container-center ">
            <a class="uk-navbar-brand uk-hidden-small" href="<?php echo get_home_url(); ?>"><i class="uk-icon-small uk-text-primary uk-margin-small-right uk-icon-play-circle"></i>
                WEBFLIX</a>

            <?php if ( is_home() ) { ?>

                <form class="uk-search uk-margin-small-top uk-margin-left uk-hidden-small">
                    <input id="autoComplete" class="uk-search-field" type="search" placeholder="Buscar..." autocomplete="off">
                    <div class="uk-dropdown uk-dropdown-flip uk-dropdown-search" aria-expanded="false"></div>
                </form>
                <div class="uk-navbar-flip uk-hidden-small">

            <?php } ?>

            </div>
            <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small uk-icon-medium" data-uk-offcanvas></a>
            <div class="uk-navbar-flip uk-visible-small">
                <a href="#offcanvas" class="uk-navbar-toggle uk-navbar-toggle-alt uk-icon-medium" data-uk-offcanvas></a>
            </div>
            <div class="uk-navbar-brand uk-navbar-center uk-visible-small"><i class="uk-icon-small uk-text-primary uk-margin-small-right uk-icon-play-circle"></i> Webflix
            </div>
        </div>
    </nav>

    <?php if ( !is_home() ) { ?>

        <nav class="uk-navbar uk-navbar-secondary  uk-hidden-small">
            <div class="uk-container-center uk-container">
                <ul class="uk-navbar-nav">

                    <li class="uk-parent" data-uk-dropdown>
                        <a href="">Categorías <i class="uk-icon-angle-down uk-margin-small-left"></i></a>
                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                <?php 

                                    $args = array( 
                                        'taxonomy' => 'categoria_pelicula',
                                        'title_li' => ''
                                    );

                                    echo wp_list_categories($args); 

                                ?>
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>

    <?php } ?>
    <!--     ./ Header Section   -->
