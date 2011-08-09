<?php
/**
 * Oenology Theme Reference
 *
 * This file defines the Reference for the Oenology Theme.
 * 
 * Theme Reference
 * 
 *  - General Theme Reference
 *  - Frequently Asked Questions (FAQ)
 *  - Code Reference
 *  - Change Log
 *  - License
 *  - Support
 * 
 * @uses	oenology_get_settings_page_cap()	defined in \functions\wordpress-hooks.php
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

/**
 * Setup the Theme Admin Reference Page
 * 
 * @uses	add_theme_page()
 */
function oenology_menu_reference() {
	add_theme_page( 
		// $page_title
		// Name displayed in HTML title tag
		__( 'Oenology Reference', 'oenology' ), 
		// $menu_title
		// Name displayed in the Admin Menu
		__( 'Oenology Reference', 'oenology' ), 
		// $capability
		// User capability required to access page
		oenology_get_settings_page_cap(), 
		// $menu_slug
		// String to append to URL after "themes.php"
		'oenology-reference', 
		// $callback
		// Function to define reference page markup
		'oenology_admin_reference_page' 
	);
}
// Hook the Admin Reference page into 'admin_menu'
add_action( 'admin_menu', 'oenology_menu_reference' );


/**
 * Oenology Theme Reference Page Markup
 * 
 * @uses	oenology_get_page_tab_markup()	defined in \functions\custom.php
 */
function oenology_admin_reference_page() { ?>

	<div class="wrap">
		<?php
		// Output the Reference Page tabs
		oenology_get_page_tab_markup();
		// Output the Reference page content.
		// This content is output per-tab.
		require( get_template_directory() . '/functions/reference-content.php' );
		?>
		
	</div>
<?php 
}

/**
 * Oenology Theme Admin Reference Page Tabs
 * 
 * Array that holds all of the tabs for the
 * Oenology Theme Reference Page. 
 * 
 * The Reference page does not include a 
 * settings form, so this array only defines 
 * the name (slug) and title for each tab.
 * 
 * @return	array	$tabs	array of arrays of tab parameters
 */
function oenology_get_reference_page_tabs() {
	
	$tabs = array( 
        'general' => array(
			'name' => 'general',
			'title' => __( 'General', 'oenology' )
		),
        'faq' => array(
			'name' => 'faq',
			'title' => __( 'FAQ', 'oenology' )
		),
        'coderef' => array(
			'name' => 'coderef',
			'title' => __( 'Code Reference', 'oenology' )
		),
		'changelog' => array(
			'name' => 'changelog',
			'title' => __( 'Changelog', 'oenology' )
		),
		'license' => array(
			'name' => 'license',
			'title' => __( 'License', 'oenology' )
		),
		'support' => array(
			'name' => 'support',
			'title' => __( 'Support', 'oenology' )
		)
    );
	return $tabs;
}
?>