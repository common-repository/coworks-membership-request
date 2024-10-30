<?php
/*
Plugin Name: Coworks Membership Request
Plugin URI:
Description: Coworks Membership Request
Version: 2.2.3
Author: Coworks
Author URI: https://coworksapp.com 
License: GPL2
*/

defined('ABSPATH') or die('Error!');

function cwr_plugin_activation_hook(){
	// Activation code here
	// Create database tables or entries etc
}
//Register activation hook
//register_activation_hook(__FILE__, 'cwr_plugin_activation_hook');

function cwr_plugin_deactivation_hook(){
	// Deactivation code here
	//  Remove databsae entries or other settings if necessary
}
//Register activation hook
//register_deactivation_hook(__FILE__, 'cwr_plugin_deactivation_hook');

function cwr_plugin_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
}
//add_action( 'wp_enqueue_scripts', 'cwr_plugin_stylesheet' );

function cwr_plugin_js() {
  // Respects SSL, JS is relative to the current file
}
//add_action( 'wp_enqueue_scripts', 'cwr_plugin_js' );

function cwr_plugin_admin_css() {
	// Admin CSS Hook File, Respects SSL, Admin.css is relative to the current file
}
//add_action( 'admin_enqueue_scripts', 'plugin_admin_my_css' );

function cwr_plugin_admin_js() {
  //Admin Js Hook File, Respects SSL, JS is relative to the current file;
  
  //this file is used to passed some localize data.
  wp_register_script( 'objectIsPass', plugins_url( 'js/object.js', __FILE__ ) );
  // Localize the script with new data
  $localizeArray = array(
	'imageurl' =>  plugins_url( 'img/coworks-icon.png', __FILE__ )
  );
  wp_localize_script( 'objectIsPass', 'objectData', $localizeArray );
  // Enqueued script with localized data.
  wp_enqueue_script( 'objectIsPass' );
}
add_action( 'admin_enqueue_scripts', 'cwr_plugin_admin_js' );


function cwr_plugin_get_content($atts, $content = null){
	extract( shortcode_atts( array(
      'id' => 'id',
      'type' => 'type',
      ), $atts ) );

  $fallbackFormType = 'membership-request';
  if (!isset($type)) $type = $fallbackFormType;
	$string = '';
	$string .= '<div class="custom-iframe-block ">';
	$string .= '<iframe class="custom-iframe" src="//'.esc_attr($id).'.coworksapp.com/'.esc_attr($type).'" style="border:0px #ffffff none;" name="coworks" scrolling="no" frameborder="1" marginheight="0px" marginwidth="0px" height="900px" width="100%" allowfullscreen></iframe>';
    $string .= '</div>';

	return $string ;
}
// Register shortcode
add_shortcode('Coworks', 'cwr_plugin_get_content');



// Filter Functions with Hooks
function cwr_plugin_mce_button() {
  // Check if user have permission
  if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
    return;
  }
  // Check if WYSIWYG is enabled
  if ( 'true' == get_user_option( 'rich_editing' ) ) {
    add_filter( 'mce_external_plugins', 'cwr_plugin_tinymce_plugin' );
    add_filter( 'mce_buttons', 'cwr_plugin_register_mce_button' );
  }
}
add_action('admin_head', 'cwr_plugin_mce_button');

// Function for new button
function cwr_plugin_tinymce_plugin( $plugin_array ) {
  $plugin_array['cwr_plugin_mce_button'] = plugins_url('js/tinymce.js', __FILE__);
  return $plugin_array;
}


// Register new button in the editor
function cwr_plugin_register_mce_button( $buttons ) {
  array_push( $buttons, 'cwr_plugin_mce_button' );
  return $buttons;
}






?>
