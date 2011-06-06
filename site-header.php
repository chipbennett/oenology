<?php
/**
 * Template part file that contains the site header content,
 * including main navigation menu, site title, and site description
 *
 * This file is called by all primary template pages
 * 
 * @uses		get_template_part()
 * @uses		oenology_hook_site_header()
 * @uses		oenology_hook_site_header_after()
 * @uses		oenology_hook_site_header_before()
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
if ( 'above' == $oenology_options['header_nav_menu_position'] ) {
	// site-navigation.php contains the main navigation menu. 
	get_template_part('site-navigation');  
}
?>
<div id="site-header-text">

	<?php oenology_hook_site_header_before(); ?>

	<?php oenology_hook_site_header(); ?>

	<?php oenology_hook_site_header_after(); ?>

</div>
<?php 
if ( 'below' == $oenology_options['header_nav_menu_position'] ) { 
	// site-navigation.php contains the main navigation menu.
	get_template_part('site-navigation');  
} 
?>

<?php /*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
bloginfo()
----------------------------------
bloginfo() is a WordPress template tag.  
Codex reference: http://codex.wordpress.org/Bloginfo

bloginfo() can be used to print several useful WordPress-related parameters. For example:

	description =  (blog description, as defined on the General Settings page in the administration panel)
	name =  (blog name, as defined on the General Settings page in the administration panel)
	
For the full list of parameters returned by bloginfo(), see the Codex.

bloginfo() prints (displays/outputs) the data requested. To get, but not display/output the data, use get_bloginfo() instead.

***********************
get_template_part()
----------------------------------
get_template_part() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_template_part

get_template_part() is used to include a Theme template file within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_template_part( $file ) will attempt to include file.php. The function will attempt to 
include files in the following order, until it finds one that exists:
 - the Theme's file.php
 - the parent theme's file.php

get_template_part( $file , $foo ) will attempt to include file-foo.php. The function will
attempt to include files in the following order, until it finds one that exists:
 - the Theme's file-foo.php
 - the Theme's file.php
 - the parent theme's file-foo.php
 - the parent theme-s file.php

=============================================================================	
*/ ?>