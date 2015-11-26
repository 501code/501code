<?php

/**
* Register and handle dev user post type
*/

function developer() {
$labels = array(
    'name'               => _x( 'Developers', 'post type general name' ),
    'singular_name'      => _x( 'Developer', 'post type singular name' ),
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
    'menu_name'          => 'Developers',
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


//Developer type meta-data
add_action( 'add_meta_boxes', 'developer_details_box' );
function developer_details_box() {
    add_meta_box(
        'developer_details_box',
        __( 'Developer details', 'myplugin_textdomain' ),
        'developer_details_box_content',
        'developer',
        'side',
        'high'
    );
}
function developer_details_box_content( $post ) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'developer_details_box_content_nonce' );

    $login = get_post_meta( get_the_ID(), 'login', true);
    $name = get_post_meta( get_the_ID(), 'name', true);
    $id = get_post_meta( get_the_ID(), 'id', true);
    $avatar = get_post_meta( get_the_ID(), 'avatar_url', true);
    $company = get_post_meta( get_the_ID(), 'company', true);
    $blog = get_post_meta( get_the_ID(), 'blog', true);
    $location = get_post_meta( get_the_ID(), 'location', true);
    ?>

    <input type="text" value="<?php echo $login;?>" name="login" placeholder="login">
    <br />
    <input type="text" value="<?php echo $name;?>" name="name" placeholder="name">
    <br />
    <input type="text" value="<?php echo $id;?>" name="id" placeholder="id">
    <br />
    <input type="text" value="<?php echo $avatar;?>" name="avatar" placeholder="avatar">
    <br />
    <input type="text" value="<?php echo $company;?>" name="company" placeholder="company">
    <br />
    <input type="text" value="<?php echo $blog;?>" name="blog" placeholder="blog">
    <br />
    <input type="text" value="<?php echo $location;?>" name="location" placeholder="location">

    <?php
}

add_action( 'save_post', 'developer_details_box_save' );

function developer_details_box_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !wp_verify_nonce( $_POST['developer_details_box_content_nonce'], plugin_basename( __FILE__ ) ) )
        return;
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return;
    } else {
        if ( !current_user_can( 'edit_post', $post_id ) )
            return;
    }
    update_post_meta( $post_id, 'login', $_POST['login'] );
    update_post_meta( $post_id, 'name', $_POST['name'] );
    update_post_meta( $post_id, 'id', $_POST['id'] );
    update_post_meta( $post_id, 'avatar', $_POST['avatar'] );
    update_post_meta( $post_id, 'company', $_POST['company'] );
    update_post_meta( $post_id, 'blog', $_POST['blog'] );
    update_post_meta( $post_id, 'location', $_POST['location'] );

}