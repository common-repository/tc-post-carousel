<?php
/**
 * Plugin Name:		   TC Post Carousel
 * Plugin URI:		    http://themescode.com/items/tc-post-carousel-pro/
 * Description:		   TC Post Carousel shows Blog post carousel . Tt is fully responsive and can be used in any page or post using shortcode [tc-post-carousel] .
 * Version: 		     1.0
 * Author: 			     themescode < imran@themescode.com >
 * Author URI: 		    http://themescode.com/items/tc-post-carousel-pro/
 * Text Domain:      tc-post-caousel
 * License:          GPL-2.0+
 * License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
 * License: GPL2
 */

// include files
include(plugin_dir_path( __FILE__ ).'/public/view.php');


function tc_post_carousel_enqueue_scripts() {
   // Vendors style & scripts
     wp_enqueue_style('owl-carousel', plugins_url('vendors/owl-carousel/owl.carousel.css', __FILE__ ));
     wp_enqueue_style( 'tc-post-carousel', plugins_url('assets/css/tc-post-carousel.css', __FILE__ ) );
     wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
   //Plugin Main CSS File
     wp_enqueue_script('owl-carousel-js', plugins_url('vendors/owl-carousel/owl.carousel.min.js', __FILE__ ), array('jquery'), 1.0, true);

 }

add_action( 'wp_enqueue_scripts', 'tc_post_carousel_enqueue_scripts' );

 function tc_post_carousel_admin_style() {

  wp_enqueue_style( 'tc-admin', plugins_url('assets/css/tc-admin.css',__FILE__ ));

 }
 add_action( 'admin_enqueue_scripts', 'tc_post_carousel_admin_style' );

 // adding setting options

 require_once dirname( __FILE__ ) . '/lib/class.settings-api.php';
 require_once dirname( __FILE__ ) . '/lib/tc-post-carousel-settings.php';

 new TC_post_cacrousel_Settings();


 // After Plugin Activation redirect


if( !function_exists( 'tc_pc_after_activation_redirect' ) ){
  function tc_pc_after_activation_redirect( $plugin ) {
      if( $plugin == plugin_basename( __FILE__ ) ) {
          exit( wp_redirect( admin_url( 'admin.php?page=tc-post-carousel' ) ) );
      }
  }
}
add_action( 'activated_plugin', 'tc_pc_after_activation_redirect' );

//settings link

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'tc_plugin_action_links' );

function tc_plugin_action_links( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=tc-post-carousel') ) .'">Settings</a>';
   $links[] = '<a href="http://themescode.com/items/category/wordpress-plugins" target="_blank">TC Plugins</a>';
   return $links;
}


// Addind Submenu page

 function tc_post_carousel_menu_help(){
   include('lib/tc-help-upgrade.php');
 }

 function tc_post_carousel_menu_init()
   {

     add_submenu_page('tc-post-carousel', __('Help & Upgrade','tc-post-caousel'), __('Help & Upgrade','tc-post-caousel'), 'manage_options', 'tc_post_carousel_menu_help', 'tc_post_carousel_menu_help');

   }

 add_action('admin_menu', 'tc_post_carousel_menu_init');
