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
 * admin_menu hook, and which is defined in /functions/options.php.
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/add_help_tab				add_help_tab()
 * @link 		http://codex.wordpress.org/Function_Reference/get_current_screen		get_current_screen()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_directory	get_template_directory()
 * 
 * @link 		http://php.net/manual/en/function.file-get-contents.php					file_get_contents()
 * 
 * @since	Oenology 2.5
 */
function oenology_settings_page_contextual_help() {
	// Globalize settings page
	global $oenology_settings_page;
	// Test for current page
	$screen = get_current_screen();
	if ( $screen->id != $oenology_settings_page ) {
		return;
	}
	// Add Settings - Varietals help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-settings-varietal',
		'title'   => __( 'Settings - Varietals', 'oenology' ),
		'content' => file_get_contents( get_template_directory() . '/help/settings-varietal.htm' ),
	) );
	// Add Settings - Layout help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-settings-layout',
		'title'   => __( 'Settings - Layout', 'oenology' ),
		'content' => file_get_contents( get_template_directory() . '/help/settings-layout.htm' ),
	) );
	// Add Settings - General help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-settings-general',
		'title'   => __( 'Settings - General', 'oenology' ),
		'content' => file_get_contents( get_template_directory() . '/help/settings-general.htm' ),
	) );
	// Add Theme Features help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-features',
		'title'   => __( 'Theme Features', 'oenology' ),
		'content' => file_get_contents( get_template_directory() . '/help/features.htm' ),
	) );
	// Add FAQ Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-faq',
		'title'   => __( 'FAQ', 'oenology' ),
		'content' => file_get_contents( get_template_directory() . '/help/faq.htm' ),
	) );
	// Add Code Ref Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-coderef',
		'title'   => __( 'Code Reference', 'oenology' ),
		'content' => file_get_contents( get_template_directory() . '/help/coderef.htm' ), 
	) );
	// Add Change Log Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-changelog',
		'title'   => __( 'Change Log', 'oenology' ),
		'content' => file_get_contents( get_template_directory() . '/help/changelog.htm' ),
	) );
	// Add License Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-license',
		'title'   => __( 'License', 'oenology' ),
		'content' => file_get_contents( get_template_directory() . '/help/license.htm' ),
	) );
	// Add Support Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-support',
		'title'   => __( 'Theme Support', 'oenology' ),
		'content' => include( get_template_directory() . '/help/support.php' ),
	) );
}
?>