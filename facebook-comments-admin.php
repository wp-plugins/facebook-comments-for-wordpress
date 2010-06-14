<?php
	// If the user submitted the form, update the database with the new settings
	if ($_POST['fbComments_update'] == 'true') {
		//$appId = (intval($_POST['fbComments_appId']) > 0) ? intval($_POST['fbComments_appId']) : null;
		$fbComments_settings['fbComments_appId'] = (!empty($_POST['fbComments_appId'])) ? esc_html(stripslashes($_POST['fbComments_appId'])) : null;
		update_option('fbComments_appId', $fbComments_settings['fbComments_appId']);
		
		$fbComments_settings['fbComments_xid'] = (!empty($_POST['fbComments_xid'])) ? esc_html(stripslashes($_POST['fbComments_xid'])) : get_option('fbComments_xid');
		update_option('fbComments_xid', $fbComments_settings['fbComments_xid']);
		
		$fbComments_settings['fbComments_includeFbComments'] = ($_POST['fbComments_includeFbComments'] == 'true') ? true : false;
		update_option('fbComments_includeFbComments', $fbComments_settings['fbComments_includeFbComments']);
		
		/*$fbComments_settings['fbComments_hideWpComments'] = ($_POST['fbComments_hideWpComments'] == 'true') ? true : false;
		update_option('fbComments_hideWpComments', $fbComments_settings['fbComments_hideWpComments']);*/
		
		$fbComments_settings['fbComments_includeFbJs'] = ($_POST['fbComments_includeFbJs'] == 'true') ? true : false;
		update_option('fbComments_includeFbJs', $fbComments_settings['fbComments_includeFbJs']);
		
		$fbComments_settings['fbComments_notifyId'] = esc_html(stripslashes($_POST['fbComments_notifyId']));
		update_option('fbComments_notifyId', $fbComments_settings['fbComments_notifyId']);
		
		$fbComments_settings['fbComments_displayTitle'] = ($_POST['fbComments_displayTitle'] == 'true') ? true : false;
		update_option('fbComments_displayTitle', $fbComments_settings['fbComments_displayTitle']);
		
		$fbComments_settings['fbComments_title'] = esc_html(stripslashes($_POST['fbComments_title']));
		update_option('fbComments_title', $fbComments_settings['fbComments_title']);
		
		$fbComments_settings['fbComments_numPosts'] = intval($_POST['fbComments_numPosts']);
		update_option('fbComments_numPosts', $fbComments_settings['fbComments_numPosts']);
		
		$fbComments_settings['fbComments_width'] = intval($_POST['fbComments_width']);
		update_option('fbComments_width', $fbComments_settings['fbComments_width']);
		
		/*$fbComments_settings['fbComments_displayLocation'] = $_POST['fbComments_displayLocation'];
		update_option('fbComments_displayLocation', $fbComments_settings['fbComments_displayLocation']);*/
		
		$fbComments_settings['fbComments_publishToWall'] = ($_POST['fbComments_publishToWall'] == 'true') ? true : false;
		update_option('fbComments_publishToWall', $fbComments_settings['fbComments_publishToWall']);
		
		$fbComments_settings['fbComments_reverseOrder'] = ($_POST['fbComments_reverseOrder'] == 'true') ? true : false;
		update_option('fbComments_reverseOrder', $fbComments_settings['fbComments_reverseOrder']);
		
		$fbComments_settings['fbComments_containerCss'] = esc_html(stripslashes($_POST['fbComments_containerCss']));
		update_option('fbComments_containerCss', $fbComments_settings['fbComments_containerCss']);
		
		$fbComments_settings['fbComments_titleCss'] = esc_html(stripslashes($_POST['fbComments_titleCss']));
		update_option('fbComments_titleCss', $fbComments_settings['fbComments_titleCss']);
		
		$fbComments_settings['fbComments_externalCss'] = esc_html(stripslashes($_POST['fbComments_externalCss']));
		update_option('fbComments_externalCss', $fbComments_settings['fbComments_externalCss']);
		
		$fbComments_settings['fbComments_noBox'] = ($_POST['fbComments_noBox'] == 'true') ? true : false;
		update_option('fbComments_noBox', $fbComments_settings['fbComments_noBox']);
		
		echo '<div class="updated"><p><strong>' . __('Options saved.') . '</strong></p></div>';
	} else {
		// Retrieve the settings array
		global $fbComments_settings;
	}
