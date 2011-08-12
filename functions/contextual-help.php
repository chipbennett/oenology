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
 * Enqueue Oenology Theme Settings Page Contextual Help
 */
function oenology_contextual_help() {
	add_contextual_help( 'appearance_page_oenology-settings', oenology_get_options_contextual_help_text()  );
	add_contextual_help( 'appearance_page_oenology-reference', oenology_get_reference_contextual_help_text()  );
}
// Add contextual help to Admin Options page
add_action('admin_init', 'oenology_contextual_help', 10, 3);
 
/**
 * Oenology Options Contextual Help Content
 * 
 * Admin settings page contextual help markup
 * Separate file for ease of management
 */
function oenology_get_options_contextual_help_text() {
	$tabtext = '';
	if ( isset ( $_GET['tab'] ) ) {
			$tab = $_GET['tab'];
	} else {
			$tab = 'varietals';
	}
	$tabtext = '';
	switch ( $tab ) {
		case 'varietals' :
			$tabtext .= '<h2>' . __( 'Varietals', 'oenology' ) . '</h2>';
			$tabtext .= '<p>' . __( 'Varietals are the skins, or styles, applied to Oenology.', 'oenology' ) . '</h2>';
			
			$option_parameters = oenology_get_option_parameters();
			$oenology_varietals = $option_parameters['varietal']['valid_options'];
			foreach ( $oenology_varietals as $varietal ) {
				$tabtext .= '<dl>';
				$tabtext .= '<dt><strong>' . $varietal['title'] . '</strong></dt>';
				$tabtext .= '<dd>' . $varietal['description'] . '</dd>';
				$tabtext .= '</dl>';
			}
			break;
		case 'layout' :
			$tabtext .= '<h2>' . __( 'Layouts', 'oenology' ) . '</h2>';
			$tabtext .= '<p>' . __( 'Set default layouts for static pages, single blog posts, and blog post indexes.', 'oenology' ) . '</h2>';
			break;
		case 'general' :
			$tabtext .= '<h2>' . __( 'Header Options', 'oenology' ) . '</h2>';
			$tabtext .= '<h3>' . __( 'Header Nav Menu Position', 'oenology' ) . '</h3>';
			$tabtext .= '<p>';
			$tabtext .= __( 'The default location of the header navigation menu is above the site title/description.', 'oenology' ) . ' ';
			$tabtext .= __( 'Use this setting to display the header navigation menu below the site title/description.', 'oenology' );
			$tabtext .= '</p>';
			$tabtext .= '<h3>' . __( 'Header Nav Menu Depth', 'oenology' ) . '</h3>';
			$tabtext .= '<p>';
			$tabtext .= __( 'By default, the Header Nav Menu only displays top-level Pages.', 'oenology' ) . ' ';
			$tabtext .= __( 'Child Pages are displayed in the Sidebar Nav Menu when the Top-Level Page is displayed.', 'oenology' ) . ' ';
			$tabtext .= __( 'To change this setting:', 'oenology' );
			$tabtext .= '</p>';
			$tabtext .= '<ol>';
			$tabtext .= '<li><strong>' . __( 'One', 'oenology' ) . '</strong> ' . __( '(default) displays only the top-level Pages in the Header Nav Menu', 'oenology' ) . '</li>';
			$tabtext .= '<li><strong>' . __( 'Two', 'oenology' ) . '</strong> ' . __( 'displays the top-level Pages in the Header Nav Menu, and displays second-level Pages in a dropdown menu when the top-level Page is hovered.', 'oenology' ) . '</li>';
			$tabtext .= '<li><strong>' . __( 'Three', 'oenology' ) . '</strong> ' . __( 'displays the top-level Pages in the Header Nav Menu, displays second-level Pages in a dropdown menu when the top-level Page is hovered, and displays third-level Pages in a dropdown menu when the second-level Page is hovered.', 'oenology' ) . '</li>';
			$tabtext .= '</ol>';
			$tabtext .= '<h2>' . __( 'Footer Options', 'oenology' ) . '</h2>';
			$tabtext .= '<h3>' . __( 'Footer Credit', 'oenology' ) . '</h3>';
			$tabtext .= '<p>';
			$tabtext .= __( 'This setting controls the display of a footer credit link.', 'oenology' ) . ' ';
			$tabtext .= __( 'By default, no footer credit link is displayed.', 'oenology' ) . ' ';
			$tabtext .= __( 'You are under no obligation to display a credit link in the footer or anywhere else.', 'oenology' );
			$tabtext .= '</p>';
			break;
	}
	return $tabtext;
}
 
/**
 * Oenology Reference Contextual Help Content
 * 
 * Admin settings page contextual help markup
 * Separate file for ease of management
 */
function oenology_get_reference_contextual_help_text() {
	$tabtext = '';
	if ( isset ( $_GET['tab'] ) ) {
			$tab = $_GET['tab'];
	} else {
			$tab = 'general';
	}
	$tabtext = '';
	switch ( $tab ) {
		case 'general' :
			$tabtext .= __( 'General Theme notes.', 'oenology' );
			break;
		case 'faq' :
			$tabtext .= __( 'Answers to questions frequently (or not-so-frequently) asked.', 'oenology' );
			break;
		case 'coderef' :
			$tabtext .= __( 'A cross-reference of every WordPress function, hook, and global variable used in the Theme.', 'oenology' );
			break;
		case 'changelog' :
			$tabtext .= __( 'Log of changes to the Theme.', 'oenology' );
			break;
		case 'license' :
			$tabtext .= __( 'License information for the Theme and any bundled resources, such as fonts and icon image files.', 'oenology' );
			break;
		case 'support' :
			$tabtext .= __( 'Support options and links for the Theme.', 'oenology' );
			break;
	}
	return $tabtext;
}
?>