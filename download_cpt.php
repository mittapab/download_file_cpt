<?php

function download_custom_post_type(){
    $supports = array(
        'title', // post title
        'editor', // post content
        'author', // post author
        'thumbnail', // featured images
        'excerpt', // post excerpt
        'custom-fields', // custom fields
        'comments', // post comments
        'revisions', // post revisions
        'post-formats', // post formats
    );

    $labels = array(
        'name' => _x('download', 'plural'),
        'singular_name' => _x('download', 'singular'),
        'menu_name' => _x('download', 'admin menu'),
        'name_admin_bar' => _x('download', 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New download'),
        'new_item' => __('New download'),
        'edit_item' => __('Edit download'),
        'view_item' => __('View download'),
        'all_items' => __('All download'),
        'search_items' => __('Search download'),
        'not_found' => __('No download found.'),
        );

        $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'download'),
        'has_archive' => true,
        'hierarchical' => false,
        );

        register_post_type('download',  $args );
}


add_action('init' , 'download_custom_post_type');
