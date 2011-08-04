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
 * Hook oenology_setup() into 'after_setup_theme'
 */
add_action( 'after_setup_theme', 'oenology_setup', 10 );
/**
 * Allow Child Themes to override this function entirely. If
 * a Child Theme includes an oenology_setup() function, it
 * will be used in place of this function.
 */
if ( ! function_exists( 'oenology_setup' ) ):
	/**
	 * Define Theme setup
	 * 
	 * Add Theme support for and configure various core WordPress 
	 * functionality, define the Theme's content width, etc.
	 * 
	 * @uses	add_theme_support()
	 * @uses	add_custom_background()
	 * @uses	add_custom_image_header()
	 * @uses	add_editor_style()
	 * @uses	oenology_get_post_formats()
	 * @uses	add_image_size()
	 * @uses	set_post_thumbnail_size()
	 * @uses	apply_filters()
	 * @uses	get_header_textcolor()
	 * @uses	oenology_get_color_scheme()
	 * @uses	file_exists()
	 * @uses	get_theme_root()
	 * @uses	register_default_headers()
	 * @uses	oenology_header_style()
	 * @uses	get_option()
	 * @uses	get_header_image()
	 * @uses	oenology_admin_header_style()
	 * @uses	register_nav_menus()
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
		
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}

		/*
		 * Add Theme support for Automatic Feed Links
		 * 
		 * Automatically add RSS feed links to document header 
		 * 
		 * @since	WordPress 2.9.0
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Add Theme support for Post Thumbnails
		 * 
		 * Allow users to specify "featured" images for Posts
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
		 * @since	WordPress 3.0.0
		 */
		add_custom_background();

		/*
		 * Add Theme support for Custom Header Images
		 * 
		 * Allow users to specify a custom header image 
		 * 
		 * @since	WordPress 3.0.0
		 */
		add_custom_image_header( 'oenology_header_style', 'oenology_admin_header_style' );

		/*
		 * Add Theme support for Custom Editor Style
		 * 
		 * Apply custom CSS to the WordPress Visual
		 * editor, so that content in the editor is
		 * visually consistent with content rendered
		 * on the site.
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
		 * @since	bbPress 2.0
		 */
		//add_theme_support( 'bbpress' );
		/**
		 * @todo	Add bbPress integration/support
		 */
		

		/*
		 * Define $content_width global variable, to keep 
		 * media content from overflowing the Theme's
		 * main content area.
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 640;
		}
		

		/**
		 * Set default Post Thumbnail size
		 * 
		 * Sets the dimensions for the default 
		 * 'thumbnail' image size.
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
		 */
		add_image_size( 'attachment-nav-thumbnail', 45, 45, true );


		/*
		 * Define Custom Headers (since WordPress 3.0)
		 */
		
		/**
		 * Define HEADER_IMAGE_WIDTH
		 * 
		 * HEADER_IMAGE is the default header image to use
		 * as the custom image header
		 */
		$default_header_image = get_template_directory_uri() . '/images/headers/pxwhite.jpg';
		define( 'HEADER_IMAGE', $default_header_image ); 
		/**
		 * Define HEADER_IMAGE_WIDTH
		 * 
		 * HEADER_IMAGE_WIDTH is the width to which WordPress will 
		 * crop uploaded header images
		 */
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'oenology_header_image_width', 1000 ) ); 
		/**
		 * Define HEADER_IMAGE_HEIGHT
		 * 
		 * HEADER_IMAGE_HEIGHT is the height to which WordPress will 
		 * crop uploaded header images
		 */
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'oenology_header_image_height', 198 ) ); 
		/**
		 * Define NO_HEADER_TEXT
		 * 
		 * NO_HEADER_TEXT is a Boolean constant that determines
		 * whether the Header Text Color form field is enabled
		 * in the Appearance -> Headers administration screen
		 */
		define( 'NO_HEADER_TEXT', false );
		/**
		 * Define HEADER_TEXTCOLOR
		 * 
		 * HEADER_TEXTCOLOR is the header text color, expressed
		 * as a Hexadecimal value, without the leading octothorpe
		 *(#).
		 * 
		 * @uses	oenology_get_header_textcolor()	defined in \functions\custom.php
		 */
		define( 'HEADER_TEXTCOLOR', oenology_get_header_textcolor() );

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

	
	} // function oenology_setup()

endif; // function_exists( 'oenology_setup' )

/**
 * Allow Child Themes to override this function entirely. If
 * a Child Theme includes an oenology_header_style() function, it
 * will be used in place of this function.
 */
if ( ! function_exists( 'oenology_header_style' ) ) :

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
#site-header-text {
	background: rgba(0, 0, 0, 0.2);
}
	<?php			 
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

endif; // function_exists( 'oenology_header_style' )

/**
 * Allow Child Themes to override this function entirely. If
 * a Child Theme includes an oenology_admin_header_style() function, it
 * will be used in place of this function.
 */
if ( ! function_exists( 'oenology_admin_header_style' ) ) :

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
	
endif;  // function_exists( 'oenology_admin_header_style' )
?>