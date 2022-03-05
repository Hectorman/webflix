<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Webflix
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
    <!-- start Main Content (Media Page Section) -->

    <div id="tm-media-section" class="uk-block uk-block-small">

        <div class="uk-container uk-container-center uk-width-8-10">
            <div class="media-container  uk-container-center">
                <a class="uk-button uk-button-large uk-button-link uk-text-muted" href="<?php echo get_home_url(); ?>"><i class=" uk-icon-arrow-left uk-margin-small-right"></i>
                    Atrás</a>
            </div>

            <div class="uk-grid">
                <div class="uk-width-medium-3-10">
                    <div class="media-cover">
                        <?php webflix_post_thumbnail(); ?>
                    </div>
                    <a class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" href="login.html"><i
                            class="uk-icon-television uk-margin-small-right"></i> ver ahora</a>
                    <a class="uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top" href="login.html"><i
                            class="uk-icon-heart uk-margin-small-right"></i> Agregar a favoritos</a>
                </div>
                <div class="uk-width-medium-7-10">
                    <div class="">
                        <ul class="uk-tab uk-tab-grid " data-uk-switcher="{connect:'#media-tabs'}">
                            <li class="uk-width-medium-1-3 uk-active"><a href="movie-detail.html">Descripción</a></li>
                            <li class="uk-width-medium-1-3"><a href="movie-detail.html">Trailer</a></li>
                            <li class="uk-tab-responsive uk-active uk-hidden" aria-haspopup="true" aria-expanded="false"><a>Active</a>
                                <div class="uk-dropdown uk-dropdown-small uk-dropdown-up">
                                    <ul class="uk-nav uk-nav-dropdown"></ul>
                                    <div></div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <?php 
                    
                        $post_id = get_the_ID();
                                    
                        $calificacion = get_post_meta( $post_id, 'calificacion', true ); 
                        $duracion = get_post_meta( $post_id, 'duracion', true ); 
                        $fecha_peli = get_post_meta( $post_id, 'fecha_pelicula', true );
                        $paises = get_post_meta( $post_id, 'paises', true );
                        $actores = get_post_meta( $post_id, 'actores_principales', true );
                        $trailer = get_post_meta( $post_id, 'trailer', true );
                        $categorias = display_taxonomy_terms('categoria_pelicula');

                    ?>

                    <ul id="media-tabs" class="uk-switcher">

                        <!--     start Tab Panel 1 (Reviews Sections) -->

                        <li>
                            <h2 class="uk-text-contrast uk-margin-large-top"><?php the_title(); ?> <span class="rating uk-margin-small-left uk-h4 uk-text-warning">

                                <?php 

                                    if ( isset( $calificacion ) ) {
                                
                                        for ($i=0; $i < $calificacion; $i++) { 

                                            echo '<i class="uk-icon-star"></i>';
                                            
                                        }

                                    } 
                                ?>

                            </span></h2>
                            <ul class="uk-subnav uk-subnav-line">
                                <li><i class="uk-icon-star uk-margin-small-right"></i> <?php echo $calificacion; ?></li>
                                <li><i class="uk-icon-clock-o uk-margin-small-right"></i> <?php echo $duracion; ?> Mins</li>
                                <li> <?php echo $fecha_peli; ?></li>
                            </ul>
                            <hr>
                            <div class="uk-text-muted uk-h4">

                                <?php the_content(); ?>

                            </div>
                            <dl class="uk-description-list-horizontal uk-margin-top">
                                <dt>Protagonistas</dt>
                                <dd>
                                    <ul class="uk-subnav ">
                                        <li><?php echo $actores; ?></li>

                                    </ul>
                                </dd>
                                <dt>Categoría</dt>
                                <dd>
                                    <ul class="uk-subnav ">
                                        <?php foreach( $categorias as $categoria ) { ?>

                                            <li><?php echo $categoria; ?></li>

                                        <?php } ?>

                                    </ul>
                                </dd>
                                <dt>Paises</dt>
                                <dd>
                                    <ul class="uk-subnav ">
                                        <li><?php echo $paises; ?></li>

                                    </ul>
                                </dd>
                            </dl>

                        </li>

                        <!--    ./ Tab Panel 1  -->


                        <!--     ./ Tab Panel 2  -->


                        <!--     start Tab Panel 3 (Trailer Section)  -->

                        <li>
                            <div class="uk-cover uk-margin-top" style="height: 400px;">
                                <?php echo $trailer; ?>
                            </div>
                        </li>

                        <!--     ./ Tab Panel 3  -->


                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- ./ Main Content (Media Page Section) -->

        <!--     Start Similar Media Section  -->

        <?php 

            $nombrePeliUrl = str_replace(' ', "%20", get_the_title());
            $searchString = 'http://www.omdbapi.com/?s='. $nombrePeliUrl .'&apikey=1d2d91f1';
            $pelis = file_get_contents( $searchString );
            $obj = json_decode($pelis);
            //echo $searchString;

        ?>

        <div class="uk-block ">
        <div class="uk-container-center uk-container uk-margin-large-bottom">
            <h3 class="uk-margin-large-bottom uk-text-contrast">Películas que te pueden interesar</h3>
            <div class="uk-margin" data-uk-slideset="{small: 2, medium: 4, large: 6}">
                <div class="uk-slidenav-position uk-margin">
                    <ul class="uk-slideset uk-grid uk-flex-center">

                        <?php 

                            foreach( $obj->Search as $movie ) {
                                //print_r($movie);
                        ?>

                            <li>
                                <a href="#"><img src="<?php echo $movie->Poster; ?>" width="600" height="400" alt=""></a>
                            </li>

                        <?php } ?>
                        
                    </ul>
                    <a href="movie-detail.html" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideset-item="previous"></a>
                    <a href="movie-detail.html" class="uk-slidenav uk-slidenav-next uk-slidenav-contrast" data-uk-slideset-item="next"></a>
                </div>
                <ul class="uk-slideset-nav uk-dotnav uk-dotnav-contrast uk-flex-center uk-margin-top"></ul>
            </div>
        </div>
    </div>

    <!--     ./ Similar Media Section  -->

</article><!-- #post-<?php the_ID(); ?> -->
