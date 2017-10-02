=== NextPage Buttons ===
Contributors: shawnparker
Donate link: http://top-frog.com/donate
Tags: next, page, button, editor, toolbar
Requires at least: 3.0
Tested up to: 3.8b
Stable tag: 1.1

The NextPage button is a simple plugin that brings back the NextPage button in the WordPress editor toolbar.

== Description ==

This is a simple plugin to put the <code>&lt;!--nextpage--&gt;</code> buttons back in the WordPress editor Toolbars.

The only caveat to using this plugin is that it uses functionality that has been in the WordPress core but hidden since the NextPage button was removed not long ago. All the functionality for handling the <code>&lt;!--nextpage--&gt;</code> tag via the editor toolbar is there in WordPress core. The JavaScript functions are loaded as well as the CSS, but the buttons are not added to the toolbar. This plugin adds those buttons to the toolbar.

If you're OK with having functionality that could break in the next revision to WordPress then use this until anything does change in WordPress.

== Installation ==

1. Upload the `nextpage-buttons` folder to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Open a post to edit, you will now have next-page buttons in both WYSIWYG and HTML editing modes

== Frequently Asked Questions ==

= What happens if WordPress enables the NextPage tag in the future? =

Chances are it'll be pretty obvious that something weird is happening with the Toolbar functionality. In that event you should simply deactivate this plugin.

= What happens if WordPress removes the current code that is used from being loaded? =

If that ever happens I'll alter this plugin to load that code directly and we'll be back in business.

== Screenshots ==

N/A

== Changelog ==

= 1.1 =
* fixing addition to button during plain text editing mode.
* adding i18n support with Spanish & French translations.
	* Thanks to Andrew Kurtis for the Spanish translation.

= 1.0.1 =
* bumping version number to circumvent the wordpress plugin directory obsolete plugin purgatory.

= 1.0 =
* Initial release