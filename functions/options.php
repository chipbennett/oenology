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
* Helper Functions
*******************************************************************************************/

function oenology_get_default_options() {

    $options = array(
        'header_nav_menu_position' => 'top',
		'header_nav_menu_depth' => 1,
        'display_footer_credit' => false,
		'varietal' => 'cuvee',
		'display_rss_feed' => true,
		'rss_feed' => 'rss2',
		'display_aim_profile' => false,
		'aim_profile' => '',
		'display_facebook_profile' => false,
		'facebook_profile' => '',
		'display_flickr_profile' => false,
		'flickr_profile' => '',
		'display_linkedin_profile' => false,
		'linkedin_profile' => '',
		'display_myspace_profile' => false,
		'myspace_profile' => '',
		'display_skype_profile' => false,
		'skype_profile' => '',
		'display_twitter_profile' => false,
		'twitter_profile' => '',
		'display_yahoo_profile' => false,
		'yahoo_profile' => '',
		'display_youtube_profile' => false,
		'youtube_profile' => '',
        'theme_version' => '1.2'
    );
    return $options;
}

function oenology_get_valid_varietals() {

    $varietals = array(
        'cuvee' => array(
	      'slug' => 'cuvee',
	      'name' => 'Cuvee',
	      'description' => '"Cuvee" is a term often used by wineries to describe a particularly high-quality batch of wine. Cuvee is the base style for Oenology.',
	      'scheme' => 'light'
	      ),
        'seyval-blanc' => array(
	      'slug' => 'seyval-blanc',
	      'name' => 'Seyval Blanc',
	      'description' => 'Seyval Blanc is a white grape, typically grown in cooler climates, that produces a wine with flavors of citrus and mineral.',
	      'scheme' => 'light'
	      ),
        'muscat' => array(
	      'slug' => 'muscat',
	      'name' => 'Muscat',
	      'description' => 'Muscat is a white grape with a pronounced flavor of grapes and spice, that produces a versatile wine from dry to sweet.',
	      'scheme' => 'light'
	      ),
        'syrah' => array(
	      'slug' => 'syrah',
	      'name' => 'Syrah',
	      'description' => 'Syrah is a red grape that produces a full-bodied, almost inky-black wine with a spicy, earthy flavor and aroma.',
	      'scheme' => 'dark'
	      ),
        'malbec' => array(
	      'slug' => 'malbec',
	      'name' => 'Malbec',
	      'description' => 'Malbec is a red grape that produces exceedingly dark, inky red-violet wins with intense flavors.',
	      'scheme' => 'dark'
	      )
    );
    return $varietals;
}

function oenology_get_valid_feeds() {
	
	$feeds = array( 
        	'rdf' => 'RDF/RSS 1.0',
        	'rss' => 'RSS 0.92,',
        	'rss2' => 'RSS 2.0',
        	'atom' => 'Atom'
	);
	return $feeds;
}

function oenology_get_settings_page_tabs() {
	
	$tabs = array( 
        'general' => 'General',
        'varietals' => 'Varietals'
    );
	return $tabs;
}

function oenology_get_icon_colors() {
	
	$iconcolors = array( 
        'black' => 'Black',
        'silver' => 'Silver',
        'gray' => 'Gray',
        'coffee' => 'Coffee'
    );
	return $iconcolors;
}

function oenology_get_social_networks() {
	
	$socialnetworks = array( 
        'youtube' => array(
        	'slug' => 'youtube',
        	'name' => 'YouTube',
        	'baseurl' => 'http://www.youtube.com'
        ),
        'myspace' => array(
        	'slug' => 'myspace',
        	'name' => 'MySpace',
        	'baseurl' => 'http://www.myspace.com'
        ),
        'linkedin' => array(
        	'slug' => 'linkedin',
        	'name' => 'Linked-In',
        	'baseurl' => 'http://www.linkedin.com/in'
        ),
        'flickr' => array(
        	'slug' => 'flickr',
        	'name' => 'Flickr',
        	'baseurl' => 'http://www.flickr.com/photos'
        ),
        'facebook' => array(
        	'slug' => 'facebook',
        	'name' => 'Facebook',
        	'baseurl' => 'http://www.facebook.com'
        ),
        'twitter' => array(
        	'slug' => 'twitter',
        	'name' => 'Twitter',
        	'baseurl' => 'http://www.twitter.com'
        )
    );
	return $socialnetworks;
}

function oenology_display_sidebar_icons() {

	$oenology_options = get_option( 'theme_oenology_options' );
	$display_sidebar_icons = false;
	if ( $oenology_options['display_rss_feed'] ) $display_sidebar_icons = true;
	$social_profiles = oenology_get_social_networks();
	foreach ( $social_profiles as $profile ) {
		$name = $profile['slug'] . '_profile';
		$display = 'display_' . $name;
		if ( $oenology_options[$display] && isset( $oenology_options[$name] ) ) {
			$display_sidebar_icons = true;
		}
	}
	return $display_sidebar_icons;

}


/*****************************************************************************************
* Setup initial Theme options
*******************************************************************************************/

