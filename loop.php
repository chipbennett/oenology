<?php
/**
 * Template part file that contains the WordPress Loop
 *
 * Contains Loop header, Loop content, and Loop footer.
 * 
 * @uses 		oenology_get_context()				Defined in /functions/custom.php
 * @uses 		oenology_hook_loop_footer_after()	Defined in /functions/hooks.php
 * @uses 		oenology_hook_loop_footer_before()	Defined in /functions/hooks.php
 * @uses 		oenology_hook_loop_header_after()	Defined in /functions/hooks.php
 * @uses 		oenology_hook_loop_header_before()	Defined in /functions/hooks.php
 * @uses 		oenology_hook_loop_no_posts()		Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_after()			Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_before()			Defined in /functions/hooks.php
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/comments_open 			comments_open()
 * @link 		http://codex.wordpress.org/Function_Reference/comments_template 		comments_template()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_part 		get_template_part()
 * @link 		http://codex.wordpress.org/Function_Reference/have_posts 				have_posts()
 * @link 		http://codex.wordpress.org/Function_Reference/get_post_format 			get_post_format()
 * @link 		http://codex.wordpress.org/Function_Reference/is_page 					is_page()
 * @link 		http://codex.wordpress.org/Function_Reference/is_single 				is_single()
 * @link 		http://codex.wordpress.org/Function_Reference/post_class 				post_class()
 * @link 		http://codex.wordpress.org/Function_Reference/post_password_required 	post_password_required()
 * @link 		http://codex.wordpress.org/Function_Reference/the_post 					the_post()
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
 * @todo	convert Loop Header to filter hook
 */
?>
<!-- Begin Loop Header (div#loop-header) -->
<div id="loop-header">

	<?php 
	/**
	 * Fire the 'oenology_hook_loop_header_before' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_loop_header_before'
	 */
	oenology_hook_loop_header_before(); 
	?>

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
	 * via "loop-header.php", or in a specific context only, via 
	 * "loop-header-{context}.php"
	 */
	get_template_part( 'loop-header', oenology_get_context() ); 
	?>

	<?php 
	/**
	 * Fire the 'oenology_hook_loop_header_after' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_loop_header_after'
	 */
	oenology_hook_loop_header_after(); 
	?>

</div>
<!-- End Loop Header (div#loop-header) -->

<?php 
//
//
if ( 
/**
 * WordPress conditional tag that returns true if
 * the current query has results
 */
have_posts() 
) { 
	while ( 
	 /**
	 * WordPress conditional tag that returns true if
	 * the current query has results
	 */
	have_posts() 
	) { 
		/**
		 * Output the content of the current Post within the Loop
		 * 
		 * Codex reference: {http://codex.wordpress.org/User:Jefte/the_post the_post}
		 */
		the_post(); 
		?>
	
		<?php 
		/**
			* Fire the 'oenology_hook_post_before' custom action hook
			* 
			* @param	null
			* @return	mixed	any output hooked into 'oenology_hook_post_before' 
			*/
		oenology_hook_post_before(); 
		?> 

		<div <?php 
		/**
		 * Output "class" attribute, 
		 * based on current Post context
		 * 
		 * Codex reference: {@link http://codex.wordpress.org/Template_Tags/post_class post_class}
		 * 
		 * @param	string|array	$class	additional classes to add; default: none
		 * @return	string			list of classes
		 */
		post_class(); 
		?>>
	
			<?php 
			/**
			 * Fire the 'oenology_hook_post_top' custom action hook
			 * 
			 * @param	null
			 * @return	mixed	any output hooked into 'oenology_hook_post_top' 
			 */
			oenology_hook_post_top(); 
			?> 
		
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
			 * via "post-{format}.php"
			 */
			get_template_part( 'post', get_post_format() );
			?>
			<?php
			/**
			 * Output a dynamic sidebar
			 * 
			 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/dynamic_sidebar}
			 * 
			 * Outputs the specified dynamic sidebar. A dynamic sidebar 
			 * is used to output Widgets as specified by the user.
			 */
			dynamic_sidebar( 'post-below' );
			?>
		
			<?php 
			/**
			 * Fire the 'oenology_hook_post_bottom' custom action hook
			 * 
			 * @param	null
			 * @return	mixed	any output hooked into 'oenology_hook_post_bottom'
			 */
			oenology_hook_post_bottom(); 
			?> 

		</div>
		
		<?php 
		/**
			* Fire the 'oenology_hook_post_after' custom action hook
			* 
			* @param	null
			* @return	mixed	any output hooked into 'oenology_hook_post_after'
			*/
		oenology_hook_post_after(); 
			?> 

	
		<?php 
		/**
		 * Only display the comments template when displaying a
		 * Single Blog Post or a Page with comments open, and 
		 * only if the Post or Page is not password-protected
		 */
		if ( 
			/**
			 * WordPress conditional tag that returns true if
			 * the current Post is password-protected
			 */
			! post_password_required() 
		&& ( 
				/**
				 * WordPress conditional tag that returns true if
				 * the current page is a Single Blog Post
				 */
				is_single() 
			|| ( 
				/**
				 * WordPress conditional tag that returns true if
				 * the current page is a static Page
				 */
					is_page() 
				/**
				 * WordPress conditional tag that returns true if
				 * comments are open for the current Post
				 */
				&& comments_open() 
				) 
			) 
		) {
			/**
			 * Output the comments template
			 */
			comments_template( '', true );
		}

	} 
	 // endwhile have_posts()
}
// Else, if there are no Posts
else {
	/**
	 * Fire the 'oenology_hook_loop_no_posts' hook
	 *
	 * @return	mixed	any content hooked into 'oenology_hook_loop_no_posts'
	 */
	oenology_hook_loop_no_posts(); 
} 
// endif have_posts()
?>

<!-- Begin Loop Footer (div#loop-footer) -->
<div id="loop-footer">

	<?php 
	/**
	 * Fire the 'oenology_hook_loop_footer_before' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_loop_footer_before'
	 */
	oenology_hook_loop_footer_before(); 
	?>

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
	 * via "loop-footer.php", or in a specific context only, via 
	 * "loop-footer-{context}.php"
	 */
	get_template_part( 'loop-footer', oenology_get_context() );
	?> 

	<?php 
	/**
	 * Fire the 'oenology_hook_loop_footer_after' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_loop_footer_after'
	 */
	oenology_hook_loop_footer_after(); 
	?>

</div>
<!-- End Loop Footer (div#loop-footer) -->