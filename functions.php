<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom Widgets, custom hooks, and Theme settings.
 * 
 * For ease of understanding the different functionality and
 * purpose of all the functions, this file is split into several
 * sub-files, each of which is called below. Refer to each
 * sub-file for documentation of each included function.
 * 
 * To facilitate creation of Child Themes for Oenology, these
 * sub-files are included via get_template_directory(), rather
 * than get_stylesheet_directory(). Using get_template_directory()
 * ensures that WordPress will always search the template, i.e.
 * Parent Theme, directory for these files. Thus, they do not
 * need to be copied to the Child Theme in order to work. Also,
 * this allows Child Themes to create their own custom functions,
 * Widgets, options, hooks, etc., that work alongside those
 * provided here.
 * 
 * @uses 		include()
 * @uses		get_template_directory()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

/**
 * Include the Theme Custom Functions File
 * 
 * custom.php includes all of the Theme's custom functions
 * - 404 error handling
 * - Current page context
 * - Custom footer copyright notice
 * - Gallery image links and metadata handling
 * - Infobar Navigation
 * - Navigation breadcrumb
 * - Paginate Archive Index Page links
 */
require( get_template_directory() . '/functions/custom.php' );

/**
 * Include the Theme Setup Function File
 * 
 * theme-setup.php includes all of the various Theme setup:
 * add_theme_support()
 * $content_width
 * Define custom image sizes, custom headers, nav menus
 */
require( get_template_directory() . '/functions/theme-setup.php' );

/**
 * Include the WordPress Hooks Function File
 * 
 * wordpress-hooks.php includes all of the functions 
 * hook into core WordPress action/filter hooks:
 * - filter get_comments_number
 * - filter the_title
 * - filter wp_enqueue_scripts
 * - filter wp_title
 * - filter wp_list_categories
 */
require( get_template_directory() . '/functions/wordpress-hooks.php' );

/**
 * Include the Widgets Functions File
 * 
 * widgets.php includes the Theme's Widgetized sidebars and custom Widgets
 * - register_sidebar
 * - define custom widgets
 * - register_widget
 */
require( get_template_directory() . '/functions/widgets.php' );

/**
 * Include the Theme Options Function File
 * 
 * options.php includes the Theme options and Admin Settings page
 * - Define default Theme Options
 * - Register/Initialize Theme Options
 * - Admin Settings Page
 * - Contextual Help
 */
require( get_template_directory() . '/functions/options.php' );

/**
 * Include the Theme Options Theme Customizer Function File
 * 
 * options-customizer.php includes the functions required to 
 * integrate the Theme options into the WordPress Theme
 * Customizer.
 */
require( get_template_directory() . '/functions/options-customizer.php' );

/**
 * Include Theme Hooks Alliance Hooks
 *
 * @link 	https://github.com/zamoose/themehookalliance
 * 
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 */
require( get_template_directory() . '/tha/tha-theme-hooks.php' );

/**
 * Include the Theme Custom Hooks Function File
 * 
 * hooks.php includes the Theme's custom hooks
 */
require( get_template_directory() . '/functions/hooks.php' );

/**
 * Include the Post Custom Metadata Function File
 * 
 * - post-custom-meta.php includes the Theme custom metadata functions
 */
require( get_template_directory() . '/functions/post-custom-meta.php' );

/**
 * Include the Theme Contextual Help Function File
 * 
 * - contextual-help.php includes the Theme Contextual Help content
 */
require( get_template_directory() . '/functions/contextual-help.php' );

/**
 * Include the Dynamic Style/Script Function File
 * 
 * - dynamic-css.php includes the Theme Dynamic Style/Script content
 */
require( get_template_directory() . '/functions/dynamic-css.php' );

/**
 * Include custom bbPress filters
 */
if ( function_exists( 'is_bbpress' ) ) {
	require( get_template_directory() . '/bbpress/bbpress-functions.php' );
}

?>