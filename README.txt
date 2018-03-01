=== Plugin Name ===
Contributors: bacoords
Donate link: https://www.briancoords.com
Tags: s2-member
Requires at least: 3.0.1
Tested up to: 4.9.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Handles automatic cleaning of old S2 Member accounts.

== Description ==

This plugin handles automatic cleaning of expired S2 Member free user accounts. To be considered expired, the account must:

* Be "subscriber" level
* Been created at least 6 months prior
* Have a "last logged in" date of at least 6 months prior

These users can be deleted manually or on a regularly scheduled basis.

*Please test this plugin out on a staging or local version of your site before using. The author of this plugin is not responsible for any issues caused by this plugin.*

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `s2-member-cleaner.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. A new admin page will appear under Settings > S2 Member Cleaner

== Frequently Asked Questions ==

= Does this work with other membership plugins? =

Nope.

= Will this immediately delete all of my expired users? =

Nope. It only runs deletes in groups of 50 users to cut down on database overload. You can repeatedly hit the "manual delete" if you'd like to speed up the process.

== Changelog ==

= 1.0 =
* Initial Release

== Upgrade Notice ==

= 1.0 =
Initial release
