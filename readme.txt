=== Debug Plugin Conflicts ===
Contributors: webzunft
Tags: debug, debugging, conflicts, plugins
Requires at least: 4.0
Tested up to: 4.5.3
Stable tag: 1.0.0

This plugin helps you to find conflicts between plugins on a website that is already online.

== Description ==

With this plugin I hope to help all of those who get asked by a theme or plugin developer to disable plugins in order to find out if a reported issue is caused by a plugin conflict.

Especially when you only have a live site, this request is not easy to follow without an interruption or breaking visible features.

Therefore, Debug Plugin Conflicts allows you to disable specific plugins only when an admin user is visiting the frontend in order to debug it.

Also support staff can now give a practical advise to their users with a link to this plugin.

You can follow the development and submit your own suggestions on [github](https://github.com/webgilde/plugin-conflicts/).

Tested on multisites.

**Instructions**

1. go to Tools > Plugin Conflicts
1. select the status of the plugins you want to test
1. save the settings
1. click the "Start Debug Mode" button
1. visit the frontend of your site for testing

You can go back to the settings page and change the status during frontend testing.

If you don’t use the plugin for a while then rather disable it.

**Possible Issues and Fixes**

The folder `wp-content/mu-plugins` must exist and be writable.

Disable caching for admin users before using this plugin. All caching plugins have an option to not cache known users.

If you have an issue with the plugins not being activated correctly then remove mu-plugins/plugin-conflicts-mu.php.
You can stop the debugging also by clearing all cookies in your browser.

== Installation ==

1. Upload `debug-plugin-conflicts` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to 'Tools > Debug Plugins' to set up which plugins to test

== Changelog ==

= 1.0.0 =

* first plugin version
