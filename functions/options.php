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
 * Filter Capability for Theme Settings Page
 * 
 * This filter implements a WordPress 3.2 fix for
 * a minor bug, in which add_theme_page() is passed
 * the "edit_theme_options" capability, but the
 * settings page form is passed through options.php,
 * which expects the "manage_options" capability.
 * 
 * The "edit_theme_options" capability is part of the
 * EDITOR user role, while "manage_options" is only
 * available to the ADMINISTRATOR role. So, users in
 * the EDITOR user role can access the Theme settings
 * page, but are unable actually to update/save the
 * Theme settings.
 * 
 * The function is hooked into a hook, introduced in
 * WordPress 3.2: "option_page_capability_{option_page}",
 * where {option_page} is the name of the options page,
 * as defined in the fourth argument of the call to
 * add_theme_page()
 * 
 * The function returns a string consisting of the
 * appropriate capability for saving Theme settings.
 */
function oenology_get_settings_page_cap() {
	return 'edit_theme_options';
}
// Hook into option_page_capability_{option_page}
add_action( 'option_page_capability_oenology-settings', 'oenology_get_settings_page_cap' );

/**
 * Setup the Theme Admin Settings Page
 * 
 * Add "Oenology Options" link to the "Appearance" menu
 */
function oenology_add_theme_page() {
	add_theme_page(
		// $page_title
		// Name displayed in HTML title tag
		'Oenology Options', 
		// $menu_title
		// Name displayed in the Admin Menu
		'Oenology Options', 
		// $capability
		// User capability required to access page
		oenology_get_settings_page_cap(), 
		// $menu_slug
		// String to append to URL after "themes.php"
		'oenology-settings', 
		// $callback
		// Function to define settings page markup
		'oenology_admin_options_page'
	);
}
// Load the Admin Options page
add_action('admin_menu', 'oenology_add_theme_page');

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
    			echo '<div class="updated"><p>';
				echo __( 'Theme settings updated successfully.', 'oenology' );
				echo '</p></div>';
		} ?>
		<form action="options.php" method="post">
		<?php 
			settings_fields('theme_oenology_options');
			do_settings_sections( $settings_section );
		?>
			<?php submit_button( __( 'Save Settings', 'oenology' ), 'primary', 'theme_oenology_options[submit-' . $currenttab . ']', false ); ?>
			<?php submit_button( __( 'Reset Defaults', 'oenology' ), 'secondary', 'theme_oenology_options[reset-' . $currenttab . ']', false ); ?>
		</form>
	</div>
<?php 
}

/**
 * Define Oenology Theme Settings Page Tab Markup
 * 
 * @link`http://www.onedesigns.com/tutorials/separate-multiple-theme-options-pages-using-tabs	Daniel Tara
 */
