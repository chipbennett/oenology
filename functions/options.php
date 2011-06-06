<?php
/**
 * Oenology Theme Options
 *
 * This file defines the Options for the Oenology Theme.
 * 
 * Theme Options Functions
 * 
 *  - Define Default Theme Options
 *  - Register/Initialize Theme Options
 *  - Define Admin Settings Page
 *  - Register Contextual Help
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

/**
 * Globalize the variable that holds the Theme Options
 * 
 * @global	array	$oenology_options	holds Theme options
 */
global $oenology_options;
/**
 * Globalize the variable that holds the
 * Theme contextual help hook
 * 
 * @global mixed	$oenology_admin_options_hook	holds the Oenology admin contextual help hook
 */
global $oenology_admin_options_hook;

/**
 * Oenology Theme Default Options
 * 
 * Array that holds all the default options for
 * Oenology. The 'type' key is used to generate
 * the proper form field markup and to sanitize
 * the user-input data properly. The 'tab' key
 * determines the Settings Page on which the
 * option appears, and the 'section' tab determines
 * the section of the Settings Page tab in which
 * the option appears.
 */
function oenology_get_default_options() {

    $options = array(
        'header_nav_menu_position' => array(
			'name' => 'header_nav_menu_position',
			'title' => 'Header Nav Menu Position',
			'type' => 'select',
			'valid_options' => array(
				'above' => array(
					'name' => 'above',
					'title' => 'Above'
				),
				'below' => array(
					'name' => 'below',
					'title' => 'Below'
				),
				'none' => array(
					'name' => 'none',
					'title' => 'Do Not Display'
				)
			),
			'description' => 'Display header navigation menu above or below the site title/description?',
			'section' => 'header',
			'tab' => 'general',
			'since' => '1.1',
			'default' => 'above'
		),
		'header_nav_menu_depth' => array(
			'name' => 'header_nav_menu_depth',
			'title' => 'Header Nav Menu Depth',
			'type' => 'select',
			'valid_options' => array(
				'1' => array(
					'name' => 1,
					'title' => 'One'
				),
				'2' => array(
					'name' => 2,
					'title' => 'Two'
				),
				'3' => array(
					'name' => 3,
					'title' => 'Three'
				)
			),
			'description' => 'How many levels of Page hierarchy should the Header Navigation Menu display?',
			'section' => 'header',
			'tab' => 'general',
			'since' => '1.1',
			'default' => 1
		),
        'display_footer_credit' => array(
			'name' => 'display_footer_credit',
			'title' => 'Display Footer Credit',
			'type' => 'select',
			'valid_options' => array(
				'false' => array(
					'name' => false,
					'title' => 'Do Not Display'
				),
				'true' => array(
					'name' => true,
					'title' => 'Display'
				)
			),
			'description' => 'Display a credit link in the footer? This option is disabled by default, and you are under no obligation whatsoever to enable it.',
			'section' => 'footer',
			'tab' => 'general',
			'since' => '1.1',
			'default' => false
		),
		'varietal' => array(
			'name' => 'varietal',
			'title' => 'Varietal',
			'type' => 'custom',
			'valid_options' => array(
				'cuvee' => array(
				  'name' => 'cuvee',
				  'title' => 'Cuvee',
				  'description' => 'Cuvee is a term often used by wineries to describe a particularly high-quality batch of wine. Cuvee is the base style for Oenology.',
				  'scheme' => 'light'
				  ),
				'seyval-blanc' => array(
				  'name' => 'seyval-blanc',
				  'title' => 'Seyval Blanc',
				  'description' => 'Seyval Blanc is a white grape, typically grown in cooler climates, that produces a wine with flavors of citrus and mineral.',
				  'scheme' => 'light'
				  ),
				'muscat' => array(
				  'name' => 'muscat',
				  'title' => 'Muscat',
				  'description' => 'Muscat is a white grape with a pronounced flavor of grapes and spice, that produces a versatile wine from dry to sweet.',
				  'scheme' => 'light'
				  ),
				'syrah' => array(
				  'name' => 'syrah',
				  'title' => 'Syrah',
				  'description' => 'Syrah is a red grape that produces a full-bodied, almost inky-black wine with a spicy, earthy flavor and aroma.',
				  'scheme' => 'dark'
				  ),
				'malbec' => array(
				  'name' => 'malbec',
				  'title' => 'Malbec',
				  'description' => 'Malbec is a red grape that produces exceedingly dark, inky red-violet wins with intense flavors.',
				  'scheme' => 'dark'
				  )
			),
			'description' => '',
			'section' => 'varietal',
			'tab' => 'varietals',
			'since' => '1.1',
			'default' => 'cuvee'
		),
		'display_social_icons' => array(
			'name' => 'display_social_icons',
			'title' => 'Display Social Icons',
			'type' => 'checkbox',
			'description' => 'Display social icons in sidebar',
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => true
		),
		'rss_feed' => array(
			'name' => 'rss_feed',
			'title' => 'RSS Feed',
			'type' => 'select',
			'valid_options' => array( 
				'none' => array(
					'name' => 'none',
					'title' => 'Do Not Display'
				),
				'rdf' => array(
					'name' => 'rdf',
					'title' => 'RDF/RSS 1.0'
				),
				'rss' => array(
					'name' => 'rss',
					'title' => 'RSS 0.92,'
				),
				'rss2' => array(
					'name' => 'rss2',
					'title' => 'RSS 2.0'
				),
				'atom' => array(
					'name' => 'atom',
					'title' => 'Atom'
				)
			),
			'description' => 'RSS Feed',
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => 'rss2'
		),
		'facebook_profile' => array(
			'name' => 'facebook_profile',
			'title' => 'Facebook Profile',
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => 'Facebook Username',
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
		'flickr_profile' => array(
			'name' => 'flickr_profile',
			'title' => 'Flickr Profile',
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => 'Flickr Username',
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
		'linkedin_profile' => array(
			'name' => 'linkedin_profile',
			'title' => 'Linked-In Profile',
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => 'Linked-In Username',
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
		'myspace_profile' => array(
			'name' => 'myspace_profile',
			'title' => 'MySpace Profile',
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => 'MySpace Username',
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
		'twitter_profile' => array(
			'name' => 'twitter_profile',
			'title' => 'Twitter Profile',
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => 'Twitter Username',
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
		'youtube_profile' => array(
			'name' => 'youtube_profile',
			'title' => 'YouTube Profile',
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => 'YouTube Username',
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
        'theme_version' => array(
			'name' => 'theme_version',
			'title' => 'Theme Version',
			'type' => 'internal',
			'description' => '',
			'section' => false,
			'tab' => false,
			'since' => '1.2',
			'default' => '1.2'
		)
    );
    return $options;
}

/**
 * Separate settings by tab
 */
function oenology_get_settings_by_tab() {
	$tabs = oenology_get_settings_page_tabs();
	$tabnames = array();
	foreach ( $tabs as $tab ) {
		$tabname = $tab['name'];
		$tabnames[] = $tabname;
	}
	$settingsbytab = $tabnames;
	$default_options = oenology_get_default_options();
	foreach ( $default_options as $default_option ) {
		if ( 'internal' != $default_option['type'] ) {
			$optiontab = $default_option['tab'];
			$optionname = $default_option['name'];
			$settingsbytab[$optiontab][] = $optionname;
		}
	}
	return $settingsbytab;
}

/**
 * Oenology Theme Social Networks
 * 
 * Array that holds all of the valid social
 * networks for Oenology.
 */
function oenology_get_social_networks() {
	
	$socialnetworks = array( 
        'youtube' => array(
        	'name' => 'youtube',
        	'title' => 'YouTube',
        	'baseurl' => 'http://www.youtube.com'
        ),
        'myspace' => array(
        	'name' => 'myspace',
        	'title' => 'MySpace',
        	'baseurl' => 'http://www.myspace.com'
        ),
        'linkedin' => array(
        	'name' => 'linkedin',
        	'title' => 'Linked-In',
        	'baseurl' => 'http://www.linkedin.com/in'
        ),
        'flickr' => array(
        	'name' => 'flickr',
        	'title' => 'Flickr',
        	'baseurl' => 'http://www.flickr.com/photos'
        ),
        'facebook' => array(
        	'name' => 'facebook',
        	'title' => 'Facebook',
        	'baseurl' => 'http://www.facebook.com'
        ),
        'twitter' => array(
        	'name' => 'twitter',
        	'title' => 'Twitter',
        	'baseurl' => 'http://www.twitter.com'
        )
    );
	return $socialnetworks;
}

/**
 * Oenology Theme Admin Settings Page Tabs
 * 
 * Array that holds all of the tabs for the
 * Oenology Theme Settings Page. Each tab
 * key holds an array that defines the 
 * sections for each tab, including the
 * description text.
 */
function oenology_get_settings_page_tabs() {
	
	$tabs = array( 
        'general' => array(
			'name' => 'general',
			'title' => 'General',
			'sections' => array(
				'header' => array(
					'name' => 'header',
					'title' => 'Header Options',
					'description' => 'Manage Header options for the Oenology Theme. Refer to the contextual help screen for descriptions and help regarding each theme option.'
				),
				'social' => array(
					'name' => 'social',
					'title' => 'Social Network Profile Options',
					'description' => 'Manage Social Network Profile options for the Oenology Theme. Refer to the contextual help screen for descriptions and help regarding each theme option.'
				),
				'footer' => array(
					'name' => 'footer',
					'title' => 'Footer Options',
					'description' => 'Manage Footer options for the Oenology Theme. Refer to the contextual help screen for descriptions and help regarding each theme option.'
				)
			)
		),
        'varietals' => array(
			'name' => 'varietals',
			'title' => 'Varietals',
			'sections' => array(
				'varietal' => array(
					'name' => 'varietal',
					'title' => 'Varietal Options',
					'description' => oenology_get_varietal_text()
				)
			)
		)
    );
	return $tabs;
}

/**
 * Oenology Theme Icon Color Schemes
 * 
 * Array that holds all of the valid color
 * schems for Oenology icons
 */
function oenology_get_icon_colors() {
	
	$iconcolors = array( 
        'black' => 'Black',
        'silver' => 'Silver',
        'gray' => 'Gray',
        'coffee' => 'Coffee'
    );
	return $iconcolors;
}


/**
 * Setup initial Theme options
 */
function oenology_options_init() {

	// set options equal to defaults
	global $oenology_options;
	$oenology_options = get_option( 'theme_oenology_options' );
	
	if ( false === $oenology_options ) {
		$options = oenology_get_default_options();
		$oenology_options = array();
		foreach ( $options as $option ) {
			$optiondefault = $option['default'];
			$oenology_options[] = $optiondefault;
		}
	}
	update_option( 'theme_oenology_options', $oenology_options );
	
	// Update New Options (Version 1.2)
	$oenology_options = get_option( 'theme_oenology_options' );
	if ( '1.2' > $oenology_options['theme_version'] ) {
		$default_options = oenology_get_default_options();
		$oenology_options['display_social_icons'] = $default_options['display_social_icons'];
		$oenology_options['rss_feed'] = $default_options['rss_feed'];
		$socialnetworks = oenology_get_social_networks();
		foreach ( $socialnetworks as $network ) {
			$profile = $network . '_profile';
			$oenology_options[$profile] = $default_options[$profile];
		}
		$oenology_options['theme_version'] = '1.2';
		update_option( 'theme_oenology_options', $oenology_options );
	}
	
	// Update New Options Structure (Version 2.0)
	$oenology_options = get_option( 'theme_oenology_options' );
	if ( '2.0' > $oenology_options['theme_version'] ) {
		$oenology_options['theme_version'] = '2.0';
		update_option( 'theme_oenology_options', $oenology_options );
	}
}
// Initialize Theme options
add_action('after_setup_theme', 'oenology_options_init', 9 );


/**
 * Enqueue Varietal Stylesheet
 */
function oenology_enqueue_varietal_style() {

	// define varietal stylesheet
	global $oenology_options;
	$oenology_options = get_option( 'theme_oenology_options' );
	$varietal_handle = 'oenology_' . $oenology_options['varietal'] . '_stylesheet';
	$varietal_stylesheet = get_template_directory_uri() . '/varietals/' . $oenology_options['varietal'] . '.css';
	
	wp_enqueue_style( $varietal_handle, $varietal_stylesheet );
}
// Enqueue Varietal Stylesheet at wp_print_styles()
add_action('wp_enqueue_scripts', 'oenology_enqueue_varietal_style', 11 );


/**
 * Determine Theme Color Scheme
 */
function oenology_get_color_scheme() {
	global $oenology_options;
	$oenology_options = get_option( 'theme_oenology_options' );
	$default_options = oenology_get_default_options();
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

	$socialnetworks = oenology_get_social_networks();
	$linkcolor = 'silver';
	$linkhovercolor = 'black';
	$colorscheme = oenology_get_color_scheme();
	if ( 'dark' == $colorscheme ) {
		$linkcolor = 'gray';
		$linkhovercolor = 'silver';
	}
?>

<style type="text/css">
a[class="sidebar-social-icon"][title ^="RSS"] {
  background: url('<?php echo get_template_directory_uri(); ?>/images/infocus/<?php echo $linkcolor; ?>/rss.png');
}
a[class="sidebar-social-icon"][title ^="RSS"]:hover {
  background: url('<?php echo get_template_directory_uri(); ?>/images/infocus/<?php echo $linkhovercolor; ?>/rss.png');
}
<?php foreach ( $socialnetworks as $network ) { ?>
a[class="sidebar-social-icon"][title ^="<?php echo $network['title']; ?>"] {
  background: url('<?php echo get_template_directory_uri(); ?>/images/infocus/<?php echo $linkcolor; ?>/<?php echo $network['name']; ?>.png');
}
a[class="sidebar-social-icon"][title ^="<?php echo $network['title']; ?>"]:hover {
  background: url('<?php echo get_template_directory_uri(); ?>/images/infocus/<?php echo $linkhovercolor; ?>/<?php echo $network['name']; ?>.png');
}
<?php } ?>
</style>
	
<?php }
// Enqueue Varietal Stylesheet at wp_print_styles()
add_action('wp_print_styles', 'oenology_enqueue_social_icon_style', 11 );


/**
 * Enqueue Post Format Icon Styles
 */
function oenology_enqueue_post_format_icon_style() { 

	$postformats = oenology_get_post_formats();
	$iconcolor = 'original';
	$colorscheme = oenology_get_color_scheme();
	if ( 'dark' == $colorscheme ) {
		$iconcolor = 'gray';
	}
?>

<style type="text/css">
<?php 
foreach ( $postformats as $postformat ) {
	$iconlocation = 'entry';
	$iconposition = 'left';
	if ( 'audio' == $postformat || 'chat' == $postformat || 'video' == $postformat ) {
		$iconlocation = 'title';
	}
	if ( 'audio' == $postformat || 'chat' == $postformat || 'gallery' == $postformat || 'image' == $postformat || 'video' == $postformat ) {
		$iconposition = 'right';
	}
 ?>
.post.format-<?php echo $postformat; ?> .post-<?php echo $iconlocation; ?> {
  background: url('<?php echo get_template_directory_uri(); ?>/images/iconsweets2/<?php echo $iconcolor; ?>/<?php echo $postformat; ?>.png') no-repeat scroll <?php echo $iconposition; ?> top;
}
<?php 
	if ( 'gallery' == $postformat || 'image' == $postformat ) { ?>
body.single-format-<?php echo $postformat; ?> .post.format-<?php echo $postformat; ?> .post-title {
  background: url('<?php echo get_template_directory_uri(); ?>/images/iconsweets2/<?php echo $iconcolor; ?>/<?php echo $postformat; ?>.png') no-repeat scroll right top;
	min-height: 35px;
}
body.single-format-<?php echo $postformat; ?> .post.format-<?php echo $postformat; ?> .post-entry {
	background-image: none;
}
	<?php }
} ?>
</style>
	
<?php }
// Enqueue Varietal Stylesheet at wp_print_styles()
add_action('wp_print_styles', 'oenology_enqueue_post_format_icon_style', 11 );


/**
 * Setup the Theme Admin Settings Page
 * 
 * Add "Oenology Options" link to the "Appearance" menu
 */
function oenology_menu_options() {
	add_theme_page('Oenology Options', 'Oenology Options', 'edit_theme_options', 'oenology-settings', 'oenology_admin_options_page');
}
// Load the Admin Options page
add_action('admin_menu', 'oenology_menu_options');

/**
 * Get current settings page tab
 */
function oenology_get_current_tab( $current = 'general' ) {

    if ( isset ( $_GET['tab'] ) ) :
        $current = $_GET['tab'];
    else:
        $current = 'general';
    endif;
	
	return $current;
}

/**
 * Define Oenology Theme Settings Page Tab Markup
 * 
 * @link`http://www.onedesigns.com/tutorials/separate-multiple-theme-options-pages-using-tabs	Daniel Tara
 */
function oenology_admin_options_page_tabs( $current = 'general' ) {

    $current = oenology_get_current_tab();
    
    $tabs = oenology_get_settings_page_tabs();
    
    $links = array();
    
    foreach( $tabs as $tab ) :
		$tabname = $tab['name'];
		$tabtitle = $tab['title'];
        if ( $tabname == $current ) :
            $links[] = "<a class='nav-tab nav-tab-active' href='?page=oenology-settings&tab=$tabname'>$tabtitle</a>";
        else :
            $links[] = "<a class='nav-tab' href='?page=oenology-settings&tab=$tabname'>$tabtitle</a>";
        endif;
    endforeach;
    
    echo '<div id="icon-themes" class="icon32"><br /></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ( $links as $link )
        echo $link;
    echo '</h2>';
    
}

/**
 * Oenology Theme Settings Page Markup
 */
function oenology_admin_options_page() { 
	$currenttab = oenology_get_current_tab();
	$settings_section = 'oenology_' . $currenttab . '_tab';
	?>

	<div class="wrap">
		<?php oenology_admin_options_page_tabs(); ?>
		<?php if ( isset( $_GET['settings-updated'] ) ) {
    			echo "<div class='updated'><p>Theme settings updated successfully.</p></div>";
		} ?>
		<form action="options.php" method="post">
		<?php 
			settings_fields('theme_oenology_options');
			do_settings_sections( $settings_section );
			
			$tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'general' );
		?>
			<input name="theme_oenology_options[submit-<?php echo $tab; ?>]" type="submit" class="button-primary" value="Save Settings" />
			<input name="theme_oenology_options[reset-<?php echo $tab; ?>]" type="submit" class="button-secondary" value="Reset Defaults" />
		</form>
	</div>
<?php 
}

/**
 * Oenology Theme Settings API Implementation
 *
 * Implement the WordPress Settings API for the 
 * Oenology Theme Settings.
 * 
 * @link	http://codex.wordpress.org/Settings_API	Codex Reference: Settings API
 * @link	http://ottopress.com/2009/wordpress-settings-api-tutorial/	Otto
 * @link	http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/	Ozh
 */
function oenology_register_options(){
	require( get_template_directory() . '/functions/options-register.php' );
}
// Settings API options initilization and validation
add_action('admin_init', 'oenology_register_options');


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
add_action( 'admin_print_styles-appearance_page_oenology-reference', 'oenology_enqueue_admin_style', 11 );


/**
 * Oenology Theme Settings Page Contextual Help Content
 * 
 * Admin settings page contextual help markup
 * Separate file for ease of management
 */
function oenology_get_contextual_help_text() {
	$tabtext = '';
	require( get_template_directory() . '/functions/options-help.php' );
	return $tabtext;
}
/**
 * Enqueue Oenology Theme Settings Page Contextual Help
 */
function oenology_contextual_help() {
	$oenology_contextual_help_text = oenology_get_contextual_help_text();
	add_contextual_help( 'appearance_page_oenology-settings', $oenology_contextual_help_text  );
	add_contextual_help( 'appearance_page_oenology-reference', $oenology_contextual_help_text  );
}
// Add contextual help to Admin Options page
add_action('admin_init', 'oenology_contextual_help', 10, 3);
?>