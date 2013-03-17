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
add_action( 'admin_init', 'oenology_register_options' );

/**
 * Setup the Theme Admin Settings Page
 * 
 * Add "Oenology Options" link to the "Appearance" menu
 * 
 * @uses	oenology_get_settings_page_cap()	defined in \functions\wordpress-hooks.php
 */
function oenology_add_theme_page() {
	// Globalize Theme options page
	global $oenology_settings_page;
	// Add Theme options page
	$oenology_settings_page = add_theme_page(
		// $page_title
		// Name displayed in HTML title tag
		__( 'Oenology Options', 'oenology' ), 
		// $menu_title
		// Name displayed in the Admin Menu
		__( 'Oenology Options', 'oenology' ), 
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
	// Load contextual help
	add_action( 'load-' . $oenology_settings_page, 'oenology_settings_page_contextual_help' );
}
// Load the Admin Options page
add_action( 'admin_menu', 'oenology_add_theme_page' );

/**
 * Oenology Theme Settings Page Markup
 * 
 * @uses	oenology_get_current_tab()	defined in \functions\custom.php
 * @uses	oenology_get_page_tab_markup()	defined in \functions\custom.php
 */
function oenology_admin_options_page() { 
	// Determine the current page tab
	$currenttab = oenology_get_current_tab();
	// Define the page section accordingly
	$settings_section = 'oenology_' . $currenttab . '_tab';
	?>

	<div class="wrap">
		<?php oenology_get_page_tab_markup(); ?>
		<?php if ( isset( $_GET['settings-updated'] ) ) {
    			echo '<div class="updated"><p>';
				echo __( 'Theme settings updated successfully.', 'oenology' );
				echo '</p></div>';
		} ?>
		<form action="options.php" method="post">
		<?php 
			// Implement settings field security, nonces, etc.
			settings_fields('theme_oenology_options');
			// Output each settings section, and each
			// Settings field in each section
			do_settings_sections( $settings_section );
		?>
			<?php submit_button( __( 'Save Settings', 'oenology' ), 'primary', 'theme_oenology_options[submit-' . $currenttab . ']', false ); ?>
			<?php submit_button( __( 'Reset Defaults', 'oenology' ), 'secondary', 'theme_oenology_options[reset-' . $currenttab . ']', false ); ?>
		</form>
	</div>
<?php 
}

/**
 * Oenology Theme Option Defaults
 * 
 * Returns an associative array that holds 
 * all of the default values for all Theme 
 * options.
 * 
 * @uses	oenology_get_option_parameters()	defined in \functions\options.php
 * 
 * @return	array	$defaults	associative array of option defaults
 */
function oenology_get_option_defaults() {
	// Get the array that holds all
	// Theme option parameters
	$option_parameters = oenology_get_option_parameters();
	// Initialize the array to hold
	// the default values for all
	// Theme options
	$option_defaults = array();
	// Loop through the option
	// parameters array
	foreach ( $option_parameters as $option_parameter ) {
		$name = $option_parameter['name'];
		// Add an associative array key
		// to the defaults array for each
		// option in the parameters array
		$option_defaults[$name] = $option_parameter['default'];
	}
	// Return the defaults array
	return apply_filters( 'oenology_option_defaults', $option_defaults );
}

/**
 * Define default options tab
 */
function oenology_define_default_options_tab( $options ) {
	$options['default_options_tab'] = 'varietals';
	return $options;
}
add_filter( 'oenology_option_defaults', 'oenology_define_default_options_tab' );

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
 * 
 * @return	array	$options	array of arrays of option parameters
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
				'solarized-light' => array(
				  'name' => 'solarized-light',
				  'title' => __( 'Solarized Light', 'oenology' ),
				  'description' => __( 'DESCRIPTION GOES HERE.', 'oenology' ),
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
				  ),
				'pinot-noir' => array(
				  'name' => 'pinot-noir',
				  'title' => __( 'Pinot Noir', 'oenology' ),
				  'description' => __( 'Pinot Noir is an extremely fickle yet versatile red grape from Burgundy.', 'oenology' ),
				  'scheme' => 'dark'
				  ),
				'zinfandel' => array(
				  'name' => 'zinfandel',
				  'title' => __( 'Zinfandel', 'oenology' ),
				  'description' => __( 'Zinfandel is a red grape known for its spicy, peppery, and berry characteristics.', 'oenology' ),
				  'scheme' => 'dark'
				  ),
				'solarized-dark' => array(
				  'name' => 'solarized-dark',
				  'title' => __( 'Solarized Dark', 'oenology' ),
				  'description' => __( 'DESCRIPTION GOES HERE.', 'oenology' ),
				  'scheme' => 'dark'
				  ),
				'cuvee' => array(
				  'name' => 'cuvee',
				  'title' => __( 'Cuvee', 'oenology' ),
				  'description' => __( 'Cuvee is a term often used by wineries to describe a particularly high-quality batch of wine. Cuvee is suitable for Child-theming.', 'oenology' ),
				  'scheme' => 'cuvee'
				  ),
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
		'dribbble_profile' => array(
			'name' => 'dribbble_profile',
			'title' => __( 'Dribbble Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'Dribbble Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '3.2',
			'default' => ''
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
		'github_profile' => array(
			'name' => 'github_profile',
			'title' => __( 'GitHub Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'GitHub Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '3.2',
			'default' => ''
		),
		'googleplus_profile' => array(
			'name' => 'googleplus_profile',
			'title' => __( 'Google+ Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'Google+ Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '3.2',
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
		'pinterest_profile' => array(
			'name' => 'pinterest_profile',
			'title' => __( 'Pinterest Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'Pinterest Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '3.2',
			'default' => ''
		),
		'tumblr_profile' => array(
			'name' => 'tumblr_profile',
			'title' => __( 'Tumblr Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'Tumblr Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '3.2',
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
		'vimeo_profile' => array(
			'name' => 'vimeo_profile',
			'title' => __( 'Vimeo Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'Vimeo Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '3.2',
			'default' => ''
		),
		'wordpress_profile' => array(
			'name' => 'wordpress_profile',
			'title' => __( 'WordPress Profile', 'oenology' ),
			'type' => 'text',
			'sanitize' => 'nohtml',
			'description' => __( 'WordPress Username', 'oenology' ),
			'section' => 'social',
			'tab' => 'general',
			'since' => '3.2',
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
			'valid_options' => array(
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
			),
			'description' => __( 'Select the layout to be used as the default for static Pages when the "Default" page template is selected.', 'oenology' ),
			'section' => 'default_layouts',
			'tab' => 'layout',
			'since' => '2.3',
			'default' => 'three-column'			
			),
        'default_single_post_layout' => array(
			'name' => 'default_single_post_layout',
			'title' => __( 'Default Single Post Layout', 'oenology' ),
			'type' => 'radio',
			'valid_options' => array(
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
			),
			'description' => __( 'Select the default layout to be used for single Blog Posts.', 'oenology' ),
			'section' => 'default_layouts',
			'tab' => 'layout',
			'since' => '2.3',
			'default' => 'two-column-left'			
			),
        'post_index_layout' => array(
			'name' => 'post_index_layout',
			'title' => __( 'Blog Posts Index Layout', 'oenology' ),
			'type' => 'radio',
			'valid_options' => array(
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
			),
			'description' => __( 'Select the layout to be used for Blog Posts Index pages.', 'oenology' ),
			'section' => 'default_layouts',
			'tab' => 'layout',
			'since' => '2.3',
			'default' => 'two-column-left'			
			),
        'default_front_page_layout' => array(
			'name' => 'default_front_page_layout',
			'title' => __( 'Default Static Front Page Layout', 'oenology' ),
			'type' => 'radio',
			'valid_options' => array(
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
			),
			'description' => __( 'Select the layout to be used as the default for a static front page.', 'oenology' ),
			'section' => 'default_layouts',
			'tab' => 'layout',
			'since' => '3.0',
			'default' => 'one-column'			
			),
        'static_page_submenu_display' => array(
			'name' => 'static_page_submenu_display',
			'title' => __( 'Static Page Submenu Display', 'oenology' ),
			'type' => 'select',
			'valid_options' => array(
				'always' => array(
					'name' => 'always',
					'title' => __( 'Always Display', 'oenology' )
				),
				'hierarchical' => array(
					'name' => 'hierarchical',
					'title' => __( 'Display Only on Hierarchical Pages', 'oenology' )
				),
				'never' => array(
					'name' => 'never',
					'title' => __( 'Never Display', 'oenology' )
				)
			),
			'description' => __( 'Display the static Page left-column submenu?', 'oenology' ),
			'section' => 'static_page_layout_options',
			'tab' => 'layout',
			'since' => '2.5',
			'default' => 'always'
		),
        'widget_display_default_state' => array(
			'name' => 'widget_display_default_state',
			'title' => __( 'Default Widget Display State', 'oenology' ),
			'type' => 'select',
			'valid_options' => array(
				'block' => array(
					'name' => 'block',
					'title' => __( 'Display Content', 'oenology' )
				),
				'none' => array(
					'name' => 'none',
					'title' => __( 'Hide Content', 'oenology' )
				),
			),
			'description' => __( 'The content of each Widget can be displayed or hidden via the "Show/Hide" link. Should Widget content be displayed or hidden by default?', 'oenology' ),
			'section' => 'widgets',
			'tab' => 'general',
			'since' => '3.0',
			'default' => 'none'
		),
    );
    return apply_filters( 'oenology_get_option_parameters', $options );
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
 * @uses	oenology_get_option_defaults()	defined in \functions\options.php
 * 
 * @uses	get_option()
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
 * 
 * Returns an array of tabs, each of
 * which is an indexed array of settings
 * included with the specified tab.
 *
 * @uses	oenology_get_option_parameters()	defined in \functions\options.php
 * @uses	oenology_get_settings_page_tabs()	defined in \functions\options.php
 * 
 * @return	array	$settingsbytab	array of arrays of settings by tab
 */
function oenology_get_settings_by_tab() {
	// Get the list of settings page tabs
	$tabs = oenology_get_settings_page_tabs();
	// Initialize an array to hold
	// an indexed array of tabnames
	$settingsbytab = array();
	// Loop through the array of tabs
	foreach ( $tabs as $tab ) {
		$tabname = $tab['name'];
		// Add an indexed array key
		// to the settings-by-tab 
		// array for each tab name
		$settingsbytab[] = $tabname;
	}
	// Get the array of option parameters
	$option_parameters = oenology_get_option_parameters();
	// Loop through the option parameters
	// array
	foreach ( $option_parameters as $option_parameter ) {
		$optiontab = $option_parameter['tab'];
		$optionname = $option_parameter['name'];
		// Add an indexed array key to the 
		// settings-by-tab array for each
		// setting associated with each tab
		$settingsbytab[$optiontab][] = $optionname;
		$settingsbytab['all'][] = $optionname;
	}
	// Return the settings-by-tab
	// array
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
 * 
 * @uses	oenology_get_varietal_text()	defined in \functions\options-register.php
 * 
 * @return	array	$tabs	array of arrays of tab parameters
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
				'default_layouts' => array(
					'name' => 'default_layouts',
					'title' => __( 'Default Layouts', 'oenology' ),
					'description' => __( 'Manage default layouts for static Pages, single Blog Posts, and Blog Post Index pages', 'oenology' )
				),
				'static_page_layout_options' => array(
					'name' => 'static_page_layout_options',
					'title' => __( 'Static Page Layout Options', 'oenology' ),
					'description' => __( 'Manage options related to static Page layout', 'oenology' )
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
				'widgets' => array(
					'name' => 'widgets',
					'title' => __( 'Widget Display Options', 'oenology' ),
					'description' => __( 'Manage Widget options for the Oenology Theme. Refer to the contextual help screen for descriptions and help regarding each theme option.', 'oenology' )
				),
				'footer' => array(
					'name' => 'footer',
					'title' => __( 'Footer Options', 'oenology' ),
					'description' => __( 'Manage Footer options for the Oenology Theme. Refer to the contextual help screen for descriptions and help regarding each theme option.', 'oenology' )
				)
			)
		),
    );
	return apply_filters( 'oenology_get_settings_page_tabs', $tabs );
}

/**
 * Add Section Text for the Varietal Settings Section
 */
function oenology_get_varietal_text() {

	$oenology_options = oenology_get_options();
	$option_parameters = oenology_get_option_parameters();
	$oenology_varietals = $option_parameters['varietal']['valid_options'];
	foreach ( $oenology_varietals as $varietal ) {
		if ( $varietal['name'] == $oenology_options['varietal'] ) {
		      $oenology_current_varietal = $varietal;
		}
	}
	$varietal_thumbnail_url = oenology_locate_template_uri( array( 'varietals/' . $oenology_options['varietal'] . '.png' ), false, false ); 
	$text = '';
	$text .= '<p>"Varietal" refers to wine made from exclusively or predominantly one variety of grape. Each varietal has unique flavor and aromatic characteristics. Refer to the contextual help screen for descriptions and help regarding each theme option.</p>';
	$text .= '<img class="oenology-varietal-thumb" src="' . $varietal_thumbnail_url . '" width="150px" height="110px" alt="' . $oenology_options['varietal'] . '" />';
	$text .= '<h4>Current Varietal</h4>';
	$text .= '<dl><dt><strong>' . $oenology_current_varietal['title'] . '</strong></dt><dd>' . $oenology_current_varietal['description'] . '</dd></dl>';
	return $text;
}
?>