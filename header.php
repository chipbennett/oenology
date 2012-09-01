<?php
/**
 * Header Template Part
 * 
 * Template part file that contains the HTML document head and 
 * opening HTML body elements, as well as the site header and 
 * "infobar".
 *
 * This file is called by all primary template pages
 * 
 * Child Themes can override this template part file globally,
 * via "header.php", or in a given specific context, via
 * "header-{context}.php". For example, to replace this
 * template part file on static Pages, a Child Theme would
 * include the file "header-page.php".
 * 
 * @uses 		oenology_get_context()			Defined in /functions/custom.php
 * @uses 		oenology_get_options()			Defined in /functions/options.php
 * @uses 		oenology_hook_extent_before()	Defined in /functions/hooks.php
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/bloginfo				bloginfo()
 * @link 		http://codex.wordpress.org/Function_Reference/body_class			body_class()
 * @link 		http://codex.wordpress.org/Function_Reference/get_option			get_option()
 * @link 		http://codex.wordpress.org/Function_Reference/get_stylesheet_uri	get_stylesheet_uri()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_part		get_template_part()
 * @link 		http://codex.wordpress.org/Function_Reference/is_front_page			is_front_page()
 * @link 		http://codex.wordpress.org/Function_Reference/is_page				is_page()
 * @link 		http://codex.wordpress.org/Function_Reference/language_attributes	language_attributes()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_head				wp_head()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_title				wp_title()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

/**
 * Global variable that contains the
 * Theme's options array.
 * 
 * @global array	$oenology_options
 */
global $oenology_options;
/**
 * Return a value from the wp_options database table
 * 
 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_option get_option}
 * 
 * Returns the value for a defined option in the WordPress wp-options 
 * database table. If the option does not exist, get_option() returns 
 * 'false', or the value passed via the $default parameter.
 * 
 * get_option() returns, but does not print/display, the value requested
 * 
 * @param	string	$show		database option to return
 * @param	string	$default	default value to return if null; default: false
 * @return	mixed				value of specified option
 */
$oenology_options = oenology_get_options();

?><!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php 
/**
 * Output language attributes for the <html> tag
 * 
 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/language_attributes language_attributes}
 * 
 * Added inside the HTML <html> tag, and outputs various HTML
 * language attributes, such as language and text-direction.
 * 
 * @param	null
 * @return	string	e.g. dir="ltr" lang="en-US"
 */
language_attributes(); 
?>>

<head profile="http://gmpg.org/xfn/11">
	<?php
	 ?>
	<meta http-equiv="Content-Type" content="<?php 
	/**
	 * Output the site HTML type
	 *
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/bloginfo bloginfo}
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_bloginfo get_bloginfo}
	 * 
	 * bloginfo() prints (displays/outputs) the data requested. 
	 * get_bloginfo() returns, rather than display/output, the data
	 * 
	 * The 'html_type' parameter is the document HTML type
	 *  - Defined on the General Settings page in the administration panel
	 *  - Usually "text/html"
	 *
	 * @param	string	$show	e.g. 'html_type'; default: none
	 * @return	string			e.g. "text/html"
	 */
	bloginfo( 'html_type' ); 
	?>; charset=<?php 
	/**
	 * Output the site HTML type
	 *
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/bloginfo bloginfo}
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_bloginfo get_bloginfo}
	 * 
	 * bloginfo() prints (displays/outputs) the data requested. 
	 * get_bloginfo() returns, rather than display/output, the data
	 * 
	 * The 'charset' parameter is the document character set
	 * 	- Defined in wp-config.php
	 *  - Usually "UTF-8"
	 *
	 * @param	string	$show	e.g. 'charset'; default: none
	 * @return	string			e.g. "UTF-8"
	 */
	bloginfo( 'charset' ); 
	?>" />

	<title><?php 
	/**
	 * Output HTML <title> tag content,
	 * based on current page context
	 * 
	 * Codex reference: {@link http://codex.wordpress.org/Template_Tags/wp_title wp_title}
	 * 
	 * Outputs HTML <title> tag content, including context-specific content, 
	 * such as the Post Title for single posts, the Date for date-based archive, 
	 * Category for category archive, etc.
	 * 
	 * This content can be filtered, via the 'wp_title' filter. Modifying output via this filter 
	 * rather than hard-coding output inside the <title> tags is the best-practice approach, as 
	 * this approach facilitates modification of the title content by Plugins (or by future core 
	 * changes). Oenology applies custom content using this filter, via the oenology_filter_wp_title() 
	 * function in \functions\wordpress-hooks.php.
	 * 
	 * @see		oenology_filter_wp_title()
	 * 
	 * @param	string	$sep			separator to use before/after Post Title; default: '&raquo;'
	 * @param	bool	$echo			whether to echo or return output; default: true
	 * @param	string	$seplocation	location of separator, left or right of Post Title; default: none (left)
	 * 
	 * @return	string
	 */
	wp_title( '&raquo;', true, 'right' ); 
	?></title>

	<link rel="stylesheet" href="<?php 
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
	echo get_stylesheet_uri(); 
	?>" type="text/css" media="all" />

	<?php 
	/**
	 * Fire the 'wp_head' action hook
	 * 
	 * Codex reference: {@link http://codex.wordpress.org/Hook_Reference/wp_head wp_head}
	 * 
	 * This hook is used by WordPress core, Themes, and Plugins to 
	 * add scripts, CSS styles, meta tags, etc. to the document head.
	 * 
	 * MUST come immediately before the closing </head> tag
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'wp_head'
	 */
	wp_head(); 
	?>
