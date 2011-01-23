<?php 
$gallery_links = oenology_gallery_links(); 
$gallery_image_meta = oenology_gallery_image_meta();
?>
<div class="gallery-nav"> <!-- Head navigation -->
	<dl>
	<dt>Gallery</dt>
	<dd class="gallery-nav-home">
	<a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?> </a>
	</dd>
	<dd>
	<div class="gallery-nav-prev">
	<?php if ( $prevlink = $gallery_links['prevlink'] ) { // if a previous gallery image exists, display thumbnail and link ?>
		<div class="gallery-nav-thumb"><?php echo $gallery_links['prevthumb']; ?></div>
		<div class="gallery-nav-caption"><a href="<?php echo $prevlink; ?>">Prev</a></div>
	<?php } else { // otherwise, display a blank space ?>
		&nbsp;
	<?php } ?>
	</div>
	<div class="gallery-nav-next">
	<?php if ( $nextlink = $gallery_links['nextlink'] ) { // if a next gallery image exists, display thumbnail and link ?>
		<div class="gallery-nav-thumb"><?php echo $gallery_links['nextthumb']; ?></div>
		<div class="gallery-nav-caption"><a href="<?php echo $nextlink; ?>">Next</a></div>
	<?php } else { // otherwise, display a blank space ?>
		&nbsp;
	<?php } ?>
	</div>
	</dd>
	</dl>
	
	<div class="gallery-more">

	<dl class="photo-tech">
	<dt>Full Size</dt>
	<?php if ( $gallery_image_meta['dimensions'] ) { // if image dimensions are defined, display them ?>
		<dd><a href="<?php echo $gallery_image_meta['url']; ?>"><?php echo $gallery_image_meta['dimensions']; ?></a></dd>
	<?php } ?>
	<dd>(<?php echo $gallery_image_meta['filesize']; ?>)</dd>
		<?php if ( $gallery_image_meta['created_timestamp'] ) { // if image created_timestamp is defined, display it ?>
		<dt>Taken</dt>
		<dd><?php echo $gallery_image_meta['created_timestamp']; ?></dd>
	<?php } ?>
	<?php if ( $gallery_image_meta['copyright'] || $gallery_image_meta['credit'] ) { // if image copyright or credit are defined, display ?>
		<dt>Owner</dt>
		<?php if ( $gallery_image_meta['copyright'] ) { // if image copyright is defined, display it ?>
			<dd>&copy;<?php echo $gallery_image_meta['copyright'] ?></dd>
		<?php } ?>
		<?php if ( $gallery_image_meta['credit'] ) { // if image credit is defined, display it ?>
			<dd><?php echo $gallery_image_meta['credit'] ?></dd>
		<?php } ?>
	<?php } ?>
	<?php if ( $gallery_image_meta['aperture'] ) { // if image aperture is defined, display it ?>
		<dt>Aperture</dt>
		<dd><?php echo $gallery_image_meta['aperture']; ?></dd>
	<?php } ?>
	<?php if ( $gallery_image_meta['focal_length'] ) { // if image focal_length is defined, display it ?>
		<dt>Focal Length</dt>
		<dd><?php echo $gallery_image_meta['focal_length']; ?>mm</dd>
	<?php } ?>
	<?php if ( $gallery_image_meta['iso'] ) { // if image ISO is defined, display it ?>
		<dt>ISO</dt>
		<dd><?php echo $gallery_image_meta['iso']; ?></dd>
	<?php } ?>
	<?php if ( $gallery_image_meta['shutter_speed'] ) { // if image shutter_speed is defined, display it ?>
		<dt>Shutter</dt>
		<dd><?php echo $gallery_image_meta['shutter_speed']; ?></dd>
	<?php } ?>
	<?php if ( $gallery_image_meta['camera'] ) { // if image camera is defined, display it ?>
		<dt>Camera</dt>
		<dd><?php echo $gallery_image_meta['camera']; ?></dd>
	<?php } ?>
	</dl>

	</div>
	
</div>

<div class="gallery-photo">
	<a href="<?php echo $gallery_image_meta['url']; ?>"><?php echo $gallery_image_meta['image'];  ?></a>
	<div class="gallery-caption bigcaption">
		<?php echo $gallery_image_meta['caption']; ?>
	</div>
</div><?php
/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
get_permalink()
----------------------------------
get_permalink() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_permalink

get_permalink() is used to return the permalink URL for the current post. This tag
returns only the permalink URL, not a fully formed HTML anchor tag.

get_permalink() returns, but does not display, the requested post permalink.

get_permalink( $id ) accepts one argument:
 - $id: ID of the post for which to return the permalink

Example:
<?php echo get_permalink($post->post_parent); ?>
Displays the URL to the post parent of the current post.

***********************
get_the_title()
----------------------------------
get_the_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_the_title

get_the_title() is used to display the Post Title of the current post.

get_the_title( $id ) accepts one argument:
 - $id: ID of the post for which to return the Post Title

Example:
<?php echo get_the_title($post->post_parent); ?> 
Displays the Post Title of the current post's parent post. 

***********************
oenology_gallery_image_meta()
----------------------------------
oenology_gallery_image_meta() is a custom Theme function.
Codex reference: N/A

oenology_gallery_image_meta() is used to output various metadata related to
gallery images. oenology_gallery_image_meta() outputs an array containing the
following values:
 - $image_meta['image']: image output, using wp_get_attachment_image()
 - $image_meta['url']: image attachment url, using wp_get_attachment_url()
 - $image_meta['width']: image width, in px
 - $image_meta['height']: image height, in px
 - $image_meta['dimensions']: image width/height dimensions, in px, displayed as "# x # px"
 - $image_meta['filesize']: image filesize, converted to human-readable size format, displayed as e.g. "### kb"
 - $image_meta['created_timestamp']: image metadata - date/time image taken, displayed as "D MMM YYYY"
 - $image_meta['copyright']: image metadata - copyright statement
 - $image_meta['credit']: image metadata - photographer
 - $image_meta['aperture']: image metadata - camera aperture setting
 - $image_meta['focal_length']: image metadata - camera focal length setting, displayed as "f/###"
 - $image_meta['iso']: image metadata - camera ISO setting
 - $image_meta['shutter_speed']: image metadata - camera shutter speed setting, displayed as e.g. "1/### sec"
 - $image_meta['camera']: image metadata - camera type
 - $image_meta['caption']: the image caption, as defined in image settings

oenology_gallery_image_meta() is defined in functions.php.

***********************
oenology_gallery_links()
----------------------------------
oenology_gallery_links() is a custom Theme function.
Codex reference: N/A

oenology_gallery_links() is used to output "previous" and "next" links with both text and
thumbnail images, for use with gallery images. The function outputs an array containing the
following values:
 - $links['prevlink']: text link to previous gallery image
 - $links['prevthumb']: thumbnail of previous gallery image
 - $links['nextlink']: text link to next gallery image
 - $links['nextthumb']: thumbnail of next gallery image

oenology_gallery_links() is defined in functions.php.

=============================================================================
*/ ?>