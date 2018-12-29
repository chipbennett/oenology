<?php
/**
 * Theme Hook Alliance hook stub list.
 *
 * @package 		themehookalliance
 * @version		1.0-draft
 * @since		1.0-draft
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * Define the version of THA support, in case that becomes useful down the road.
 */
define( 'THA_HOOKS_VERSION', '1.0-draft' );

/** 
 * Themes and Plugins can check for tha_hooks using current_theme_supports( 'tha_hooks', $hook )
 * to determine whether a theme declares itself to support this specific hook type.
 * 
 * Example:
 * <code>
 * 		// Declare support for all hook types
 * 		add_theme_support( 'tha_hooks', array( 'all' ) );
 * 
 * 		// Declare support for certain hook types only
 * 		add_theme_support( 'tha_hooks', array( 'header', 'content', 'footer' ) );
 * </code>
 */
add_theme_support( 'tha_hooks', array(
	
	/**
	 * As a Theme developer, use the 'all' parameter, to declare support for all
	 * hook types.
	 * Please make sure you then actually reference all the hooks in this file,
	 * Plugin developers depend on it!
	 */
	'all',
	
	/**
	 * Themes can also choose to only support certain hook types.
	 * Please make sure you then actually reference all the hooks in this type
	 * family.
	 * 
	 * When the 'all' parameter was set, specific hook types do not need to be
	 * added explicitly. The following hook types can be set specifically:
	 * 
	 * - html
	 * - body
	 * - head
	 * - header
	 * - content
	 * - entry
	 * - comments
	 * - sidebars
	 * - sidebar
	 * - footer
	 * 
	 * If/when WordPress Core implements similar methodology, Themes and Plugins
	 * will be able to check whether the version of THA supplied by the theme
	 * supports Core hooks:
	 * 
	 * - core
	 */
) );

/**
 * Determines, whether the specific hook type is actually supported.
 * 
 * Plugin developers should always check for the support of a <strong>specific</strong>
 * hook type before hooking a callback function to a hook of this type.
 * 
 * Example:
 * <code>
 * 		if ( current_theme_supports( 'tha_hooks', 'header' ) )
 * 	  		add_action( 'tha_head_top', 'prefix_header_top' );	
 * </code>
 * 
 * @param bool  $bool true.
 * @param array $args The hook type being checked.
 * @param array $registered All registered hook types.
 * 
 * @return bool
 */
function tha_current_theme_supports( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-tha_hooks', 'tha_current_theme_supports', 10, 3 );

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $tha_supports[] = 'html;
 */
function tha_html_before() {
	do_action( 'tha_html_before' );
}

/**
 * HTML <body> hooks
 * $tha_supports[] = 'body';
 */

/**
 * Tag: HTML <body> tag, open
 */
function tha_body_top() {
	do_action( 'tha_body_top' );
}

/**
 * Tag: HTML <body> tag, close
 */
function tha_body_bottom() {
	do_action( 'tha_body_bottom' );
}

/**
 * HTML <head> hooks
 * 
 * $tha_supports[] = 'head';
 */
 
/**
 * Tag: HTML <head> tag, open
 */
function tha_head_top() {
	do_action( 'tha_head_top' );
}

/**
 * Tag: HTML <head> tag, close
 */
function tha_head_bottom() {
	do_action( 'tha_head_bottom' );
}


/**
 * Semantic <header> hooks
 * 
 * $tha_supports[] = 'header';
 */

/**
 * Tag: Site header container tag, outside open
 */
function tha_header_before() {
	do_action( 'tha_header_before' );
}

/**
 * Tag: Site header container tag, outside close
 */
function tha_header_after() {
	do_action( 'tha_header_after' );
}

/**
 * Tag: Site header container tag, inside open
 */
function tha_header_top() {
	do_action( 'tha_header_top' );
}

/**
 * Tag: Site header container tag, inside close
 */
function tha_header_bottom() {
	do_action( 'tha_header_bottom' );
}

/**
 * Semantic <content> hooks
 * 
 * $tha_supports[] = 'content';
 */

/**
 * Tag: Site content container tag, outside open
 */
function tha_content_before() {
	do_action( 'tha_content_before' );
}

/**
 * Tag: Site content container tag, outside close
 */
function tha_content_after() {
	do_action( 'tha_content_after' );
}

/**
 * Tag: Site content container tag, inside open
 */
function tha_content_top() {
	do_action( 'tha_content_top' );
}

/**
 * Tag: Site content container tag, inside close
 */
function tha_content_bottom() {
	do_action( 'tha_content_bottom' );
}

/**
 * Tag: Site content while loop container tag, outside open
 */
function tha_content_while_before() {
	do_action( 'tha_content_while_before' );
}

/**
 * Tag: Site content while loop container tag, outside close
 */
function tha_content_while_after() {
	do_action( 'tha_content_while_after' );
}

/**
 * Semantic <entry> hooks
 * 
 * $tha_supports[] = 'entry';
 */

/**
 * Tag: Post content loop, outside open
 */
function tha_entry_before() {
	do_action( 'tha_entry_before' );
}

/**
 * Tag: Post content loop, outside close
 */
function tha_entry_after() {
	do_action( 'tha_entry_after' );
}

/**
 * Tag: Post content loop, inside open
 */
function tha_entry_top() {
	do_action( 'tha_entry_top' );
}

/**
 * Tag: Post content loop, inside close
 */
function tha_entry_bottom() {
	do_action( 'tha_entry_bottom' );
}

/**
 * Tag: Post the_content, before
 */
function tha_entry_content_before() {
	do_action( 'tha_entry_content_before' );
}

/**
 * Tag: Post the_content, after
 */
function tha_entry_content_after() {
	do_action( 'tha_entry_content_after' );
}

/**
 * Comments block hooks
 * 
 * $tha_supports[] = 'comments';
 */

/**
 * Tag: Post comment loop, outside open
 */
function tha_comments_before() {
	do_action( 'tha_comments_before' );
}

/**
 * Tag: Post comment loop, outside close
 */
function tha_comments_after() {
	do_action( 'tha_comments_after' );
}

/**
 * Semantic <sidebar> hooks
 * 
 * $tha_supports[] = 'sidebar';
 */

/**
 * Tag: Sidebars container, outside open
 */
function tha_sidebars_before() {
	do_action( 'tha_sidebars_before' );
}

/**
 * Tag: Sidebars container, outside close
 */
function tha_sidebars_after() {
	do_action( 'tha_sidebars_after' );
}

/**
 * Tag: Sidebars container, inside open
 */
function tha_sidebar_top() {
	do_action( 'tha_sidebar_top' );
}

/**
 * Tag: Sidebars container, inside close
 */
function tha_sidebar_bottom() {
	do_action( 'tha_sidebar_bottom' );
}

/**
 * Semantic <footer> hooks
 * 
 * $tha_supports[] = 'footer';
 */

/**
 * Tag: Site footer container, outside open
 */
function tha_footer_before() {
	do_action( 'tha_footer_before' );
}

/**
 * Tag: Site footer container, outside close
 */
function tha_footer_after() {
	do_action( 'tha_footer_after' );
}

/**
 * Tag: Site footer container, inside open
 */
function tha_footer_top() {
	do_action( 'tha_footer_top' );
}

/**
 * Tag: Site footer container, inside close
 */
function tha_footer_bottom() {
	do_action( 'tha_footer_bottom' );
}