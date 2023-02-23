<?php

function link_bootstrap(){
    wp_enqueue_style( "link_bootstrap", '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', array() , '1.0', '' );
}

add_action('wp_enqueue_scripts','link_bootstrap');

function create_shortcode_cpt(){
    ob_start();
    $args = array(
        'post_type' => 'download',
        'post_status' => 'publish',
   );
    $loop_post = new WP_Query($args); ?>
          

         <div class="container">
            <div class="row">
               
 <?php   while($loop_post->have_posts()){ $loop_post->the_post();     ?>
       <div class="col-2">
           <img src="<?php echo get_the_post_thumbnail_url();?>" class="img-fluid menu-image" alt="" width="100%" height="350px">
      
           <a href="<?php echo get_field('upload_pdf');  ?>" target="blank" style="text-decoration: none; color:#9f9a9a;">Download</a>
      </div>
<?php   }  ?>

               
            </div>
         </div> 

<?php
    wp_reset_postdata(); 
    echo ob_get_clean();
}

add_shortcode('cpt_download', 'create_shortcode_cpt');