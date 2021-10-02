<?php
/* enqueue script for parent theme stylesheeet */        
function childtheme_parent_styles() {
 
 // enqueue style
 wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );
 wp_enqueue_style('custom', get_stylesheet_directory_uri() . '/css/custom.css', array(), '0.1.0', 'all');
                    
}

add_action( 'wp_enqueue_scripts', 'childtheme_parent_styles');


// Min egna action med krok och funktion, vid aktivering så försvinner dennna
add_action('my_hook', 'my_function');

function my_function() {
    echo 'random text som kommer synas när plugin är ej aktiverat';
}

//Ska ta bort Archive titeln i början av Stores sidan test
add_filter('get_the_archive_title', 'my_get_the_archive_title' );
function my_get_the_archive_title( $title ) {
    return '';
};


// Our custom post type function
function create_posttype() {
 
    register_post_type( 'Stores',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Stores' ),
                'singular_name' => __( 'Store' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Stores'),
            'show_in_rest' => true,
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
    // Set UI labels for Custom Post Type for Butiker
        $labels = array(
            'name'                => _x( 'Stores', 'Post Type General Name', 'twentytwenty' ),
            'singular_name'       => _x( 'Store', 'Post Type Singular Name', 'twentytwenty' ),
            'menu_name'           => __( 'Stores', 'twentytwenty' ),
            'parent_item_colon'   => __( 'Parent Store', 'twentytwenty' ),
            'all_items'           => __( 'All Stores', 'twentytwenty' ),
            'view_item'           => __( 'View Store', 'twentytwenty' ),
            'add_new_item'        => __( 'Add New Store', 'twentytwenty' ),
            'add_new'             => __( 'Add New', 'twentytwenty' ),
            'edit_item'           => __( 'Edit Store', 'twentytwenty' ),
            'update_item'         => __( 'Update Store', 'twentytwenty' ),
            'search_items'        => __( 'Search Store', 'twentytwenty' ),
            'not_found'           => __( 'Not Found', 'twentytwenty' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
        );
         
    // Set other options for Custom Post Type for Butiker
         
        $args = array(
            'label'               => __( 'Stores', 'twentytwenty' ),
            'description'         => __( 'Store news and reviews', 'twentytwenty' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
     
        );
         
        // Registering your Custom Post Type
        register_post_type( 'Stores', $args );
     
    }
     
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     

     
add_action( 'init', 'custom_post_type', 0 );


// Lägga till texten "Short info"
add_action('woocommerce_single_product_summary', 'text');

function text() {
    echo 'Short info:';
}