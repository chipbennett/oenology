<?php
/**
 * Oenology Dynamic Styles and Scripts
 *
 * This file defines the dynamic styles and
 * scripts that are output in the front and
 * back end.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 2.3
 */


/**
 * Enqueue Custom Admin Page Stylesheet
 */
function oenology_enqueue_admin_style() {

	// define admin stylesheet
	$admin_handle = 'oenology_admin_stylesheet';
	$admin_stylesheet = get_template_directory_uri() . '/functions/oenology-admin.css';
	
	wp_enqueue_style( $admin_handle, $admin_stylesheet, '', false );
}
// Enqueue Admin Stylesheet at admin_print_styles()
add_action( 'admin_print_styles-appearance_page_oenology-settings', 'oenology_enqueue_admin_style', 11 );

/**
 * Enqueue #content img max-width
 * 
 * Set the max-width CSS property for
 * images inside div#content, based on
 * the $content_width global variable.
 */
function oenology_enqueue_content_img_max_width() {
	global $content_width;
?>
<style type="text/css">
.post-entry img,
.post-entry .wp-caption {
	max-width: <?php echo $content_width; ?>px;
}
</style>
<?php
}
// Enqueue Varietal Stylesheet at wp_print_styles
add_action( 'wp_print_styles', 'oenology_enqueue_content_img_max_width', 11 );

/**
 * Enqueue Footer Nav Menu Styles
 * 
 * If no menu is assigned to the nav-footer
 * Theme Location, then set the footer to
 * center-align content
 */
function oenology_enqueue_footer_nav_menu_style() {
	if ( has_nav_menu( 'nav-footer' ) ) {
	?>
<style type="text/css">
#footer {
	text-align: left;
}
</style>
	<?php
	}
}
add_action( 'wp_print_styles', 'oenology_enqueue_footer_nav_menu_style', 11 );


/**
 * Enqueue Varietal Stylesheet
 */
function oenology_enqueue_varietal_style() {

	// define varietal stylesheet
	global $oenology_options;
	$oenology_options = oenology_get_options();
	$varietal_handle = 'oenology_' . $oenology_options['varietal'] . '_stylesheet';
	$varietal_stylesheet = get_template_directory_uri() . '/varietals/' . $oenology_options['varietal'] . '.css';
	
	wp_enqueue_style( $varietal_handle, $varietal_stylesheet );
}
// Enqueue Varietal Stylesheet at wp_print_styles
add_action('wp_enqueue_scripts', 'oenology_enqueue_varietal_style', 11 );


/**
 * Determine Theme Color Scheme
 */
function oenology_get_color_scheme() {
	global $oenology_options;
	$oenology_options = oenology_get_options();
	$default_options = oenology_get_option_parameters();
	$oenology_varietals = $default_options['varietal']['valid_options'];
	$oenology_current_varietal = array();
	foreach ( $oenology_varietals as $varietal ) {
		if ( $varietal['name'] == $oenology_options['varietal'] ) {
		      $oenology_current_varietal = $varietal;
		}
	}
	$colorscheme = $oenology_current_varietal['scheme'];
	return $colorscheme;
}

/**
 * Enqueue Social Icon Styles
 */
