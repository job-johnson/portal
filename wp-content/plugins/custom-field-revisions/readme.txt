=== Custom Field Revisions ===
Contributors: coocoomoo
Donate link: http://coocoomoo.com/custom-field-revisions/
Tags: cms, revision, meta, post meta, custom, field, custom fields, preview
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: 1.0.2

Enables custom fields in revisions and makes preview work as expected when using custom fields.


== Description ==

This plugin enables custom fields in revisions and makes preview work as expected when using custom fields (Means that custom fields are NOT saved to original post when clicking that Preview button).

= Features =

* Saves revisions of the values in your custom fields (created by other plugins or native)
* The fields are displayed on revision screen along with Title, Content, Excerpt
* Using restore on the revision screen also restores the defined fields
* Has various options to define which fields are saved in revisions
* BONUS: When previewing a post/page the plugin prevents the fields being saved to the original post.


== Installation ==

1. Upload `custom-field-revisions` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set up which fields should be handled by the plugin under Settings / Custom Field Revisions

= Optional =

If you want the "Compare revisions" feature in Wordpress to show differences in your custom fields there is a patch included in the assets folder. The plugin will work fine without this hack but for now this is included until I find a way of acheiving the feature. Use at own risk! :)

You need to apply the revision.patch to wp-admin/revision.php and check the box under *Advanced* section in the plugin settings page to get it working.

IMPORTANT: Do not check the box UNLESS you have applied the patch. It will make the plugin work incorrect.


== Frequently Asked Questions ==

= Do you know of any good plugin to handle custom fields? =
http://wordpress.org/extend/plugins/advanced-custom-fields/


== Screenshots ==

1. Options
2. Revision screen with some custom fields
3. Compare revisions when using core hack. (Hopefully this can be done without patching in a later version...)


== Changelog ==

= 1.0.2 =
Added "Using core hack" option to settings replacing constant variable in main class to simplify plugin updates

= 1.0.1 =
Made plugin work without core patch

= 1.0.0 =
Custom Field Revisions first release
