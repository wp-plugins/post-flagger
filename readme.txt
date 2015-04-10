=== Post Flagger ===
Contributors: nosoycesaros
Donate link: http://owak.co/post-flagger/
Tags: flag, posts, favorites, views
Requires at least: 3.0.1
Tested up to: 4.3
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add "Favorites" to your posts. Add / Edit post flags, to be used only by logged in users.

== Description ==

Manage flags to posts, to be used by logged in users. Autmatically creates "Favorites" flag ready to use in your posts.

* Administrators can create flags like 'Favorites' or 'Seen' for logged in users
* Allow customization of HTML code for each flag
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

= 0.9 =
* This is the first release of this plugin
* Add / Edit Post flags for themes
* Creates 'Favorites' flags automaticlly

== Upgrade Notice ==

No information yet