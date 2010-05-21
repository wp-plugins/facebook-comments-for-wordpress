=== Facebook Comments for WordPress ===
Tags: comments, facebook, social graph, posts
Requires at least: 2.9.2
Tested up to: 2.9.2
Stable tag: 1.1

Allows your visitors to comment on posts using their Facebook profile. Makes use of Facebook's new Social Graph plugins.

== Description ==

This plugin integrates the Facebook commenting system right into your website. If a reader is logged into Facebook while
viewing any comment-enabled page or post, they'll be able to leave a comment using their Facebook profile.

The styles can all be customized, along with the number of comments displayed. Readers also have the option of posting
their comment straight to their Facebook profile page.

== Installation ==

1. Upload facebook_comments.php and facebook_comments_admin.php to your /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set the plugin up by using the 'Facebook Comments' page (located under the 'Settings' menu)
   a) Note that a Facebook application ID is required. For details on how to get one, check out http://grahamswan.com/facebook-comments

== Changelog ==

= 1.0 =
* Initial release.

== Known Issues ==

NOTE: The following are all issues with the Facebook library itself. They are out of my control.

* Scrollbars appear and disappear continually when the comments box is set inside a strict container
* Most recent comments fail to load
* Incompatible with Internet Explorer v7 and below (comments box does not show up at all)
* Inability to subscribe to new comments (not an issue, just a requested feature)

== Upcoming Features ==

* Entire plugin to be moved into 'fbComments' class (to avoid potention function duplication with other plugins)
* Checkbox to be added allowing user to include/exclude the comments box without having to deactivate the plugin
* Option to be added allowing user to disable default WordPress commenting system on any post with Facebook Comments enabled
* Options page to be rebuilt using AJAX (so no page reloads are required to update the settings)
* Option to be added allowing the Facebook comments box to be included before OR after the WordPress comments