function oenology_enqueue_social_icon_style() {
	
	// Get Theme options
	$oenology_options = oenology_get_options();

	// If we're not displaying social icons,
	// no need to proceed
	if( false == $oenology_options['display_social_icons'] ) {
        return;
	}
	
	$socialiconbgposition = apply_filters( 'oenology_social_icon_bg_position', array(
		'aim' => array(
			'name' => 'aim',
			'black' => array(
				'x' => '0',
				'y' => '0'
			),
			'gray' => array(
				'x' => '0',
				'y' => '-90'
			),
			'silver' => array(
				'x' => '0',
				'y' => '-180'
			)
		),
		'facebook' => array(
			'name' => 'facebook',
			'black' => array(
				'x' => '0',
				'y' => '-270'
			),
			'gray' => array(
				'x' => '0',
				'y' => '-360'
			),
			'silver' => array(
				'x' => '0',
				'y' => '-450'
			)
		),
		'flickr' => array(
			'name' => 'flickr',
			'black' => array(
				'x' => '0',
				'y' => '-540'
			),
			'gray' => array(
				'x' => '0',
				'y' => '-630'
			),
			'silver' => array(
				'x' => '0',
				'y' => '-720'
			)
		),
		'linkedin' => array(
			'name' => 'linkedin',
			'black' => array(
				'x' => '0',
				'y' => '-810'
			),
			'gray' => array(
				'x' => '0',
				'y' => '-900'
			),
			'silver' => array(
				'x' => '0',
				'y' => '-990'
			)
		),
		'myspace' => array(
			'name' => 'myspace',
			'black' => array(
				'x' => '0',
				'y' => '-1080'
			),
			'gray' => array(
				'x' => '0',
				'y' => '-1170'
			),
			'silver' => array(
				'x' => '0',
				'y' => '-1260'
			)
		),
		'rss' => array(
			'name' => 'rss',
			'black' => array(
				'x' => '0',
				'y' => '-1350'
			),
			'gray' => array(
				'x' => '0',
				'y' => '-1440'
			),
			'silver' => array(
				'x' => '0',
				'y' => '-1530'
			)
		),
		'skype' => array(
			'name' => 'skype',
			'black' => array(
				'x' => '0',
				'y' => '-1620'
			),
			'gray' => array(
				'x' => '0',
				'y' => '-1710'
			),
			'silver' => array(
				'x' => '0',
				'y' => '-1800'
			)
		),
		'twitter' => array(
			'name' => 'twitter',
			'black' => array(
				'x' => '0',
				'y' => '-1890'
			),
			'gray' => array(
				'x' => '-90',
				'y' => '0'
			),
			'silver' => array(
				'x' => '-90',
				'y' => '-90'
			)
		),
		'yahoo' => array(
			'name' => 'yahoo',
			'black' => array(
				'x' => '-90',
				'y' => '-180'
			),
			'gray' => array(
				'x' => '-90',
				'y' => '-270'
			),
			'silver' => array(
				'x' => '-90',
				'y' => '-360'
			)
		),
		'youtube' => array(
			'name' => 'youtube',
			'black' => array(
				'x' => '-90',
				'y' => '-450'
			),
			'gray' => array(
				'x' => '-90',
				'y' => '-540'
			),
			'silver' => array(
				'x' => '-90',
				'y' => '-630'
			)
		)
	) );

	$socialnetworks = oenology_get_social_networks();
	$linkcolor = apply_filters( 'oenology_light_color_scheme_linkcolor', 'silver' );
	$linkhovercolor = apply_filters( 'oenology_light_color_scheme_linkhovercolor', 'black' );
	$colorscheme = oenology_get_color_scheme();
	if ( 'dark' == $colorscheme ) {
		$linkcolor = apply_filters( 'oenology_dark_color_scheme_linkcolor', 'gray' );
		$linkhovercolor = apply_filters( 'oenology_dark_color_scheme_linknovercolor', 'silver' );
	}
	
?>

<style type="text/css">
<?php 
	if ( 'none' != $oenology_options['rss_feed'] ) { 
		?>
a[class="sidebar-social-icon"][title ^="RSS"] {
    background: url('<?php echo get_template_directory_uri(); ?>/images/socialiconsprite.png');
    background-position: <?php echo $socialiconbgposition['rss'][$linkcolor]['x'] . 'px ' . $socialiconbgposition['rss'][$linkcolor]['y'] . 'px'; ?>;
}
a[class="sidebar-social-icon"][title ^="RSS"]:hover {
    background: url('<?php echo get_template_directory_uri(); ?>/images/socialiconsprite.png');
    background-position: <?php echo $socialiconbgposition['rss'][$linkhovercolor]['x'] . 'px ' . $socialiconbgposition['rss'][$linkhovercolor]['y'] . 'px'; ?>;
}
		<?php 
	}
	foreach ( $socialnetworks as $network ) {

		$profile = $network['name'] . '_profile';

		if ( isset( $oenology_options[$profile] ) && '' != $oenology_options[$profile] ) {
			// Get background link and hover positions
			$linkposx = $socialiconbgposition[$network['name']][$linkcolor]['x'];
			$linkposy = $socialiconbgposition[$network['name']][$linkcolor]['y'];
			$hoverposx = $socialiconbgposition[$network['name']][$linkhovercolor]['x'];
			$hoverposy = $socialiconbgposition[$network['name']][$linkhovercolor]['y'];
			
		?>
a[class="sidebar-social-icon"][title ^="<?php echo $network['title']; ?>"] {
	background: url('<?php echo get_template_directory_uri(); ?>/images/socialiconsprite.png');
	background-position: <?php echo $linkposx . 'px ' . $linkposy . 'px'; ?>;
}
a[class="sidebar-social-icon"][title ^="<?php echo $network['title']; ?>"]:hover {
	background: url('<?php echo get_template_directory_uri(); ?>/images/socialiconsprite.png');
	background-position: <?php echo $hoverposx . 'px ' . $hoverposy . 'px'; ?>;
}
		<?php 
		} 
	}
	?>
</style>
	
<?php 
}
// Enqueue Varietal Stylesheet at wp_print_styles
add_action( 'wp_print_styles', 'oenology_enqueue_social_icon_style', 11 );

