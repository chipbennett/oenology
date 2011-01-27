<?php 

global $oenology_options;
$oenology_options = get_option( 'theme_oenology_options' );

/*****************************************************************************************
* Register Theme Settings
*******************************************************************************************/
	
// Register theme_oenology_options array to hold all theme options
register_setting( 'theme_oenology_options', 'theme_oenology_options', 'oenology_options_validate' );

/*****************************************************************************************
* Add Theme Settings Form Sections
*******************************************************************************************/
	
// Add a form section for the General theme settings
add_settings_section('oenology_settings_general', 'General Options', 'oenology_settings_general_section_text', 'oenology');
	
/*****************************************************************************************
* Add Form Fields to General Settings Section
*******************************************************************************************/
	
// Add Header Navigation Menu Position setting to the General section
add_settings_field('oenology_setting_header_nav_menu_position', 'Header Nav Menu Position', 'oenology_setting_header_nav_menu_position', 'oenology', 'oenology_settings_general');
// Add Footer Credit Link setting to the General section
add_settings_field('oenology_setting_display_footer_credit', 'Footer Credit', 'oenology_setting_display_footer_credit', 'oenology', 'oenology_settings_general');

/*****************************************************************************************
* Add Section Text for Each Form Section
*******************************************************************************************/

// General Settings Section
function oenology_settings_general_section_text() { ?>
	<p><?php _e( 'Refer to the contextual help screen for descriptions and help regarding each theme option.', 'oenology' ); ?></p>
<?php }

/*****************************************************************************************
* Add Form Field Markup for Each Theme Option
*******************************************************************************************/

// Navigation Menu Position Setting
function oenology_setting_header_nav_menu_position() {
	$oenology_options = get_option( 'theme_oenology_options' ); ?>
	<p>
		<label for="oenology_header_nav_menu_position">
			Display header navigation menu above or below the site title/description?<br />
			<select name="theme_oenology_options[header_nav_menu_position]">
				<option <?php selected( 'above' == $oenology_options['header_nav_menu_position'] ); ?> value="above">Above</option>
				<option <?php selected( 'below' == $oenology_options['header_nav_menu_position'] ); ?> value="below">Below</option>
			</select>
		</label>
	</p>
<?php }

// Display Footer Credit Setting
function oenology_setting_display_footer_credit() {
	$oenology_options = get_option( 'theme_oenology_options' ); ?>
	<p>
		<label for="oenology_display_footer_credit">
			Display a credit link in the footer? This option is disabled by default, and you are under no obligation whatsoever to enable it.<br />
			<select name="theme_oenology_options[display_footer_credit]">
				<option <?php selected( false == $oenology_options['display_footer_credit'] ); ?> value="false">Do Not Display</option>
				<option <?php selected( true == $oenology_options['display_footer_credit'] ); ?> value="true">Display</option>
			</select>
		</label>
	</p>
<?php }


/*****************************************************************************************
* Validate/Whitelist User-Input Data Before Updating Theme Options
*******************************************************************************************/
function oenology_options_validate( $input ) {

	$oenology_options = get_option( 'theme_oenology_options' );

	$valid_input = $oenology_options;	
	
	$valid_input['header_nav_menu_position'] = ( 'below' == $input['header_nav_menu_position'] ? 'below' : 'above' );
	$valid_input['display_footer_credit'] = ( 'true' == $input['display_footer_credit'] ? true : false );	
	
	return $valid_input;
}
?>