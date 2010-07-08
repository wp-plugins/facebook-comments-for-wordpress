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
		
		$fbComments_settings['fbComments_hideWpComments'] = ($_POST['fbComments_hideWpComments'] == 'true') ? true : false;
		update_option('fbComments_hideWpComments', $fbComments_settings['fbComments_hideWpComments']);
		
		$fbComments_settings['fbComments_includeFbJs'] = ($_POST['fbComments_includeFbJs'] == 'true') ? true : false;
		update_option('fbComments_includeFbJs', $fbComments_settings['fbComments_includeFbJs']);
		
		$fbComments_settings['fbComments_includeFbmlLangAttr'] = ($_POST['fbComments_includeFbmlLangAttr'] == 'true') ? true : false;
		update_option('fbComments_includeFbmlLangAttr', $fbComments_settings['fbComments_includeFbmlLangAttr']);
		
		$fbComments_settings['fbComments_includeOpenGraphLangAttr'] = ($_POST['fbComments_includeOpenGraphLangAttr'] == 'true') ? true : false;
		update_option('fbComments_includeOpenGraphLangAttr', $fbComments_settings['fbComments_includeOpenGraphLangAttr']);
		
		$fbComments_settings['fbComments_includeOpenGraphMeta'] = ($_POST['fbComments_includeOpenGraphMeta'] == 'true') ? true : false;
		update_option('fbComments_includeOpenGraphMeta', $fbComments_settings['fbComments_includeOpenGraphMeta']);
		
		$fbComments_settings['fbComments_notifyId'] = esc_html(stripslashes($_POST['fbComments_notifyId']));
		update_option('fbComments_notifyId', $fbComments_settings['fbComments_notifyId']);
		
		$fbComments_settings['fbComments_language'] = $_POST['fbComments_language'];
		update_option('fbComments_language', $fbComments_settings['fbComments_language']);
		
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
		
		$fbComments_settings['fbComments_displayPagesOrPosts'] = $_POST['fbComments_displayPagesOrPosts'];
		update_option('fbComments_displayPagesOrPosts', $fbComments_settings['fbComments_displayPagesOrPosts']);
		
		$fbComments_settings['fbComments_publishToWall'] = ($_POST['fbComments_publishToWall'] == 'true') ? true : false;
		update_option('fbComments_publishToWall', $fbComments_settings['fbComments_publishToWall']);
		
		$fbComments_settings['fbComments_reverseOrder'] = ($_POST['fbComments_reverseOrder'] == 'true') ? true : false;
		update_option('fbComments_reverseOrder', $fbComments_settings['fbComments_reverseOrder']);
		
		$fbComments_settings['fbComments_hideFbLikeButton'] = ($_POST['fbComments_hideFbLikeButton'] == 'true') ? true : false;
		update_option('fbComments_hideFbLikeButton', $fbComments_settings['fbComments_hideFbLikeButton']);
		
		/*$fbComments_settings['fbComments_hideFbLikeFaces'] = ($_POST['fbComments_hideFbLikeFaces'] == 'true') ? true : false;
		update_option('fbComments_hideFbLikeFaces', $fbComments_settings['fbComments_hideFbLikeFaces']);
		
		$fbComments_settings['fbComments_hideFbProfilePics'] = ($_POST['fbComments_hideFbProfilePics'] == 'true') ? true : false;
		update_option('fbComments_hideFbProfilePics', $fbComments_settings['fbComments_hideFbProfilePics']);
		
		$fbComments_settings['fbComments_hideFbLink'] = ($_POST['fbComments_hideFbLink'] == 'true') ? true : false;
		update_option('fbComments_hideFbLink', $fbComments_settings['fbComments_hideFbLink']);*/
		
		$fbComments_settings['fbComments_containerCss'] = esc_html(stripslashes($_POST['fbComments_containerCss']));
		update_option('fbComments_containerCss', $fbComments_settings['fbComments_containerCss']);
		
		$fbComments_settings['fbComments_titleCss'] = esc_html(stripslashes($_POST['fbComments_titleCss']));
		update_option('fbComments_titleCss', $fbComments_settings['fbComments_titleCss']);
		
		$fbComments_settings['fbComments_darkSite'] = ($_POST['fbComments_darkSite'] == 'true') ? true : false;
		update_option('fbComments_darkSite', $fbComments_settings['fbComments_darkSite']);
		
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
		}/* elseif ((($fbComments_settings['fbComments_hideFbLikeButton']) || ($fbComments_settings['fbComments_hideFbLikeFaces']) || ($fbComments_settings['fbComments_hideFbProfilePics']) || ($fbComments_settings['fbComments_hideFbLink']) || ($fbComments_settings['fbComments_darkSite'])) && (!is_writable(FBCOMMENTS_CUSTOMSTYLESHEET))) {
			$customStylesheet = FBCOMMENTS_CUSTOMSTYLESHEET;
			
			echo '<div class="error"><p><strong>' . __("In order to hide the Like button, faces, profile pictures or Facebook link, or to enable the theme for darker websites, the following file must be writable by WordPress:<br /><br />$customStylesheet<br /><br />Please CHMOD this file to 666 using an FTP program.") . '</strong></p></div>';
		}*/ elseif ($_POST['fbComments_update'] != 'true') {
			echo '<br class="gutter" />';
		}
	?>
	
	<form method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	
		<div id="poststuff" class="postbox">
			<h3><?php _e('Application Settings'); ?></h3>
			
			<div class="inside">
				<p><?php _e('Application ID (<a href="http://grahamswan.com/facebook-comments">Help</a>): '); ?><input type="text" name="fbComments_appId" value="<?php echo $fbComments_settings['fbComments_appId']; ?>" size="20"><em><?php _e(' (This can be retrieved from your <a href="http://www.facebook.com/developers/apps.php">Facebook application page</a>)'); ?></em></p>
    			<p><?php _e('Comments XID: '); ?><input type="text" name="fbComments_xid" value="<?php echo $fbComments_settings['fbComments_xid']; ?>" size="20"><em><?php _e(" (Only change this if you know what you're doing. Must be a unique string. <a href='#fbComments_xid'>Learn more</a>)"); ?></em></p>
    			<p><input type="checkbox" id="fbComments_includeFbComments" name="fbComments_includeFbComments" value="true" <?php if ($fbComments_settings['fbComments_includeFbComments']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_includeFbComments"><?php _e(' Include Facebook comments on blog'); ?></label><em><?php _e(" (Uncheck this if you want to hide the Facebook comments without having to deactivate the plugin)"); ?></em></p>
    			<p><input type="checkbox" id="fbComments_hideWpComments" name="fbComments_hideWpComments" value="true" <?php if ($fbComments_settings['fbComments_hideWpComments']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_hideWpComments"> <?php _e('Only allow Facebook commenting'); ?></label><em><?php _e(" (Checking this will hide the default WordPress comments section on pages/posts when Facebook comments are enabled)"); ?></em></p>
    			<p><input type="checkbox" id="fbComments_includeFbJs" name="fbComments_includeFbJs" value="true" <?php if ($fbComments_settings['fbComments_includeFbJs']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_includeFbJs"><?php _e(' Include Facebook JavaScript SDK'); ?></label><em><?php _e(" (This should be checked unless you've manually included the SDK elsewhere)"); ?></em></p>
    			<p><input type="checkbox" id="fbComments_includeFbmlLangAttr" name="fbComments_includeFbmlLangAttr" value="true" <?php if ($fbComments_settings['fbComments_includeFbmlLangAttr']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_includeFbmlLangAttr"><?php _e(' Include Facebook FBML reference'); ?></label><em><?php _e(" (This should be checked unless you have another plugin enabled that includes the FBML reference)"); ?></em></p>
    			<p><input type="checkbox" id="fbComments_includeOpenGraphLangAttr" name="fbComments_includeOpenGraphLangAttr" value="true" <?php if ($fbComments_settings['fbComments_includeOpenGraphLangAttr']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_includeOpenGraphLangAttr"><?php _e(' Include OpenGraph reference'); ?></label><em><?php _e(" (This should be checked unless you have another plugin enabled that includes the OpenGraph reference)"); ?></em></p>
    			<p><input type="checkbox" id="fbComments_includeOpenGraphMeta" name="fbComments_includeOpenGraphMeta" value="true" <?php if ($fbComments_settings['fbComments_includeOpenGraphMeta']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_includeOpenGraphMeta"><?php _e(' Include OpenGraph meta information'); ?></label><em><?php _e(" (This will add the following meta information to the page &lt;head&gt; to assist with Like button clicks: post/page title, site name, current URL and content type)"); ?></em></p>
			</div>
		</div>
		
		<div id="poststuff" class="postbox">
			<h3><?php _e('Notification Settings'); ?></h3>
			
			<div class="inside">
				<p><?php _e('Notification UID: '); ?><input type="text" name="fbComments_notifyId" value="<?php echo $fbComments_settings['fbComments_notifyId']; ?>" size="20"><em><?php _e(' (Set this to your Facebook UID if you want notifications to show up whenever a comment is posted)'); ?></em></p>
			</div>
		</div>
		
		<div id="poststuff" class="postbox">
			<h3><?php _e('Language Settings'); ?></h3>
			
			<div class="inside">
				<p><?php _e('Language for comments: '); ?>
					<select name="fbComments_language">
						<option value="af_ZA"<?php if ($fbComments_settings['fbComments_language'] == 'af_ZA') echo ' selected="selected"'; ?>>Afrikaans</option>
						<option value="sq_AL"<?php if ($fbComments_settings['fbComments_language'] == 'sq_AL') echo ' selected="selected"'; ?>>Albanian</option>
						<option value="ar_AR"<?php if ($fbComments_settings['fbComments_language'] == 'ar_AR') echo ' selected="selected"'; ?>>Arabic</option>
						<option value="hy_AM"<?php if ($fbComments_settings['fbComments_language'] == 'hy_AM') echo ' selected="selected"'; ?>>Armenian</option>
						<option value="ay_BO"<?php if ($fbComments_settings['fbComments_language'] == 'ay_BO') echo ' selected="selected"'; ?>>Aymara</option>
						<option value="az_AZ"<?php if ($fbComments_settings['fbComments_language'] == 'az_AZ') echo ' selected="selected"'; ?>>Azeri</option>
						<option value="eu_ES"<?php if ($fbComments_settings['fbComments_language'] == 'eu_ES') echo ' selected="selected"'; ?>>Basque</option>
						<option value="be_BY"<?php if ($fbComments_settings['fbComments_language'] == 'be_BY') echo ' selected="selected"'; ?>>Belarusian</option>
						<option value="bn_IN"<?php if ($fbComments_settings['fbComments_language'] == 'bn_IN') echo ' selected="selected"'; ?>>Bengali</option>
						<option value="bs_BA"<?php if ($fbComments_settings['fbComments_language'] == 'bs_BA') echo ' selected="selected"'; ?>>Bosnian</option>
						<option value="bg_BG"<?php if ($fbComments_settings['fbComments_language'] == 'bg_BG') echo ' selected="selected"'; ?>>Bulgarian</option>
						<option value="ca_ES"<?php if ($fbComments_settings['fbComments_language'] == 'ca_ES') echo ' selected="selected"'; ?>>Catalan</option>
						<option value="ck_US"<?php if ($fbComments_settings['fbComments_language'] == 'ck_US') echo ' selected="selected"'; ?>>Cherokee</option>
						<option value="hr_HR"<?php if ($fbComments_settings['fbComments_language'] == 'hr_HR') echo ' selected="selected"'; ?>>Croatian</option>
						<option value="cs_CZ"<?php if ($fbComments_settings['fbComments_language'] == 'cs_CZ') echo ' selected="selected"'; ?>>Czech</option>
						<option value="da_DK"<?php if ($fbComments_settings['fbComments_language'] == 'da_DK') echo ' selected="selected"'; ?>>Danish</option>
						<option value="nl_BE"<?php if ($fbComments_settings['fbComments_language'] == 'nl_BE') echo ' selected="selected"'; ?>>Dutch (Belgi&euml;)</option>
						<option value="nl_NL"<?php if ($fbComments_settings['fbComments_language'] == 'nl_NL') echo ' selected="selected"'; ?>>Dutch</option>
						<option value="en_PI"<?php if ($fbComments_settings['fbComments_language'] == 'en_PI') echo ' selected="selected"'; ?>>English (Pirate)</option>
						<option value="en_GB"<?php if ($fbComments_settings['fbComments_language'] == 'en_GB') echo ' selected="selected"'; ?>>English (UK)</option>
						<option value="en_US"<?php if ($fbComments_settings['fbComments_language'] == 'en_US') echo ' selected="selected"'; ?>>English (US)</option>
						<option value="en_UD"<?php if ($fbComments_settings['fbComments_language'] == 'en_UD') echo ' selected="selected"'; ?>>English (Upside Down)</option>
						<option value="eo_EO"<?php if ($fbComments_settings['fbComments_language'] == 'eo_EO') echo ' selected="selected"'; ?>>Esperanto</option>
						<option value="et_EE"<?php if ($fbComments_settings['fbComments_language'] == 'et_EE') echo ' selected="selected"'; ?>>Estonian</option>
						<option value="fo_FO"<?php if ($fbComments_settings['fbComments_language'] == 'fo_FO') echo ' selected="selected"'; ?>>Faroese</option>
						<option value="tl_PH"<?php if ($fbComments_settings['fbComments_language'] == 'tl_PH') echo ' selected="selected"'; ?>>Filipino</option>
						<option value="fb_FI"<?php if ($fbComments_settings['fbComments_language'] == 'fb_FI') echo ' selected="selected"'; ?>>Finnish (test)</option>
						<option value="fi_FI"<?php if ($fbComments_settings['fbComments_language'] == 'fi_FI') echo ' selected="selected"'; ?>>Finnish</option>
						<option value="fr_CA"<?php if ($fbComments_settings['fbComments_language'] == 'fr_CA') echo ' selected="selected"'; ?>>French (Canada)</option>
						<option value="fr_FR"<?php if ($fbComments_settings['fbComments_language'] == 'fr_FR') echo ' selected="selected"'; ?>>French (France)</option>
						<option value="gl_ES"<?php if ($fbComments_settings['fbComments_language'] == 'gl_ES') echo ' selected="selected"'; ?>>Galician</option>
						<option value="ka_GE"<?php if ($fbComments_settings['fbComments_language'] == 'ka_GE') echo ' selected="selected"'; ?>>Georgian</option>
						<option value="de_DE"<?php if ($fbComments_settings['fbComments_language'] == 'de_DE') echo ' selected="selected"'; ?>>German</option>
						<option value="el_GR"<?php if ($fbComments_settings['fbComments_language'] == 'el_GR') echo ' selected="selected"'; ?>>Greek</option>
						<option value="gn_PY"<?php if ($fbComments_settings['fbComments_language'] == 'gn_PY') echo ' selected="selected"'; ?>>Guaran&iacute;</option>
						<option value="gu_IN"<?php if ($fbComments_settings['fbComments_language'] == 'gu_IN') echo ' selected="selected"'; ?>>Gujarati</option>
						<option value="he_IL"<?php if ($fbComments_settings['fbComments_language'] == 'he_IL') echo ' selected="selected"'; ?>>Hebrew</option>
						<option value="hi_IN"<?php if ($fbComments_settings['fbComments_language'] == 'hi_IN') echo ' selected="selected"'; ?>>Hindi</option>
						<option value="hu_HU"<?php if ($fbComments_settings['fbComments_language'] == 'hu_HU') echo ' selected="selected"'; ?>>Hungarian</option>
						<option value="is_IS"<?php if ($fbComments_settings['fbComments_language'] == 'is_IS') echo ' selected="selected"'; ?>>Icelandic</option>
						<option value="id_ID"<?php if ($fbComments_settings['fbComments_language'] == 'id_ID') echo ' selected="selected"'; ?>>Indonesian</option>
						<option value="ga_IE"<?php if ($fbComments_settings['fbComments_language'] == 'ga_IE') echo ' selected="selected"'; ?>>Irish</option>
						<option value="it_IT"<?php if ($fbComments_settings['fbComments_language'] == 'it_IT') echo ' selected="selected"'; ?>>Italian</option>
						<option value="ja_JP"<?php if ($fbComments_settings['fbComments_language'] == 'ja_JP') echo ' selected="selected"'; ?>>Japanese</option>
						<option value="jv_ID"<?php if ($fbComments_settings['fbComments_language'] == 'jv_ID') echo ' selected="selected"'; ?>>Javanese</option>
						<option value="kn_IN"<?php if ($fbComments_settings['fbComments_language'] == 'kn_IN') echo ' selected="selected"'; ?>>Kannada</option>
						<option value="kk_KZ"<?php if ($fbComments_settings['fbComments_language'] == 'kk_KZ') echo ' selected="selected"'; ?>>Kazakh</option>
						<option value="km_KH"<?php if ($fbComments_settings['fbComments_language'] == 'km_KH') echo ' selected="selected"'; ?>>Khmer</option>
						<option value="tl_ST"<?php if ($fbComments_settings['fbComments_language'] == 'tl_ST') echo ' selected="selected"'; ?>>Klingon</option>
						<option value="ko_KR"<?php if ($fbComments_settings['fbComments_language'] == 'ko_KR') echo ' selected="selected"'; ?>>Korean</option>
						<option value="ku_TR"<?php if ($fbComments_settings['fbComments_language'] == 'ku_TR') echo ' selected="selected"'; ?>>Kurdish</option>
						<option value="la_VA"<?php if ($fbComments_settings['fbComments_language'] == 'la_VA') echo ' selected="selected"'; ?>>Latin</option>
						<option value="lv_LV"<?php if ($fbComments_settings['fbComments_language'] == 'lv_LV') echo ' selected="selected"'; ?>>Latvian</option>
						<option value="fb_LT"<?php if ($fbComments_settings['fbComments_language'] == 'fb_LT') echo ' selected="selected"'; ?>>Leet Speak</option>
						<option value="li_NL"<?php if ($fbComments_settings['fbComments_language'] == 'li_NL') echo ' selected="selected"'; ?>>Limburgish</option>
						<option value="lt_LT"<?php if ($fbComments_settings['fbComments_language'] == 'lt_LT') echo ' selected="selected"'; ?>>Lithuanian</option>
						<option value="mk_MK"<?php if ($fbComments_settings['fbComments_language'] == 'mk_MK') echo ' selected="selected"'; ?>>Macedonian</option>
						<option value="mg_MG"<?php if ($fbComments_settings['fbComments_language'] == 'mg_MG') echo ' selected="selected"'; ?>>Malagasy</option>
						<option value="ms_MY"<?php if ($fbComments_settings['fbComments_language'] == 'ms_MY') echo ' selected="selected"'; ?>>Malay</option>
						<option value="ml_IN"<?php if ($fbComments_settings['fbComments_language'] == 'ml_IN') echo ' selected="selected"'; ?>>Malayalam</option>
						<option value="mt_MT"<?php if ($fbComments_settings['fbComments_language'] == 'mt_MT') echo ' selected="selected"'; ?>>Maltese</option>
						<option value="mr_IN"<?php if ($fbComments_settings['fbComments_language'] == 'mr_IN') echo ' selected="selected"'; ?>>Marathi</option>
						<option value="mn_MN"<?php if ($fbComments_settings['fbComments_language'] == 'mn_MN') echo ' selected="selected"'; ?>>Mongolian</option>
						<option value="ne_NP"<?php if ($fbComments_settings['fbComments_language'] == 'ne_NP') echo ' selected="selected"'; ?>>Nepali</option>
						<option value="se_NO"<?php if ($fbComments_settings['fbComments_language'] == 'se_NO') echo ' selected="selected"'; ?>>Northern S&aacute;mi</option>
						<option value="nb_NO"<?php if ($fbComments_settings['fbComments_language'] == 'nb_NO') echo ' selected="selected"'; ?>>Norwegian (bokmal)</option>
						<option value="nn_NO"<?php if ($fbComments_settings['fbComments_language'] == 'nn_NO') echo ' selected="selected"'; ?>>Norwegian (nynorsk)</option>
						<option value="ps_AF"<?php if ($fbComments_settings['fbComments_language'] == 'ps_AF') echo ' selected="selected"'; ?>>Pashto</option>
						<option value="fa_IR"<?php if ($fbComments_settings['fbComments_language'] == 'fa_IR') echo ' selected="selected"'; ?>>Persian</option>
						<option value="pl_PL"<?php if ($fbComments_settings['fbComments_language'] == 'pl_PL') echo ' selected="selected"'; ?>>Polish</option>
						<option value="pt_BR"<?php if ($fbComments_settings['fbComments_language'] == 'pt_BR') echo ' selected="selected"'; ?>>Portuguese (Brazil)</option>
						<option value="pt_PT"<?php if ($fbComments_settings['fbComments_language'] == 'pt_PT') echo ' selected="selected"'; ?>>Portuguese (Portugal)</option>
						<option value="pa_IN"<?php if ($fbComments_settings['fbComments_language'] == 'pa_IN') echo ' selected="selected"'; ?>>Punjabi</option>
						<option value="qu_PE"<?php if ($fbComments_settings['fbComments_language'] == 'qu_PE') echo ' selected="selected"'; ?>>Quechua</option>
						<option value="ro_RO"<?php if ($fbComments_settings['fbComments_language'] == 'ro_RO') echo ' selected="selected"'; ?>>Romanian</option>
						<option value="rm_CH"<?php if ($fbComments_settings['fbComments_language'] == 'rm_CH') echo ' selected="selected"'; ?>>Romansh</option>
						<option value="ru_RU"<?php if ($fbComments_settings['fbComments_language'] == 'ru_RU') echo ' selected="selected"'; ?>>Russian</option>
						<option value="sa_IN"<?php if ($fbComments_settings['fbComments_language'] == 'sa_IN') echo ' selected="selected"'; ?>>Sanskrit</option>
						<option value="sr_RS"<?php if ($fbComments_settings['fbComments_language'] == 'sr_RS') echo ' selected="selected"'; ?>>Serbian</option>
						<option value="zh_CN"<?php if ($fbComments_settings['fbComments_language'] == 'zh_CN') echo ' selected="selected"'; ?>>Simplified Chinese (China)</option>
						<option value="sk_SK"<?php if ($fbComments_settings['fbComments_language'] == 'sk_SK') echo ' selected="selected"'; ?>>Slovak</option>
						<option value="sl_SI"<?php if ($fbComments_settings['fbComments_language'] == 'sl_SI') echo ' selected="selected"'; ?>>Slovenian</option>
						<option value="so_SO"<?php if ($fbComments_settings['fbComments_language'] == 'so_SO') echo ' selected="selected"'; ?>>Somali</option>
						<option value="es_CL"<?php if ($fbComments_settings['fbComments_language'] == 'es_CL') echo ' selected="selected"'; ?>>Spanish (Chile)</option>
						<option value="es_CO"<?php if ($fbComments_settings['fbComments_language'] == 'es_CO') echo ' selected="selected"'; ?>>Spanish (Colombia)</option>
						<option value="es_MX"<?php if ($fbComments_settings['fbComments_language'] == 'es_MX') echo ' selected="selected"'; ?>>Spanish (Mexico)</option>
						<option value="es_ES"<?php if ($fbComments_settings['fbComments_language'] == 'es_ES') echo ' selected="selected"'; ?>>Spanish (Spain)</option>
						<option value="es_VE"<?php if ($fbComments_settings['fbComments_language'] == 'es_VE') echo ' selected="selected"'; ?>>Spanish (Venezuela)</option>
						<option value="es_LA"<?php if ($fbComments_settings['fbComments_language'] == 'es_LA') echo ' selected="selected"'; ?>>Spanish</option>
						<option value="sw_KE"<?php if ($fbComments_settings['fbComments_language'] == 'sw_KE') echo ' selected="selected"'; ?>>Swahili</option>
						<option value="sv_SE"<?php if ($fbComments_settings['fbComments_language'] == 'sv_SE') echo ' selected="selected"'; ?>>Swedish</option>
						<option value="sy_SY"<?php if ($fbComments_settings['fbComments_language'] == 'sy_SY') echo ' selected="selected"'; ?>>Syriac</option>
						<option value="tg_TJ"<?php if ($fbComments_settings['fbComments_language'] == 'tg_TJ') echo ' selected="selected"'; ?>>Tajik</option>
						<option value="ta_IN"<?php if ($fbComments_settings['fbComments_language'] == 'ta_IN') echo ' selected="selected"'; ?>>Tamil</option>
						<option value="tt_RU"<?php if ($fbComments_settings['fbComments_language'] == 'tt_RU') echo ' selected="selected"'; ?>>Tatar</option>
						<option value="te_IN"<?php if ($fbComments_settings['fbComments_language'] == 'te_IN') echo ' selected="selected"'; ?>>Telugu</option>
						<option value="th_TH"<?php if ($fbComments_settings['fbComments_language'] == 'th_TH') echo ' selected="selected"'; ?>>Thai</option>
						<option value="zh_HK"<?php if ($fbComments_settings['fbComments_language'] == 'zh_HK') echo ' selected="selected"'; ?>>Traditional Chinese (Hong Kong)</option>
						<option value="zh_TW"<?php if ($fbComments_settings['fbComments_language'] == 'zh_TW') echo ' selected="selected"'; ?>>Traditional Chinese (Taiwan)</option>
						<option value="tr_TR"<?php if ($fbComments_settings['fbComments_language'] == 'tr_TR') echo ' selected="selected"'; ?>>Turkish</option>
						<option value="uk_UA"<?php if ($fbComments_settings['fbComments_language'] == 'uk_UA') echo ' selected="selected"'; ?>>Ukrainian</option>
						<option value="ur_PK"<?php if ($fbComments_settings['fbComments_language'] == 'ur_PK') echo ' selected="selected"'; ?>>Urdu</option>
						<option value="uz_UZ"<?php if ($fbComments_settings['fbComments_language'] == 'uz_UZ') echo ' selected="selected"'; ?>>Uzbek</option>
						<option value="vi_VN"<?php if ($fbComments_settings['fbComments_language'] == 'vi_VN') echo ' selected="selected"'; ?>>Vietnamese</option>
						<option value="cy_GB"<?php if ($fbComments_settings['fbComments_language'] == 'cy_GB') echo ' selected="selected"'; ?>>Welsh</option>
						<option value="xh_ZA"<?php if ($fbComments_settings['fbComments_language'] == 'xh_ZA') echo ' selected="selected"'; ?>>Xhosa</option>
						<option value="yi_DE"<?php if ($fbComments_settings['fbComments_language'] == 'yi_DE') echo ' selected="selected"'; ?>>Yiddish</option>
						<option value="zu_ZA"<?php if ($fbComments_settings['fbComments_language'] == 'zu_ZA') echo ' selected="selected"'; ?>>Zulu</option>
					</select>
				</p>
			</div>
		</div>
		
		<div id="poststuff" class="postbox">
			<h3><?php _e('Comments Box Settings'); ?></h3>
			
			<div class="inside">
				<p><?php _e('Facebook Comments Section Title: '); ?><input type="text" name="fbComments_title" value="<?php echo $fbComments_settings['fbComments_title']; ?>" size="30"><em><?php _e(' (This is the title text displayed above the Facebook commenting section)'); ?></em></p>
				<p><input type="checkbox" id="fbComments_displayTitle" name="fbComments_displayTitle" value="true" <?php if ($fbComments_settings['fbComments_displayTitle']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_displayTitle"><?php _e(' Display the Facebook comments title (set above)'); ?></label></p>
				<p><?php _e('Number of Posts to Display: '); ?><input type="text" name="fbComments_numPosts" value="<?php echo $fbComments_settings['fbComments_numPosts']; ?>" size="5" maxlength="3"></p>
				<p><?php _e('Width of Comments Box (px): '); ?><input type="text" name="fbComments_width" value="<?php echo $fbComments_settings['fbComments_width']; ?>" size="5" maxlength="4"></p>
				<p><?php _e('Display Facebook comments before or after WordPress comments? '); ?>
					<select name="fbComments_displayLocation" disabled="disabled">
						<option value="before"<?php if ($fbComments_settings['fbComments_displayLocation'] == 'before') echo ' selected="selected"'; ?>>Before</option>
						<option value="after"<?php if ($fbComments_settings['fbComments_displayLocation'] == 'after') echo ' selected="selected"'; ?>>After</option>
					</select>
					<em><?php _e(" (<strong>In development; <a href='#fbComments_commentPlacement'>see here</a> for manual instructions</strong>)"); ?></em>
				</p>
				<p><?php _e('Display Facebook comments on pages only, posts only or both? '); ?>
					<select name="fbComments_displayPagesOrPosts">
						<option value="both"<?php if ($fbComments_settings['fbComments_displayPagesOrPosts'] == 'both') echo ' selected="selected"'; ?>>Both</option>
						<option value="pages"<?php if ($fbComments_settings['fbComments_displayPagesOrPosts'] == 'pages') echo ' selected="selected"'; ?>>Pages only</option>
						<option value="posts"<?php if ($fbComments_settings['fbComments_displayPagesOrPosts'] == 'posts') echo ' selected="selected"'; ?>>Posts only</option>
					</select>
				</p>
				<p><input type="checkbox" id="fbComments_publishToWall" name="fbComments_publishToWall" value="true" <?php if ($fbComments_settings['fbComments_publishToWall']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_publishToWall"><?php _e(' Check the <strong>Post comment to my Facebook profile</strong> by default'); ?></label></p>
				<p><input type="checkbox" id="fbComments_reverseOrder" name="fbComments_reverseOrder" value="true" <?php if ($fbComments_settings['fbComments_reverseOrder']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_reverseOrder"><?php _e(' Reverse the order of the Facebook comments section'); ?></label><em><?php _e('  (Comments will appear in chronological order and the composer will be at the bottom)'); ?></em></p>
				<p><input type="checkbox" id="fbComments_hideFbLikeButton" name="fbComments_hideFbLikeButton" value="true" <?php if ($fbComments_settings['fbComments_hideFbLikeButton']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_hideFbLikeButton"><?php _e(' Hide the Like button and text'); ?></label></p>
				<!--<p><input type="checkbox" id="fbComments_hideFbLikeFaces" name="fbComments_hideFbLikeFaces" value="true" <?php //if ($fbComments_settings['fbComments_hideFbLikeFaces']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_hideFbLikeFaces"><?php //_e(' Hide the faces of people who have clicked the Like button'); ?></label></p>
				<p><input type="checkbox" id="fbComments_hideFbProfilePics" name="fbComments_hideFbProfilePics" value="true" <?php //if ($fbComments_settings['fbComments_hideFbProfilePics']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_hideFbProfilePics"><?php //_e(' Hide the profile pictures beside each comment'); ?></label></p>
				<p><input type="checkbox" id="fbComments_hideFbLink" name="fbComments_hideFbLink" value="true" <?php //if ($fbComments_settings['fbComments_hideFbLink']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_hideFbLink"><?php //_e(' Hide the <strong>Facebook social plugin</strong> link and icon'); ?></label></p>-->
			</div>
		</div>
		
		<div id="poststuff" class="postbox">
			<h3><?php _e('Style Settings'); ?></h3>
			
			<div class="inside">
				<p><?php _e('Container Styles: '); ?><input type="text" name="fbComments_containerCss" value="<?php echo $fbComments_settings['fbComments_containerCss']; ?>" size="70"><em><?php _e(' (These styles will be applied to a &lt;div&gt; element wrapping the comments box)'); ?></em></p>
				<p><?php _e('Title Styles: '); ?><input type="text" name="fbComments_titleCss" value="<?php echo $fbComments_settings['fbComments_titleCss']; ?>" size="70"><em><?php _e(' (These styles will be applied to the title text above the comments box)'); ?></em></p>
				<p><input type="checkbox" id="fbComments_darkSite" name="fbComments_darkSite" value="true" <?php if ($fbComments_settings['fbComments_darkSite']) echo 'checked="checked"'; ?> size="20"><label for="fbComments_darkSite"><?php _e(' Use colors more easily visible on a darker website'); ?></label><em><?php _e('  (To modify the colors used for darker sites, manually edit the <strong>facebook-comments-darksite.css</strong> stylesheet)'); ?></em></p>
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
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHbwYJKoZIhvcNAQcEoIIHYDCCB1wCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYBO2HjewNFFoq3Di8I9WC0e2pzpWj8b7Z5Ur+wa68Pt9RB74051ZmEaBN6LQ5oYd/gWkdtGD5DBLTc5ZfA61Siq005MTDczI70evAjoF2t0P0Z9xP7NCZA0yVwNtyUO2mWyDW/8EUv4RYd6friwtr5yu3Ntfmt0jAfsXwTC92RzczELMAkGBSsOAwIaBQAwgewGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQI2cquYu+yZuuAgcjKd4ZrQCfcoJqwUekkiiBf+/FSmwk4Tgo34Ghf+0aBQpMMVlbFNHE5x8HcNeciFb4b5xt0n0kd5HbXZ7u/1VfX6OcFd7pCV2yU0Tquz32AlnJN3T3Syz+mXJisGGhZ90CwibjFjOGDrnP7BHBD6vnoUxhamwL5M/SG8nw5bpnnbXIefB2woGtJ7Gxp54vix3l3L49GcuitiA/Y8bNuqJdBiLIBsi/ckYHnTPpLHaCThB5+AclRp5dPJ0ceszU4QWD1ZQJ0m3/VRqCCA4cwggODMIIC7KADAgECAgEAMA0GCSqGSIb3DQEBBQUAMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTAeFw0wNDAyMTMxMDEzMTVaFw0zNTAyMTMxMDEzMTVaMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEAwUdO3fxEzEtcnI7ZKZL412XvZPugoni7i7D7prCe0AtaHTc97CYgm7NsAtJyxNLixmhLV8pyIEaiHXWAh8fPKW+R017+EmXrr9EaquPmsVvTywAAE1PMNOKqo2kl4Gxiz9zZqIajOm1fZGWcGS0f5JQ2kBqNbvbg2/Za+GJ/qwUCAwEAAaOB7jCB6zAdBgNVHQ4EFgQUlp98u8ZvF71ZP1LXChvsENZklGswgbsGA1UdIwSBszCBsIAUlp98u8ZvF71ZP1LXChvsENZklGuhgZSkgZEwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tggEAMAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQEFBQADgYEAgV86VpqAWuXvX6Oro4qJ1tYVIT5DgWpE692Ag422H7yRIr/9j/iKG4Thia/Oflx4TdL+IFJBAyPK9v6zZNZtBgPBynXb048hsP16l2vi0k5Q2JKiPDsEfBhGI+HnxLXEaUWAcVfCsQFvd2A1sxRr67ip5y2wwBelUecP3AjJ+YcxggGaMIIBlgIBATCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwCQYFKw4DAhoFAKBdMBgGCSqGSIb3DQEJAzELBgkqhkiG9w0BBwEwHAYJKoZIhvcNAQkFMQ8XDTEwMDYwODA2NTk1MVowIwYJKoZIhvcNAQkEMRYEFIkAVcK/8b2g/DstmRjdHWOQRKZCMA0GCSqGSIb3DQEBAQUABIGAQsSxd+PC0aO/hUZ/0zjMP68blm/8QrF7+ZxZR4nqtAypl/QkJ5V+MWUbMsSqlINAPLci6cpSaQTxfO+RD4vegtzd017oGViZcXg5hYd9C1wHUEKRJfW4hUu/GnFZXEJQ2iGAiMYyR9fJN7KwzZMhUDgcIKUuPGaMKjzUAmcGO60=-----END PKCS7-----">
				<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="float: left;">
				<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			
			<p class="donate"><?php _e('Please consider making a contribution towards future development of this plugin.'); ?></p>
		</div>
	</div>
	
	<div id="icon-help"></div>
	<h2><?php _e('Important Information'); ?></h2>
    <a name="fbComments_xid"></a><h3><?php _e("What's an XID and how does it work?"); ?></h3>
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
    
    <a name="fbComments_commentPlacement"></a><h3><?php _e('How do I get the Facebook comments to show up <em>after</em> the WordPress comments?'); ?></h3>
    <?php _e("<ol>
    	<li>From your WordPress Dashboard, go to <strong>Appearance -> Editor</strong></li>
    	<li>Select the <strong>Single Post (single.php)</strong> or <strong>Page Template (page.php)</strong> file from the list on the right-hand side (depending on whether you want comments included on posts or pages)</li>
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
