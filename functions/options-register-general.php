<?php 
/*****************************************************************************************
* Add Theme Settings Form Sections
*******************************************************************************************/
	
// Add a form section for the Header settings
add_settings_section('oenology_settings_general_header', 'Header Options', 'oenology_settings_general_header_section_text', 'oenology');
	
// Add a form section for the Footer settings
add_settings_section('oenology_settings_general_footer', 'Footer Options', 'oenology_settings_general_footer_section_text', 'oenology');
	
/*****************************************************************************************
* Add Form Fields to Header Settings Section
*******************************************************************************************/
	
// Add Header Navigation Menu Position setting to the Header section
add_settings_field('oenology_setting_header_nav_menu_position', 'Header Nav Menu Position', 'oenology_setting_header_nav_menu_position', 'oenology', 'oenology_settings_general_header');	
// Add Header Navigation Menu Depth setting to the Header section
add_settings_field('oenology_setting_header_nav_menu_depth', 'Header Nav Menu Depth', 'oenology_setting_header_nav_menu_depth', 'oenology', 'oenology_settings_general_header');
	
/*****************************************************************************************
* Add Form Fields to Footer Settings Section
*******************************************************************************************/	

// Add Footer Credit Link setting to the Footer section
add_settings_field('oenology_setting_display_footer_credit', 'Footer Credit', 'oenology_setting_display_footer_credit', 'oenology', 'oenology_settings_general_footer');

/*****************************************************************************************
* Add Section Text for Each Form Section
*******************************************************************************************/

// Header Settings Section
function oenology_settings_general_header_section_text() { ?>
	<p><?php _e( 'Manage Header options for the Oenology Theme. Refer to the contextual help screen for descriptions and help regarding each theme option.', 'oenology' ); ?></p>
<?php }

// Footer Settings Section
function oenology_settings_general_footer_section_text() { ?>
	<p><?php _e( 'Manage Footer options for the Oenology Theme. Refer to the contextual help screen for descriptions and help regarding each theme option.', 'oenology' ); ?></p>
<?php }

/*****************************************************************************************
* Add Form Field Markup for Each Theme Option
*******************************************************************************************/

// Navigation Menu Position Setting
function oenology_setting_header_nav_menu_position() {
	$oenology_options = get_option( 'theme_oenology_options' ); ?>
	<select name="theme_oenology_options[header_nav_menu_position]">
		<option <?php selected( 'above' == $oenology_options['header_nav_menu_position'] ); ?> value="above">Above</option>
		<option <?php selected( 'below' == $oenology_options['header_nav_menu_position'] ); ?> value="below">Below</option>
	</select>
	<span class="description">Display header navigation menu above or below the site title/description?</span>
<?php }

// Navigation Menu Position Depth
function oenology_setting_header_nav_menu_depth() {
	$oenology_options = get_option( 'theme_oenology_options' ); ?>	
	<select name="theme_oenology_options[header_nav_menu_depth]">
		<option <?php selected( 1 == $oenology_options['header_nav_menu_depth'] ); ?> value="1">One</option>
		<option <?php selected( 2 == $oenology_options['header_nav_menu_depth'] ); ?> value="2">Two</option>
		<option <?php selected( 3 == $oenology_options['header_nav_menu_depth'] ); ?> value="3">Three</option>
	</select>
	<span class="description">How many levels of Page hierarchy should the Header Navigation Menu display?</span>
<?php }

// Display Footer Credit Setting
function oenology_setting_display_footer_credit() {
	$oenology_options = get_option( 'theme_oenology_options' ); ?>
	<select name="theme_oenology_options[display_footer_credit]">
		<option <?php selected( false == $oenology_options['display_footer_credit'] ); ?> value="false">Do Not Display</option>
		<option <?php selected( true == $oenology_options['display_footer_credit'] ); ?> value="true">Display</option>
	</select>
	<span class="description">Display a credit link in the footer? This option is disabled by default, and you are under no obligation whatsoever to enable it.</span>
<?php }
?>