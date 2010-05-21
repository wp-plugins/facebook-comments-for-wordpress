=== Facebook Comments for WordPress ===
Contributors: thinkswan
Tags: comments, facebook, social graph, posts, pages, discussion, facebook comments
Requires at least: 2.9.2
Tested up to: 2.9.2
Stable tag: 1.1

Allows your visitors to comment on posts using their Facebook profile. Makes use of Facebook's new Social Graph plugins.

== Description ==

This plugin integrates the Facebook commenting system right into your website. If a reader is logged into Facebook while
viewing any comment-enabled page or post, they'll be able to leave a comment using their Facebook profile.

Features:

* Styles can all be customized to fit your site's theme
* Number of comments displayed can be adjusted
* Option to post comments directly to a user's Facebook profile page

== Installation ==

1. Unzip `facebook-comments-for-wordpress.zip` to your `/wp-content/plugins/` directory
2. Activate the plugin through the `Plugins` menu in WordPress
3. Setup the plugin options by using the `Facebook Comments` page (located under the `Settings` menu)

* Note that a `Facebook application ID` is required. For details on how to get one, including a screenshot walkthrough,
      check out http://grahamswan.com/facebook-comments

== Frequently Asked Questions ==

= How do I get the Facebook comments to show up on a dark background? =

Adjust the `Container Styles` option. Eg: add `background: #000; color: #fff;` to force the comments box to have a black
background and white text.

= Can I have the Facebook comments show up after the WordPress comments? =

This option will be added in a later version of the plugin.

= The Facebook comments aren't loading on my site. What's wrong? =

Ensure you've entered a valid `Facebook application ID` in your settings. A walkthrough on how to obtain one is available
at http://grahamswan.com/facebook-comments

== Screenshots ==

1. The Facebook commenting box, complete with comments.

== Changelog ==

= 1.1 =
* Fixed bug: plugin's settings are no longer reset/removed when activating/deactivating other plugins
* New option: Ability to hide the Facebook comments box without having to deactivate the plugin (in case you want to keep
  your settings)
* Minor style changes

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.1 =
This update fixes a critical bug where the plugin's settings are reset or removed every time any other plugin is
activated/deactivated. Also provides new options.

== Known Issues ==

NOTE: The following are all issues with the Facebook library itself. They are out of my control.

* Scrollbars appear and disappear continually when the comments box is set inside a strict container
* Most recent comments fail to load sometimes
* Incompatible with Internet Explorer v7 and below (comments box does not show up at all)
* Inability to subscribe to new comments (I'll be adding this in a later version)
* Inability to add Facebook comment count to main WordPress comment count (I'll be adding this in a later version)
* Inability to see comments added through your website on your Facebook application's wall

== Upcoming Features ==

* Entire plugin to be moved into 'fbComments' class (to avoid potential conflicts with other plugins)
* Option to be added allowing user to disable default WordPress commenting system on any post with Facebook Comments enabled
* Options page to be rebuilt using AJAX (so no page reloads are required to update the settings)
* Option to be added allowing the Facebook comments box to be included before *or* after the WordPress comments
* Facebook comments will not be shown on posts/pages where WordPress commenting is disallowed
* Option to email site admin whenever a new Facebook comment is added
* Facebook application ID will be checked for validity
* Add `[facebook-comments]` tag so the comments can be inserted anywhere in a theme
* Option to change `Facebook comments:` title to anything you want
* Facebook comment count will be added to WordPress comment count
