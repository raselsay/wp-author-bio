<?php
/*
Plugin Name:  WP Author Bio wedo
Plugin URI:   https://developer.wordpress.org/plugins/wp_wedo/
Description:  Basic WordPress Plugin an Author bio and social link
Version:      1.0
Author:       Abedin Rasel
License:      wedo
License URI:  https://www.wordpress.org/
Text Domain:  wedo
Domain Path:  /languages
*/

/**
* Print SEO TAG
* @return void
*/

if (is_admin()) {
	require_once dirname(__FILE__).'/include/admin/profile.php';
}

function wedoSeoTag() {
 ?>
   <meta name="keyword" content="wedo ,author,bio,wedo authro bio,wp, infp ">
<?php
}

add_action('wp_head','wedoSeoTag');

function wedo_content_author_bio( $content )
{
   global $post;

   $author= get_user_by('id',$post->post_author);

   $author_twitter = get_user_meta($author->ID,'twitter',true);
   $author_facebook = get_user_meta($author->ID,'facebook',true);
   $author_linkedin = get_user_meta($author->ID,'linkedin',true);
   $author_youtube = get_user_meta($author->ID,'youtube',true);


   // $author_avatar = get_avatar($author->ID,64);
   $author_avatar = get_avatar( $author->ID, 64, null, null, ['class'=>'mr-3 rounded-circle'] );

   ob_start();
   ?>

  <div class="card">
  <div class="card-body">
	<div class="media">
	  <?php echo $author_avatar ?>
	  <div class="media-body ml-3">
	    <h5 class="mt-0 mb-0"><?php echo $author->display_name; ?></h5>
	     <ul class="mt-2 wedo_social_link">
    	<li><a style="text-decoration: none" href="<?php echo esc_url($author_twitter)?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
    	<li><a href="<?php echo esc_url($author_facebook)?>">
    		<i class="fa fa-facebook-square" aria-hidden="true"></i>
    	</a></li>
        <li><a href="<?php echo esc_url($author_linkedin)?>">
    		<i class="fa fa-linkedin-square" aria-hidden="true"></i>
    	</a></li>

    	<li><a href="<?php echo esc_url($author_youtube)?>">
    		<i class="fa fa-youtube-square" aria-hidden="true"></i>
    	</a></li>

    </ul>
	  </div>
	</div>
</div>
</div>


<?php

	$bio =ob_get_clean();
	if (is_single()) {
		return $content.$bio;
	} else {
		return $content;
	}

}

add_filter('the_content','wedo_content_author_bio');	

function wedo_enqueue_script() {
	wp_enqueue_style('wedo_style',plugins_url( 'assets/css/style.css', __FILE__ ));
	wp_enqueue_style('wedo_bootstrap_style',plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ));
	wp_enqueue_style('wedo_font_awesome',plugins_url( 'assets/css/font-awesome.min.css', __FILE__ ));
	wp_enqueue_script('wedo_bootstrap_js', plugins_url( 'assets/js/bootstrap.min.js', __FILE__ ));
}

add_action( 'wp_enqueue_scripts','wedo_enqueue_script' );




