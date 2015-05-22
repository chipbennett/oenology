<?php
/**
 * Oenology Theme Options Configuration
 *
 * This file defines the Options configuration for the Oenology Theme.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2015, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 3.4
 */
 
 /**
 * Oenology Theme Option Parameters
 * 
 * Array that holds parameters for all options for
 * Oenology. The 'type' key is used to generate
 * the proper form field markup and to sanitize
 * the user-input data properly. The 'panel' key
 * determines the Settings Page on which the
 * option appears, and the 'section' panel determines
 * the section of the Settings Page panel in which
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
			'panel' => 'general',
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
			'panel' => 'general',
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
			'panel' => 'general',
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
			'panel' => 'general',
			'since' => '1.1',
			'default' => false
		),
		'varietal' => array(
			'name' => 'varietal',
			'title' => __( 'Varietal', 'oenology' ),
			'type' => 'radio-image',
			'valid_options' => array(
				'chardonnay' => array(
				  'name' => 'chardonnay',
				  'title' => __( 'Chardonnay', 'oenology' ),
				  'description' => __( 'Chardonnay is the ubiquitous white wine, produced from a versatile white grape. Color: White.', 'oenology' ),
				  'scheme' => 'light',
				  'image' => get_template_directory_uri() . '/varietals/chardonnay.png'
				  ),
				'seyval-blanc' => array(
				  'name' => 'seyval-blanc',
				  'title' => __( 'Seyval Blanc', 'oenology' ),
				  'description' => __( 'Seyval Blanc is a white grape, typically grown in cooler climates, that produces a wine with flavors of citrus and mineral. Color: Light Beige.', 'oenology' ),
				  'scheme' => 'light',
				  'image' => get_template_directory_uri() . '/varietals/seyval-blanc.png'
				  ),
				'muscat' => array(
				  'name' => 'muscat',
				  'title' => __( 'Muscat', 'oenology' ),
				  'description' => __( 'Muscat is a white grape with a pronounced flavor of grapes and spice, that produces a versatile wine from dry to sweet. Color: Light Green.', 'oenology' ),
				  'scheme' => 'light',
				  'image' => get_template_directory_uri() . '/varietals/muscat.png'
				  ),
				'syrah' => array(
				  'name' => 'syrah',
				  'title' => __( 'Syrah', 'oenology' ),
				  'description' => __( 'Syrah is a red grape that produces a full-bodied, almost inky-black wine with a spicy, earthy flavor and aroma. Color: Black.', 'oenology' ),
				  'scheme' => 'dark',
				  'image' => get_template_directory_uri() . '/varietals/syrah.png'
				  ),
				'malbec' => array(
				  'name' => 'malbec',
				  'title' => __( 'Malbec', 'oenology' ),
				  'description' => __( 'Malbec is a red grape that produces exceedingly dark, inky red-violet wins with intense flavors. Color: Dark Green.', 'oenology' ),
				  'scheme' => 'dark',
				  'image' => get_template_directory_uri() . '/varietals/malbec.png'
				  ),
				'pinot-noir' => array(
				  'name' => 'pinot-noir',
				  'title' => __( 'Pinot Noir', 'oenology' ),
				  'description' => __( 'Pinot Noir is an extremely fickle yet versatile red grape from Burgundy. Color: Dark Red.', 'oenology' ),
				  'scheme' => 'dark',
				  'image' => get_template_directory_uri() . '/varietals/pinot-noir.png'
				  ),
				'zinfandel' => array(
				  'name' => 'zinfandel',
				  'title' => __( 'Zinfandel', 'oenology' ),
				  'description' => __( 'Zinfandel is a red grape known for its spicy, peppery, and berry characteristics. Color: Dark Blue.', 'oenology' ),
				  'scheme' => 'dark',
				  'image' => get_template_directory_uri() . '/varietals/zinfandel.png'
				  ),
				'solarized-light' => array(
				  'name' => 'solarized-light',
				  'title' => __( 'Solarized Light', 'oenology' ),
				  'description' => __( 'Solarized is a sixteen color palette (eight monotones, eight accent colors) designed for selective contrast. Solarized Light and Solarized Dark are my attempt at color schemes that meet accessibility requirements.', 'oenology' ),
				  'scheme' => 'light',
				  'image' => get_template_directory_uri() . '/varietals/solarized-light.png'
				  ),
				'solarized-dark' => array(
				  'name' => 'solarized-dark',
				  'title' => __( 'Solarized Dark', 'oenology' ),
				  'description' => __( 'Solarized is a sixteen color palette (eight monotones, eight accent colors) designed for selective contrast. Solarized Light and Solarized Dark are my attempt at color schemes that meet accessibility requirements.', 'oenology' ),
				  'scheme' => 'dark',
				  'image' => get_template_directory_uri() . '/varietals/solarized-dark.png'
				  ),
				'cuvee' => array(
				  'name' => 'cuvee',
				  'title' => __( 'Cuvee', 'oenology' ),
				  'description' => __( 'Cuvee is a term often used by wineries to describe a particularly high-quality batch of wine. Cuvee is suipanelle for Child-theming. Color: None.', 'oenology' ),
				  'scheme' => 'cuvee',
				  'image' => get_template_directory_uri() . '/varietals/cuvee.png'
				  ),
			),
			'label' => __( 'Color Scheme', 'oenology' ),
			'description' => '',
			'section' => 'varietal',
			'panel' => 'varietals',
			'since' => '1.1',
			'default' => 'chardonnay'
		),
        'default_static_page_layout' => array(
			'name' => 'default_static_page_layout',
			'title' => __( 'Default Static Page Layout', 'oenology' ),
			'type' => 'radio-image',
			'valid_options' => array(
				'one-column' => array(
					'name' => 'one-column',
					'title' => __( '1-Column', 'oenology' ),
					'description' => __( 'One column (full-width content)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/1c.png'
				),
				'two-column' => array(
					'name' => 'two-column',
					'title' => __( '2-Column, Menu on Left', 'oenology' ),
					'description' => __( 'Two columns (menu on left, content on right)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/2cl.png'
				),
				'two-column-right-sidebar' => array(
					'name' => 'two-column-right-sidebar',
					'title' => __( '2-Column, Sidebar on Right', 'oenology' ),
					'description' => __( 'Two columns (content on left, sidebar on right)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/2cr.png'
				),
				'three-column' => array(
					'name' => 'three-column',
					'title' => __( '3-Column', 'oenology' ),
					'description' => __( 'Three columns (menu on left, sidebar on right, content in the center)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/3cm.png'
				),
			),
			'description' => __( 'Default layout for static Pages when the "Default" page template is selected. Can be customized per page.', 'oenology' ),
			'section' => 'default_layouts',
			'panel' => 'layout',
			'since' => '2.3',
			'default' => 'three-column'			
			),
        'default_single_post_layout' => array(
			'name' => 'default_single_post_layout',
			'title' => __( 'Default Single Post Layout', 'oenology' ),
			'type' => 'radio-image',
			'valid_options' => array(
				'one-column' => array(
					'name' => 'one-column',
					'title' => __( '1-Column', 'oenology' ),
					'description' => __( 'One column (full-width content)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/1c.png'
				),
				'two-column-right' => array(
					'name' => 'two-column-right',
					'title' => __( '2-Column, Right', 'oenology' ),
					'description' => __( 'Two columns (content on the right, full-width sidebar on the left)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/3cl.png'
				),
				'two-column-left' => array(
					'name' => 'two-column-left',
					'title' => __( '2-Column, Left', 'oenology' ),
					'description' => __( 'Two columns (content on the left, full-width sidebar on the right)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/3cr.png'
				),
				'three-column' => array(
					'name' => 'three-column',
					'title' => __( '3-Column', 'oenology' ),
					'description' => __( 'Three columns (content in the center, half-width sidebars on the left and right)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/3cm.png'
				),
			),
			'description' => __( 'Default layout for single Blog Posts. Can be customized per post.', 'oenology' ),
			'section' => 'default_layouts',
			'panel' => 'layout',
			'since' => '2.3',
			'default' => 'two-column-left'			
			),
        'post_index_layout' => array(
			'name' => 'post_index_layout',
			'title' => __( 'Blog Posts Index Layout', 'oenology' ),
			'type' => 'radio-image',
			'valid_options' => array(
				'one-column' => array(
					'name' => 'one-column',
					'title' => __( '1-Column', 'oenology' ),
					'description' => __( 'One column (full-width content)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/1c.png'
				),
				'two-column-right' => array(
					'name' => 'two-column-right',
					'title' => __( '2-Column, Right', 'oenology' ),
					'description' => __( 'Two columns (content on the right, full-width sidebar on the left)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/3cl.png'
				),
				'two-column-left' => array(
					'name' => 'two-column-left',
					'title' => __( '2-Column, Left', 'oenology' ),
					'description' => __( 'Two columns (content on the left, full-width sidebar on the right)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/3cr.png'
				),
				'three-column' => array(
					'name' => 'three-column',
					'title' => __( '3-Column', 'oenology' ),
					'description' => __( 'Three columns (content in the center, half-width sidebars on the left and right)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/3cm.png'
				),
			),
			'description' => __( 'Layout for Blog Posts Index pages.', 'oenology' ),
			'section' => 'default_layouts',
			'panel' => 'layout',
			'since' => '2.3',
			'default' => 'two-column-left'			
			),
        'default_front_page_layout' => array(
			'name' => 'default_front_page_layout',
			'title' => __( 'Default Static Front Page Layout', 'oenology' ),
			'type' => 'radio-image',
			'valid_options' => array(
				'one-column' => array(
					'name' => 'one-column',
					'title' => __( '1-Column', 'oenology' ),
					'description' => __( 'One column (full-width content)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/1c.png'
				),
				'two-column' => array(
					'name' => 'two-column',
					'title' => __( '2-Column', 'oenology' ),
					'description' => __( 'Two columns (menu on left, content on right)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/2cl.png'
				),
				'three-column' => array(
					'name' => 'three-column',
					'title' => __( '3-Column', 'oenology' ),
					'description' => __( 'Three columns (menu on left, sidebar on right, content in the center)', 'oenology' ),
					'image' => get_template_directory_uri() . '/images/layouts/3cm.png'
				),
			),
			'description' => __( 'Default layout for a static front page.', 'oenology' ),
			'section' => 'default_layouts',
			'panel' => 'layout',
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
			'panel' => 'layout',
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
			'panel' => 'general',
			'since' => '3.0',
			'default' => 'none'
		),
    );
    return apply_filters( 'oenology_get_option_parameters', $options );
}

 
/**
 * Oenology Theme Customizer Panels
 * 
 * Array that holds all of the panels for the
 * Oenology Theme Customizer. Each panel
 * key holds an array that defines the 
 * sections for each panel, including the
 * description text.
 * 
 * @return	array	$panels	array of arrays of customizer panel parameters
 */
