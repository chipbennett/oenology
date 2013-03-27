<?php
/**
 * bbPress Forum Archive template file
 *
 * This file is used to display the bbPress forums archive
 * index page.
 *
 * @uses 		oenology_get_context()	Defined in /functions/custom.php
 * 
 * @link		http://codex.wordpress.org/Function_Reference/get_header 			get_header()
 * @link 		http://codex.wordpress.org/Function_Reference/get_footer 			get_footer()
 * @link 		http://codex.wordpress.org/Function_Reference/get_sidebar 			get_sidebar()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_part 	get_template_part()
 * @link 		http://codex.wordpress.org/Function_Reference/has_post_format 		has_post_format()
 * @link 		http://codex.wordpress.org/Function_Reference/is_active_sidebar 	is_active_sidebar()
 * @link 		http://codex.wordpress.org/Function_Reference/is_archive 			is_archive()
 * @link 		http://codex.wordpress.org/Function_Reference/is_attachment 		is_attachment()
 * @link 		http://codex.wordpress.org/Function_Reference/is_home 				is_home()
 * @link 		http://codex.wordpress.org/Function_Reference/is_single 			is_single()
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
 * @see {@link: http://codex.wordpress.org/Function_Reference/get_header get_header}
 * 
 * Child Themes can replace this template part file globally, via "header.php",
 * or in a specific context only, via "header-{context}.php"
 */
get_header( oenology_get_context() );
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

	<?php do_action( 'bbp_before_main_content' ); ?>

	<?php do_action( 'bbp_template_notices' ); ?>

	<div id="forum-front" class="bbp-forum-front">
		<h2 class="pagetitle"><?php bbp_forum_archive_title(); ?></h2>
		<div class="entry-content">

			<?php bbp_get_template_part( 'content', 'archive-forum' ); ?>

		</div>
	</div><!-- #forum-front -->

	<?php do_action( 'bbp_after_main_content' ); ?>
	
</div>
<!-- End Main (div#main) -->
	
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
 * or in a specific context only, via "footer-{context}.php"
 */
get_footer( oenology_get_context() );  
?>