<?php
/**
 * Template part file that contains the Post entry
 *
 * Contains Loop header, Loop content, and Loop footer.
 * 
 * @uses 		oenology_hook_post_entry_after()	Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_entry_before()	Defined in /functions/hooks.php
 * 
 * @link		http://codex.wordpress.org/Function_Reference/dynamic_sidebar			dynamic_sidebar()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_part			get_template_part()
 * @link 		http://codex.wordpress.org/Function_Reference/is_post_type_archive		is_post_type_archive()
 * @link 		http://codex.wordpress.org/Function_Reference/is_search					is_search()
 * @link 		http://codex.wordpress.org/Function_Reference/the_content				the_content()
 * @link 		http://codex.wordpress.org/Function_Reference/the_excerpt				the_excerpt()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_attachment_is_image	wp_attachment_is_image()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_link_pages				wp_link_pages()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?>
<?php 
// Fire the 'oenology_hook_post_entry_before' custom action hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_entry_before'
oenology_hook_post_entry_before(); 
?>
<!-- Post Entry Begin -->
<?php 
// only display the full post content on 
// the blog home page, single blog posts, 
// and static Pages
if ( 
	( 
// WordPress conditional tag that returns true if
// the current page is a blog posts archive index page
	is_post_type_archive( 'post' ) 
// WordPress conditional tag that returns true if
// the current page is a search results page
	|| is_search() 
	) 
// WordPress conditional tag that returns true if
// the current page has an image mime-type attachment
&& ! wp_attachment_is_image()
// WordPress template tag that returns the post format
// type of the current post, as a string, or FALSE iff 
// the current post does not have a post format assigned.
// Here, get_post_format() is used rather than
// has_post_format(), because has_post_format() requires 
// a post format to be passed as a parameter, rendering
// it unsuitable for use to determine if the post has
// *any* post format assigned.
&& ! get_post_format() 
) {
	// Output the Post Excerpt
	//
	// Codex reference: {@link http://codex.wordpress.org/Function_Reference/the_excerpt}
	the_excerpt();
}
// for image Attachment Pages, display custom template
else if ( 
// WordPress conditional tag that returns true if
// the current page has an image mime-type attachment
wp_attachment_is_image() 
) {
	// Include the specified Theme template part file
	// 
	// Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_template_part get_template_part}
	// 
	// get_template_part( $slug ) will attempt to include $slug.php. 
	// The function will attempt to include files in the following 
	// order, until it finds one that exists: the Theme's $slug.php, 
	// the parent Theme's $slug.php
	// 
	// get_template_part( $slug , $name ) will attempt to include 
	// $slug-$name.php. The function will attempt to include files 
	// in the following order, until it finds one that exists: the 
	// Theme's $slug-$name.php, the Theme's $slug.php, the parent 
	// Theme's $slug-$name.php, the parent Theme's $slug.php
	// 
	// Child Themes can replace this template part file globally, 
	// via "post-entry-image.php"
	get_template_part( 'post-entry-image' );
}
// for all other contexts, display full Post content
else {
	// Output the Post Content
	// 
	// Codex reference: {@link http://codex.wordpress.org/Function_Reference/the_content the_content}
	//
	// @param	string	$more_link_text	text to use for the "More" link; default: '(more...)'
	// @param	bool	$strip_teaser	strip text prior to "More" link on Single Post view; default: true
	the_content('Read the rest of this entry &raquo;'); 
	// Output the post pagination links
	// if current post is paginated
	// 
	// Codex reference: {@link http://codex.wordpress.org/Function_Reference/wp_link_pages wp_link_pages}
	wp_link_pages( array(
		// Apply class="link-pages" to the default <p> tag
		'before' => '<p class="link-pages">Page: ' 
	) ); 
}
?>
<!-- Post Entry End -->
<?php
// Widgetized sidebar 'post-content-below'
dynamic_sidebar( 'post-entry-below' );
?>

<?php 
// Fire the 'oenology_hook_post_entry_after' custom action hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_entry_after'
oenology_hook_post_entry_after(); 
?>