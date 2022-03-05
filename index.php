<?php
/**
 * Plugin Name:       Webflix plugin
 * Plugin URI:        https://madmonkeystudio.com.co/webflix/
 * Description:       Plugin para administrar catálogo de peliculas
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Hector Mancera
 * Author URI:        https://madmonkeystudio.com.co/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       webflix-plugin
 */

// creamos el custom post 'pelicula'
function create_post_type() {

    register_post_type( 'pelicula',
      array(
        'labels' => array(
          'name' => __( 'Peliculas' ),
          'singular_name' => __( 'Pelicula' ),
          'all_items' => _( 'Todas las peliculas' )
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => false,
        'supports' => array( 'thumbnail', 'title', 'editor' )
      )
    );
 
}
add_action( 'init', 'create_post_type' );

//creamos la custom taxonomy y la agregamos a peliculas
function add_custom_taxonomies() {

    register_taxonomy('categoria_pelicula', 'pelicula', array(
        'hierarchical' => true,
        'labels' => array(
        'name' => _x( 'Categorías', 'taxonomy general name' ),
        'singular_name' => _x( 'Categoría', 'taxonomy singular name' ),
        'search_items' =>  __( 'Buscar categorías' ),
        'all_items' => __( 'Todas las categorías' ),
        'parent_item' => __( 'Categoría padre' ),
        'parent_item_colon' => __( 'Categoría padre' ),
        'edit_item' => __( 'Editar categoría' ),
        'update_item' => __( 'Actualizar categoría' ),
        'add_new_item' => __( 'Agregar nueva categoría' ),
        'new_item_name' => __( 'Nuevo nombre de categoría' ),
        'menu_name' => __( 'Categorías' ),
        ),
        'rewrite' => array(
        'slug' => 'categorias-peliculas', 
        'with_front' => false, 
        'hierarchical' => true 
        ),
    ));

}
add_action( 'init', 'add_custom_taxonomies', 0 );

// mostramos las peliculas en el home
add_action( 'pre_get_posts', 'add_peliculas_to_query' );

function add_peliculas_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'pelicula' ) );
    return $query;
}

// inicializamos los custom fields
add_action( 'load-post.php', 'campos_personalizados' );
add_action( 'load-post-new.php', 'campos_personalizados' );

function campos_personalizados() {

    /* Add meta boxes on the 'add_meta_boxes' hook. */
    add_action( 'add_meta_boxes', 'add_post_meta_boxes' );

    add_action( 'save_post', 'webflix_save_meta_data', 10, 2 );
}

function add_post_meta_boxes() {

    add_meta_box(
      'campos-adicionales',      // Unique ID
      'Campos adicionales',    // Title
      'campos_adicionales_html',   // Callback function
      'pelicula',         // Admin page (or post type)
      'normal',         // Context
      'default'         // Priority
    );

}

/* Display the post meta box. */
function campos_adicionales_html( $post ) { ?>

    <?php wp_nonce_field( basename( __FILE__ ), 'campos_adicionales_nonce' ); ?>
  
    <p>
      <label for="actores_principales"><?php _e( "Actores principales", 'webflix' ); ?></label>
      <br />
      <input class="widefat" type="text" name="actores_principales" id="actores_principales" value="<?php echo esc_attr( get_post_meta( $post->ID, 'actores_principales', true ) ); ?>" size="30" />
    </p>

    <p>
      <label for="paises"><?php _e( "Paises donde se presenta", 'webflix' ); ?></label>
      <br />
      <input class="widefat" type="text" name="paises" id="paises" value="<?php echo esc_attr( get_post_meta( $post->ID, 'paises', true ) ); ?>" size="30" />
    </p>

    <p>
      <label for="calificacion"><?php _e( "Calificación", 'webflix' ); ?></label>
      <br />
      <input class="widefat" type="number" name="calificacion" id="calificacion" value="<?php echo esc_attr( get_post_meta( $post->ID, 'calificacion', true ) ); ?>" size="10" />
    </p>

    <p>
      <label for="fecha_pelicula"><?php _e( "Fecha de la pelicula", 'webflix' ); ?></label>
      <br />
      <input class="widefat" type="date" name="fecha_pelicula" id="fecha_pelicula" value="<?php echo esc_attr( get_post_meta( $post->ID, 'fecha_pelicula', true ) ); ?>" size="30" />
    </p>

    <p>
      <label for="duracion"><?php _e( "Duración", 'webflix' ); ?></label>
      <br />
      <input class="widefat" type="text" name="duracion" id="duracion" value="<?php echo esc_attr( get_post_meta( $post->ID, 'duracion', true ) ); ?>" size="30" />
    </p>

    <p>
      <label for="trailer"><?php _e( "Trailer", 'webflix' ); ?></label>
      <br />
      <textarea rows=5 class="widefat" name="trailer" id="trailer"><?php echo esc_attr( get_post_meta( $post->ID, 'trailer', true ) ); ?></textarea>
    </p>
<?php }

/* Save the meta box’s post metadata. */
function webflix_save_meta_data( $post_id, $post ) {

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['campos_adicionales_nonce'] ) || !wp_verify_nonce( $_POST['campos_adicionales_nonce'], basename( __FILE__ ) ) )
      return $post_id;
  
    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );
  
    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
      return $post_id;

    $campos = ['actores_principales', 'paises', 'calificacion', 'fecha_pelicula', 'duracion', 'trailer'];

    foreach( $campos as $campo ) {
  
      /* Get the posted data and sanitize it for use as an HTML class. */
      $new_meta_value = $_POST[$campo];
    
      /* Get the meta key. */
      $meta_key = $campo;
    
      /* Get the meta value of the custom field key. */
      $meta_value = get_post_meta( $post_id, $meta_key, true );
    
      /* If a new meta value was added and there was no previous value, add it. */
      if ( $new_meta_value && '' == $meta_value )
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );
    
      /* If the new meta value does not match the old value, update it. */
      elseif ( $new_meta_value && $new_meta_value != $meta_value )
        update_post_meta( $post_id, $meta_key, $new_meta_value );
    
      /* If there is no new meta value but an old value exists, delete it. */
      elseif ( '' == $new_meta_value && $meta_value )
        delete_post_meta( $post_id, $meta_key, $meta_value );

    }
  }

  function display_taxonomy_terms($post_type) {
    global $post;
    
    $term_list = wp_get_post_terms($post->ID, $post_type, array('fields' => 'names'));
  
    
    return $term_list;
  
  }