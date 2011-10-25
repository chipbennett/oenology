<?php
/**
 * Template part file that contains the Gallery Post content,
 * including Post title, Post entry and Post footer
 *
 * This file is called by Posts with the "Gallery" Post Format
 * 
 * @uses		oenology_get_context()					Defined in /functions/custom.php
 * @uses		oenology_hook_post_entry_after()		Defined in /functions/hooks.php
 * @uses		oenology_hook_post_entry_before()		Defined in /functions/hooks.php
 * @uses		oenology_hook_post_header_metadata()	Defined in /functions/hooks.php
 * @uses		oenology_hook_post_header_taxonomies()	Defined in /functions/hooks.php
 * @uses		oenology_hook_post_header_title()		Defined in /functions/hooks.php
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
<?php 
if ( is_single() ) { 
	?>
	<div class="post-title">
		<?php 
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
		// via "post-header.php", or in a specific context only, via 
		// "post-header-{context}.php"
		get_template_part( 'post-header', oenology_get_context() );
		?>
	</div>
	<?php 
} 
?>

<div class="post-entry">

	<?php 
	// Fire the 'oenology_hook_post_entry_before' custom action hook
	// 
	// @param	null
	// @return	mixed	any output hooked into 'oenology_hook_post_entry_before'
	oenology_hook_post_entry_before(); 
	?>

	<!-- Post Entry Begin -->
	<?php 
	if ( is_single() || post_password_required() ) {
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
	} else {
		
		$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
		if ( $images ) {
			$total_images = count( $images );
			$image = array_shift( $images );
			$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
			?>
			<div class="gallery-thumb">
				<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
			</div><!-- .gallery-thumb -->
			<?php 
			// Fire the 'oenology_hook_post_header_title' custom action hook
			// 
			// @param	null
			// @return	mixed	any output hooked into 'oenology_hook_post_header_title'
			oenology_hook_post_header_title(); 
			?>
			<p class="gallery-description"><?php echo get_the_excerpt(); ?></p>
			<ul class="gallery-meta">
				<li>
					<?php 
					// Fire the 'oenology_hook_post_header_metadata' custom action hook
					// 
					// @param	null
					// @return	mixed	any output hooked into 'oenology_hook_post_header_metadata'
					oenology_hook_post_header_metadata(); 
					?>
				</li>
				<li>
					<?php 
					// Fire the 'oenology_hook_post_header_taxonomies' custom action hook
					// 
					// @param	null
					// @return	mixed	any output hooked into 'oenology_hook_post_header_taxonomies'
					oenology_hook_post_header_taxonomies(); 
					?>
				</li>
			</ul>
		<?php 
		} else { 
			the_content();
		} // if $images
	} // if is_single or post_password_required 
	?>
	<!-- Post Entry End -->
	<?php 
	// Fire the 'oenology_hook_post_entry_after' custom action hook
	// 
	// @param	null
	// @return	mixed	any output hooked into 'oenology_hook_post_entry_after'
	oenology_hook_post_entry_after(); 
	?>

</div>

<div class="post-footer">
	<?php 
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
	// via "post-footer.php", or in a specific context only, via 
	// "post-footer-{context}.php"
	get_template_part( 'post-footer', oenology_get_context() ); 
	?>
</div>