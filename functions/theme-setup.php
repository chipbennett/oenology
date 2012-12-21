<?php
/**
 * Oenology Theme Setup
 *
 * This file defines the setup functions for the Oenology Theme.
 *
 * For more information on hooks, actions, and filters, 
 * see {@link http://codex.wordpress.org/Plugin_API Plugin API}.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

/**
 * @todo	complete inline documentation
 */

/**
 * Dynamically set $content_width
 * 
 * Define $content_width global variable, to keep 
 * media content from overflowing the Theme's
 * main content area.
 * 
 * @link	Codex reference: is_admin()
 * 
 * @uses	oenology_get_current_page_layout()	Defined in \functions\custom.php
 * @uses	oenology_get_options()	Defined in \functions\options.php
 */
function oenology_set_content_width() {
	global $pagenow;
	if ( ! is_admin() || ( is_admin() && 'post.php' == $pagenow ) ) {

		// Content width for three-
		// column Page layout, and
		// for two- and three-
		// column Post layouts
		$width_three_column = 635;
		// Content width for two-
		// column Page layout
		$width_two_column = 810;
		// Content width for one-
		// column Page and one-
		// column Post layouts
		$width_one_column = 815;
		// Content width for 
		// attachment pages
		$width_attachment = 900;
		// content width for full-
		// width layout
		$width_full = 975;

		// Get the current layout
		$layout = oenology_get_current_page_layout();

		// Set default content width
		//
		// The default layout is the three-column
		// layout for static Pages, and the two-
		// column layout for single posts and post
		// indexes.
		//
		// Note: the width of the *content* area,
		// which is div#main, is the same for the
		// three-column static Page layout as for
		// the two-column post/index layout.
		$dynamic_width = $width_three_column;
		
		// Set content width for attachment pages
		if ( 'attachment' == $layout ) {
			$dynamic_width = $width_attachment;
		} 
		
		// Set content width for full-width pages
		if ( 'full' == $layout ) {
			$dynamic_width = $width_full;
		} 
		
		// Set content width for one-column layout
		else if ( 'one-column' == $layout ) {
			$dynamic_width = $width_one_column;
		} 
		
		// Set content width for two-column layout
		// Note: only applies to static Pages
		else if ( 'two-column' == $layout ) {
			$dynamic_width = $width_two_column;
		}
		
		// Apply dynamic width to $content_width
		global $content_width;
		$content_width = $dynamic_width;
	}
}
// Hook oenology_set_content_width() into 'admin_head'
add_action( 'admin_head', 'oenology_set_content_width' );
// Hook oenology_set_content_width() into 'wp_head'
add_action( 'wp_head', 'oenology_set_content_width', 0 );

/**
 * Define Theme setup
 * 
 * Add Theme support for and configure various core WordPress 
 * functionality, define the Theme's content width, etc.
 * 
 * @link	http://codex.wordpress.org/Function_Reference/add_editor_style				add_editor_style()
 * @link	http://codex.wordpress.org/Function_Reference/add_image_size				add_image_size()
 * @link	http://codex.wordpress.org/Function_Reference/add_theme_support				add_theme_support()
 * @link	http://codex.wordpress.org/Function_Reference/apply_filters					apply_filters()
 * @link	http://codex.wordpress.org/Function_Reference/apply_filters					get_header_image()
 * @link	http://codex.wordpress.org/Function_Reference/get_header_textcolor			get_header_textcolor()
 * @link	http://codex.wordpress.org/Function_Reference/get_locale					get_locale()
 * @link	http://codex.wordpress.org/Function_Reference/get_option					get_option()
 * @link	http://codex.wordpress.org/Function_Reference/get_template_directory		get_template_directory()
 * @link	http://codex.wordpress.org/Function_Reference/get_template_directory_uri	get_template_directory_uri()
 * @link	http://codex.wordpress.org/Function_Reference/get_theme_root				get_theme_root()
 * @link	http://codex.wordpress.org/Function_Reference/is_readable					is_readable()
 * @link	http://codex.wordpress.org/Function_Reference/load_theme_textdomain			load_theme_textdomain()
 * @link	http://codex.wordpress.org/Function_Reference/register_default_headers		register_default_headers()
 * @link	http://codex.wordpress.org/Function_Reference/register_nav_menus			register_nav_menus()
 * @link	http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size		set_post_thumbnail_size()
 * 
 * @link	http://php.net/manual/en/function.file-exists.php							PHP reference: file_exists()
 * 
 * @uses	oenology_admin_header_style()	Defined in \functions\theme-setup.php
 * @uses	oenology_get_post_formats()		Defined in \functions\custom.php
 * @uses	oenology_get_color_scheme()		Defined in \functions\dynamic-css.php
 * @uses	oenology_header_style()			Defined in \functions\theme-setup.php
 */
