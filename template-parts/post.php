<?php
/**
 * Template part file that contains the default Post content,
 * including Post header, Post entry, and Post footer
 *
 * This file is called by all primary template pages
 * 
 * @uses		oenology_get_context()	Defined in /functions/custom.php
 * 
 * @link		http://codex.wordpress.org/Function_Reference/get_option		get_option()
 * @link		http://codex.wordpress.org/Function_Reference/get_template_part	get_template_part()
 * @link 		http://codex.wordpress.org/Function_Reference/is_front_page		is_front_page()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

// don't display Post Title on Front Page.
if ( 
// WordPress conditional tag that returns true if the current page is the Front Page.
   ! is_front_page() 
|| 'posts' == get_option( 'show_on_front' )
) {
	?>
	<div class="post-title">
		<?php 
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
		 * via "post-header.php", or in a specific context only, via 
		 * "post-header-{context}.php".
		 */
		get_template_part( 'template-parts/post-header', oenology_get_context() );  
		?>
	</div>
	<?php
} 
?>

<div class="post-entry">
	<?php 
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
	 * via "post-entry.php", or in a specific context only, via 
	 * "post-entry-{context}.php".
	 */
	get_template_part( 'template-parts/post-entry', oenology_get_context() );
	?>
</div>

<div class="post-footer">
	<?php 
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
	 * via "post-footer.php", or in a specific context only, via 
	 * "post-footer-{context}.php".
	 */
	get_template_part( 'template-parts/post-footer', oenology_get_context() ); 
	?>
</div>