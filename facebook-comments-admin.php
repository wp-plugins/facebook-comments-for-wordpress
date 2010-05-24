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

<div class="wrap">
	<h2><?php _e('Facebook Comments for WordPress Options'); ?></h2>
	
	<?php if (empty($fbComments_settings['fbComments_appId'])) echo '<div class="error"><p><strong>' . __('The Facebook comments box will not be included in your posts until you set a valid application ID.') . '</strong></p></div>'; ?>
	
	<form method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<h3><?php _e('Application Settings'); ?></h3>
		<p><?php _e('Application ID (<a href="http://grahamswan.com/facebook-comments">Help</a>): '); ?><input type="text" name="fbComments_appId" value="<?php echo $fbComments_settings['fbComments_appId']; ?>" size="20"><em><?php _e(' (This can be retrieved from your <a href="http://www.facebook.com/developers/apps.php">Facebook application page</a>)'); ?></em></p>
		<p><?php _e('Comments XID: '); ?><input type="text" name="fbComments_xid" value="<?php echo $fbComments_settings['fbComments_xid']; ?>" size="20"><em><?php _e(" (Only change this if you know what you're doing. Must be a unique string. <a href='#xid'>Learn more</a>)"); ?></em></p>
		<p><input type="checkbox" id="fbComments_includeFbComments" name="fbComments_includeFbComments" value="true" <?php if ($fbComments_settings['fbComments_includeFbComments']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_includeFbComments"><?php _e(' Include Facebook Comments in posts'); ?></label><em><?php _e(" (Uncheck this if you want to hide the Facebook comments without having to deactivate the plugin)"); ?></em></p>
		<p><input type="checkbox" id="fbComments_hideWpComments" name="fbComments_hideWpComments" value="true" <?php if ($fbComments_settings['fbComments_hideWpComments']) echo 'checked="checked"'; ?> size="20" disabled="disabled"><label for="fbComments_hideWpComments"> <?php _e('Only allow Facebook commenting'); ?></label><em><?php _e(" (Checking this will hide the default WordPress comments section on posts when Facebook comments are enabled; <strong>in development</strong>)"); ?></em></p>
		<p><input type="checkbox" id="fbComments_includeFbJs" name="fbComments_includeFbJs" value="true" <?php if ($fbComments_settings['fbComments_includeFbJs']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_includeFbJs"><?php _e(' Include Facebook JavaScript SDK'); ?></label><em><?php _e(" (This should be checked unless you've manually included the SDK elsewhere)"); ?></em></p>
		
		<br /><h3><?php _e('Notification Settings'); ?></h3>
		<p><?php _e('Notification UID: '); ?><input type="text" name="fbComments_notifyId" value="<?php echo $fbComments_settings['fbComments_notifyId']; ?>" size="20"><em><?php _e(' (Set this to your Facebook UID if you want notifications to show up whenever a comment is posted)'); ?></em></p>
		
		<br /><h3><?php _e('Comments Box Settings'); ?></h3>
		<p><?php _e('Facebook Comments Section Title: '); ?><input type="text" name="fbComments_title" value="<?php echo $fbComments_settings['fbComments_title']; ?>" size="30"><em><?php _e(' (This is the title text displayed above the Facebook commenting section)'); ?></em></p>
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
		
		<br /><h3><?php _e('Style Settings'); ?></h3>
		<p><?php _e('Container Styles: '); ?><input type="text" name="fbComments_containerCss" value="<?php echo $fbComments_settings['fbComments_containerCss']; ?>" size="70"><em><?php _e(' (These styles will be applied to a &lt;div&gt; element wrapping the comments box)'); ?></em></p>
		<p><?php _e('Title Styles: '); ?><input type="text" name="fbComments_titleCss" value="<?php echo $fbComments_settings['fbComments_titleCss']; ?>" size="70"><em><?php _e(' (These styles will be applied to the title text above the comments box)'); ?></em></p>
		<p><?php _e('URL to External Stylesheet: '); ?><input type="text" name="fbComments_externalCss" value="<?php echo $fbComments_settings['fbComments_externalCss']; ?>" size="70"><em><?php _e(" (This stylesheet will overwrite the default Facebook styles. Follow <a href='http://www.somethingtoputhere.com/commentdemo/comments.css?1274511030'>this example</a>. Leave blank for defaults)"); ?></em></p>
		<p><input type="checkbox" id="fbComments_noBox" name="fbComments_noBox" value="true" <?php if ($fbComments_settings['fbComments_noBox']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_noBox"><?php _e(' Remove grey box surrounding Facebook comments'); ?></label></p>
		
		<br /><h2><?php _e('Important Information'); ?></h2>
		<a name="xid"></a><h3><?php _e("What's an XID and how does it work?"); ?></h3>
		<?php _e('<p>Every set of Facebook comments requires a unique <strong>XID</strong> so Facebook can keep track of which comments belong to which pages.
This plugin takes your <strong>XID</strong> (which was randomly generated when you activated the plugin) and appends <code>_post&lt;postId&gt;</code> to
it, thereby ensuring a unique <strong>XID</strong> for each post.</p>
<p><strong>XIDs</strong> are maintained when you upgrade this plugin. A new one will only be generated if the <code>fbComments_xid</code> option in the <code>wp_options</code> table is empty.</p>
<p>Note that if you change a post ID manually, your Facebook comments will no longer show up for that particular post because that also causes your <strong>XID</strong> to change.</p>'); ?>

		<h3><?php _e('How do I obtain a Facebook application ID?'); ?></h3>
		<?php _e("<p>Please follow <a href='http://grahamswan.com/facebook-comments#install'>this step-by-step procedure</a> on how to get one, complete with screenshots. All that's required is a Facebook account.</p>"); ?>
		
		<h3><?php _e('How do I manually include Facebook comments in my theme?'); ?></h3>
		<?php _e("<p>Simply add the following code where you'd like the comments to show up in your theme: <code>&lt;?php if (function_exists('facebook_comments')) facebook_comments(); ?&gt;</code></p>
		<p>Note that you'll still need a valid <strong>Facebook application ID</strong> and a unique <strong>XID</strong> for the comments to show up. Also, since the post ID is appended
to the <strong>XID</strong>, the comments will still be unique for each page (so you can't use them as a shoutbox in your sidebar or something).</p>"); ?>
		
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
		
		<input type="hidden" name="fbComments_update" value="true" />
		
		<p class="submit">
			<input type="submit" value="<?php _e('Update Options'); ?>" />
		</p>
	</form>
</div>
