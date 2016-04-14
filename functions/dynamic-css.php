<?php
/**
 * Oenology Dynamic Styles and Scripts
 *
 * This file defines the dynamic styles and
 * scripts that are output in the front and
 * back end.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 2.3
 */


/**
 * Enqueue Custom Admin Page Stylesheet
 */
function oenology_enqueue_admin_style() {

	// define admin stylesheet
	$admin_handle = 'oenology_admin_stylesheet';
	$admin_stylesheet = get_template_directory_uri() . '/css/oenology-admin.css';
	
	wp_enqueue_style( $admin_handle, $admin_stylesheet, '', false );
}
// Enqueue Admin Stylesheet at admin_print_styles()
add_action( 'admin_print_styles-appearance_page_oenology-settings', 'oenology_enqueue_admin_style', 11 );


/**
 * Enqueue main style sheet
 * 
 * Enqueue main style sheet, in order to append dynamic styles
 * 
 * @uses	oenology_get_options()			Defined in functions/options.php
 * @uses	oenology_get_color_scheme()		Defined in functions/custom.php
 * @uses	oenology_locate_template_uri()	Defined in functions/custom.php
 */
function oenology_enqueue_front_end_stylesheets() {
	// Fetch Theme options
	global $oenology_options;
	$oenology_options = oenology_get_options();
	// Add main stylesheet
	wp_enqueue_style( 
		// Stylesheet handle
		'oenology-main', 		 
		/**
		 * Return the URL for the default stylesheet
		 * 
		 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_stylesheet_uri get_stylesheet_uri}
		 * 
		 * Returns the value for the URI of the Theme default style sheet (style.css).
		 * 
		 * @param	null 
		 * @return	string	URL of default stylesheet
		 */
		get_stylesheet_uri() 
	);
	/**
	 * Add dynmamic image max width style
	 * 
	 * Set the max-width CSS property for
	 * images inside div#content, based on
	 * the $content_width global variable.
	 */
	global $content_width;
	$content_img_max_width = '.post-entry img, .post-entry .wp-caption { max-width: ' . $content_width . 'px; }';
	wp_add_inline_style( 'oenology-main', $content_img_max_width );
	/**
	 * Add footer nav style
	 * 
	 * If no menu is assigned to the nav-footer
	 * Theme Location, then set the footer to
	 * center-align content
	 */
	if ( has_nav_menu( 'nav-footer' ) ) {
		$footer_nav_menu = '#footer { text-align: left; }';
		wp_add_inline_style( 'oenology-main', $footer_nav_menu );
	}
	/** 
	 * Add header nav style
	 */
	if ( 'fluid' == $oenology_options['header_nav_menu_item_width'] ) {
		$header_nav_menu = '.nav-header li a, .nav-header li a:link, .nav-header li a:visited, .nav-header li a:hover, .nav-header li a:active { width: auto; padding: 0px 10px; }';
		$header_nav_menu .= '#nav ul { width: auto; }';
		$header_nav_menu .= '#nav ul li a { width: auto; min-width: 100px; }';
		$header_nav_menu .= '#nav ul ul { width: auto; }';
		wp_add_inline_style( 'oenology-main', $header_nav_menu );

		/**
		 * Add fonts
		 */
		wp_enqueue_style( 
			'oenology-fonts', 
			oenology_locate_template_uri( array( 'css/fonts.css' ), false, false ) 
		);
	}

	// Fetch color scheme
	$color_scheme = oenology_get_color_scheme();

	/**
	 * Only add font and dark/light color scheme stylesheets
	 * if the Cuvee (blank) varietal is not selected
	 */
	if ( 'cuvee' != $color_scheme ) {

		/**
		 * Add font color scheme
		 */
		wp_enqueue_style( 
			// Handle
			'oenology_' . $color_scheme . '_stylesheet', 
			// URL
			oenology_locate_template_uri( array( 'varietals/' . $color_scheme . '.css' ), false, false ) 
		);
	}

	/**
	 * Enqueue varietal stylesheet
	 */
	$varietal_stylesheet = oenology_locate_template_uri( array( 'varietals/' . $oenology_options['varietal'] . '.css' ), false, false );
	
	wp_enqueue_style( 'oenology_' . $oenology_options['varietal'] . '_stylesheet', $varietal_stylesheet );
}
add_action( 'wp_enqueue_scripts', 'oenology_enqueue_front_end_stylesheets' );
?>