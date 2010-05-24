<?php
	/**********************************
	 Common functions
	 **********************************/
	
	// Update database with default options upon plugin activation
	function fbComments_init() {
		global $fbComments_defaults;
		
		foreach($fbComments_defaults as $key => $val) {
			update_option($key, $val);
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
	
	function fbComments_include($comments='') {
		global $fbComments_settings, $wp_query;
		
		$commentStatus = $wp_query->post->comment_status;
		
		// Only display the Facebook comments if commenting is enabled on this post
		if ($commentStatus == 'open') {		
			$postId = $wp_query->post->ID;
			$xid = $fbComments_settings['fbComments_xid'] . "_post$postId";
			
			// Display the WordPress comments first if user specified (and not hidden)
			/*if ((!$fbComments_settings['fbComments_hideWpComments']) && ($fbComments_settings['fbComments_displayLocation'] == 'after')) {
				return $comments;
			}*/
			
			echo "\n<!-- Facebook Comments for WordPress by Graham Swan (http://grahamswan.com/) -->\n";
	
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
			
			echo "\n<div style='{$fbComments_settings['fbComments_containerCss']}'>
		<p style='{$fbComments_settings['fbComments_titleCss']}'>" . __($fbComments_settings['fbComments_title']) . "</p>
		<fb:comments xid='$xid' numposts='{$fbComments_settings['fbComments_numPosts']}' width='{$fbComments_settings['fbComments_width']}' simple='{$fbComments_settings['fbComments_noBox']}' publish_feed='{$fbComments_settings['fbComments_publishToWall']}' reverse='{$fbComments_settings['fbComments_reverseOrder']}' css='{$fbComments_settings['fbComments_externalCss']}' send_notification_uid='{$fbComments_settings['fbComments_notifyId']}'></fb:comments>
	</div>\n";
			
			// Display the WordPress comments first if user specified (and not hidden)
			//if ((!$fbComments_settings['fbComments_hideWpComments']) && ($fbComments_settings['fbComments_displayLocation'] == 'before')) {
				return $comments;
			//}
		}
	}
	
	function fbComments_error($comments='') {
		global $fbComments_settings, $wp_query;
		
		$commentStatus = $wp_query->post->comment_status;;
		
		// Get user info to see if the currently logged in user (if any) has the 'manage_options' capability
		get_currentuserinfo();
		
		if ((current_user_can('manage_options')) && ($commentStatus == 'open')) {		
			$optionsPage = get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=facebook_comments';
			
			echo "\n<!-- Facebook Comments for WordPress by Graham Swan (http://grahamswan.com/) -->
	
	<div style='{$fbComments_settings['fbComments_containerCss']}'>
	    <p style='{$fbComments_settings['fbComments_titleCss']}'>" . __($fbComments_settings['fbComments_title']) . "</p>
	    
	    <div style='background-color: #ffebe8; border: 1px solid #c00; padding: 7px; font-weight: bold; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; -khtml-border-radius: 5px;'>" . __("Your Facebook comments would normally appear here, but you haven't set a valid application ID yet. <a href='$optionsPage' style='color: #c00;'>Go set one now</a>.") . "</div>
	</div>\n";
			
			return $comments;
		}
	}
	
	/**********************************
	 Manual inclusion
	 **********************************/
	
	// Manually insert Facebook comments in a theme
	function facebook_comments() {
		global $fbComments_settings, $wp_query;
		
		// Only insert the Facebook comments if an application ID has been set
		if (!empty($fbComments_settings['fbComments_appId'])) {
			$postId = $wp_query->post->ID;
	    	$xid = $fbComments_settings['fbComments_xid'] . "_post$postId";
	    	
	    	echo "\n<!-- Facebook Comments for WordPress by Graham Swan (http://grahamswan.com/) -->\n";
	
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
	    	
	    	echo "\n<div style='{$fbComments_settings['fbComments_containerCss']}'>
		<p style='{$fbComments_settings['fbComments_titleCss']}'>" . __($fbComments_settings['fbComments_title']) . "</p>
	    <fb:comments xid='$xid' numposts='{$fbComments_settings['fbComments_numPosts']}' width='{$fbComments_settings['fbComments_width']}' simple='{$fbComments_settings['fbComments_noBox']}' publish_feed='{$fbComments_settings['fbComments_publishToWall']}' reverse='{$fbComments_settings['fbComments_reverseOrder']}' css='{$fbComments_settings['fbComments_externalCss']}' send_notification_uid='{$fbComments_settings['fbComments_notifyId']}'></fb:comments>
	</div>\n";
		} else { // If no application ID is set, display a message asking the user to set one (if they have permission to do so)
			// Get user info to see if the currently logged in user (if any) has the 'manage_options' capability
			get_currentuserinfo();
		    
		    if (current_user_can('manage_options')) {		
		    	$optionsPage = get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=facebook_comments';
		    	
		    	echo "\n<!-- Facebook Comments for WordPress by Graham Swan (http://grahamswan.com/) -->
		
		<div style='{$fbComments_settings['fbComments_containerCss']}'>
		    <p style='{$fbComments_settings['fbComments_titleCss']}'>" . __($fbComments_settings['fbComments_title']) . "</p>
		    
		    <div style='background-color: #ffebe8; border: 1px solid #c00; padding: 7px; font-weight: bold; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; -khtml-border-radius: 5px;'>" . __("Your Facebook comments would normally appear here, but you haven't set a valid application ID yet. <a href='$optionsPage' style='color: #c00;'>Go set one now</a>.") . "</div>
		</div>\n";
		    }
		}
	}
?>
