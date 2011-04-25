<?php
/*
Template Name: Sidebar-Column-Top
*/
?>
<?php
$oenology_options = get_option( 'theme_oenology_options' );
if ( $oenology_options['display_social_icons'] ) {
	$socialprofiles = oenology_get_social_networks();
	foreach ( $socialprofiles as $profile ) {
		$profilename = $profile['slug'] . '_profile';
		if ( ! empty( $oenology_options[$profilename] ) ) { 
			$baseurl = $profile['baseurl'];
			$profileurl = $baseurl . '/' . $oenology_options[$profilename]; ?>
			<a class="sidebar-social-icon" href="<?php echo $profileurl; ?>" title="<?php echo $profile['name']; ?>">
				<?php echo $profile['name']; ?>
			</a>
		<?php }
	}	
	if ( 'none' != $oenology_options['rss_feed'] ) {
		$rssarg = $oenology_options['rss_feed'] . '_url';
		$rssurl = get_bloginfo( $rssarg ); ?>
		<a class="sidebar-social-icon" href="<?php echo $rssurl; ?>" title="RSS">RSS</a>
	<?php }
} ?>

<!-- Begin Sidebar Top Widget Area-->
<?php if ( !dynamic_sidebar( 'sidebar-column-top' ) ) {

// No default content

} ?>
<!-- End Sidebar Top Widget Area--><?php
 /*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
dynamic_sidebar()
----------------------------------
dynamic_sidebar() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/dynamic_sidebar

dynamic_sidebar() is used to insert widgetized areas ("sidebars") into a Theme.
dynamic_sidebar( 'foo' ) will insert a dynamic sidebar named "foo".

Dynamic sidebars must be defined and registered. Refer to functions.php for more information.

=============================================================================
*/ ?>