function oenology_get_customizer_panels() {
	
	$panels = array( 
        'varietals' => array(
			'name' => 'varietals',
			'title' => __( 'Theme Color Options', 'oenology' ),
			'sections' => array(
				'varietal' => array(
					'name' => 'varietal',
					'title' => __( 'Color Scheme', 'oenology' ),
					'description' => __( '"Varietal" refers to wine made from exclusively or predominantly one variety of grape. Each varietal has unique flavor and aromatic characteristics.', 'oenology' )
				)
			)
		),
        'layout' => array(
			'name' => 'layout',
			'title' => __( 'Theme Layout Options', 'oenology' ),
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
			'title' => __( 'Theme General Options', 'oenology' ),
			'sections' => array(
				'header' => array(
					'name' => 'header',
					'title' => __( 'Header Options', 'oenology' ),
					'description' => __( 'Manage Header options for the Oenology Theme.', 'oenology' )
				),
				'widgets' => array(
					'name' => 'widgets',
					'title' => __( 'Widget Display Options', 'oenology' ),
					'description' => __( 'Manage Widget options for the Oenology Theme.', 'oenology' )
				),
				'footer' => array(
					'name' => 'footer',
					'title' => __( 'Footer Options', 'oenology' ),
					'description' => __( 'Manage Footer options for the Oenology Theme.', 'oenology' )
				)
			)
		),
    );
	return apply_filters( 'oenology_get_customizer_panels', $panels );
}