function oenology_setup() {
	
	/*
	 * Enable translation
	 * 
	 * Declare Theme textdomain and define
	 * location for translation files.
	 * 
	 * Translations can be added to the /languages
	 * directory.
	 *
	 * @since	Oenology 2.2
	 */
	load_theme_textdomain( 'oenology', get_template_directory() . '/languages' );

	/*
	 * Add Theme support for Automatic Feed Links
	 * 
	 * Automatically add RSS feed links to document header.
	 * 
	 * Child Themes can remove support for this feature via
	 * remove_theme_support( 'automatic-feed-links' ).
	 * 
	 * @since	WordPress 2.9.0
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Add Theme support for Post Thumbnails
	 * 
	 * Allow users to specify "featured" images for Posts.
	 * 
	 * Child Themes can remove support for this feature via
	 * remove_theme_support( 'post-thumbnails' ).
	 * 
	 * @since	WordPress 2.9.0
	 */
	add_theme_support( 'post-thumbnails' ); 

	/*
	 * Add Theme support for Custom Backgrounds
	 * 
	 * Allow users to specify a custom background image
	 * or color.
	 * 
	 * Note: as of WordPress 3.4, add_custom_background() is 
	 * deprecated, in favor of 
	 * add_theme_support( 'custom-background' ). Child Themes 
	 * can remove support for this feature via
	 * remove_theme_support( 'custom-background' ).
	 * 
	 * @since	WordPress 3.0.0
	 */
	add_theme_support( 'custom-background' );

	/*
	 * Add Theme support for Custom Header Images
	 * 
	 * Allow users to specify a custom header image.
	 * 
	 * Note: as of WordPress 3.4, add_custom_image_header() is 
	 * deprecated, in favor of 
	 * add_theme_support( 'custom-header' ). Child Themes 
	 * can remove support for this feature via
	 * remove_theme_support( 'custom-header' ).
	 * 
	 * @since	WordPress 3.0.0
	 */
	//add_custom_image_header( 'oenology_header_style', 'oenology_admin_header_style' );
	add_theme_support( 'custom-header', array( 
		// Header image default
		'default-image'			=> get_template_directory_uri() . '/images/headers/pxwhite.jpg',
		// Header text display default
		'header-text'			=> false,
		// Header text color default
		'default-text-color'	=> oenology_get_header_textcolor(),
		// Header image width (in pixels)
		'width'					=> apply_filters( 'oenology_header_image_width', 1000 ),
		// Header image height (in pixels)
		'height'				=> apply_filters( 'oenology_header_image_height', 198 ),
		// Header image random rotation default
		'random-default'		=> false,
		// Template header style callback
		'wp-head-callback'		=> 'oenology_header_style',
		// Admin header style callback
		'admin-head-callback'	=> 'oenology_admin_header_style'
	) );


	/*
	 * Add Theme support for Custom Editor Style
	 * 
	 * Apply custom CSS to the WordPress Visual
	 * editor, so that content in the editor is
	 * visually consistent with content rendered
	 * on the site.
	 * 
	 * Child Themes can remove support for this feature via
	 * remove_editor_styles(). (Note PLURAL vs. singular.)
	 * 
	 * @since	WordPress 3.0.0
	 */
	add_editor_style();
	
	/*
	 * Add Theme support for Post Formats
	 * 
	 * Allow user to designate a "format" taxonomy 
	 * for Blog Posts. This taxonomy can be used
	 * to alter the layout or style of Posts that
	 * have a given taxonomy term. The supported
	 * Post Format types - i.e. the supported 
	 * taxonomy terms - are defined by function
	 * oenology_get_post_formats().
	 * 
	 * Child Themes can change the array of supported
	 * post formats via the 'oenology_supported_post_formats'
	 * filter hook, which is an array of strings of
	 * supported post format types. For example, to
	 * support only 'aside' and 'gallery' in a Child 
	 * Theme, hook into the filter, and return 
	 * array( 'aside', 'gallery' ).
	 * 
	 * Child Themes can completely remove support for this 
	 * feature via remove_theme_support( 'post-formats' ).
	 * 
	 * @uses	oenology_get_post_formats()	defined in \functions\custom.php
	 * 
	 * @since	WordPress 3.1.0
	 */

	// Define a variable to pass to add_theme_support()
	$postformats = oenology_get_post_formats();
	$supportedpostformats = array();
	foreach ( $postformats as $format ) {
		$supportedpostformats[] = $format['slug'];
	}
	$supportedpostformats = apply_filters( 'oenology_supported_post_formats', $supportedpostformats );
	
	// Add Theme support for Post Formats
	add_theme_support( 'post-formats', $supportedpostformats );
	
	/*
	 * Add Theme support for bbPress
	 * 
	 * Allow Theme to incorporate forum functionality
	 * via the bbPress Plugin. Placeholder for now, for
	 * testing purposes. Full bbPress support will be
	 * included in a future version of Oenology.
	 * 
	 * Child Themes can remove support for this feature via
	 * remove_theme_support( 'bbpress' ).
	 * 
	 * @since	bbPress 2.0
	 */
	//add_theme_support( 'bbpress' );
	/**
	 * @todo	Add bbPress integration/support
	 */
	

	/**
	 * Set default Post Thumbnail size
	 * 
	 * Sets the dimensions for the default 
	 * 'thumbnail' image size.
	 * 
	 * Child Themes can override this setting 
	 * via set_post_thumbnail_size().
	 */
	set_post_thumbnail_size( 150, 150, true );
	
	/**
	 * Add 'post-title-thumbnail' Image size
	 * 
	 * Defines a new image size to the default array,
	 * which includes 'full', 'large', 'medium', and'
	 * 'thumbnail'.
	 * 
	 * The 'post-title-thumbnail' image is defined
	 * as having dimensions of 55x55px, and will
	 * be hard-cropped rather than box-resized.
	 * 
	 * Child Themes can override this setting 
	 * via add_image_size().
	 */
	add_image_size( 'post-title-thumbnail', 55, 55, true );
	/**
	 * Add 'attachment-nav-thumbnail' Image size
	 * 
	 * Defines a new image size to the default array,
	 * which includes 'full', 'large', 'medium', and'
	 * 'thumbnail'.
	 * 
	 * The 'post-title-thumbnail' image is defined
	 * as having dimensions of 45x45px, and will
	 * be hard-cropped rather than box-resized.
	 * 
	 * Child Themes can override this setting 
	 * via add_image_size().
	 */
	add_image_size( 'attachment-nav-thumbnail', 45, 45, true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See oenology_admin_header_style(), below.

	// Default custom headers packaged with the theme. 
	// %s is a placeholder for the theme template directory URI.
	
	// Auto-magically registers the headers included with TwentyEleven if it is installed
	if ( file_exists( get_theme_root() . '/twentyeleven/style.css' ) ) {
		register_default_headers( array(
			'wheel' => array(
				'url' => '%s/../twentyeleven/images/headers/wheel.jpg',
				'thumbnail_url' => '%s/../twentyeleven/images/headers/wheel-thumbnail.jpg',
				'description' => 'Wheel'
			),
			'shore' => array(
				'url' => '%s/../twentyeleven/images/headers/shore.jpg',
				'thumbnail_url' => '%s/../twentyeleven/images/headers/shore-thumbnail.jpg',
				'description' => 'Shore'
			),
			'trolley' => array(
				'url' => '%s/../twentyeleven/images/headers/trolley.jpg',
				'thumbnail_url' => '%s/../twentyeleven/images/headers/trolley-thumbnail.jpg',
				'description' => 'Trolley'
			),
			'pine-cone' => array(
				'url' => '%s/../twentyeleven/images/headers/pine-cone.jpg',
				'thumbnail_url' => '%s/../twentyeleven/images/headers/pine-cone-thumbnail.jpg',
				'description' => 'Pine Cone'
			),
			'chessboard' => array(
				'url' => '%s/../twentyeleven/images/headers/chessboard.jpg',
				'thumbnail_url' => '%s/../twentyeleven/images/headers/chessboard-thumbnail.jpg',
				'description' => 'Chessboard'
			),
			'lanterns' => array(
				'url' => '%s/../twentyeleven/images/headers/lanterns.jpg',
				'thumbnail_url' => '%s/../twentyeleven/images/headers/lanterns-thumbnail.jpg',
				'description' => 'Lanterns'
			),
			'willow' => array(
				'url' => '%s/../twentyeleven/images/headers/willow.jpg',
				'thumbnail_url' => '%s/../twentyeleven/images/headers/willow-thumbnail.jpg',
				'description' => 'Willow'
			),
			'hanoi' => array(
				'url' => '%s/../twentyeleven/images/headers/hanoi.jpg',
				'thumbnail_url' => '%s/../twentyeleven/images/headers/hanoi-thumbnail.jpg',
				'description' => 'Hanoi Plant'
			)
		) );
	}
	// Auto-magically registers the headers included with TwentyTen if it is installed
	if ( file_exists( get_theme_root() . '/twentyten/style.css' ) ) {
		register_default_headers( array(
			'berries' => array(
				'url' => '%s/../twentyten/images/headers/berries.jpg',
				'thumbnail_url' => '%s/../twentyten/images/headers/berries-thumbnail.jpg',
				'description' => 'Berries'
			),
			'cherryblossom' => array(
				'url' => '%s/../twentyten/images/headers/cherryblossoms.jpg',
				'thumbnail_url' => '%s/../twentyten/images/headers/cherryblossoms-thumbnail.jpg',
				'description' => 'Cherry Blossoms'
			),
			'concave' => array(
				'url' => '%s/../twentyten/images/headers/concave.jpg',
				'thumbnail_url' => '%s/../twentyten/images/headers/concave-thumbnail.jpg',
				'description' => 'Concave'
			),
			'fern' => array(
				'url' => '%s/../twentyten/images/headers/fern.jpg',
				'thumbnail_url' => '%s/../twentyten/images/headers/fern-thumbnail.jpg',
				'description' => 'Fern'
			),
			'forestfloor' => array(
				'url' => '%s/../twentyten/images/headers/forestfloor.jpg',
				'thumbnail_url' => '%s/../twentyten/images/headers/forestfloor-thumbnail.jpg',
				'description' => 'Forest Floor'
			),
			'inkwell' => array(
				'url' => '%s/../twentyten/images/headers/inkwell.jpg',
				'thumbnail_url' => '%s/../twentyten/images/headers/inkwell-thumbnail.jpg',
				'description' => 'Inkwell', 'oenology'
			),
			'path' => array(
				'url' => '%s/../twentyten/images/headers/path.jpg',
				'thumbnail_url' => '%s/../twentyten/images/headers/path-thumbnail.jpg',
				'description' => 'Path'
			),
			'sunset' => array(
				'url' => '%s/../twentyten/images/headers/sunset.jpg',
				'thumbnail_url' => '%s/../twentyten/images/headers/sunset-thumbnail.jpg',
				'description' => 'Sunset'
			)
		) );
	}

	/*
	 * Define Nav Menus (since WordPress 3.0)
	 */

	// This theme uses wp_nav_menu() in two locations: main site navigation, and left-colum page navigation.
	register_nav_menus( array(
		'nav-header' => 'Header Navigation',
		'nav-sidebar' => 'Sidebar Navigation',
		'nav-footer' => 'Footer Navigation'
	) );


}
// Hook oenology_setup() into 'after_setup_theme'
add_action( 'after_setup_theme', 'oenology_setup', 10 );

/**
 * Custom Image Header Front-End Callback
 * 
 * Callback to define the front-end style 
 * definitions for the custom image header.
 * 
 * @uses	oenology_get_options()	Defined in /functions/options.php
 * 
 * @link	http://codex.wordpress.org/Function_Reference/get_header_image 		get_header_image() 
 * @link	http://codex.wordpress.org/Function_Reference/get_header_textcolor	get_header_textcolor()
 * @link	http://codex.wordpress.org/Function_Reference/header_image 			header_image()
 * @link	http://codex.wordpress.org/Function_Reference/header_textcolor		header_textcolor()
 */
function oenology_header_style() {
?>			
<style type="text/css">
/* Sets header image as background for div#header */
<?php 
if ( get_header_image() && HEADER_IMAGE != get_header_image() ) { 
	?>
#header {
	background:url('<?php header_image(); ?>') no-repeat center top;
	overflow: hidden;
}
	<?php if ( 'blank' != get_header_textcolor() ) { ?>
#site-header-text {
	background: rgba(0, 0, 0, 0.2);
}
	<?php 
	}			 
	$oenology_options = oenology_get_options();
	if ( 'above' == $oenology_options['header_nav_menu_position'] ) {
		if ( get_header_image() ) { 
			?>
#nav,
.navmenu,
.nav-header {
	background-color: rgba(0, 0, 0, 0.2);
}
		<?php
		}
	}
} 
?>
/* Sets text color for div#header p and div */
<?php 
if ( get_header_textcolor() ) { 
	?>
#site-header-text {
	color:#<?php header_textcolor(); ?>;
}
			
.navmenu li {
	padding-top: 1px;
}
	<?php 
	}
?>
</style>
<?php
}

/**
 * Custom Image Header Admin Callback
 * 
 * Callback to define the admin (back-end) style 
 * definitions for the custom image header.
 */
function oenology_admin_header_style() {
?>
<style type="text/css">
#headimg {
	width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	text-align: center;
}
#headimg h1,
#headimg div {
	border:0;
}
#headimg h1 {
  clear:both;
  width:100%;
  padding-top:10px;
  padding-bottom:10px;
  font-size: 28pt;
  line-height:1.5em;
  letter-spacing: 0.2em;
  font-weight:normal;
  text-transform:none;
  font-family: slab-serif, serif;
}
#headimg h1 a {
	text-decoration: none;
}
#headimg div {
  padding-top:0px;
  padding-bottom:10px;
  max-width:100%;
  text-align:center;
  font-size: 13pt;
  line-height:2.0em;
  letter-spacing:0em;
  font-family: 'Nimbus Roman No9 L', 'Times New Roman', serif;
}  
</style>
<?php
}
?>