<?php
	/*
	Plugin Name: Facebook Comments for WordPress
	Plugin URI: http://www.grahamswan.com/facebook-comments
	Description: Allows your visitors to comment on posts using their Facebook profile. Makes use of Facebook's new Social Graph plugins.
	Author: Graham Swan
	Version: 1.2
	Author URI: http://www.grahamswan.com/
	*/
	
	/*
	Things I wish I could add, but don't have the time:
	 - Ability to import all WordPress comments to Facebook comments for any given post, and vice versa
	 - Ability to subscribe to new Facebook comments
	 - Move entire plugin into 'fbComments' class (to avoid potential conflicts with other plugins)
	 - Rebuild options page with AJAX
	 - Check Facebook application ID for validity	 
	*/
	
	define('FBCOMMENTS_VERSION', '1.2');
	
	// Include common functions
	require_once 'facebook-comments-functions.php';
	
	/**********************************
	 Globals
	 **********************************/
	
	global $fbComments_defaults, $fbComments_optionKeys, $fbComments_settings;
	
	$fbComments_optionKeys = array(
		'fbComments_appId',
		//'fbComments_xid',
		'fbComments_includeFbComments',
		'fbComments_hideWpComments',
		'fbComments_includeFbJs',
		'fbComments_title',
		'fbComments_notifyId',
		'fbComments_numPosts',
		'fbComments_width',
		'fbComments_displayLocation',
		'fbComments_publishToWall',
		'fbComments_reverseOrder',
		'fbComments_containerCss',
		'fbComments_titleCss',
		'fbComments_externalCss',
		'fbComments_noBox',
		'fbComments_displayWarning'
	);
	
	$fbComments_defaults = array(
		'fbComments_appId'					=> '',
		//'fbComments_xid'					=> fbComments_getRandXid(),
		'fbComments_includeFbComments'		=> true,
		'fbComments_hideWpComments'			=> false,
		'fbComments_includeFbJs'			=> true,
		'fbComments_notifyId'				=> '',
		'fbComments_title'					=> 'Facebook comments:',
		'fbComments_numPosts'				=> 10,
		'fbComments_width'					=> 500,
		'fbComments_displayLocation'		=> 'before',
		'fbComments_publishToWall'			=> true,
		'fbComments_reverseOrder'			=> false,
		'fbComments_containerCss'			=> 'margin: 20px 0;',
		'fbComments_titleCss'				=> 'margin-bottom: 15px; font-size: 140%; font-weight: bold; border-bottom: 2px solid #000; padding-bottom: 5px;',
		'fbComments_externalCss'			=> '',
		'fbComments_noBox'					=> false,
		'fbComments_displayWarning'			=> true
	);
	
	$fbComments_settings = fbComments_getSettings();
	
	/**********************************
	 Activation hooks
	 **********************************/
	
	register_activation_hook(__FILE__, 'fbComments_init');
	register_deactivation_hook(__FILE__, 'fbComments_uninit');
	
	// Display a message prompting the user to enter a Facebook application ID upon plugin activation
	if ($fbComments_settings['fbComments_displayWarning']) {
		function fbComments_warning() {
			echo "\n<div class='error'><p><strong>" . __('The Facebook comments box will not be included in your posts until you set a valid application ID. Please <a href="options-general.php?page=facebook_comments">set your application ID now</a> using the options page.') . "</strong></p></div>\n";
		}
	
		add_action('admin_notices', 'fbComments_warning');
		
		// Set the fbComments_displayWarning option to false so the message is only displayed once
		update_option('fbComments_displayWarning', false);
	}

	/**********************************
	 Settings page
	 **********************************/
	
	function fbComments_adminPage() {
		include('facebook-comments-admin.php');
	}
	
	function fbComments_admin() {
		add_options_page(__('Facebook Comments for WordPress Options'), __('Facebook Comments'), 'manage_options', 'facebook_comments', 'fbComments_adminPage');
	}
	
	add_action('admin_menu', 'fbComments_admin');
	
	/**********************************
	 Program entry point
	 **********************************/
	
	// Ensure we're able to display the comment box
	if ($fbComments_settings['fbComments_includeFbComments']) {
		if (!empty($fbComments_settings['fbComments_appId'])) {
			add_filter('comments_array', 'fbComments_include');
		} else {
			add_filter('comments_array', 'fbComments_error');
		}
	}
?>
