<div>
    <div class="uk-overlay uk-overlay-hover">
        <?php the_post_thumbnail(); ?>
        <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background  uk-overlay-icon"></div>
        <a class="uk-position-cover" href="<?php the_permalink(); ?>"></a>
    </div>
    <div class="uk-panel">

        <h5 class="uk-panel-title"><? the_title(); ?></h5>
        <?php 

            $post_id = get_the_ID();                              
            $calificacion = get_post_meta( $post_id, 'calificacion', true );
            
        ?>
        <p>
            <span class="rating">
            <?php 

                if ( isset( $calificacion ) ) {

                    for ($i=0; $i < $calificacion; $i++) { 

                        echo '<i class="uk-icon-star"></i>';
                        
                    }

                } 
                
            ?>
            </span>
            <span class="uk-float-right">2016</span>
        </p>
    </div>
</div>