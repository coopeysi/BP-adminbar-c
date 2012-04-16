<?php
/*
Plugin Name: BuddyPress Adminbar Log In Fix
Plugin URI: http://simoncoopey.net
Description: Fixes BuddyPress adminbar - log in returns user to same page, not multisite homepage
Author: Simon Coopey
Version: 0.2.3
Author URI: http://simoncoopey.net
*/

// Make sure BuddyPress is loaded before we do anything.

if ( !function_exists( 'bp_core_install' ) ) {
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'buddypress/bp-loader.php' ) ) {
		require_once ( WP_PLUGIN_DIR . '/buddypress/bp-loader.php' );
	} else {
		add_action( 'admin_notices', 'bp_verified_install_buddypress_notice' );
		return;
	}
} 

	// creates a log in to this site button- so users don't get redirected to homepage
	function custom_adminbar_li_button() {
		if (!is_user_logged_in()) {
        	echo '<li><a href="/wp-login.php/">Log In</a></li>';
		}
	}
	
	// removes old 'log in' button, and puts our new one in its place
	function remv_bp_adminbar_li(){
		remove_action('bp_adminbar_menus', 'bp_adminbar_login_menu', 2);
		add_action('bp_adminbar_menus', 'custom_adminbar_li_button', 2);
		}
	add_action('wp_footer','remv_bp_adminbar_li',1);
	
?>