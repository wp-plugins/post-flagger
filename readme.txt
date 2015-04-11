=== Post Flagger ===
Contributors: nosoycesaros
Donate link: http://owak.co/post-flagger/
Tags: flag, post, favorites, views, shortcode, meta, user, log in
Requires at least: 3.0.1
Tested up to: 4.1.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add "Favorite" button to your posts. Create post flags to be used by logged in users.

== Description ==

Manage posts flags, which can be marked on/off by logged in users. Automatically creates "Favorites" flag and button ready to use in your posts.

* Administrators can create flags like 'Favorites' or 'Seen' for logged in users
* Allows customization of HTML code for each flag
* Insert in themes and post by `[shortcode]`
* This plugin creates 'Favorites' flag by default

== Installation ==

1. Upload `post-flagger` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php do_shortcode( '[flag slug="flag-slug"]' ); ?>` in your templates
4. Manage flags in `Settings/Post Flags`

== Frequently Asked Questions ==

= Can i delete 'Favorites' flag? =

Yes you can

= Why my html code for flagged and unflagged is not showing properly? =

Try using your html code whitout any quotes. e.g.
`<img src=star.png />`

== Screenshots ==

1. Manage your flags in `Settings/Post Flags`
2. Edit each flag separately. It allows HTML

== Changelog ==

= 1.0 =
* Adds support to new language: Spanish
* Allows bulk actions with flags

= 0.9 =
* This is the first release of this plugin
* Add / Edit Post flags for themes
* Creates 'Favorites' flags automaticlly

== Upgrade Notice ==

= 1.0 =
This upgrade sets basis for 1.x improvements, technically is the first official release.