/**
 * Return Post Formats whose icons display in the Post Entry
 */
function oenology_get_post_format_icon_formats() {

	$icons = array(
		'aside' => array(
			'name' => 'aside',
			'location' => 'entry',
			'position' => 'left'
		),
		'audio' => array(
			'name' => 'audio',
			'location' => 'title',
			'position' => 'left'
		),
		'chat' => array(
			'name' => 'chat',
			'location' => 'title',
			'position' => 'left'
		),
		'gallery' => array(
			'name' => 'gallery',
			'location' => 'both',
			'position' => 'left'
		),
		'image' => array(
			'name' => 'image',
			'location' => 'both',
			'position' => 'left'
		),
		'link' => array(
			'name' => 'link',
			'location' => 'entry',
			'position' => 'left'
		),
		'quote' => array(
			'name' => 'quote',
			'location' => 'entry',
			'position' => 'left'
		),
		'status' => array(
			'name' => 'status',
			'location' => 'entry',
			'position' => 'left'
		),
		'video' => array(
			'name' => 'video',
			'location' => 'title',
			'position' => 'left'
		)
	);
	return apply_filters( 'oenology_get_post_format_icon_formats', $icons );
}

/**
 * Add Post-Entry container for Post Format icon
 */
function oenology_post_format_entry_icon_container() {
	$postformat = get_post_format();
	$iconformats = oenology_get_post_format_icon_formats();
	
	foreach ( $iconformats as $format ) {
		if ( $postformat == $format['name'] ) {
			if ( 'entry' == $format['location'] || 'both' == $format['location'] ) {
				?>
				<div class="post-format-icon-container"></div>
				<?php
			}
		}
	}
}
add_filter( 'oenology_hook_post_entry_before', 'oenology_post_format_entry_icon_container' );

/**
 * Add Post-Title container for Post Format icon
 */
function oenology_post_format_title_icon_container() {
	$postformat = get_post_format();
	$iconformats = oenology_get_post_format_icon_formats();
	
	foreach ( $iconformats as $format ) {
		if ( $postformat == $format['name'] ) {
			if ( 'title' == $format['location'] || 'both' == $format['location'] ) {
				?>
				<div class="post-format-icon-container"></div>
				<?php
			}
		}
	}
}
add_filter( 'oenology_hook_post_header_before', 'oenology_post_format_title_icon_container' );

/**
 * Enqueue Post Format Icon Styles
 */
