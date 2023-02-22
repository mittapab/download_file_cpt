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


// add metabox 

function add_custom_meta_boxes() {  
    add_meta_box('wp_custom_attachment', 'upload category (.pdf) ', 'wp_custom_attachment', 'download', 'normal', 'high');  
}
add_action('add_meta_boxes', 'add_custom_meta_boxes');  

function wp_custom_attachment() {  
    wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');
    $html = '<p class="description">';
    $html .= 'Upload your PDF here.';
    $html .= '</p>';
    $html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25">';
    echo $html;
}


add_action('save_post', 'save_custom_meta_data');

function save_custom_meta_data($id) {
    if(!empty($_FILES['wp_custom_attachment']['name'])) {
        $supported_types = array('application/pdf');
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));
        $uploaded_type = $arr_file_type['type'];

        if(in_array($uploaded_type, $supported_types)) {
            $upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
            if(isset($upload['error']) && $upload['error'] != 0) {
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
            } else {
                update_post_meta($id, 'wp_custom_attachment', $upload);
            }
        }
        else {
            wp_die("The file type that you've uploaded is not a PDF.");
        }
    }
}

function update_edit_form() {
    echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'update_edit_form');


// เพื่อรับไฟล์ PDF

// $hotel_brochure = get_post_meta( $post_id, 'wp_custom_attachment', true );
// $hotel_brochure['url']