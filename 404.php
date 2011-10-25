<?php
/**
 * Error 404 Page template file
 *
 * This file is the Error 404 Page template file, which is output whenever
 * the server encounters a "404 - file not found" error.
 * 
 * @uses		oenology_hook_post_404()	Defined in /functions/hooks.php
 * 
 * @link		http://codex.wordpress.org/Function_Reference/get_header 	get_header()
 * @link 		http://codex.wordpress.org/Function_Reference/get_footer 	get_footer()
 * @link 		http://codex.wordpress.org/Function_Reference/get_sidebar 	get_sidebar()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
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
 * or in a specific context only, via "header-404.php"
 */
get_header( '404' );
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
		
	<div <?php 
	post_class(); 
	?>>	 
			
		<div class="post-title">
			<h1>Don't Panic</h1>				
		</div>
				
		<div class="post-entry">
			<?php
			/**
			 * Fire the 'oenology_hook_post_404' hook
			 *
			 * @return	mixed	any content hooked into 'oenology_hook_post_404'
			 */
			oenology_hook_post_404();
			?>				
		</div>

	</div>
			
</div>
<!-- End Main (div#main) -->

<?php 
/**
 * Include the sidebar template part file
 * 
 * Calls a sidebar template part file.
 * Used in all primary template pages, except static Pages.
 *
 * Codex reference: http: *codex.wordpress.org/Function_Reference/get_sidebar
 * 
 * Child Themes can replace this template part file globally, 
 * via "sidebar.php", or in the Error 404 Page context only, via
 * "sidebar-404.php"
 */
get_sidebar( '404' ); 
?>
	
<?php 
/**
 * Include the footer template part file
 * 
 * MUST come last. 
 * Calls the footer PHP file. 
 * Used in all primary template pages
 * 
 * Codex reference: {@link http: *codex.wordpress.org/Function_Reference/get_footer get_footer}
 * 
 * Child Themes can replace this template part file globally, via "footer.php",
 * or in a specific context only, via "footer-{context}.php"
 */
get_footer( '404' );  
?>