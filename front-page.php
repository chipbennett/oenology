<?php
/**
 * Front Page template file
 *
 * This file is the Front Page template file, used to display the site
 * Front Page, whether the Front Page is set to display a static Page
 * or the Blog Posts Index.
 * 
 * @link		http://codex.wordpress.org/Function_Reference/get_header 			get_header()
 * @link 		http://codex.wordpress.org/Function_Reference/get_footer 			get_footer()
 * @link 		http://codex.wordpress.org/Function_Reference/get_sidebar 			get_sidebar()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_part 	get_template_part()
 * @link 		http://codex.wordpress.org/Function_Reference/is_active_sidebar 	is_active_sidebar()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 2.0
 */
?>

<?php
/**
 * Include the header template part file
 * 
 * MUST come first. 
 * Calls the header PHP file. 
 * Used in all primary template pages
 * 
 * Codex reference: {@link: http://codex.wordpress.org/Function_Reference/get_header get_header}
 * 
 * Child Themes can replace this template part file globally, via "header.php",
 * or in the Front Page context only, via "header-front-page.php"
 */
get_header( 'front-page' );
?>

<!-- Begin Main (div#main) -->
<?php
/**
 * div#main contains the center column content of the three-column 
 * layout, and the left-column content of the two-column layout. 
 * Generally, this column contains the main content of the page 
 * (blog post/posts, page content, search results, etc.), and 
 * contains the WordPress "Loop". For other non-WordPress pages 
 * (or any page not containing the "Loop") the site structure 
 * can be kept consistent by replacing "loop.php" with whatever 
 * file (or static content) is desired.
 */
?>
<div id="main">
	<?php 
	/**
	 * Include the loop template part file
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
	 * via "loop.php", or in the Front Page context only, via 
	 * "loop-front-page.php"
	 */
	get_template_part( 'loop', 'front-page' ); 
	?>
</div>
<!-- End Main (div#main) -->
		
<?php 
/**
 * Include the sidebar template part file
 * 
 * Calls a sidebar template part file.
 * Used in all primary template pages, except static Pages.
 *
 * Codex reference: http://codex.wordpress.org/Function_Reference/get_sidebar
 * 
 * Child Themes can replace this template part file in the 
 * Front Page context, via "sidebar-front-page.php"
 */
get_sidebar( 'front-page' ); 
?>
	
<?php 
/**
 * Include the footer template part file
 * 
 * MUST come last. 
 * Calls the footer PHP file. 
 * Used in all primary template pages
 * 
 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_footer get_footer}
 * 
 * Child Themes can replace this template part file globally, via "footer.php",
 * or in the Front Page context only, via "footer-front-page.php"
 */
get_footer( 'front-page' );  
?>