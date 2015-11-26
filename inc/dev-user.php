<?php

/**
* Register and handle dev user post type
*/

function developer() {
$labels = array(
    'name'               => _x( 'developers', 'post type general name' ),
    'singular_name'      => _x( 'developer', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'developer' ),
    'add_new_item'       => __( 'Add New developer' ),
    'edit_item'          => __( 'Edit developer' ),
    'new_item'           => __( 'New developer' ),
    'all_items'          => __( 'All developers' ),
    'view_item'          => __( 'View developers' ),
    'search_items'       => __( 'Search developers' ),
    'not_found'          => __( 'No developers found' ),
    'not_found_in_trash' => __( 'No developers found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'developers',
);
$args = array(
    'labels'        => $labels,
    'description'   => 'Defines developer structure',
    'public'        => true,
    'menu_position' => 6,
    'supports'      => array( 'title', 'editor', 'revisions', 'thumbnail'),
    'has_archive'   => true,
    'menu_icon'   => 'dashicons-clipboard'
);
register_post_type( 'developer', $args );
}
add_action( 'init', 'developer' );