</head>
<!-- End HTML Header -->

<?php
/**
 * oenology_get_context()
 * 
 * Output HTML <body> tag CSS ID attribute content, 
 * based on current page context
 * 
 * @param	null
 * @return	string	current page context; default: "index"
 *
 * body_class()
 *
 * Output HTML <body> tag "class" attribute, 
 * based on current page context
 * 
 * @param	string|array	$class	additional classes to add; default: none
 * @return	string			list of classes
 */
?>
<body id="<?php echo oenology_get_context(); ?>" <?php body_class(); ?>> 

<!-- Begin Extent (div#extent) -->
<?php 
/**
 * div#extent contains all displayed content, 
 * including the site header, main content,
 * sidebars, and sitefooter.
 */
?>
<div id="extent"> 

	<?php 
	/**
	* Fire the 'oenology_hook_extent_before' custom action hook
	* 
	* @param	null
	* @return	mixed	any output hooked into 'oenology_hook_extent_before'
	*/
	oenology_hook_extent_before(); 
	?>

	<?php 
	/**
	 * Fire the 'oenology_hook_site_header_before' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_site_header_before'
	 */
	oenology_hook_site_header_before(); 
	?>

	<!-- Begin Header  (div#header)-->
	<?php
	/**
	 * div#header contains the Main Navigation Menu, 
	 * Blog Title and Blog description.
	 */
	?>
	<div id="header"> 
		
		<!-- Begin Blog Head -->
		<?php 
		/**
		 * Include the site-header Theme template part file
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
		 * via "site-header.php", or in a specific context only, via 
		 * "site-header-{context}.php"
		 */
		get_template_part( 'site-header', oenology_get_context() ); 
		?>
		<!-- End Blog Head -->
		
	</div>
	<!-- End Header (div#header) -->

	<?php 
	/**
	 * Fire the 'oenology_hook_site_header_after' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_site_header_after'
	 */
	oenology_hook_site_header_after(); 
	?>
	
	<!-- Begin Infobar (div#infobar) -->
	<?php
	/**
	 * div#infobar contains the site breadcrumb navigation,
	 * login/admin links, and search form.
	 */
	?>
	<div id="infobar">
		<?php 
		/**
		 * Include the infobar Theme template part file
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
		 * via "infobar.php", or in a specific context only, via 
		 * "infobar-{context}.php"
		 */
		get_template_part( 'infobar', oenology_get_context() ); 
		?>
	</div>
	<!-- End Infobar (div#infobar) -->

	<?php 
	/**
	 * Fire the 'oenology_hook_content_before' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_content_before'
	 */
	oenology_hook_content_before(); 
	?>

	<!-- Begin Content (div#content) -->
	<?php 
	/**
	 * div#content contains the site main content 
	 * (left column, center column, right column).
	 */
	?>
	<div id="content">