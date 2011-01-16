=== Facebook Comments for WordPress ===
Contributors: thinkswan, AlmogBaku, sboddez
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=7QKHFXCNDTA5U&lc=CA&item_name=Graham%20Swan%20%28Facebook%20Comments%20for%20WordPress%20plugin%29&item_number=thinkswan&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted
Tags: comments, facebook, social graph, posts, pages, discussion, facebook comments
Requires at least: 2.9.2
Tested up to: 3.0.4
Stable tag: 1.6

Allows your visitors to comment on posts using their Facebook profile. Makes use of Facebook's new Social Graph plugins.

== Description ==

This plugin integrates the Facebook commenting system right into your website. If a reader is logged into Facebook while
viewing any comment-enabled page or post, they'll be able to leave a comment using their Facebook profile. Non-Facebook
users can post with a valid email address.

Features:

* Styles can all be customized to fit your site's theme
* Number of comments displayed can be adjusted
* Option to post comments directly to a user's Facebook profile page
* Comments can be included on pages only, posts only or both
* Comments can be shown in chronological order or with the most recent comments first
* Facebook comments can be attached to WordPress comments or inserted manually anywhere in your theme
* WordPress comments can be hidden on pages/posts where Facebook comments are enabled
* Comment counts on pages/posts reflect both the Facebook and WordPress comments
* Like button can be hidden if required

== Installation ==

1. Unzip `facebook-comments-for-wordpress.1.6.zip` to your `/wp-content/plugins/` directory
2. Activate the plugin through the `Plugins` menu in WordPress
3. Setup the plugin options by using the `Facebook Comments` page (located under the `Settings` menu)

* Note that a `Facebook application ID` is required. For details on how to get one, including a screenshot walkthrough,
  check out http://grahamswan.com/facebook-comments
* In order to keep your comments through upgrades, you **must** set a unique `XID`. This `XID` will be maintained when you
  upgrade the plugin

== Frequently Asked Questions ==

If you need help, please refer to the official FAQ at http://grahamswan.com/facebook-comments.

== Changelog ==

= 1.6 =
* Comment inclusion code is now far more lightweight
* Facebook and WordPress comments are now counted together

= 1.5.2 =
* Bugfix: WordPress commenting form should now be properly hidden for most themes
* Bugfix: `type` attribute is now set in the script inclusion (so older browsers will render it properly)

= 1.5.1 =
* Bugfix: fixes the bug where hiding the WordPress comments caused errors in `foreach()` loops on certain themes
* Moves all stylesheets to `css/` folder and all images to `images/` folder for better organization

= 1.5 =
* Option: WordPress comments can be hidden on pages/posts where Facebook comments are enabled
* Option: Like button can be hidden
* Option: `Facebook Social Plugins` text and icon is hidden
* Option: custom stylesheet for darker websites can be included (as a result, ability to reference your own custom stylesheet was removed)
* Bugfix: comments now render properly in Internet Explorer (due to `FBML` reference)
* Added `title` and `url` attributes to the `<fb:comments>` tag so the Like button links to the correct page when clicked
* Facebook comments can now be linked to by appending `#facebook-comments` to the end of a post/page's URL
* Support for 100+ languages is now available (including Arabic, Hebrew, Spanish and all other requested languages)

= 1.4.1 =
* Bugfix: WordPress comments are no longer hidden when the Pages only or Posts only options are selected

= 1.4 =
* Option: include comments on pages only, posts only or both
* Tested and works properly with WordPress 3.0

= 1.3 =
* Bugfix: settings/XID are no longer lost when upgrading
* Bugfix: anonymous posting now works properly
* Option: allow user to hide the `Facebook comments:` title
* Added `Settings` link to plugin's action links on the `Plugins` page
* Redesigned settings page
* Refactored code to prepare for next release

= 1.2 =
* Bugfix: Facebook comments will be hidden on posts on which WordPress comments are disabled
* Bugfix: Facebook comments are retained through upgrades (you **must** set a XID to keep your comments)
* Feature: add Facebook comments anywhere in your theme by manually inserting `<?php if (function_exists('facebook_comments')) facebook_comments(); ?>` where you'd like them to show up
* Option: change `Facebook comments:` title to anything you want
* Option: allow user to reverse the order of the Facebook comments so they're in chronological order (like WordPress comments)
* Option: allow removal of the grey box behind the composer
* Option: allow use of external stylesheet to alter the appearance of the Facebook comments section
* Option: receive Facebook notifications whenever someone posts a comment
* Option: uncheck `Post comment to my Facebook profile` box by default
* Assorted code maintenance

= 1.1 =
* Fixed bug: plugin's settings are no longer reset/removed when activating/deactivating other plugins
* New option: ability to hide the Facebook comments box without having to deactivate the plugin (in case you want to keep
  your settings)
* Minor style changes

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.6 =
This update introduces the highly-anticipated combined comment counts feature.

= 1.5.2 =
This update fixes a bug where the WordPress commenting form couldn't be hidden.

= 1.5.1 =
This update fixes a bug where hiding the WordPress comments caused errors with `foreach()` loops.

= 1.5 =
This update provides options to hide the Like button and to hide the WordPress comments section on pages/posts
where Facebook comments are enabled. The comments also render properly in Internet Explorer now.

= 1.4.1 =
This update provides a simple bugfix where WordPress comments were being hidden if the Pages only or Posts only
option was selected.

= 1.4 =
This update ensures compatibility with WordPress 3.0, and also provides an option to include the comments on pages
only, posts only or both.

= 1.3 =
This update adds the option to remove the `Facebook comments:` title, fixes a bug where settings are lost, allows
anonymous posting and provides a brand new configuration page.

= 1.2 =
This update fixes a bug where the Facebook comments are not consistent across upgrades. Also provides new options.

= 1.1 =
This update fixes a critical bug where the plugin's settings are reset or removed every time any other plugin is
activated/deactivated. Also provides new options.

== Known Issues ==

NOTE: The following are all issues with the Facebook library itself. They are out of my control.

* New comments may take several seconds to load or require a page refresh
* The `Post comment to my Facebook profile` box is checked regardless of whether the attribute is set to `false` or not
* Facebook notifications are not sent when new comments are posted (notifications are being added in the next release of this plugin)
* After deleting a Facebook comment, all `Delete` links disappear until you refresh the page

== Upcoming Features ==

* Option to be added allowing the Facebook comments box to be included before *or* after the WordPress comments
* Option to include Facebook comments in the `Recent Comments` list
* Option to be notified by email whenever a new comment is posted
* Ability to import Facebook comments into the WordPress database and vice-versa
* Ability to use custom XIDs
* Ability to use different styles for posts and pages
* Ability to moderate all comments against a profanity/spam list
* Check Facebook application ID for validity

== Screenshots ==

1. The Facebook commenting box, complete with comments.
2. Anonymous posting for users without a Facebook account.
3. Using a custom stylesheet.
4. The plugin settings page.
