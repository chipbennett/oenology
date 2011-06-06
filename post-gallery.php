<?php
/**
 * Template part file that contains the Gallery Post content,
 * including Post title, Post entry and Post footer
 *
 * This file is called by Posts with the "Gallery" Post Format
 * 
 * @uses		get_template_part()
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

	<!-- Post Entry Begin -->
	<?php 
	if ( is_single() || post_password_required() ) {
		the_content();
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
			<h2 class="gallery-title"><?php if ( get_the_title() ) {
				the_title(); // set Post Headline (H1) to Post Title 
			} else {
				echo '<em>(Untitled)</em>'; // set Post headline (H1) to "(Untitled)" if no Post Title is defined
			} ?></h2>
			<p class="gallery-description"><?php echo get_the_excerpt(); ?></p>
			<ul class="gallery-meta">
				<li>
					<a href="<?php the_permalink(); // link to post permalink ?>" rel="bookmark" title="Permanent Link to <?php the_title(); // display Post Title in tooltip on hover ?>"> Photos: <?php echo $total_images; ?></a>
					<?php if ( ! is_attachment() ) { // shortlink isn't generated for attachmets ?>
						<strong>|</strong>
						<?php the_shortlink( 'Shortlink' ); // link to post shortlink ?>
					<?php } ?>
					<strong>|</strong>
					<a href="<?php comments_link(); ?>" target="_self" title="Comment on <?php the_title(); ?>">
					Comments (<?php comments_number('0','1','%'); // Display total number of post comments ?>)
					</a> 
					<strong> | </strong>
					<a href="<?php echo get_trackback_url(); // link to Trackback URL ?>" target="_self" title="Trackback to <?php the_title(); ?>">
					Trackback
					</a>
					<?php if ( is_singular() ) { // only display a Print link on single posts, pages, and attachments ?>
						<strong>|</strong> <a href="print" onclick="window.print();return false;">Print</a> 
					<?php } ?>
					<strong>|</strong>
					<?php edit_post_link('Edit','',''); // Display "Edit" link for logged-in Admin users ?>
				</li>
				<li>Filed in <?php the_category(', ');  // Display Post Categories ?></li>
				<li><?php the_tags(); // Display Post Tags ?></li>
			</ul>
		<?php 
		} else { 
			the_content();
		} // if $images
	} // if is_single or post_password_required 
	?>
	<!-- Post Entry End -->

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