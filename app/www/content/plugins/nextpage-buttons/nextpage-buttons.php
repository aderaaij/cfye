<?php
/*
Plugin Name: NextPage Buttons
Plugin URI: http://top-frog.com
Description: Adding &lt;!--nextpage--&gt; functionality back in to the tinyMCE buttons &amp; QuickTags. Exposes existing functionality already present in the WordPress code base. For WordPress 2.8+ only.
Version: 1.1
Text Domain: nextpage-buttons
Author: Shawn Parker
Author URI: http://top-frog.com/ 
*/

// Copyright (c) 2009 Shawn Parker. All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// This is an add-on for WordPress
// http://wordpress.org/
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

// Init

	/**
	 * Only do the tinyMCE integration when a user has enough privileges and if rich text editing is enabled
	 *
	 * @return void
	 */
	function spnp_init() {
		global $pagenow;
			
		load_plugin_textdomain('nextpage-buttons', false, 'nextpage-buttons/languages');
		
		if (in_array($pagenow,array('page.php', 'page-new.php', 'post.php', 'post-new.php'))) { 
			if (current_user_can('edit_posts') && current_user_can('edit_pages') && get_user_option('rich_editing') == 'true') {
				add_filter('mce_external_plugins', 'spnp_add_tinymce_plugin');
				add_filter('mce_buttons', 'spnp_register_button');
			}
			add_action('admin_print_footer_scripts', 'spnp_quicktag_js', 99);
		}
	}
	add_action('init', 'spnp_init');

// Request Handler/tinyMCE Plugin Code

	/**
	 * Deliver tinyMCE plugin code on request only.
	 * The plugin uses existing functionality in the WordPress core that is not currently exposed. If WordPress
	 * ever turns this functionality back on (ie: you see two next-page buttons), simply turn off this plugin.
	 *
	 * @return void
	 */
	function spnp_js() {		
		if (!empty($_REQUEST['spnp-action']) && $_REQUEST['spnp-action'] == 'spnp-admin-js') {
			header('content-type: text/javascript');
			echo trim('
(function() {
	tinymce.create("tinymce.plugins.spnpnextpage", {
		init : function(ed, url) {			
			ed.addButton("spnpNextPageBtn", {
                title: "' . __('Insert Next Page Tag (Alt+Shift+P)', 'nextpage-buttons') . '",
                cmd: "WP_Page",
				image : "'.includes_url('js/tinymce/plugins/wordpress/').'img/page.gif"
            });
		},
		getInfo : function() {
            return {
                longname: "spnpNextPage",
                author: "Shawn Parker",
                authorurl: "http://top-frog.com",
                infourl: "http://top-frog.com",
                version: "1.0"
            };
        }
	});
	tinymce.PluginManager.add("spnpnextpage", tinymce.plugins.spnpnextpage);
})();
			');
			exit;
		}
	}
	add_action('init','spnp_js');

// tinyMCE integration

	/**
	 * Register the button to the tinyMCE top row of buttons
	 *
	 * @param array $buttons 
	 * @return array
	 */
	function spnp_register_button($buttons) {
		array_push($buttons, '|', "spnpNextPageBtn");
		return $buttons;
	}

	/**
	 * Register the tinyMCE plugin URL with tinyMCE
	 *
	 * @param array $plugin_array 
	 * @return array
	 */
	function spnp_add_tinymce_plugin($plugin_array) {
		$plugin_array['spnpnextpage'] = trailingslashit(get_bloginfo('wpurl')).'index.php?spnp-action=spnp-admin-js';
		return $plugin_array;
	}

// Quicktag

	/**
	 * Add the next page tag in to the quicktags toolbar (HTML edit mode).
	 * The only way to get it in there is to be a little haxie - there are no hooks or filters in to quicktags
	 *
	 * @return void
	 */
	function spnp_quicktag_js() {
		global $pagenow;

		echo '
<script type="text/javascript">
	jQuery(function($) {
		QTags.addButton("ed_next", "page", "<!--nextpage-->","","p");

		$("<input />")
			.attr("type", "button")
			.attr("id","ed_next")
			.attr("value","' . __('next page', 'nextpage-buttons') . '")
			.attr("accesskey","p")
			.attr("title","' . __('Insert Next Page Tag', 'nextpage-buttons') . '")
			.addClass("ed_button")
			.click(function(e){
				e.preventDefault();
				edInsertTag(edCanvas, $(this).attr("name"));
			})
			.appendTo($("#ed_toolbar"));
	});
</script>
		';
	}
?>