function oenology_admin_options_page_tabs() {

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
 * Get current settings page tab
 */
function oenology_get_current_tab() {

    if ( isset ( $_GET['tab'] ) ) :
        $current = $_GET['tab'];
    else:
		$oenology_options = get_option( 'theme_oenology_options' );
        $current = $oenology_options['default_options_tab'];
    endif;
	
	return $current;
}

/**
 * Oenology Theme Option Defaults
 * 
 * Returns an associative array that holds 
 * all of the default values for all Theme 
 * options.
 * 
 * @uses	oenology_get_option_parameters()
 * 
 * @return	array	$defaults	associative array of option defaults
 */
function oenology_get_option_defaults() {
	$option_parameters = oenology_get_option_parameters();
	$option_defaults = array();
	foreach ( $option_parameters as $option_parameter ) {
		$name = $option_parameter['name'];
		$default = $option_parameter['default'];
		$option_defaults[$name] = $default;
	}
	return $option_defaults;
}

/**
 * Oenology Theme Option Parameters
 * 
 * Array that holds parameters for all options for
 * Oenology. The 'type' key is used to generate
 * the proper form field markup and to sanitize
 * the user-input data properly. The 'tab' key
 * determines the Settings Page on which the
 * option appears, and the 'section' tab determines
 * the section of the Settings Page tab in which
 * the option appears.
 */
function oenology_get_option_parameters() {

    $options = array(
        'header_nav_menu_position' => array(
			'name' => 'header_nav_menu_position',
			'title' => __( 'Header Nav Menu Position', 'oenology' ),
			'type' => 'select',
			'valid_options' => array(
				'above' => array(
					'name' => 'above',
					'title' => __( 'Above', 'oenology' )
				),
				'below' => array(
					'name' => 'below',
					'title' => __( 'Below', 'oenology' )
				),
				'none' => array(
					'name' => 'none',
					'title' => __( 'Do Not Display', 'oenology' )
				)
			),
			'description' => __( 'Display header navigation menu above or below the site title/description?', 'oenology' ),
			'section' => 'header',
			'tab' => 'general',
			'since' => '1.1',
			'default' => 'above'
		),
		'header_nav_menu_depth' => array(
			'name' => 'header_nav_menu_depth',
			'title' => __( 'Header Nav Menu Depth', 'oenology' ),
			'type' => 'select',
			'valid_options' => array(
				'1' => array(
					'name' => 1,
					'title' => __( 'One', 'oenology' )
				),
				'2' => array(
					'name' => 2,
					'title' => __( 'Two', 'oenology' )
				),
				'3' => array(
					'name' => 3,
					'title' => __( 'Three', 'oenology' )
				)
			),
			'description' => __( 'How many levels of Page hierarchy should the Header Navigation Menu display?', 'oenology' ),
			'section' => 'header',
			'tab' => 'general',
			'since' => '1.1',
			'default' => 1
		),
        'header_nav_menu_item_width' => array(
			'name' => 'header_nav_menu_item_width',
			'title' => __( 'Header Nav Menu Item Width', 'oenology' ),
			'type' => 'select',
			'valid_options' => array(
				'fixed' => array(
					'name' => 'fixed',
					'title' => __( 'Fixed', 'oenology' )
				),
				'fluid' => array(
					'name' => 'fluid',
					'title' => __( 'Fluid', 'oenology' )
				)
			),
			'description' => __( 'Should Header Nav Menu items have a fixed or fluid width?', 'oenology' ),
			'section' => 'header',
			'tab' => 'general',
			'since' => '2.1',
			'default' => 'fluid'
		),
        'display_footer_credit' => array(
			'name' => 'display_footer_credit',
			'title' => __( 'Display Footer Credit', 'oenology' ),
			'type' => 'select',
			'valid_options' => array(
				'false' => array(
					'name' => 'false',
					'title' => __( 'Do Not Display', 'oenology' )
				),
				'true' => array(
					'name' => 'true',
					'title' => __( 'Display', 'oenology' )
				)
			),
			'description' => __( 'Display a credit link in the footer? This option is disabled by default, and you are under no obligation whatsoever to enable it.', 'oenology' ),
			'section' => 'footer',
			'tab' => 'general',
			'since' => '1.1',
			'default' => false
		),
		'varietal' => array(
			'name' => 'varietal',
			'title' => __( 'Varietal', 'oenology' ),
			'type' => 'custom',
			'valid_options' => array(
				'cuvee' => array(
				  'name' => 'cuvee',
				  'title' => __( 'Cuvee', 'oenology' ),
				  'description' => __( 'Cuvee is a term often used by wineries to describe a particularly high-quality batch of wine. Cuvee is suitable for Child-theming.', 'oenology' ),
				  'scheme' => 'light'
				  ),
				'chardonnay' => array(
				  'name' => 'chardonnay',
				  'title' => __( 'Chardonnay', 'oenology' ),
				  'description' => __( 'Chardonnay is the ubiquitous white wine, produced from a versatile white grape.', 'oenology' ),
				  'scheme' => 'light'
				  ),
				'seyval-blanc' => array(
				  'name' => 'seyval-blanc',
				  'title' => __( 'Seyval Blanc', 'oenology' ),
				  'description' => __( 'Seyval Blanc is a white grape, typically grown in cooler climates, that produces a wine with flavors of citrus and mineral.', 'oenology' ),
				  'scheme' => 'light'
				  ),
				'muscat' => array(
				  'name' => 'muscat',
				  'title' => __( 'Muscat', 'oenology' ),
				  'description' => __( 'Muscat is a white grape with a pronounced flavor of grapes and spice, that produces a versatile wine from dry to sweet.', 'oenology' ),
				  'scheme' => 'light'
				  ),
				'syrah' => array(
				  'name' => 'syrah',
				  'title' => __( 'Syrah', 'oenology' ),
				  'description' => __( 'Syrah is a red grape that produces a full-bodied, almost inky-black wine with a spicy, earthy flavor and aroma.', 'oenology' ),
				  'scheme' => 'dark'
				  ),
				'malbec' => array(
				  'name' => 'malbec',
				  'title' => __( 'Malbec', 'oenology' ),
				  'description' => __( 'Malbec is a red grape that produces exceedingly dark, inky red-violet wins with intense flavors.', 'oenology' ),
				  'scheme' => 'dark'
				  )
			),
			'description' => '',
			'section' => 'varietal',
			'tab' => 'varietals',
			'since' => '1.1',
			'default' => 'chardonnay'
		),
		'display_social_icons' => array(
			'name' => 'display_social_icons',
			'title' => __( 'Display Social Icons', 'oenology' ),
			'type' => 'checkbox',
			'description' => __( 'Display social icons in sidebar', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => true
		),
		'rss_feed' => array(
			'name' => 'rss_feed',
			'title' => __( 'RSS Feed', 'oenology' ),
			'type' => 'select',
			'valid_options' => array( 
				'none' => array(
					'name' => 'none',
					'title' => __( 'Do Not Display', 'oenology' )
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
			'description' => __( 'RSS Feed', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => 'rss2'
		),
		'facebook_profile' => array(
			'name' => 'facebook_profile',
			'title' => __( 'Facebook Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'Facebook Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
		'flickr_profile' => array(
			'name' => 'flickr_profile',
			'title' => __( 'Flickr Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'Flickr Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
		'linkedin_profile' => array(
			'name' => 'linkedin_profile',
			'title' => __( 'Linked-In Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'Linked-In Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
		'myspace_profile' => array(
			'name' => 'myspace_profile',
			'title' => __( 'MySpace Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'MySpace Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
		'twitter_profile' => array(
			'name' => 'twitter_profile',
			'title' => __( 'Twitter Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'Twitter Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
		'youtube_profile' => array(
			'name' => 'youtube_profile',
			'title' => __( 'YouTube Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'YouTube Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '1.2',
			'default' => ''
		),
        'default_static_page_layout' => array(
			'name' => 'default_static_page_layout',
			'title' => __( 'Default Static Page Layout', 'oenology' ),
			'type' => 'radio',
			'valid_options' => oenology_get_valid_page_layouts(),
			'description' => __( 'Select the layout to be used as the default for static Pages when the "Default" page template is selected.', 'oenology' ),
			'section' => 'layouts',
			'tab' => 'layout',
			'since' => '2.3',
			'default' => 'three-column'			
			),
        'single_post_layout' => array(
			'name' => 'single_post_layout',
			'title' => __( 'Single Post Layout', 'oenology' ),
			'type' => 'radio',
			'valid_options' => oenology_get_valid_post_layouts(),
			'description' => __( 'Select the layout to be used for single Blog Posts.', 'oenology' ),
			'section' => 'layouts',
			'tab' => 'layout',
			'since' => '2.3',
			'default' => 'two-column-left'			
			),
        'post_index_layout' => array(
			'name' => 'post_index_layout',
			'title' => __( 'Blog Posts Index Layout', 'oenology' ),
			'type' => 'radio',
			'valid_options' => oenology_get_valid_post_layouts(),
			'description' => __( 'Select the layout to be used for Blog Posts Index pages.', 'oenology' ),
			'section' => 'layouts',
			'tab' => 'layout',
			'since' => '2.3',
			'default' => 'two-column-left'			
			),
        'default_options_tab' => array(
			'name' => 'default_options_tab',
			'title' => 'Default Options Page Tab',
			'type' => 'internal',
			'description' => '',
			'section' => false,
			'tab' => false,
			'since' => '2.3',
			'default' => 'varietals'
		),
        'theme_version' => array(
			'name' => 'theme_version',
			'title' => 'Theme Version',
			'type' => 'internal',
			'description' => '',
			'section' => false,
			'tab' => false,
			'since' => '1.2',
			'default' => '2.3'
		)
    );
    return $options;
}

/**
 * Get Oenology Theme Options
 * 
 * Array that holds all of the defined values
 * for Oenology Theme options. If the user 
 * has not specified a value for a given Theme 
 * option, then the option's default value is
 * used instead.
 *
 * @uses	wp_parse_args()
 * 
 * @return	array	$oenology_options	current values for all Theme options
 */
function oenology_get_options() {
	// Get the option defaults
	$option_defaults = oenology_get_option_defaults();
	// Globalize the variable that holds the Theme options
	global $oenology_options;
	// Parse the stored options with the defaults
	$oenology_options = wp_parse_args( get_option( 'theme_oenology_options', array() ), $option_defaults );
	// Return the parsed array
	return $oenology_options;
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
	$default_options = oenology_get_option_parameters();
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
        'varietals' => array(
			'name' => 'varietals',
			'title' => __( 'Varietals', 'oenology' ),
			'sections' => array(
				'varietal' => array(
					'name' => 'varietal',
					'title' => __( 'Varietal Options', 'oenology' ),
					'description' => oenology_get_varietal_text()
				)
			)
		),
        'layout' => array(
			'name' => 'layout',
			'title' => __( 'Layout', 'oenology' ),
			'sections' => array(
				'layouts' => array(
					'name' => 'layouts',
					'title' => __( 'Layout Options', 'oenology' ),
					'description' => __( 'Manage layout options for static Pages, single Blog Posts, and Blog Post Index pages', 'oenology' )
				)
			)
		),
        'general' => array(
			'name' => 'general',
			'title' => __( 'General', 'oenology' ),
			'sections' => array(
				'header' => array(
					'name' => 'header',
					'title' => __( 'Header Options', 'oenology' ),
					'description' => __( 'Manage Header options for the Oenology Theme. Refer to the contextual help screen for descriptions and help regarding each theme option.', 'oenology' )
				),
				'social' => array(
					'name' => 'social',
					'title' => __( 'Social Network Profile Options', 'oenology' ),
					'description' => __( 'Manage Social Network Profile options for the Oenology Theme. Refer to the contextual help screen for descriptions and help regarding each theme option.', 'oenology' )
				),
				'footer' => array(
					'name' => 'footer',
					'title' => __( 'Footer Options', 'oenology' ),
					'description' => __( 'Manage Footer options for the Oenology Theme. Refer to the contextual help screen for descriptions and help regarding each theme option.', 'oenology' )
				)
			)
		),
    );
	return $tabs;
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
        	'title' => __( 'YouTube', 'oenology' ),
        	'baseurl' => 'http://www.youtube.com'
        ),
        'myspace' => array(
        	'name' => 'myspace',
        	'title' => __( 'MySpace', 'oenology' ),
        	'baseurl' => 'http://www.myspace.com'
        ),
        'linkedin' => array(
        	'name' => 'linkedin',
        	'title' => __( 'Linked-In', 'oenology' ),
        	'baseurl' => 'http://www.linkedin.com/in'
        ),
        'flickr' => array(
        	'name' => 'flickr',
        	'title' => __( 'Flickr', 'oenology' ),
        	'baseurl' => 'http://www.flickr.com/photos'
        ),
        'facebook' => array(
        	'name' => 'facebook',
        	'title' => __( 'Facebook', 'oenology' ),
        	'baseurl' => 'http://www.facebook.com'
        ),
        'twitter' => array(
        	'name' => 'twitter',
        	'title' => __( 'Twitter', 'oenology' ),
        	'baseurl' => 'http://www.twitter.com'
        )
    );
	return $socialnetworks;
}

/**
 * Oenology Static Page Layout Templates
 * 
 * Array that holds all of the valid static
 * Page layouts
 */
function oenology_get_valid_page_layouts() {	
	$layouts = array( 
        'one-column' => array(
        	'name' => 'one-column',
        	'title' => __( '1-Column', 'oenology' ),
        	'description' => __( 'One column (full-width content)', 'oenology' )
        ),
        'two-column' => array(
        	'name' => 'two-column',
        	'title' => __( '2-Column', 'oenology' ),
        	'description' => __( 'Two columns (menu on left, content on right)', 'oenology' )
        ),
        'three-column' => array(
        	'name' => 'three-column',
        	'title' => __( '3-Column', 'oenology' ),
        	'description' => __( 'Three columns (menu on left, sidebar on right, content in the center)', 'oenology' )
        ),
    );
	return $layouts;
}

/**
 * Oenology Static Page Layout Templates
 * 
 * Array that holds all of the valid static
 * Page layouts
 */
function oenology_get_valid_post_layouts() {	
	$layouts = array( 
        'one-column' => array(
        	'name' => 'one-column',
        	'title' => __( '1-Column', 'oenology' ),
        	'description' => __( 'One column (full-width content)', 'oenology' )
        ),
        'two-column-left' => array(
        	'name' => 'two-column-left',
        	'title' => __( '2-Column, Left', 'oenology' ),
        	'description' => __( 'Two columns (content on the left, full-width sidebar on the right)', 'oenology' )
        ),
        'two-column-right' => array(
        	'name' => 'two-column-right',
        	'title' => __( '2-Column, Right', 'oenology' ),
        	'description' => __( 'Two columns (content on the right, full-width sidebar on the left)', 'oenology' )
        ),
        'three-column' => array(
        	'name' => 'three-column',
        	'title' => __( '3-Column', 'oenology' ),
        	'description' => __( 'Three columns (content in the center, half-width sidebars on the left and right)', 'oenology' )
        ),
    );
	return $layouts;
}
?>