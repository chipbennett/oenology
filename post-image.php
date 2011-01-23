<?php if ( is_single() ) { ?>
<div class="post-title">

	<!-- Post Header Begin -->
	<h1><a href="<?php the_permalink(); //link Post Headline (H1) to post permalink ?>">
	<?php if ( get_the_title() ) {
		the_title(); // set Post Headline (H1) to Post Title 
	} else {
		echo '<em>(Untitled)</em>'; // set Post headline (H1) to "(Untitled)" if no Post Title is defined
	} ?>
</a>&nbsp;</h1>
	<!-- Post Header End -->

</div>
<?php } ?>

<div class="post-entry">

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
			<h2 class="gallery-title"><?php if ( get_the_title() ) {
				the_title(); // set Post Headline (H2) to Post Title 
			} else {
				echo '<em>(Untitled)</em>'; // set Post headline (H2) to "(Untitled)" if no Post Title is defined
			} ?></h2>
			<p class="gallery-description"><?php echo $thumbcaption; ?></p>
			<ul class="gallery-meta">	
				<li>
					<a href="<?php the_permalink(); // link to post permalink ?>" rel="bookmark" title="Permanent Link to <?php the_title(); // display Post Title in tooltip on hover ?>"> Permalink</a>
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
	<?php }
	?>
	<!-- Post Entry End -->

</div>

<div class="post-footer">

	<!-- Post footer Begin -->
	<?php get_template_part('post-footer'); // post-footer.php contains post timestamp and copyright information ?>
	<!-- Post Footer End -->
			
</div>

<?php
/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
get_template_part()
----------------------------------
get_template_part() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_template_part

get_template_part() is used to include a Theme template file within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_template_part( $file ) will attempt to include file.php. The function will attempt to 
include files in the following order, until it finds one that exists:
 - the Theme's file.php
 - the parent theme's file.php

get_template_part( $file , $foo ) will attempt to include file-foo.php. The function will
attempt to include files in the following order, until it finds one that exists:
 - the Theme's file-foo.php
 - the Theme's file.php
 - the parent theme's file-foo.php
 - the parent theme-s file.php

=============================================================================
*/ ?>