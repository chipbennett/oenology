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

	$reset_submit = $input['reset'];
	
	if ( ! empty( $reset_submit ) ) {
	  
	      $default_options = oenology_get_default_options();
		  
		  foreach ( $default_options as $option => $value ) {
			$valid_input[$option] = $value;
		  }
	
	      return $valid_input;
	  
	} else {

		global $pagenow;
	
		$oenology_options = get_option( 'theme_oenology_options' );

		$valid_input = $oenology_options;
	
		if ( isset ( $_GET['tab'] ) ) {
        	$tab = $_GET['tab'];
		} else {
        	$tab = 'general';
		}
    	switch ( $tab ) {
        	case 'general' :
            		$valid_input['header_nav_menu_position'] = ( 'below' == $input['header_nav_menu_position'] ? 'below' : 'above' );
	    		$valid_input['display_footer_credit'] = ( 'true' == $input['display_footer_credit'] ? true : false );	
            		break;
        	case 'varietal' :
            		$valid_varietals = oenology_get_valid_varietals();
            		$valid_input['varietal'] = ( in_array( $input['varietal'], $valid_varietals ) ? $input['varietal'] : $valid_input['varietal'] );
            		break;
		}
	
		return $valid_input;
	
	}
}
?>