function oenology_options_init() {

	// set options equal to defaults
	global $oenology_options;
	$oenology_options = get_option( 'theme_oenology_options' );
	
	if ( false === $oenology_options ) {
		$oenology_options = oenology_get_default_options();
	}
	update_option( 'theme_oenology_options', $oenology_options );
	
	// Update New Options
	if ( '1.2' > $oenology_options['theme_version'] ) {
		$default_options = oenology_get_default_options();
		$oenology_options['display_rss_feed'] = $default_options['display_rss_feed'];
		$oenology_options['rss_feed'] = $default_options['rss_feed'];
		$socialnetworks = oenology_get_social_networks();
		foreach ( $socialnetworks as $network ) {
			$profile = $network . '_profile';
			$oenology_options[$profile] = $default_options[$profile];
			$displayprofile = 'display_' . $profile;
			$oenology_options[$displayprofile] = $default_options[$displayprofile];
		}
		$oenology_options['theme_version'] = '1.2';
		update_option( 'theme_oenology_options', $oenology_options );
	}
}
// Initialize Theme options
add_action('after_setup_theme', 'oenology_options_init', 9 );


/*****************************************************************************************
* Enqueue Varietal Stylesheet
*******************************************************************************************/

function oenology_enqueue_varietal_style() {

	// define varietal stylesheet
	global $oenology_options;
	$oenology_options = get_option( 'theme_oenology_options' );
	$varietal_handle = 'oenology_' . $oenology_options['varietal'] . '_stylesheet';
	$varietal_stylesheet = get_template_directory_uri() . '/varietals/' . $oenology_options['varietal'] . '.css';
	
	wp_enqueue_style( $varietal_handle, $varietal_stylesheet );
}
// Enqueue Varietal Stylesheet at wp_print_styles()
add_action('wp_print_styles', 'oenology_enqueue_varietal_style', 11 );


/*****************************************************************************************
* Determine Theme Color Scheme
*******************************************************************************************/

function oenology_get_color_scheme() {
	global $oenology_options;
	$oenology_options = get_option( 'theme_oenology_options' );
	$oenology_varietals = oenology_get_valid_varietals();
	$oenology_current_varietal = array();
	foreach ( $oenology_varietals as $varietal ) {
		if ( $varietal['slug'] == $oenology_options['varietal'] ) {
		      $oenology_current_varietal = $varietal;
		}
	}
	$colorscheme = $oenology_current_varietal['scheme'];
	return $colorscheme;
}

/*****************************************************************************************
* Enqueue Social Icon Styles
*******************************************************************************************/

function oenology_enqueue_social_icon_style() { 

	$socialnetworks = oenology_get_social_networks();
	$linkcolor = 'silver';
	$linkhovercolor = 'black';
	$colorscheme = oenology_get_color_scheme();
	if ( 'dark' == $colorscheme ) {
		$linkcolor = 'gray';
		$linkhovercolor = 'silver';
	}
?>

<style type="text/css">
a[class="sidebar-social-icon"][title ^="RSS"] {
  background: url('<?php echo get_template_directory_uri(); ?>/images/infocus/<?php echo $linkcolor; ?>/rss.png');
}
a[class="sidebar-social-icon"][title ^="RSS"]:hover {
  background: url('<?php echo get_template_directory_uri(); ?>/images/infocus/<?php echo $linkhovercolor; ?>/rss.png');
}
<?php foreach ( $socialnetworks as $network ) { ?>
a[class="sidebar-social-icon"][title ^="<?php echo $network['name']; ?>"] {
  background: url('<?php echo get_template_directory_uri(); ?>/images/infocus/<?php echo $linkcolor; ?>/<?php echo $network['slug']; ?>.png');
}
a[class="sidebar-social-icon"][title ^="<?php echo $network['name']; ?>"]:hover {
  background: url('<?php echo get_template_directory_uri(); ?>/images/infocus/<?php echo $linkhovercolor; ?>/<?php echo $network['slug']; ?>.png');
}
<?php } ?>
</style>
	
<?php }
// Enqueue Varietal Stylesheet at wp_print_styles()
add_action('wp_print_styles', 'oenology_enqueue_social_icon_style', 11 );


/*****************************************************************************************
* Enqueue Post Format Icon Styles
*******************************************************************************************/

