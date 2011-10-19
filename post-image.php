<?php
/**
 * Template part file that contains the Image Post content,
 * including Post title, Post entry and Post footer
 *
 * This file is called by Posts with the "Image" Post Format
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
	if ( is_single() ) {
		get_template_part('post-entry-image'); // post-entry-image.php contains the post content
	} else {
		$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
		// If there are attached images, count them
		$total_images = ( $images ? count( $images ) : '0' );
		// If there are attached images, get the first one
		$image = ( $images ? array_shift( $images ) : false );
		// If there are attached images, grab the markup of the first image
		$image_img_tag = ( $image ? wp_get_attachment_image( $image->ID, 'thumbnail' ) : false );
		// If there are no attached images, grab the markup of the first linked image in the_content()
		$linkedimage = ( ! $images ? preg_match('/<img.*src\s*=\s*"([^"]+)[^>]+>/i', get_the_content(), $linkedimages) : false );
		// If there are no attached images, and no linked images, output some text
		$spancontent = ( $linkedimage ? $linkedimages[0] : '<span>No Thumbnail Available</span>' );		
		// Determine which output to use
		$thumboutput = ( $image ? $image_img_tag : $spancontent );
		// Determine what to use as the caption: either the attached-image caption, or the post excerpt
		$thumbcaption = ( $image ? $image->post_excerpt : get_the_excerpt() );
		?>
			<div class="gallery-thumb">
				<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $thumboutput; ?></a>
			</div><!-- .gallery-thumb -->
			<?php 
			// Fire the 'oenology_hook_post_header_title' custom action hook
			// 
			// @param	null
			// @return	mixed	any output hooked into 'oenology_hook_post_header_title'
			oenology_hook_post_header_title(); 
			?>
			<p class="gallery-description"><?php echo $thumbcaption; ?></p>
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
	<?php }
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