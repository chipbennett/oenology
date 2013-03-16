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
 * Enqueue #content img max-width
 * 
 * Set the max-width CSS property for
 * images inside div#content, based on
 * the $content_width global variable.
 */
function oenology_enqueue_content_img_max_width() {
	global $content_width;
?>
<style type="text/css">
.post-entry img,
.post-entry .wp-caption {
	max-width: <?php echo $content_width; ?>px;
}
</style>
<?php
}
// Enqueue Varietal Stylesheet at wp_print_styles
add_action( 'wp_print_styles', 'oenology_enqueue_content_img_max_width', 11 );

/**
 * Enqueue Footer Nav Menu Styles
 * 
 * If no menu is assigned to the nav-footer
 * Theme Location, then set the footer to
 * center-align content
 */
function oenology_enqueue_footer_nav_menu_style() {
	if ( has_nav_menu( 'nav-footer' ) ) {
	?>
<style type="text/css">
#footer {
	text-align: left;
}
</style>
	<?php
	}
}
add_action( 'wp_print_styles', 'oenology_enqueue_footer_nav_menu_style', 11 );


/**
 * Enqueue Varietal Stylesheet
 * 
 * @uses	oenology_get_options()			Defined in functions/options.php
 * @uses	oenology_get_color_scheme()		Defined in functions/custom.php
 * @uses	oenology_locate_template_uri()	Defined in functions/custom.php
 */
function oenology_enqueue_varietal_style() {

	// define varietal stylesheet
	global $oenology_options;
	$oenology_options = oenology_get_options();
	$color_scheme = oenology_get_color_scheme();
	if ( 'cuvee' != $color_scheme ) {
		$fonts_stylesheet = oenology_locate_template_uri( array( 'css/fonts.css' ), false, false );
		wp_enqueue_style( 'oenology-fonts', $fonts_stylesheet );
		$scheme_handle = 'oenology_' . $color_scheme . '_stylesheet';
		$scheme_stylesheet = oenology_locate_template_uri( array( 'varietals/' . $color_scheme . '.css' ), false, false );
		wp_enqueue_style( $scheme_handle, $scheme_stylesheet );
	}
	$varietal_handle = 'oenology_' . $oenology_options['varietal'] . '_stylesheet';
	$varietal_stylesheet = oenology_locate_template_uri( array( 'varietals/' . $oenology_options['varietal'] . '.css' ), false, false );
	
	wp_enqueue_style( $varietal_handle, $varietal_stylesheet );
}
// Enqueue Varietal Stylesheet at wp_print_styles
add_action('wp_enqueue_scripts', 'oenology_enqueue_varietal_style', 11 );


/**
 * Enqueue Header Nav Menu Styles
 * 
 * @uses	oenology_get_options()			Defined in functions/options.php
 */
function oenology_enqueue_header_nav_menu_style() {
	global $oenology_options;
	$oenology_options = oenology_get_options();
	$header_nav_menu_item_width = $oenology_options['header_nav_menu_item_width'];
	if ( 'fluid' == $header_nav_menu_item_width ) {
	?>
<style type="text/css">
.nav-header li a,
.nav-header li a:link,
.nav-header li a:visited,
.nav-header li a:hover,
.nav-header li a:active {
     width: auto; 
	 padding: 0px 10px;
}
#nav ul {
	width: auto;
}
#nav ul li a {
	width: auto;
	min-width: 100px;
}
#nav ul ul {
	width: auto;
}
</style>
	<?php
	}
}
add_action( 'wp_print_styles', 'oenology_enqueue_header_nav_menu_style', 11 );
?>