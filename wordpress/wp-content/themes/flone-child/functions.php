<?php
/**
 * Loads parent and child themes' style.css
 */
function flone_child_enqueue_styles() {
    $parent_style = 'flone-parent-style'; // This is 'flone-style' for the flone theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array('bootstrap', 'flone-main', 'flone-blocks', 'flone-responsive') );

    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'flone_child_enqueue_styles');

@ini_set( 'upload_max_size' , '500M' );
@ini_set( 'post_max_size', '510M');
@ini_set( 'memory_limit', '550M' );

?>

