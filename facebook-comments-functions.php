<?php
	if (FBCOMMENTS_ERRORS) {
		error_reporting(E_ALL); // Ensure all errors and warnings are verbose
	}
	
	/**********************************
	 Common functions
	 **********************************/
	
	// Update database with default options upon plugin activation
	function fbComments_init() {
		global $fbComments_defaults;
		
		foreach($fbComments_defaults as $key => $val) {
			// Only insert default value if option is not already in the database
			add_option($key, $val);
		}
	}
	
	// Remove database entries upon plugin deactivation
	function fbComments_uninit() {
		global $fbComments_optionKeys;
		
		foreach($fbComments_optionKeys as $key) {
			delete_option($key);
		}
	}
	
	// Retrieve array of plugin settings
	function fbComments_getSettings($keys=null) {
		$settings = array();
		
		global $fbComments_optionKeys;
			
		foreach($fbComments_optionKeys as $key) {
			$settings[$key] = get_option($key);
		}
		
		// Retrieve the XID (since it's not in the options array)
		$settings['fbComments_xid'] = get_option('fbComments_xid');
		
		return $settings;
	}
	
	// Generate a random alphanumeric string for the comments XID
	function fbComments_getRandXid($length=15) {
		$chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
		$rand = '';
		
		for ($i = 0; $i < $length; $i++) {
			$rand .= $chars[mt_rand(0, count($chars)-1)];
		}
		
		return $rand;
	}
	
	/**********************************
	 Facebook API interactions
	 **********************************/
	 
	// Thanks to Almog Baku for this feature (http://www.almogbaku.com/)
	function fbComments_combineCommentCounts($value) {
		global $fbComments_settings, $wp_query;
		
		require_once('scripts/facebook.php');
			
		$fbApiCredentials = array(
		    'appId'	 => $fbComments_settings['fbComments_appId'],
		    'secret' => $fbComments_settings['fbComments_appSecret']
		);
		
		$fb = new Facebook($fbApiCredentials);
		
		$postId = $wp_query->post->ID;
	    $xid = $fbComments_settings['fbComments_xid'] . "_post$postId";
	    $query = array(
			'method' => 'fql.query',
			'query'	 => 'SELECT count FROM comments_info WHERE app_id="' . $fb->getAppId() . '" AND xid="' . $xid . '"'
		);

		try {
			$result = $fb->api($query);
			
			// If the WordPress comments are hidden, just return the Facebook comments count
			if ($fbComments_settings['fbComments_hideWpComments']) {
				return $result[0]['count'];
			} else {
				return $value + $result[0]['count'];
			}
		} catch (FacebookApiException $e) {
			return $value;
		}
	}

	/**********************************
	 Facebook comments box inclusion
	 **********************************/
	
	// Insert Facebook comments manually or into the comments array
	function facebook_comments($comments='') {
		global $fbComments_settings, $wp_query;
		
		$postId = $wp_query->post->ID;
	    $xid = $fbComments_settings['fbComments_xid'] . "_post$postId";
	    $postTitle = single_post_title('', false);
	    $postUrl = get_permalink($postId);
	    
	    // Decide which stylesheet to use
	    if (($fbComments_settings['fbComments_hideFbLikeButton']) && ($fbComments_settings['fbComments_darkSite'])) {
	    	$customStylesheet = FBCOMMENTS_CSS_HIDELIKEANDDARKSITE . '?' . fbComments_getRandXid();
	    } elseif ($fbComments_settings['fbComments_hideFbLikeButton']) {
	    	$customStylesheet = FBCOMMENTS_CSS_HIDELIKE . '?' . fbComments_getRandXid();
	    } elseif ($fbComments_settings['fbComments_darkSite']) {
	    	$customStylesheet = FBCOMMENTS_CSS_DARKSITE . '?' . fbComments_getRandXid();
	    } else {
	    	$customStylesheet = FBCOMMENTS_CSS_HIDEFBLINK . '?' . fbComments_getRandXid();
	    }
	    
	    // Return out of function if commenting is closed for this post
	    if (!comments_open()) {
	    	return $comments;
	    }
	    
	    // Return out of function if we're only supposed to display comments on pages OR posts
	    if (($fbComments_settings['fbComments_displayPagesOrPosts'] == 'pages') && (!is_page())) {
	    	return $comments;
	    }
	    
	    if (($fbComments_settings['fbComments_displayPagesOrPosts'] == 'posts') && (!is_single())) {
	    	return $comments;
	    }
		
		// Only insert the Facebook comments if an application ID has been set
		if (!empty($fbComments_settings['fbComments_appId'])) {
			echo "\n<!-- Facebook Comments for WordPress v" . FBCOMMENTS_VER . " by " . FBCOMMENTS_AUTHOR . " (" . FBCOMMENTS_WEBPAGE . ") -->\n
<a name='facebook-comments'></a>\n";

	    	if ($fbComments_settings['fbComments_includeFbJs']) {
	    		echo "\n<div id='fb-root'></div>
<script src='http://connect.facebook.net/{$fbComments_settings['fbComments_language']}/all.js#appId={$fbComments_settings['fbComments_appId']}&amp;xfbml=1'></script>\n";

/*
 * The FB.Event.subscribe snippet below will allow us to achieve the following for the next release:
 * 	- Add Facebook comments to the Recent Comments section of a blog
 * 	- Send email notifications to the site admin whenever a comment is made
 * 	- Update (cache) the comment count whenever a new comment is made (thereby causing the Popular Posts functionality to work as expected as well)

echo "\n
<script>
	FB.api({
		method: 'fql.query',
		query: 'SELECT name FROM user WHERE uid=648900111'
	}, function(response) {
		alert('Name is ' + response[0].name);
	});

	var addedComment = function(response) {
		alert('A comment was added!');
	};
	
	FB.Event.subscribe('comments.add', addedComment);
</script>\n
";
*/
	    	}
	    	
	    	echo "\n<div id='fbComments' style='{$fbComments_settings['fbComments_containerCss']}'>\n";
	    	
	    	if ($fbComments_settings['fbComments_displayTitle']) {
	    		echo "\t<p style='{$fbComments_settings['fbComments_titleCss']}'>" . __($fbComments_settings['fbComments_title']) . "</p>\n";
	    	}
			
			echo "\t<fb:comments xid='$xid' numposts='{$fbComments_settings['fbComments_numPosts']}' width='{$fbComments_settings['fbComments_width']}' simple='{$fbComments_settings['fbComments_noBox']}' publish_feed='{$fbComments_settings['fbComments_publishToWall']}' reverse='{$fbComments_settings['fbComments_reverseOrder']}' css='$customStylesheet' send_notification_uid='{$fbComments_settings['fbComments_notifyId']}' title='$postTitle' url='$postUrl' notify='true'></fb:comments>
</div>\n";

			// Hide the WordPress commenting form if requested
			if ($fbComments_settings['fbComments_hideWpComments']) {
			    return array(); // Must return an empty array so foreach() loops in certain themes don't produce errors
			}
		} else { // If no application ID is set, display a message asking the user to set one (if they have permission to do so)			
			get_currentuserinfo(); // Get user info to see if the currently logged in user (if any) has the 'manage_options' capability
		    
		    if (current_user_can('manage_options')) {		
		    	$optionsPage = admin_url('options-general.php?page=facebook-comments');
		    	
		    	echo "\n<!-- Facebook Comments for WordPress v" . FBCOMMENTS_VER . " by " . FBCOMMENTS_AUTHOR . " (" . FBCOMMENTS_WEBPAGE . ") -->
		
<div style='{$fbComments_settings['fbComments_containerCss']}'>\n";

				if ($fbComments_settings['fbComments_displayTitle']) {
					echo "\t<p style='{$fbComments_settings['fbComments_titleCss']}'>" . __($fbComments_settings['fbComments_title']) . "</p>\n";
				}
				
				echo "\t<div style='background-color: #ffebe8; border: 1px solid #c00; padding: 7px; font-weight: bold; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; -khtml-border-radius: 5px;'>" . __("Your Facebook comments would normally appear here, but you haven't set a valid application ID yet. <a href='$optionsPage' style='color: #c00;'>Go set one now</a>.") . "</div>
</div>\n";
		    }
		}
		
		return $comments;
	}
?>
