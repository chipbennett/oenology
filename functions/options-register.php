<?php 

global $oenology_options;
$oenology_options = get_option( 'theme_oenology_options' );

/*****************************************************************************************
* Register Theme Settings
*******************************************************************************************/
	
// Register theme_oenology_options array to hold all theme options
register_setting( 'theme_oenology_options', 'theme_oenology_options', 'oenology_options_validate' );


/*****************************************************************************************
* Register Settings Per Tab Content
*******************************************************************************************/

global $pagenow;
if ( 'themes.php' == $pagenow && isset( $_GET['page'] ) && 'oenology-settings' == $_GET['page'] ) :
    if ( isset ( $_GET['tab'] ) ) :
        $tab = $_GET['tab'];
    else:
        $tab = 'general';
    endif;
    switch ( $tab ) :
        case 'general' :
            require( get_template_directory() . '/functions/options-register-general.php' );
            break;
        case 'varietals' :
            require( get_template_directory() . '/functions/options-register-varietals.php' );
            break;
    endswitch;
endif;


/*****************************************************************************************
* Validate/Whitelist User-Input Data Before Updating Theme Options
*******************************************************************************************/

// Codex Reference: http://codex.wordpress.org/Data_Validation
function oenology_options_validate( $input ) {

	$oenology_options = get_option( 'theme_oenology_options' );
	$valid_input = $oenology_options;
	
	// Determine which form action was submitted
	$submit_general = ( ! empty( $input['submit-general']) ? true : false );	
	$reset_general = ( ! empty($input['reset-general']) ? true : false );
	$submit_varietals = ( ! empty($input['submit-varietals']) ? true : false );
	$reset_varietals = ( ! empty($input['reset-varietals']) ? true : false );
	
	if ( $submit_general ) { // if General Settings Submit
	
		$valid_input['header_nav_menu_position'] = ( 'below' == $input['header_nav_menu_position'] ? 'below' : 'above' );
		$valid_input['display_footer_credit'] = ( 'true' == $input['display_footer_credit'] ? true : false );
		
	} elseif ( $reset_general ) { // if General Settings Reset Defaults
	
		$oenology_default_options = oenology_get_default_options();
		$valid_input['header_nav_menu_position'] = $oenology_default_options['header_nav_menu_position'];
		$valid_input['display_footer_credit'] = $oenology_default_options['display_footer_credit'];
		
	} elseif ( $submit_varietals ) { // if Varietals Settings Submit
	
		$valid_varietals = oenology_get_valid_varietals();
		$valid_input['varietal'] = ( array_key_exists( $input['varietal'], $valid_varietals ) ? $input['varietal'] : $valid_input['varietal'] );
		
	} elseif ( $reset_varietals ) { // if Varietals Settings Reset Defaults
	
		$oenology_default_options = oenology_get_default_options();
		$valid_input['varietal'] = $oenology_default_options['varietal'];
		
	}
	return $valid_input;		

}
?>