function oenology_enqueue_post_format_icon_style() { 

	$postformats = oenology_get_post_formats();
	$iconcolor = 'original';
	$colorscheme = oenology_get_color_scheme();
	if ( 'dark' == $colorscheme ) {
		$iconcolor = 'gray';
	}
?>

<style type="text/css">
<?php 
$iconlocation = 'entry';
$iconposition = 'left';
foreach ( $postformats as $postformat ) {
	if ( 'audio' == $postformat || 'chat' == $postformat || 'video' == $postformat ) {
		$iconlocation = 'title';
	}
	if ( 'audio' == $postformat || 'chat' == $postformat || 'gallery' == $postformat || 'image' == $postformat || 'video' == $postformat ) {
		$iconposition = 'right';
	}
 ?>
.post.format-<?php echo $postformat; ?> .post-<?php echo $iconlocation; ?> {
  background: url('<?php echo get_template_directory_uri(); ?>/images/iconsweets2/<?php echo $iconcolor; ?>/<?php echo $postformat; ?>.png') no-repeat scroll <?php echo $iconposition; ?> top;
}
<?php 
	if ( 'gallery' == $postformat || 'image' == $postformat ) { ?>
body.single-format-<?php echo $postformat; ?> .post.format-<?php echo $postformat; ?> .post-title {
  background: url('<?php echo get_template_directory_uri(); ?>/images/iconsweets2/<?php echo $iconcolor; ?>/<?php echo $postformat; ?>.png') no-repeat scroll right top;
	min-height: 35px;
}
body.single-format-<?php echo $postformat; ?> .post.format-<?php echo $postformat; ?> .post-entry {
	background-image: none;
}
	<?php }
} ?>
</style>
	
<?php }
// Enqueue Varietal Stylesheet at wp_print_styles()
add_action('wp_print_styles', 'oenology_enqueue_post_format_icon_style', 11 );


/*****************************************************************************************
* Setup the Theme Admin Settings Page
*******************************************************************************************/

// Add "Oenology Options" link to the "Appearance" menu
function oenology_menu_options() {
	add_theme_page('Oenology Options', 'Oenology Options', 'edit_theme_options', 'oenology-settings', 'oenology_admin_options_page');
}
// Load the Admin Options page
add_action('admin_menu', 'oenology_menu_options');


// Define Settings Page Tabs
// http://www.onedesigns.com/tutorials/separate-multiple-theme-options-pages-using-tabs
function oenology_admin_options_page_tabs( $current = 'general' ) {

    if ( isset ( $_GET['tab'] ) ) :
        $current = $_GET['tab'];
    else:
        $current = 'general';
    endif;
    
    $tabs = oenology_get_settings_page_tabs();
    
    $links = array();
    
    foreach( $tabs as $tab => $name ) :
        if ( $tab == $current ) :
            $links[] = "<a class='nav-tab nav-tab-active' href='?page=oenology-settings&tab=$tab'>$name</a>";
        else :
            $links[] = "<a class='nav-tab' href='?page=oenology-settings&tab=$tab'>$name</a>";
        endif;
    endforeach;
    
    echo '<div id="icon-themes" class="icon32"><br /></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ( $links as $link )
        echo $link;
    echo '</h2>';
    
}

// Admin settings page markup 
function oenology_admin_options_page() { ?>

	<div class="wrap">
		<?php oenology_admin_options_page_tabs(); ?>
		<?php if ( isset( $_GET['settings-updated'] ) ) {
    			echo "<div class='updated'><p>Theme settings updated successfully.</p></div>";
		} ?>
		<form action="options.php" method="post">
		<?php 
			settings_fields('theme_oenology_options');
			do_settings_sections('oenology');
			
			$tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'general' );
		?>
			<input name="theme_oenology_options[submit-<?php echo $tab; ?>]" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'oenology'); ?>" />
			<input name="theme_oenology_options[reset-<?php echo $tab; ?>]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'oenology'); ?>" />
		</form>
	</div>
<?php }

// Admin settings page Form Fields markup
// 
// Codex Reference: http://codex.wordpress.org/Settings_API
// Reference: http://ottopress.com/2009/wordpress-settings-api-tutorial/
// Reference: http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
function oenology_register_options(){
	require( get_template_directory() . '/functions/options-register.php' );
}
// Settings API options initilization and validation
add_action('admin_init', 'oenology_register_options');


/*****************************************************************************************
* Enqueue Custom Admin Page Stylesheet
*******************************************************************************************/

function oenology_enqueue_admin_style() {

	// define admin stylesheet
	$admin_handle = 'oenology_admin_stylesheet';
	$admin_stylesheet = get_template_directory_uri() . '/functions/oenology-admin.css';
	
	wp_enqueue_style( $admin_handle, $admin_stylesheet, '', false );
}
// Enqueue Admin Stylesheet at admin_print_styles()
add_action('admin_print_styles-appearance_page_oenology-settings', 'oenology_enqueue_admin_style', 11 );
add_action('admin_print_styles-appearance_page_oenology-reference', 'oenology_enqueue_admin_style', 11 );


/*****************************************************************************************
* Setup the Theme Admin Settings Page Contextual help
*******************************************************************************************/

// Admin settings page contextual help markup
// Separate file for ease of management
function oenology_get_contextual_help_text() {
	$tabtext = '';
	require( get_template_directory() . '/functions/options-help.php' );
	return $tabtext;
}

function oenology_contextual_help() {
	$oenology_contextual_help_text = oenology_get_contextual_help_text();
	add_contextual_help( 'appearance_page_oenology-settings', $oenology_contextual_help_text  );
	add_contextual_help( 'appearance_page_oenology-reference', $oenology_contextual_help_text  );
}
// Add contextual help to Admin Options page
add_action('admin_init', 'oenology_contextual_help', 10, 3);


?>