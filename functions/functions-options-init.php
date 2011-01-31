<?php 

global $oenology_options;
$oenology_options = get_option( 'theme_oenology_options' );

/*****************************************************************************************
* Register Theme Settings
*******************************************************************************************/
	
// Register theme_oenology_options array to hold all theme options
register_setting( 'theme_oenology_options', 'theme_oenology_options', 'oenology_options_validate' );


/*****************************************************************************************
* Load Settings Page Tabs
*******************************************************************************************/

global $pagenow;
if ( 'themes.php' == $pagenow && isset( $_GET['page'] ) && 'oenology' == $_GET['page'] ) :
    if ( isset ( $_GET['tab'] ) ) :
        $tab = $_GET['tab'];
    else:
        $tab = 'general';
    endif;
    switch ( $tab ) :
        case 'general' :
            require_once( 'functions-options-init-general.php' );
            break;
        case 'varietals' :
            require_once( 'functions-options-init-varietals.php' );
            break;
    endswitch;
endif;


/*****************************************************************************************
* Validate/Whitelist User-Input Data Before Updating Theme Options
*******************************************************************************************/
function oenology_options_validate( $input ) {

	$oenology_options = get_option( 'theme_oenology_options' );
	$valid_input = $oenology_options;
	
	$submit_general = $input['submit-general'];	
	$reset_general = $input['reset-general'];
	$submit_varietals = $input['submit-varietals'];
	$reset_varietals = $input['reset-varietals'];
	
	if ( ! empty( $submit_general ) ) {
		$valid_input['header_nav_menu_position'] = ( 'below' == $input['header_nav_menu_position'] ? 'below' : 'above' );
		$valid_input['display_footer_credit'] = ( 'true' == $input['display_footer_credit'] ? true : false );
	} elseif ( ! empty( $reset_general ) ) {
		$oenology_default_options = oenology_get_default_options();
		$valid_input['header_nav_menu_position'] = $oenology_default_options['header_nav_menu_position'];
		$valid_input['display_footer_credit'] = $oenology_default_options['display_footer_credit'];
	} elseif ( ! empty( $submit_varietals ) ) {
		$valid_varietals = oenology_get_valid_varietals();
		$valid_input['varietal'] = ( array_key_exists( $input['varietal'], $valid_varietals ) ? $input['varietal'] : $valid_input['varietal'] );
	}elseif ( ! empty( $reset_varietals ) ) {
		$oenology_default_options = oenology_get_default_options();
		$valid_input['varietal'] = $oenology_default_options['varietal'];
	}
	return $valid_input;		

}
?>