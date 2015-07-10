<?php
// Creates Projects Custom Post Type
function observo_projects_post_type_init() {
    $args = array(
        'label' => 'Projects',
        'labels' => array(
            'name_admin_bar' => __('Project', 'observo'),
            'all_items' => __('All Projects', 'observo'),
            'add_new_item' => __('Add New Project', 'observo'),
            'edit_item' => __('Edit Project', 'observo'),
            'search_items' => __('Search Projects', 'observo'),
        ),
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