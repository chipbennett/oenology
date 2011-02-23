<?php
/*****************************************************************************************
* Theme Reference
* 
*  - Define Default Theme Options
*  - Register/Initialize Theme Options
*  - Define Admin Settings Page
*  - Register Contextual Help
*******************************************************************************************/

global $oenology_admin_reference_hook;

/*****************************************************************************************
* Helper Functions
*******************************************************************************************/

function oenology_get_reference_page_tabs() {
	
	$tabs = array( 
        'general' => 'General',
        'faq' => 'FAQ',
        'coderef' => 'Code Reference',
		'changelog' => 'Changelog'
    );
	return $tabs;
}


/*****************************************************************************************
* Setup the Theme Admin Reference Page
*******************************************************************************************/

// Add "Oenology Reference" link to the "Appearance" menu
function oenology_menu_reference() {
	global $oenology_admin_reference_hook;
	$oenology_admin_reference_hook = add_theme_page('Oenology Reference', 'Oenology Reference', 'edit_theme_options', 'oenology-reference', 'oenology_admin_reference_page');
}
// Load the Admin Reference page
add_action('admin_menu', 'oenology_menu_reference');

// Define Reference Page Tabs
// http://www.onedesigns.com/tutorials/separate-multiple-theme-options-pages-using-tabs
function oenology_admin_reference_page_tabs( $current = 'general' ) {

    if ( isset ( $_GET['tab'] ) ) :
        $current = $_GET['tab'];
    else:
        $current = 'general';
    endif;
    
    $tabs = oenology_get_reference_page_tabs();
    
    $links = array();
    
    foreach( $tabs as $tab => $name ) :
        if ( $tab == $current ) :
            $links[] = "<a class='nav-tab nav-tab-active' href='?page=oenology-reference&tab=$tab'>$name</a>";
        else :
            $links[] = "<a class='nav-tab' href='?page=oenology-reference&tab=$tab'>$name</a>";
        endif;
    endforeach;
    
    echo '<div id="icon-themes" class="icon32"><br /></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ( $links as $link )
        echo $link;
    echo '</h2>';
    
}


// Admin reference page markup 
function oenology_admin_reference_page() { ?>

	<div class="wrap">
		<?php
		oenology_admin_reference_page_tabs();
		require( get_template_directory() . '/functions/reference-content.php' );
		?>
		
	</div>
<?php }


/*****************************************************************************************
* Enqueue Custom Admin Page Thickbox jQuery
*******************************************************************************************/

function oenology_enqueue_admin_thickbox_style() {

	// enqueue style
	wp_enqueue_style('thickbox'); 
}
// Enqueue Admin Stylesheet at admin_print_styles()
//add_action('admin_print_styles-appearance_page_oenology-reference', 'oenology_enqueue_admin_thickbox_style' );

function oenology_enqueue_admin_thickbox_scripts() {

	// enqueue scripts
	wp_enqueue_script('jquery'); 
	wp_enqueue_script('thickbox'); 
}
// Enqueue Admin Stylesheet at admin_print_styles()
//add_action('admin_print_scripts-appearance_page_oenology-reference', 'oenology_enqueue_admin_thickbox_scripts' );



/*****************************************************************************************
* Setup the Theme Admin Reference Page Contextual help
*******************************************************************************************/

// Admin reference page contextual help markup
// Separate file for ease of management
function oenology_contextual_help_reference( $contextual_help, $screen_id, $screen ) {		
	global $oenology_admin_reference_hook;
	require( get_template_directory() . '/functions/reference-help.php' );
	if ( $screen_id == $oenology_admin_reference_hook ) {
		$contextual_help = $text;
	}
	return $contextual_help;
}
// Add contextual help to Admin Options page
add_action('contextual_help', 'oenology_contextual_help_reference', 10, 3);
?>