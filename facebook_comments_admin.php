<?php
	// If the user submitted the form, update the database with the new settings
	if ($_POST['fbComments_update'] == 'true') {
		$includeFbJs = ($_POST['fbComments_includeFbJs'] == 'true') ? true : false;
		update_option('fbComments_includeFbJs', $includeFbJs);
		
		//$appId = (intval($_POST['fbComments_appId']) > 0) ? intval($_POST['fbComments_appId']) : null;
		$appId = (!empty($_POST['fbComments_appId'])) ? $_POST['fbComments_appId'] : null;
		update_option('fbComments_appId', $appId);
		
		$numPosts = intval($_POST['fbComments_numPosts']);
		update_option('fbComments_numPosts', $numPosts);
		
		$width = intval($_POST['fbComments_width']);
		update_option('fbComments_width', $width);
		
		$containerCss = stripslashes($_POST['fbComments_containerCss']);
		update_option('fbComments_containerCss', $containerCss);
		
		$titleCss = stripslashes($_POST['fbComments_titleCss']);
		update_option('fbComments_titleCss', $titleCss);
		
		echo '<div class="updated"><p><strong>' . __('Options saved.') . '</strong></p></div>';
	} else { // Retrieve the settings to display in the form
		$includeFbJs = get_option('fbComments_includeFbJs');
		$appId = get_option('fbComments_appId');
		$numPosts = get_option('fbComments_numPosts');
		$width = get_option('fbComments_width');
		$containerCss = esc_html(get_option('fbComments_containerCss'));
		$titleCss = esc_html(get_option('fbComments_titleCss'));
	}
?>

<div class="wrap">
	<h2><?php _e('Facebook Comments for WordPress Options'); ?></h2>
	
	<?php if (empty($appId)) echo '<div class="error"><p><strong>' . __('The Facebook comments box will not be included in your posts until you set a valid application ID.') . '</strong></p></div>'; ?>
	
	<form method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<h4><?php _e('Application Settings'); ?></h4>
		<p><?php _e('Application ID (<a href="http://grahamswan.com/wordpress-comments">Help</a>):'); ?><input type="text" name="fbComments_appId" value="<?php echo $appId; ?>" size="20"><em><?php _e(' (This can be retrieved from your <a href="http://www.facebook.com/developers/apps.php">Facebook application page</a>)'); ?></em></p>
		<p><input type="checkbox" id="fbComments_includeFbJs" name="fbComments_includeFbJs" value="true" <?php if ($includeFbJs) echo 'checked="checked"'; ?> size="20"><label for="fbComments_includeFbJs"> Include Facebook JavaScript SDK</label><em><?php _e(" (This should be checked unless you've manually included the SDK elsewhere)"); ?></em></p>
		
		<h4><?php _e('Comments Box Settings'); ?></h4>
		<p><?php _e('Number of Posts to Display: '); ?><input type="text" name="fbComments_numPosts" value="<?php echo $numPosts; ?>" size="5" maxlength="3"></p>
		<p><?php _e('Width of Comments Box (px): '); ?><input type="text" name="fbComments_width" value="<?php echo $width; ?>" size="5" maxlength="4"></p>
		
		<h4><?php _e('Style (CSS) Settings'); ?></h4>
		<p><?php _e('Container Styles: '); ?><input type="text" name="fbComments_containerCss" value="<?php echo $containerCss; ?>" size="70"><em><?php _e(' (These styles will be applied to a &lt;div&gt; element wrapping the comments box)'); ?></em></p>
		<p><?php _e('Title Styles: '); ?><input type="text" name="fbComments_titleCss" value="<?php echo $titleCss; ?>" size="70"><em><?php _e(' (These styles will be applied to the "Facebook comments:" text above the comments box)'); ?></em></p>
		
		<input type="hidden" name="fbComments_update" value="true" />
		
		<p class="submit">
			<input type="submit" value="<?php _e('Update Options'); ?>" />
		</p>
	</form>
</div>
