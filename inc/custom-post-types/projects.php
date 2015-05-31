<?php
// Creates Projects Custom Post Type
function observo_projects_post_type_init() {
    $args = array(
      'label' => 'Projects',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'projects'),
        'query_var' => true,
        'menu_icon' => 'dashicons-welcome-widgets-menus',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
        );
    register_post_type( 'projects', $args );
}
add_action( 'init', 'observo_projects_post_type_init' );