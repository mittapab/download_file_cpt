<?php



function create_shortcode_cpt(){
    ob_start();
    $args = array(
        'post_type' => 'download',
        'post_status' => 'publish',
     
    );
    
    $loop_post = new WP_Query($args);

    while($loop_post->have_posts()){ $loop_post->the_post();  
       $hotel_brochure =  get_post_meta( $post_id, 'wp_custom_attachment', true );
       print_r(get_post_meta( $post_id, 'wp_custom_attachment', true ));
    //    $hotel_brochure['url']
    ?>
          
           <img src="<?php echo get_the_post_thumbnail_url();?>" class="img-fluid menu-image" alt="">
           <h4><?php  the_title(); ?></h4>
    
           <hr>
<?php   }  ?>

<?php
    wp_reset_postdata(); 
    echo ob_get_clean();
}

add_shortcode('cpt_download', 'create_shortcode_cpt');