<?php
/**
 * Template part file that contains the site header content,
 * including main navigation menu, site title, and site description
 *
 * This file is called by all primary template pages
 * 
 * @uses		oenology_get_context()				Defined in /functions/custom.php
 * @uses		oenology_hook_site_header()			Defined in /functions/hooks.php
 * @uses		oenology_hook_site_header_after()	Defined in /functions/hooks.php
 * @uses		oenology_hook_site_header_before()	Defined in /functions/hooks.php
 * 
 * @link		http://codex.wordpress.org/Function_Reference/get_template_part	get_template_part()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?>
<?php global $oenology_options; ?>

<?php
if ( 
// site-navigation.php contains the main navigation menu. 
'above' == $oenology_options['header_nav_menu_position'] 
) {
	/**
	 * Include the specified Theme template part file
	 * 
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_template_part get_template_part}
	 * 
	 * get_template_part( $slug ) will attempt to include $slug.php. 
	 * The function will attempt to include files in the following 
	 * order, until it finds one that exists: the Theme's $slug.php, 
	 * the parent Theme's $slug.php
	 * 
	 * get_template_part( $slug , $name ) will attempt to include 
	 * $slug-$name.php. The function will attempt to include files 
	 * in the following order, until it finds one that exists: the 
	 * Theme's $slug-$name.php, the Theme's $slug.php, the parent 
	 * Theme's $slug-$name.php, the parent Theme's $slug.php
	 * 
	 * Child Themes can replace this template part file globally, 
	 * via "site-navigation.php", or in a specific context only, via 
	 * "site-navigation-{context}.php"
	 */
	get_template_part( 'site-navigation', oenology_get_context() );  
}
?>
<div id="site-header-text">

	<?php 
	/**
	 * Fire the 'oenology_hook_site_header_text_before' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_site_header_text_before'
	 */
	oenology_hook_site_header_text_before(); 
	?>

	<?php 
	/**
	 * Fire the 'oenology_hook_site_header' custom filter hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_site_header'
	 */
	oenology_hook_site_header(); 
	?>

	<?php 
	/**
	 * Fire the 'oenology_hook_site_header_text_after' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_site_header_text_after'
	 */
	oenology_hook_site_header_text_after(); 
	?>

</div>
<?php 
if ( 
// site-navigation.php contains the main navigation menu.
'below' == $oenology_options['header_nav_menu_position'] 
) { 	
	/**
	 * Include the specified Theme template part file
	 * 
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_template_part get_template_part}
	 * 
	 * get_template_part( $slug ) will attempt to include $slug.php. 
	 * The function will attempt to include files in the following 
	 * order, until it finds one that exists: the Theme's $slug.php, 
	 * the parent Theme's $slug.php
	 * 
	 * get_template_part( $slug , $name ) will attempt to include 
	 * $slug-$name.php. The function will attempt to include files 
	 * in the following order, until it finds one that exists: the 
	 * Theme's $slug-$name.php, the Theme's $slug.php, the parent 
	 * Theme's $slug-$name.php, the parent Theme's $slug.php
	 * 
	 * Child Themes can replace this template part file globally, 
	 * via "site-navigation.php", or in a specific context only, via 
	 * "site-navigation-{context}.php"
	 */
	get_template_part('site-navigation');  
} 
?>