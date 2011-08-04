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
	switch ( $tab ) {
			case 'general' :
				$tabtext = oenology_get_contextual_help_options_general();
				break;
			case 'varietals' :
				$tabtext = oenology_get_contextual_help_options_varietals();
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
	switch ( $tab ) {
			case 'general' :
				$tabtext .= "General Theme notes";
				break;
			case 'faq' :
				$tabtext .= "Answers to questions frequently (or not-so-frequently) asked";
				break;
			case 'coderef' :
				$tabtext .= "A cross-reference of every WordPress function, hook, and global variable used in the Theme";
				break;
			case 'changelog' :
				$tabtext .= "Log of changes to the Theme";
				break;
	}
	return $tabtext;
}

function oenology_get_contextual_help_options_general() {

	$tabtext = '';
	$tabtext .= <<<EOT
	<h2>Header Options</h2>
	<h3>Header Nav Menu Position</h3>
	<p>The default location of the header navigation menu is above the site title/description. Use this setting to 
	display the header navigation menu below the site title/description.</p>
	<h3>Header Nav Menu Depth</h3>
	<p>By default, the Header Nav Menu only displays top-level Pages. Child Pages are displayed in the Sidebar Nav 
	Menu when the Top-Level Page is displayed. To change this setting:</p>
	<ol>
	<li><strong>One</strong> (default) displays only the top-level Pages in the Header Nav Menu</li>
	<li><strong>Two</strong> displays the top-level Pages in the Header Nav Menu, and displays second-level
	Pages in a dropdown menu when the top-level Page is hovered.</li>
	<li><strong>Three</strong> displays the top-level Pages in the Header Nav Menu, displays second-level
	Pages in a dropdown menu when the top-level Page is hovered, and displays third-level Pages in a dropdown menu 
	when the second-level Page is hovered.</li>
	</ol>
	<h2>Footer Options</h2>
	<h3>Footer Credit</h3>
	<p>This setting controls the display of a footer credit link. By default, no footer credit link is displayed. You 
	are under no obligation to display a credit link in the footer or anywhere else.</p>
EOT;
	return $tabtext;
}

function oenology_get_contextual_help_options_varietals() {

	$tabtext = '';
	$tabtext .= <<<EOT
	<h2>Varietals</h2>
	<p><em>Varietals</em> are the <em>skins</em>, or styles, applied to Oenology.</p>
EOT;
	$option_parameters = oenology_get_option_parameters();
	$oenology_varietals = $option_parameters['varietal']['valid_options'];
    foreach ( $oenology_varietals as $varietal ) {
	    $tabtext .= <<<EOT
		<dl>
		<dt><strong>{$varietal['title']}</strong></dt>
		<dd>{$varietal['description']}</dd>
		</dl>
EOT;
	}
	return $tabtext;
}
?>