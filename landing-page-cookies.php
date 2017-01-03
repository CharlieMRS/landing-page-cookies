<?php

/*

Plugin Name: Landing Page Cookie
Description: Sets a Cookie for specific landing pages
Author: Charlie Meers
Version: 1.1

*/

add_action('wp_enqueue_scripts', 'MRSCRTV_this_here_enqueue_scripts');

function MRSCRTV_this_here_enqueue_scripts() {
	if ( is_front_page() ) : 
	wp_enqueue_script('cookie-script', plugins_url( 'js/cookie.min.js', __FILE__ ), null, true); 
	/*
	$post = get_post($post_id);
	$slug = $post->post_name; 
	wp_enqueue_script('these-cookies-script', plugins_url( 'js/these-cookies.js', __FILE__ ), array('cookie-script'), null, true);
	wp_localize_script('these-cookies-script', 'referral', $slug );
	
	*/ ?>

	<?php endif;

}

add_action('wp_footer', 'set_cookie_func');
function set_cookie_func() {
    $post = get_post($post_id);
	
	if ( is_front_page() ) : ?>
	<script type="text/javascript">   
    	var referral = <?php echo '"' . $post->post_name . '"'; ?>;
		cookie.set( 'landing-page', referral, {expires: 7} );
	</script>
    
<?php endif;
}



/*"lp_cookie" is parameter name of gravity forms hidden field*/
add_filter( 'gform_field_value_lp_cookie', 'populate_lp_cookie' );

function populate_lp_cookie( $value ) {
   return $_COOKIE['landing-page'];
}