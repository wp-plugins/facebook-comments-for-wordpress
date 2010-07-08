<?php
	/*
	Plugin Name: Facebook Comments for WordPress
	Plugin URI: http://www.grahamswan.com/facebook-comments
	Description: Allows your visitors to comment on posts using their Facebook profile. Makes use of Facebook's new Social Graph plugins.
	Author: Graham Swan
	Version: 1.5
	Author URI: http://www.grahamswan.com/
	*/
	
	define('FBCOMMENTS_VER', '1.5');
	define('FBCOMMENTS_AUTHOR', 'Graham Swan');
	define('FBCOMMENTS_WEBPAGE', 'http://grahamswan.com/facebook-comments/');
	define('FBCOMMENTS_PATH', plugins_url('facebook-comments-for-wordpress/'));
	//define('FBCOMMENTS_CUSTOMSTYLESHEET', FBCOMMENTS_PATH . 'facebook-comments-custom.css');
	define('FBCOMMENTS_CSS_HIDEFBLINK', FBCOMMENTS_PATH . 'facebook-comments-hidefblink.css');
	define('FBCOMMENTS_CSS_HIDELIKE', FBCOMMENTS_PATH . 'facebook-comments-hidelike.css');
	define('FBCOMMENTS_CSS_DARKSITE', FBCOMMENTS_PATH . 'facebook-comments-darksite.css');
	define('FBCOMMENTS_CSS_HIDELIKEANDDARKSITE', FBCOMMENTS_PATH . 'facebook-comments-custom.css');
	
	// Include common functions
	require_once 'facebook-comments-functions.php';
	
	/**********************************
	 Globals
	 **********************************/
	
	global $fbComments_defaults, $fbComments_optionKeys, $fbComments_settings;
	
	$fbComments_optionKeys = array(
		'fbComments_appId',
		'fbComments_includeFbComments',
		'fbComments_hideWpComments',
		'fbComments_includeFbJs',
		'fbComments_includeFbmlLangAttr',
		'fbComments_includeOpenGraphLangAttr',
		'fbComments_includeOpenGraphMeta',
		'fbComments_notifyId',
		'fbComments_language',
		'fbComments_displayTitle',
		'fbComments_title',
		'fbComments_numPosts',
		'fbComments_width',
		'fbComments_displayLocation',
		'fbComments_displayPagesOrPosts',
		'fbComments_publishToWall',
		'fbComments_reverseOrder',
		'fbComments_hideFbLikeButton',
		//'fbComments_hideFbLikeFaces',
		//'fbComments_hideFbProfilePics',
		//'fbComments_hideFbLink',
		'fbComments_containerCss',
		'fbComments_titleCss',
		'fbComments_darkSite',
		'fbComments_noBox',
		'fbComments_displayWarning'
	);
	
	$fbComments_defaults = array(
		'fbComments_appId'						=> '',
		'fbComments_xid'						=> fbComments_getRandXid(),
		'fbComments_includeFbComments'			=> true,
		'fbComments_hideWpComments'				=> false,
		'fbComments_includeFbJs'				=> true,
		'fbComments_includeFbmlLangAttr'		=> true,
		'fbComments_includeOpenGraphLangAttr'	=> true,
		'fbComments_includeOpenGraphMeta'		=> true,
		'fbComments_notifyId'					=> '',
		'fbComments_language'					=> 'en_US',
		'fbComments_displayTitle'				=> true,
		'fbComments_title'						=> 'Facebook comments:',
		'fbComments_numPosts'					=> 10,
		'fbComments_width'						=> 500,
		'fbComments_displayLocation'			=> 'before',
		'fbComments_displayPagesOrPosts'		=> 'posts',
		'fbComments_publishToWall'				=> true,
		'fbComments_reverseOrder'				=> false,
		'fbComments_hideFbLikeButton'			=> false,
		//'fbComments_hideFbLikeFaces'			=> false,
		//'fbComments_hideFbProfilePics'		=> false,
		//'fbComments_hideFbLink'				=> false,
		'fbComments_containerCss'				=> 'margin: 20px 0;',
		'fbComments_titleCss'					=> 'margin-bottom: 15px; font-size: 140%; font-weight: bold; border-bottom: 2px solid #000; padding-bottom: 5px;',
		'fbComments_darkSite'					=> '',
		'fbComments_noBox'						=> false,
		'fbComments_displayWarning'				=> true
	);
	
	$fbComments_settings = fbComments_getSettings();
	
	/**********************************
	 Activation hooks/actions
	 **********************************/
	
	register_activation_hook(__FILE__, 'fbComments_init');
	register_uninstall_hook(__FILE__, 'fbComments_uninit');
	
	// Display a message prompting the user to enter a Facebook application ID upon plugin activation
	if ($fbComments_settings['fbComments_displayWarning']) {
		function fbComments_warning() {
			echo "\n<div class='error'><p><strong>" . __('The Facebook comments box will not be included in your posts until you set a valid application ID. Please <a href="' . admin_url('options-general.php?page=facebook-comments') . '">set your application ID now</a> using the options page.') . "</strong></p></div>\n";
		}
	
		add_action('admin_notices', 'fbComments_warning');
		
		// Set the fbComments_displayWarning option to false so the message is only displayed once
		update_option('fbComments_displayWarning', false);
	}
	
	// Enqueue correct stylesheet if user wants to hide the WordPress commenting form
	if ($fbComments_settings['fbComments_hideWpComments']) {
		function fbComments_enqueueHideWpCommentsCss() {
			wp_register_style('fbComments_hideWpComments', FBCOMMENTS_PATH . 'facebook-comments-hidewpcomments.css', array(), FBCOMMENTS_VER);
            wp_enqueue_style('fbComments_hideWpComments');
		}
	
		add_action('init', 'fbComments_enqueueHideWpCommentsCss');
	}
	
	/*// Create stylesheet for custom Facebook Comments box styles
	if ((($fbComments_settings['fbComments_hideFbLikeButton']) || ($fbComments_settings['fbComments_hideFbLikeFaces']) || ($fbComments_settings['fbComments_hideFbProfilePics']) || ($fbComments_settings['fbComments_hideFbLink']) || ($fbComments_settings['fbComments_darkSite'])) && (is_writable(FBCOMMENTS_CUSTOMSTYLESHEET))) {
		$customStylesheet = fopen(FBCOMMENTS_CUSTOMSTYLESHEET, 'w');
		
		// Correct comments for this line if it ever gets included in the plugin
		fwrite($customStylesheet, '@charset "UTF-8";\n\n/*****************************\n/* Custom styles for modifying/hiding certain elements of the Facebook Comments box\n/*****************************\n\n');
		
		if ($fbComments_settings['fbComments_hideFbLikeButton']) {
			fwrite($customStylesheet, '@import url("' . FBCOMMENTS_PATH . 'facebook-comments-hidelike.css");\n');
		}
		if ($fbComments_settings['fbComments_hideFbLikeFaces']) {
			fwrite($customStylesheet, '@import url("' . FBCOMMENTS_PATH . 'facebook-comments-hidelikefaces.css");\n');
		}
		if ($fbComments_settings['fbComments_hideFbProfilePics']) {
			fwrite($customStylesheet, '@import url("' . FBCOMMENTS_PATH . 'facebook-comments-hideprofilepics.css");\n');
		}
		if ($fbComments_settings['fbComments_hideFbLink']) {
			fwrite($customStylesheet, '@import url("' . FBCOMMENTS_PATH . 'facebook-comments-hidefblink.css");\n');
		}
		if ($fbComments_settings['fbComments_darkSite']) {
			fwrite($customStylesheet, '@import url("' . FBCOMMENTS_PATH . 'facebook-comments-darksite.css");\n');
		}
		
		fclose($customStylesheet);
	}*/
	
	// Add appropriate language attributes (must use get_option() because $fbComments_settings[] isn't available at this point)
	if (($fbComments_settings['fbComments_includeFbmlLangAttr']) || ($fbComments_settings['fbComments_includeOpenGraphLangAttr'])) {
		function fbComments_includeLangAttrs($attributes='') {
			if (get_option('fbComments_includeFbmlLangAttr')) {
				$attributes .= ' xmlns:fb="http://www.facebook.com/2008/fbml"';
			}
			
			if (get_option('fbComments_includeOpenGraphLangAttr')) {
				$attributes .= ' xmlns:og="http://opengraphprotocol.org/schema/"';
			}
			
			return $attributes;
		}
	
		add_filter('language_attributes', 'fbComments_includeLangAttrs');
	}
	
	// Add OpenGraph meta information
	if ($fbComments_settings['fbComments_includeOpenGraphMeta']) {
		function fbComments_addOpenGraphMeta() {
			global $wp_query;
			
			$postId = $wp_query->post->ID;
		    $postTitle = single_post_title('', false);
		    $postUrl = get_permalink($postId);
		    $siteName = get_bloginfo('name');
		    $appId = get_option('fbComments_appId');
		    
			echo "<meta property='og:title' content='$postTitle' />
<meta property='og:site_name' content='$siteName' />
<meta property='og:url' content='$postUrl' />
<meta property='og:type' content='article' />
<meta property='fb:app_id' content='$appId' />\n";
		}
		
		add_action('wp_head', 'fbComments_addOpenGraphMeta');
	}
	
	/**********************************
	 Settings page
	 **********************************/
	
	function fbComments_includeAdminPage() {
		include('facebook-comments-admin.php');
	}
	
	function fbComments_adminPage() {
		add_options_page(__('Facebook Comments for WordPress Options'), __('Facebook Comments'), 'manage_options', 'facebook-comments', 'fbComments_includeAdminPage');
	}
	
	function fbComments_settingsLink($actionLinks, $file) {
 		if (($file == 'facebook-comments-for-wordpress/facebook-comments.php') && function_exists('admin_url')) {
			$settingsLink = '<a href="' . admin_url('options-general.php?page=facebook-comments') . '">' . __('Settings') . '</a>';
		
			// Add 'Settings' link to plugin's action links
			array_unshift($actionLinks, $settingsLink);
		}
		
		return $actionLinks;
	}
	
	add_action('admin_menu', 'fbComments_adminPage');
	add_filter('plugin_action_links', 'fbComments_settingsLink', 0, 2);
	
	/**********************************
	 Program entry point
	 **********************************/
	
	// Ensure we're able to display the comment box
	if ($fbComments_settings['fbComments_includeFbComments']) {		
		add_filter('comments_array', 'facebook_comments');
	}
?>
