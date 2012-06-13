<?php
/**
 * Oenology Theme Contextual Help
 *
 * This file defines the Theme Options contextual help content 
 * for the Oenology Theme.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
 

/**
 * Settings Page Contextual Help
 * 
 * Contextual help, WordPress 3.3-compatible
 * 
 * This callback is hooked into the load-$oenology_settings_page hook,
 * via the oenology_add_theme_page() callback, which is hooked into the
 * admin_menu hook. The oenology_add_theme_page() callback is defined 
 * in /functions/options.php.
 * 
 * This callback works by calling the current screen object, via the WP_Screen() 
 * class via get_current_screen(), and then adding contextual help tabs to the 
 * screen object, via add_help_tab().
 * 
 * The add_help_tab() function is a member of the WP_Screen() class, and must be 
 * referenced from the class. The function accepts four arguments:
 *     add_help_tab( 
 *     		$id,		// string		(required) HTML ID attribute
 *     		$title,		// string		(required) Tab title
 *     		$content,	// string		(optional) Tab content
 *     		$callback	// callback		(optional) function that returns tab content
 *     )
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/add_help_tab				add_help_tab()
 * @link 		http://codex.wordpress.org/Function_Reference/get_current_screen		get_current_screen()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_directory	get_template_directory()
 * 
 * @link 		http://php.net/manual/en/function.file.php								file()
 * @link 		http://php.net/manual/en/function.implode.php							implode()
 * @link 		http://php.net/manual/en/function.include.php							include()
 * 
 * @since	Oenology 2.5
 */
function oenology_settings_page_contextual_help() {
	// Globalize settings page
	global $oenology_settings_page;
	// Get the current screen object
	$screen = get_current_screen();
	// Ensure current page is Oenology settings page
	if ( $screen->id != $oenology_settings_page ) {
		return;
	}
	// Add Settings - Varietals help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'oenology-settings-varietal',
		// Tab Title
		'title'   => __( 'Settings - Varietals', 'oenology' ),
		// Tab content
		'content' => implode( '', file( get_template_directory() . '/help/settings-varietal.htm' ) ),
	) );
	// Add Settings - Layout help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'oenology-settings-layout',
		// Tab title
		'title'   => __( 'Settings - Layout', 'oenology' ),
		// Tab content
		'content' => implode( '', file( get_template_directory() . '/help/settings-layout.htm' ) ),
	) );
	// Add Settings - General help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'oenology-settings-general',
		// Tab Title
		'title'   => __( 'Settings - General', 'oenology' ),
		// Tab content
		'content' => implode( '', file( get_template_directory() . '/help/settings-general.htm' ) ),
	) );
	// Add Theme Features help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'oenology-features',
		// Tab title
		'title'   => __( 'Theme Features', 'oenology' ),
		// Tab content
		'content' => implode( '', file( get_template_directory() . '/help/features.htm' ) ),
	) );
	// Add FAQ Reference help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'oenology-faq',
		// Tab title
		'title'   => __( 'FAQ', 'oenology' ),
		// Tab content
		'content' => implode( '', file( get_template_directory() . '/help/faq.htm' ) ),
	) );
	// Add Code Ref Reference help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'oenology-coderef',
		// Tab title
		'title'   => __( 'Code Reference', 'oenology' ),
		// Tab content
		'content' => implode( '', file( get_template_directory() . '/help/coderef.htm' ) ), 
	) );
	// Add Change Log Reference help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'oenology-changelog',
		'title'   => __( 'Change Log', 'oenology' ),
		'content' => implode( '', file( get_template_directory() . '/help/changelog.htm' ) ),
	) );
	// Add License Reference help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'oenology-license',
		// Tab title
		'title'   => __( 'License', 'oenology' ),
		// Tab content
		'content' => implode( '', file( get_template_directory() . '/help/license.htm' ) ),
	) );
	// Add Support Reference help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id'      => 'oenology-support',
		// Tab title
		'title'   => __( 'Theme Support', 'oenology' ),
		// Tab content
		'content' => include( get_template_directory() . '/help/support.php' ),
	) );
}
?>