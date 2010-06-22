<?php
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
		
		/* If no XID is present, generate a random one (this can't be removed upon plugin
		   deactivation because it would cause comments to disappear when upgrading the plugin */
		if (get_option('fbComments_xid') == '') {
			update_option('fbComments_xid', fbComments_getRandXid());
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
		
		// If user requested an array of specific settings
		if (is_array($keys)) {
			foreach($keys as $key) {
				$settings[$key] = get_option($key);
			}
		}
		else { // If no specific settings were requested, return all of them
			global $fbComments_optionKeys;
			
			foreach($fbComments_optionKeys as $key) {
				$settings[$key] = get_option($key);
			}
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
	 Facebook comments box inclusion
	 **********************************/
	
	// Insert Facebook comments manually or into the comments array
	function facebook_comments($comments='') {
		global $fbComments_settings, $wp_query;
		
		$postId = $wp_query->post->ID;
	    $xid = $fbComments_settings['fbComments_xid'] . "_post$postId";
	    
	    // Return out of function if commenting is closed for this post
	    if (!comments_open()) {
	    	return;
	    }
	    
	    // Return out of function if we're only supposed to display comments on pages OR posts
	    if (($fbComments_settings['fbComments_displayPagesOrPosts'] == 'pages') && (!is_page())) {
	    	return;
	    }
	    
	    if (($fbComments_settings['fbComments_displayPagesOrPosts'] == 'posts') && (!is_single())) {
	    	return;
	    }
		
		// Only insert the Facebook comments if an application ID has been set
		if (!empty($fbComments_settings['fbComments_appId'])) {
			echo "\n<!-- Facebook Comments for WordPress v1.4 by Graham Swan (http://grahamswan.com/facebook-comments/) -->\n";
	
	    	if ($fbComments_settings['fbComments_includeFbJs']) {
	    		echo "\n<div id='fb-root'></div>
<script>
    window.fbAsyncInit = function() {
    	FB.init({appId: '{$fbComments_settings['fbComments_appId']}', status: true, cookie: true, xfbml: true});
    };
    (function() {
    	var e = document.createElement('script'); e.async = true;
    	e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    	document.getElementById('fb-root').appendChild(e);
    }());
</script>\n";
	    	}
	    	
	    	echo "\n<div style='{$fbComments_settings['fbComments_containerCss']}'>\n";
	    	
	    	if ($fbComments_settings['fbComments_displayTitle']) {
	    		echo "\t<p style='{$fbComments_settings['fbComments_titleCss']}'>" . __($fbComments_settings['fbComments_title']) . "</p>\n";
	    	}
			
			echo "\t<fb:comments xid='$xid' numposts='{$fbComments_settings['fbComments_numPosts']}' width='{$fbComments_settings['fbComments_width']}' simple='{$fbComments_settings['fbComments_noBox']}' publish_feed='{$fbComments_settings['fbComments_publishToWall']}' reverse='{$fbComments_settings['fbComments_reverseOrder']}' css='{$fbComments_settings['fbComments_externalCss']}' send_notification_uid='{$fbComments_settings['fbComments_notifyId']}'></fb:comments>
</div>\n";
		} else { // If no application ID is set, display a message asking the user to set one (if they have permission to do so)			
			get_currentuserinfo(); // Get user info to see if the currently logged in user (if any) has the 'manage_options' capability
		    
		    if (current_user_can('manage_options')) {		
		    	$optionsPage = admin_url('options-general.php?page=facebook-comments');
		    	
		    	echo "\n<!-- Facebook Comments for WordPress by Graham Swan (http://grahamswan.com/facebook-comments/) -->
		
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
