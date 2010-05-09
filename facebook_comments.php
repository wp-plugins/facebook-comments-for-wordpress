<?php
	/*
	Plugin Name: Facebook Comments for WordPress
	Plugin URI: http://www.grahamswan.com/facebook-comments
	Description: Allows your visitors to comment on posts using their Facebook profile. Makes use of Facebook's new Social Graph plugins.
	Author: Graham Swan
	Version: 1.0
	Author URI: http://www.grahamswan.com/
	*/
	
	define('FBCOMMENTS_VERSION', '1.0');

	// Update database with default options upon plugin activation
	function fbComments_init() {
		$defaults = array(
			'fbComments_includeFbJs'	=> true,
			'fbComments_appId'			=> '',
			'fbComments_numPosts'		=> 10,
			'fbComments_width'			=> 500,
			'fbComments_containerCss'	=> 'margin: 20px 0;',
			'fbComments_titleCss'		=> 'margin-bottom: 15px; font-size: 140%; font-weight: bold; border-bottom: 2px solid #000; padding-bottom: 5px;',
			'fbComments_displayWarning'	=> true
		);
		
		foreach($defaults as $key => $val) {
			update_option($key, $val);
		}
	}
	
	// Remove database entries upon plugin deactivation
	function fbComments_uninit() {
		$defaults = array(
			'fbComments_includeFbJs',
			'fbComments_appId',
			'fbComments_numPosts',
			'fbComments_width',
			'fbComments_containerCss',
			'fbComments_titleCss',
			'fbComments_displayWarning'
		);
		
		foreach($defaults as $key) {
			delete_option($key);
		}
	}
	
	add_action('activate_plugin', 'fbComments_init');
	add_action('deactivate_plugin', 'fbComments_uninit');
	
	// Display a message prompting the user to enter a Facebook application ID upon plugin activation
	if (get_option('fbComments_displayWarning')) {
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
		include('facebook_comments_admin.php');
	}
	
	function fbComments_admin() {
		add_options_page(__('Facebook Comments for WordPress Options'), __('Facebook Comments'), 'manage_options', 'facebook_comments', 'fbComments_adminPage');
	}
	
	add_action('admin_menu', 'fbComments_admin');
	
	/**********************************
		Facebook comments box inclusion
	 **********************************/
	
	function fbComments_include($comments='') {
		// Retrieve the settings to display the comments box
		$includeFbJs = get_option('fbComments_includeFbJs');
		$appId = get_option('fbComments_appId');
		$numPosts = get_option('fbComments_numPosts');
		$width = get_option('fbComments_width');
		$containerCss = get_option('fbComments_containerCss');
		$titleCss = get_option('fbComments_titleCss');
		
		echo "\n<!-- Facebook Comments for WordPress by Graham Swan (http://grahamswan.com/) -->\n";

		if ($includeFbJs) {
			echo "\n<div id='fb-root'></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({appId: '$appId', status: true, cookie: true, xfbml: true});
	};
	(function() {
		var e = document.createElement('script'); e.async = true;
		e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
		document.getElementById('fb-root').appendChild(e);
	}());
</script>\n";
		}
		
		echo "\n<div style='$containerCss'>
	<p style='$titleCss'>Facebook comments:</p>
	<fb:comments numposts='$numPosts' width='$width'></fb:comments>
</div>\n";
		
		return $comments;
	}
	
	function fbComments_error($comments='') {
		// Get user info to see if the currently logged in user (if any) has the 'manage_options' capability
		get_currentuserinfo();
		
		if (current_user_can('manage_options')) {		
			// Retrieve the settings to display the comments box
			$containerCss = get_option('fbComments_containerCss');
			$titleCss = get_option('fbComments_titleCss');
			$optionsPage = get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=facebook_comments';
			
			echo "\n<!-- Facebook Comments for WordPress by Graham Swan (http://grahamswan.com/) -->
	
	<div style='$containerCss'>
	    <p style='$titleCss'>" . __('Facebook comments:') . "</p>
	    
	    <div style='background-color: #ffebe8; border: 1px solid #c00; padding: 10px;'>" . __("Your Facebook comments would normally appear here, but you haven't set a valid application ID yet. <a href='$optionsPage' style='color: #c00;'>Go set one now</a>.") . "</div>
	</div>\n";
		}
		
		return $comments;
	}	
	
	// Retrieve application ID to ensure we're able to display the comment box
	$appId = get_option('fbComments_appId');
	
	if (!empty($appId)) {
		add_filter('comments_array', 'fbComments_include');
	} else {
		add_filter('comments_array', 'fbComments_error');
	}
?>