?>

<link rel="stylesheet" type="text/css" href="<?php echo FBCOMMENTS_PATH; ?>facebook-comments.css" />

<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('Facebook Comments for WordPress Options'); ?></h2>
	
	<?php
		if (empty($fbComments_settings['fbComments_appId'])) {
			echo '<div class="error"><p><strong>' . __('The Facebook comments box will not be included in your posts until you set a valid application ID.') . '</strong></p></div>';
		} else if ($_POST['fbComments_update'] != 'true') {
			echo '<br class="gutter" />';
		}
	?>
	
	<form method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	
		<div id="poststuff" class="postbox">
			<h3><?php _e('Application Settings'); ?></h3>
			
			<div class="inside">
				<p><?php _e('Application ID (<a href="http://grahamswan.com/facebook-comments">Help</a>): '); ?><input type="text" name="fbComments_appId" value="<?php echo $fbComments_settings['fbComments_appId']; ?>" size="20"><em><?php _e(' (This can be retrieved from your <a href="http://www.facebook.com/developers/apps.php">Facebook application page</a>)'); ?></em></p>
    			<p><?php _e('Comments XID: '); ?><input type="text" name="fbComments_xid" value="<?php echo $fbComments_settings['fbComments_xid']; ?>" size="20"><em><?php _e(" (Only change this if you know what you're doing. Must be a unique string. <a href='#xid'>Learn more</a>)"); ?></em></p>
    			<p><input type="checkbox" id="fbComments_includeFbComments" name="fbComments_includeFbComments" value="true" <?php if ($fbComments_settings['fbComments_includeFbComments']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_includeFbComments"><?php _e(' Include Facebook Comments in posts'); ?></label><em><?php _e(" (Uncheck this if you want to hide the Facebook comments without having to deactivate the plugin)"); ?></em></p>
    			<p><input type="checkbox" id="fbComments_hideWpComments" name="fbComments_hideWpComments" value="true" <?php if ($fbComments_settings['fbComments_hideWpComments']) echo 'checked="checked"'; ?> size="20" disabled="disabled"><label for="fbComments_hideWpComments"> <?php _e('Only allow Facebook commenting'); ?></label><em><?php _e(" (Checking this will hide the default WordPress comments section on posts when Facebook comments are enabled; <strong>in development</strong>)"); ?></em></p>
    			<p><input type="checkbox" id="fbComments_includeFbJs" name="fbComments_includeFbJs" value="true" <?php if ($fbComments_settings['fbComments_includeFbJs']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_includeFbJs"><?php _e(' Include Facebook JavaScript SDK'); ?></label><em><?php _e(" (This should be checked unless you've manually included the SDK elsewhere)"); ?></em></p>
			</div>
		</div>
		
		<div id="poststuff" class="postbox">
			<h3><?php _e('Notification Settings'); ?></h3>
			
			<div class="inside">
				<p><?php _e('Notification UID: '); ?><input type="text" name="fbComments_notifyId" value="<?php echo $fbComments_settings['fbComments_notifyId']; ?>" size="20"><em><?php _e(' (Set this to your Facebook UID if you want notifications to show up whenever a comment is posted)'); ?></em></p>
			</div>
		</div>
		
		<div id="poststuff" class="postbox">
			<h3><?php _e('Comments Box Settings'); ?></h3>
			
			<div class="inside">
				<p><?php _e('Facebook Comments Section Title: '); ?><input type="text" name="fbComments_title" value="<?php echo $fbComments_settings['fbComments_title']; ?>" size="30"><em><?php _e(' (This is the title text displayed above the Facebook commenting section)'); ?></em></p>
				<p><input type="checkbox" id="fbComments_displayTitle" name="fbComments_displayTitle" value="true" <?php if ($fbComments_settings['fbComments_displayTitle']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_displayTitle"><?php _e(' Display the Facebook Comments title (set above)'); ?></label></p>
				<p><?php _e('Number of Posts to Display: '); ?><input type="text" name="fbComments_numPosts" value="<?php echo $fbComments_settings['fbComments_numPosts']; ?>" size="5" maxlength="3"></p>
				<p><?php _e('Width of Comments Box (px): '); ?><input type="text" name="fbComments_width" value="<?php echo $fbComments_settings['fbComments_width']; ?>" size="5" maxlength="4"></p>
				<p><?php _e('Display Facebook comments before or after WordPress comments? '); ?>
					<select name="fbComments_displayLocation" disabled="disabled">
						<option value="before"<?php if ($fbComments_settings['fbComments_displayLocation'] == 'before') echo ' selected="selected"'; ?>>Before</option>
						<option value="after"<?php if ($fbComments_settings['fbComments_displayLocation'] == 'after') echo ' selected="selected"'; ?>>After</option>
					</select>
					<em><?php _e(" (<strong>In development; see below for manual instructions</strong>)"); ?></em>
				</p>
				<p><input type="checkbox" id="fbComments_publishToWall" name="fbComments_publishToWall" value="true" <?php if ($fbComments_settings['fbComments_publishToWall']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_publishToWall"><?php _e(' Check the <strong>Post comment to my Facebook profile</strong> by default'); ?></label></p>
				<p><input type="checkbox" id="fbComments_reverseOrder" name="fbComments_reverseOrder" value="true" <?php if ($fbComments_settings['fbComments_reverseOrder']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_reverseOrder"><?php _e(' Reverse the order of the Facebook comments section'); ?></label><em><?php _e('  (Comments will appear in chronological order and the composer will be at the bottom)'); ?></em></p>
			</div>
		</div>
		
		<div id="poststuff" class="postbox">
			<h3><?php _e('Style Settings'); ?></h3>
			
			<div class="inside">
				<p><?php _e('Container Styles: '); ?><input type="text" name="fbComments_containerCss" value="<?php echo $fbComments_settings['fbComments_containerCss']; ?>" size="70"><em><?php _e(' (These styles will be applied to a &lt;div&gt; element wrapping the comments box)'); ?></em></p>
				<p><?php _e('Title Styles: '); ?><input type="text" name="fbComments_titleCss" value="<?php echo $fbComments_settings['fbComments_titleCss']; ?>" size="70"><em><?php _e(' (These styles will be applied to the title text above the comments box)'); ?></em></p>
				<p><?php _e('URL to External Stylesheet: '); ?><input type="text" name="fbComments_externalCss" value="<?php echo $fbComments_settings['fbComments_externalCss']; ?>" size="70"><em><?php _e(" (This stylesheet will overwrite the default Facebook styles. Follow <a href='http://www.somethingtoputhere.com/commentdemo/comments.css?1274511030'>this example</a>. Leave blank for defaults)"); ?></em></p>
				<p><input type="checkbox" id="fbComments_noBox" name="fbComments_noBox" value="true" <?php if ($fbComments_settings['fbComments_noBox']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_noBox"><?php _e(' Remove grey box surrounding Facebook comments'); ?></label></p>
			</div>
		</div>
		
		<input type="hidden" name="fbComments_update" value="true" />
		
		<input type="submit" class="button-primary" value="<?php _e('Update Options'); ?>" />
		
	</form>
	
	<div id="poststuff" class="postbox gutter">
		<h3><?php _e('Donate'); ?></h3>
			
		<div class="inside contain-floats">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
				<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="float: left;">
				<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			
			<p class="donate"><?php _e('Please consider making a contribution towards future development of this plugin.'); ?></p>
		</div>
	</div>
	
	<div id="icon-help"></div>
	<h2><?php _e('Important Information'); ?></h2>
    <a name="xid"></a><h3><?php _e("What's an XID and how does it work?"); ?></h3>
    <?php _e('<p>Every set of Facebook comments requires a unique <strong>XID</strong> so Facebook can keep track of which comments belong to which pages.
 plugin takes your <strong>XID</strong> (which was randomly generated when you activated the plugin) and appends <code>_post&lt;postId&gt;</code> to
thereby ensuring a unique <strong>XID</strong> for each post.</p>
strong>XIDs</strong> are maintained when you upgrade this plugin. A new one will only be generated if the <code>fbComments_xid</code> option in the <code>wp_options</code> table is empty.</p>
ote that if you change a post ID manually, your Facebook comments will no longer show up for that particular post because that also causes your <strong>XID</strong> to change.</p>'); ?>

    <h3><?php _e('How do I obtain a Facebook application ID?'); ?></h3>
    <?php _e("<p>Please follow <a href='http://grahamswan.com/facebook-comments'>this step-by-step procedure</a> on how to get one, complete with screenshots. All that's required is a Facebook account.</p>"); ?>
    
    <h3><?php _e('How do I manually include Facebook comments in my theme?'); ?></h3>
    <?php _e("<p>Simply add the following code where you'd like the comments to show up in your theme: <code>&lt;?php if (function_exists('facebook_comments')) facebook_comments(); ?&gt;</code></p>
    <p>Note that you'll still need a valid <strong>Facebook application ID</strong> and a unique <strong>XID</strong> for the comments to show up. Also, since the post ID is appended
he <strong>XID</strong>, the comments will still be unique for each page (so you can't use them as a shoutbox in your sidebar or something).</p>"); ?>
    
    <h3><?php _e('How do I get the Facebook comments to show up on a dark background?'); ?></h3>
    <?php _e('<p>Create a new CSS file on your webserver with the following contents:</p>'); ?>
    <code>
    	.wallkit_frame {<br />
		&nbsp;&nbsp;background-color: #000;<br />
		}<br />
		.wallkit_post {<br />
		&nbsp;&nbsp;color: #fff;<br />
		}<br />
		.wallkit_form {<br />
		&nbsp;&nbsp;color: #fff;<br />
		}
    </code>
    <?php _e("<p>You may change the colors to whatever is required. Once the stylesheet has been created, simply point to it in the <strong>URL to External Stylesheet</strong> text field on the plugin's options page."); ?>
    
    <h3><?php _e('How do I get the Facebook comments to show up <em>after</em> the WordPress comments?'); ?></h3>
    <?php _e("<ol>
    	<li>From your WordPress Dashboard, go to <strong>Appearance -> Editor</strong></li>
    	<li>Select the <strong>Single Post (single.php)</strong> template from the list on the right-hand side</li>
    	<li>Insert the following code somewhere between <code>&lt;?php comments_template(); ?&gt;</code> and <code>&lt;?php endwhile; else: ?&gt;</code>: <code>&lt;?php if (function_exists('facebook_comments')) facebook_comments(); ?&gt;</code></li>
    </ol>
    
    <p><strong>Example:</strong></p>"); ?>
    <code>
    	...<br />
    	&lt;div id="commentsContainer"&gt;<br />
    	&nbsp;&nbsp;&lt;?php comments_template(); ?&gt;<br />
    	&lt;/div&gt;<br />
    	<strong>&lt?php if (function_exists('facebook_comments')) facebook_comments(); ?&gt;</strong><br />
    	&lt;?php endwhile; else: ?&gt;<br />
    	...
    </code>
    
    <h3><?php _e("I'm receiving a <strong>Database Down</strong> error when I try to post. How do I fix this?"); ?></h3>
    <?php _e("<p>Try disabling any other Facebook-related plugins running on your site. They often cause conflicts that disrupt the
communication between the comments and Facebook's servers.</p>"); ?>

	<h3><?php _e("Why do my comments take a few seconds to show up?"); ?></h3>
    <?php _e("<p>The Facebook comments widget has to query Facebook's servers to retrieve the appropriate comments. This can take up to 10
seconds. If they still haven't shown up after that time, refresh the page.</p>"); ?>
    
    <br /><br />
</div>
