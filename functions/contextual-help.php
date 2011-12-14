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
		'content' => include( get_template_directory() . '/functions/contextual-help-settings-varietal.php' ),
	) );
	// Add Settings - Layout help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-settings-layout',
		'title'   => __( 'Settings - Layout', 'oenology' ),
		'content' => include( get_template_directory() . '/functions/contextual-help-settings-layout.php' ),
	) );
	// Add Settings - General help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-settings-general',
		'title'   => __( 'Settings - General', 'oenology' ),
		'content' => include( get_template_directory() . '/functions/contextual-help-settings-general.php' ),
	) );
	// Add Theme Features help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-features',
		'title'   => __( 'Theme Features', 'oenology' ),
		'content' => include( get_template_directory() . '/functions/contextual-help-features.php' ),
	) );
	// Add FAQ Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-faq',
		'title'   => __( 'FAQ', 'oenology' ),
		'content' => include( get_template_directory() . '/functions/contextual-help-faq.php' ),
	) );
	// Add Code Ref Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-coderef',
		'title'   => __( 'Code Reference', 'oenology' ),
		'content' => include( get_template_directory() . '/functions/contextual-help-coderef.php' ), 
	) );
	// Add Change Log Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-changelog',
		'title'   => __( 'Change Log', 'oenology' ),
		'content' => include( get_template_directory() . '/functions/contextual-help-changelog.php' ),
	) );
	// Add License Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-license',
		'title'   => __( 'License', 'oenology' ),
		'content' => include( get_template_directory() . '/functions/contextual-help-license.php' ),
	) );
	// Add Support Reference help screen tab
	$screen->add_help_tab( array(
		'id'      => 'oenology-support',
		'title'   => __( 'Theme Support', 'oenology' ),
		'content' => include( get_template_directory() . '/functions/contextual-help-support.php' ),
	) );
}
?>