function oenology_enqueue_post_format_icon_style() {

	$postformatbgposition = apply_filters( 'oenology_post_format_bg_position', array(
		'aside' => array(
			'name' => 'aside',
			'gray' => array(
				'x' => '0',
				'y' => '0'
			),
			'original' => array(
				'x' => '0',
				'y' => '-83'
			)
		),
		'audio' => array(
			'name' => 'audio',
			'gray' => array(
				'x' => '0',
				'y' => '-166'
			),
			'original' => array(
				'x' => '0',
				'y' => '-242'
			)
		),
		'chat' => array(
			'name' => 'chat',
			'gray' => array(
				'x' => '0',
				'y' => '-318'
			),
			'original' => array(
				'x' => '0',
				'y' => '-394'
			)
		),
		'gallery' => array(
			'name' => 'gallery',
			'gray' => array(
				'x' => '0',
				'y' => '-470'
			),
			'original' => array(
				'x' => '0',
				'y' => '-554'
			)
		),
		'image' => array(
			'name' => 'image',
			'gray' => array(
				'x' => '0',
				'y' => '-638'
			),
			'original' => array(
				'x' => '0',
				'y' => '-722'
			)
		),
		'link' => array(
			'name' => 'link',
			'gray' => array(
				'x' => '0',
				'y' => '-806'
			),
			'original' => array(
				'x' => '0',
				'y' => '-888'
			)
		),
		'quote' => array(
			'name' => 'quote',
			'gray' => array(
				'x' => '0',
				'y' => '-970'
			),
			'original' => array(
				'x' => '0',
				'y' => '-1050'
			)
		),
		'status' => array(
			'name' => 'status',
			'gray' => array(
				'x' => '0',
				'y' => '-1130'
			),
			'original' => array(
				'x' => '0',
				'y' => '-1211'
			)
		),
		'video' => array(
			'name' => 'video',
			'gray' => array(
				'x' => '0',
				'y' => '-1292'
			),
			'original' => array(
				'x' => '0',
				'y' => '-1376'
			)
		)
	) );

	$postformats = oenology_get_post_formats();
	$iconcolor = apply_filters( 'oenology_light_color_scheme_postformat_linkcolor', 'original' );
	$colorscheme = oenology_get_color_scheme();
	if ( 'dark' == $colorscheme ) {
		$iconcolor = apply_filters( 'oenology_dark_color_scheme_postformat_linkcolor', 'gray' );
	}
	
?>

<style type="text/css">

	<?php 	
	foreach ( $postformats as $postformat ) {
		$iconlocation = 'entry';
		$iconposition = 'left';
		if ( 'audio' == $postformat['slug'] || 'chat' == $postformat['slug'] || 'video' == $postformat['slug'] ) {
			$iconlocation = 'title';
		}
		if ( 'audio' == $postformat['slug'] || 'chat' == $postformat['slug'] || 'gallery' == $postformat['slug'] || 'image' == $postformat['slug'] || 'video' == $postformat['slug'] ) {
			$iconposition = 'right';
		}
		$bgposx = '0';
		$bgposy = '0';
		foreach ( $postformatbgposition as $bg ) {
			if ( $postformat['slug'] == $bg['name'] ) {
				$bgposx = $bg[$iconcolor]['x'];
				$bgposy = $bg[$iconcolor]['y'];
			}
		}
	if ( 'entry' == $iconlocation ) {
			?>
.post.format-<?php echo $postformat['slug']; ?> .post-entry .post-format-icon-container {
	background: url('<?php echo get_template_directory_uri(); ?>/images/postformaticonsprite.png');
	background-position: <?php echo $bgposx . 'px ' . $bgposy . 'px'; ?>;
	float:<?php echo $iconposition; ?>;
	width: 33px; 
	height: 33px;
<?php if ( 'left' == $iconposition ) { ?>
	position: relative;
	left: -50px; 
<?php } ?>
}
<?php
	} else if ( 'title' == $iconlocation ) {
			?>
.post.format-<?php echo $postformat['slug']; ?> .post-title .post-format-icon-container {
	background: url('<?php echo get_template_directory_uri(); ?>/images/postformaticonsprite.png');
	background-position: <?php echo $bgposx . 'px ' . $bgposy . 'px'; ?>;
	float:<?php echo $iconposition; ?>;
	width: 33px; 
	height: 33px;
}
			<?php 
	}
	if ( is_single() && ( 'gallery' == get_post_format() || 'image' == get_post_format() ) ) { ?>
body.single-format-<?php echo $postformat['slug']; ?> .post.format-<?php echo get_post_format(); ?> .post-title .post-format-icon-container  {
	background: url('<?php echo get_template_directory_uri(); ?>/images/postformaticonsprite.png');
	background-position: <?php echo $bgposx . 'px ' . $bgposy . 'px'; ?>;
	float:<?php echo $iconposition; ?>;
	width: 33px; 
	height: 33px;
	min-height: 33px;
}
body.single-format-<?php echo get_post_format(); ?> .post.format-<?php echo get_post_format(); ?> .post-entry .post-format-icon-container {
	background-image: none;
}
	<?php }
} ?>
</style>
	
<?php 
}
// Enqueue Varietal Stylesheet at wp_print_styles
add_action( 'wp_print_styles', 'oenology_enqueue_post_format_icon_style', 11 );

/**
 * Enqueue Header Nav Menu Styles
 */
function oenology_enqueue_header_nav_menu_style() {
	global $oenology_options;
	$oenology_options = oenology_get_options();
	$header_nav_menu_item_width = $oenology_options['header_nav_menu_item_width'];
	if ( 'fluid' == $header_nav_menu_item_width ) {
	?>
<style type="text/css">
.nav-header li a,
.nav-header li a:link,
.nav-header li a:visited,
.nav-header li a:hover,
.nav-header li a:active {
     width: auto; 
	 padding: 0px 10px;
}
#nav ul {
	width: auto;
}
#nav ul li a {
	width: auto;
	min-width: 100px;
}
#nav ul ul {
	width: auto;
}
</style>
	<?php
	}
}
add_action( 'wp_print_styles', 'oenology_enqueue_header_nav_menu_style', 11 );
?>