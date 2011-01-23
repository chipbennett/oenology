<?php
/*****************************************************************************************
* Theme Options Functions
* 
*  - Define Default Theme Options
*  - Register/Initialize Theme Options
*  - Define Admin Settings Page
*  - Register Contextual Help
*******************************************************************************************/

global $oenology_options;
global $oenology_admin_options_hook;

/*****************************************************************************************
* Define the default options
*******************************************************************************************/
global $oenology_options_default;
$oenology_options_default = array(
		'header_nav_menu_position' => 'top',
		'display_footer_credit' => false,
		'theme_version' => '1.1'
);


/*****************************************************************************************
* Setup initial Theme options
*******************************************************************************************/

function oenology_options_init() {

	// set options equal to defaults
	global $oenology_options_default;
	global $oenology_options;
	$oenology_options = get_option( 'theme_oenology_options' );
	
	if ( false === $oenology_options ) {
		$oenology_options_initial = $oenology_options_default;
	}
}
// Initialize Theme options
add_action('after_setup_theme', 'oenology_options_init', 9 );


/*****************************************************************************************
* Setup the Theme Admin Settings Page
*******************************************************************************************/

// Add "Theme Options" link to the "Appearance" menu
function oenology_menu() {
	global $oenology_admin_options_hook;
	$oenology_admin_options_hook = add_theme_page('Theme Options', 'oenology', 'edit_theme_options', 'oenology', 'oenology_admin_options_page');
}
// Load the Admin Options page
add_action('admin_menu', 'oenology_menu');


// Admin settings page markup 
function oenology_admin_options_page() { ?>
	<div>
		<h2>Oenology Theme Options</h2>
		<p>Manage options for the Oenology Theme</p>
		<form action="options.php" method="post">
			<?php 
			settings_fields('theme_oenology_options');
			do_settings_sections('oenology');
			?>
			<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
		</form>
	</div>
<?php }

// Codex Reference: http://codex.wordpress.org/Settings_API
// Codex Reference: http://codex.wordpress.org/Data_Validation
// Reference: http://ottopress.com/2009/wordpress-settings-api-tutorial/
// Reference: http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
function oenology_admin_init(){
	include_once( 'functions-options-init.php' );
}
// Settings API options initilization and validation
add_action('admin_init', 'oenology_admin_init');


/*****************************************************************************************
* Setup the Theme Admin Settings Page Contextual help
*******************************************************************************************/

// Admin settings page contextual help markup
// Separate file for ease of management
function oenology_contextual_help( $contextual_help, $screen_id, $screen ) {		
	global $oenology_admin_options_hook;
	include_once( 'functions-options-help.php' );
	if ( $screen_id == $oenology_admin_options_hook ) {
		$contextual_help = $text;
	}
	return $contextual_help;
}
// Add contextual help to Admin Options page
add_action('contextual_help', 'oenology_contextual_help', 10, 3);
?>