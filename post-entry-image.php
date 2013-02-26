<?php
/**
 * Template part file that contains the Post entry for Images
 *
 * Contains Post entry content for Image mime-type Attachment
 * Pages
 * 
 * @uses		oenology_gallery_image_meta()	Defined in /functions/custom.php
 * @uses		oenology_gallery_links()		Defined in /functions/custom.php
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?><?php 
$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC' ) );

$total_images = ( $images ? count( $images ) : '0' );

if ( is_attachment() || $images ) { 	
	$gallery_image_meta = oenology_gallery_image_meta();
	$gallery_links = oenology_gallery_links();
	?>

<div class="gallery-photo">
	<a href="<?php echo $gallery_image_meta['url']; ?>"><?php echo $gallery_image_meta['image'];  ?></a>
	<div class="gallery-caption bigcaption">
		<?php echo $gallery_image_meta['caption']; ?>
	</div>
</div>

<div class="gallery-nav"> <!-- Head navigation -->
<?php 
if ( ! has_post_format( 'image', $post->post_parent ) ) { // image Post Format should only have one image attachment
?>
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
<?php } ?>
	
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
	<?php }
	if ( ! is_attachment() ) { ?>
		<dt>Filed Under:</dt>
		<dd><?php the_category(', '); ?></dd>
		<dt>Tags:</dt>
		<dd><?php the_tags( '', ',<br />', '' ); ?></dd>
	<?php } ?>
	</dl>

	</div>
	
</div>

<?php } else { ?>
<div class="gallery-nav">
  <div class="gllery-more">
      <dl class="photo-tech">
	<?php if ( ! is_attachment() ) { ?>
		<dt>Filed Under:</dt>
		<dd><?php the_category(', '); ?></dd>
		<dt>Tags:</dt>
		<dd><?php the_tags( '', ',<br />', '' ); ?></dd>
	<?php } ?>
      </dl>
  </div>
</div>
<div class="gallery-photo">
	<?php the_content(); ?> 
</div>
<?php } ?>
	<!-- Post Entry End -->