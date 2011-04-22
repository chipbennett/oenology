<?php 

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
		$valid_input['header_nav_menu_depth'] = ( ( 1 || 2 || 3 ) == $input['header_nav_menu_depth'] ? $input['header_nav_menu_depth'] : $valid_input['header_nav_menu_depth'] );
		$valid_input['display_rss_feed'] = ( true == $input['display_rss_feed'] ? true : false );
		$valid_rss_feeds = oenology_get_valid_feeds();
		$valid_input['rss_feed'] = ( array_key_exists( $input['rss_feed'], $valid_rss_feeds ) ? $input['rss_feed'] : $valid_input['rss_feed'] );
		$valid_input['display_aim_profile'] = ( true == $input['display_aim_profile'] ? true : false );
		$valid_input['aim_profile'] = wp_filter_nohtml_kses( $input['aim_profile'] );
		$valid_input['display_facebook_profile'] = ( true == $input['display_facebook_profile'] ? true : false );
		$valid_input['facebook_profile'] = wp_filter_nohtml_kses( $input['facebook_profile'] );
		$valid_input['display_flickr_profile'] = ( true == $input['display_flickr_profile'] ? true : false );
		$valid_input['flickr_profile'] = wp_filter_nohtml_kses( $input['flickr_profile'] );
		$valid_input['display_linkedin_profile'] = ( true == $input['display_linkedin_profile'] ? true : false );
		$valid_input['linkedin_profile'] = wp_filter_nohtml_kses( $input['linkedin_profile'] );
		$valid_input['display_myspace_profile'] = ( true == $input['display_myspace_profile'] ? true : false );
		$valid_input['myspace_profile'] = wp_filter_nohtml_kses( $input['myspace_profile'] );
		$valid_input['display_skype_profile'] = ( true == $input['display_skype_profile'] ? true : false );
		$valid_input['skype_profile'] = wp_filter_nohtml_kses( $input['skype_profile'] );
		$valid_input['display_twitter_profile'] = ( true == $input['display_twitter_profile'] ? true : false );
		$valid_input['twitter_profile'] = wp_filter_nohtml_kses( $input['twitter_profile'] );
		$valid_input['display_yahoo_profile'] = ( true == $input['display_yahoo_profile'] ? true : false );
		$valid_input['yahoo_profile'] = wp_filter_nohtml_kses( $input['yahoo_profile'] );
		$valid_input['display_youtube_profile'] = ( true == $input['display_youtube_profile'] ? true : false );
		$valid_input['youtube_profile'] = wp_filter_nohtml_kses( $input['youtube_profile'] );
		$valid_input['display_footer_credit'] = ( 'true' == $input['display_footer_credit'] ? true : false );
		
	} elseif ( $reset_general ) { // if General Settings Reset Defaults
	
		$oenology_default_options = oenology_get_default_options();
		$valid_input['header_nav_menu_position'] = $oenology_default_options['header_nav_menu_position'];
		$valid_input['header_nav_menu_depth'] = $oenology_default_options['header_nav_menu_depth'];
		$valid_input['display_footer_credit'] = $oenology_default_options['display_footer_credit'];
		$valid_input['display_aim_profile'] = $oenology_default_options['display_aim_profile'];
		$valid_input['aim_profile'] = $oenology_default_options['aim_profile'];
		
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