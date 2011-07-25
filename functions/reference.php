<?php
/**
 * Oenology Theme Reference
 *
 * This file defines the Reference for the Oenology Theme.
 * 
 * Theme Reference
 * 
 *  - Define Default Theme Options
 *  - Register/Initialize Theme Options
 *  - Define Admin Settings Page
 *  - Register Contextual Help
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

// Globalize the variable that holds
// the Theme contextual help hook
global $oenology_admin_reference_hook;

/**
 * Helper Functions
 */

function oenology_get_reference_page_tabs() {
	
	$tabs = array( 
        'general' => __( 'General', 'oenology' ),
        'faq' => __( 'FAQ', 'oenology' ),
        'coderef' => __( 'Code Reference', 'oenology' ),
		'changelog' => __( 'Changelog', 'oenology' ),
		'license' => __( 'License', 'oenology' ),
		'support' => __( 'Support', 'oenology' )
    );
	return $tabs;
}


/**
 * Setup the Theme Admin Reference Page
 */

// Add "Oenology Reference" link to the "Appearance" menu
function oenology_menu_reference() {
	global $oenology_admin_reference_hook;
	$oenology_admin_reference_hook = add_theme_page( __( 'Oenology Reference', 'oenology' ), __( 'Oenology Reference', 'oenology' ), 'edit_theme_options', 'oenology-reference', 'oenology_admin_reference_page');
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


/**
 * Enqueue Custom Admin Page Thickbox jQuery
 */

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



/**
 * Setup the Theme Admin Reference Page Contextual help
 */

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


/**
 * Get GitHub API Data
 * 
 * Uses the GitHub API (v3) to get information
 * regarding open or closed issues (bug reports)
 * or commits, then outputs them in a table.
 *
 * Derived from code originally developed by
 * Michael Fields (@_mfields):
 * @link	https://gist.github.com/1061846 Simple Github commit API shortcode for WordPress
 * 
 * @param	string	$context		(required) API data context. Currently supports 'commits' and 'issues'. Default: 'commits'
 * @param	string	$status			(optional) Issue state, either 'open' or 'closed'. Only used for 'commits' context. Default: 'open'
 * @param	string	$releasedate	(optional) Date, in YYYY-MM-DD format, used to return commits/issues since last release.
 * @param	string	$user			(optional) GitHub user who owns repository.
 * @param	string	$repo			(optional) GitHub repository for which to return API data
 * 
 * @return	string	table of formatted API data
 */
function oenology_get_github_api_data( $context = 'commits', $status = 'open', $releasedate = '2011-07-25', $user = 'chipbennett', $repo = 'oenology' ) {

	$capability = 'read';

	// $branch is user/repository string.
	// Used variously throughout the function
	$branch = $user . '/' . $repo;

	// Create transient key string. Used to ensure API data are 
	// pinged only periodically. Different transient keys are
	// created for commits, open issues, and closed issues.
	$transient_key = 'gh_';
	if ( 'commits' == $context ) {
		$transient_key .= 'commits' . md5( $branch );
	} elseif ( 'issues' == $context ) {
		$transient_key .= 'issues_' . $status . md5( $branch );
	}

	// If cached (transient) data are used, output an HTML
	// comment indicating such
	$cached = get_transient( $transient_key );

	if ( false !== $cached ) {
		return $cached .= "\n" . '<!--Returned from transient cache.-->';
	}
	
	// Construct the API request URL, based on $branch and
	// $context, and for issues, $status
	$apiurl = 'https://api.github.com/repos/' . $branch . '/' . $context;
	if ( 'commits' == $context ) {
		$apiurl .= '';;
	} elseif ( 'issues' == $context ) {
		$apiurl .= '?state=' . $status;
	}
	
	// Request the API data, using the constructed URL
	$remote = wp_remote_get( esc_url( $apiurl ) );

	// If the API data request results in an error, return
	// an appropriate comment
	if ( is_wp_error( $remote ) ) {
		if ( current_user_can( $capability ) ) {
			return '<p>Github API: Github is unavailable.</p>';
		}
		return;
	}

	// If the API returns a server error in response, output
	// an error message indicating the server response.
	if ( '200' != $remote['response']['code'] ) {
		if ( current_user_can( $capability ) ) {
			return '<p>Github API: Github responded with an HTTP status code of ' . esc_html( $remote['response']['code'] ) . '.</p>';
		}
		return;
	}

	// If the API returns a valid response, the data will be
	// json-encoded; so decode it.
	$data = json_decode( $remote['body'] );	

	// If the decoded json data is null, return a message
	// indicating that no data were returned.
	if ( ! isset( $data ) || empty( $data ) ) {
		$apidata = $context;
		if ( 'issues' == $context ) {
			$apidata = $status . ' ' . $context;
		}
		if ( current_user_can( $capability ) ) {
			return '<p>No ' . $apidata . ' could be found.</p>';
			return '<p>Github API: No ' . $apidata . ' could be found for this repository.</p>';
		}
		return;
	}

	// If the decoded json data has content, prepare the data
	// to be output.
	if ( 'issues' == $context ) {
		// $reportdate is used as a table column header
		$reportdate = ( 'open' == $status ? 'Reported' : 'Closed' );
		// $reportobject is used to return the appropriate timestamp
		$reportobject = ( 'open' == $status ? 'created_at' : 'closed_at' );
	} elseif ( 'commits' == $context ) {
		// $reportdate is used as a table column header
		$reportdate = 'Date';
	}
	// $reportidlabel is used as a table column header
	$reportidlabel = ( 'issues' == $context ? '#' : 'Commit' );
	// $datelastrelease is the PHP date of last released, based
	// on the $releasedate parameter passed to the function
	$datelastrelease = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime( $releasedate ) ), 'U' );

	// Begin constructing the table
	$output = '';
	$output .= "\n" . '<table class="github-api github-issues">';
	$output .= "\n" . '<thead>';
	$output .= "\n\t" . '<tr><th>' . $reportidlabel . '</th><th>' . $reportdate . '</th><th>Issue</th>';
	if ( 'issues' == $context ) {
		$output .= '<th>Label</th>';
	}
	$output .= '</tr>';
	$output .= "\n" . '</thead>';
	$output .= "\n" . '<tbody>';

	// Step through each object in the $data array
	foreach( $data as $object ) {
		if ( 'issues' == $context ) {
			$url = 'https://github.com/' . $branch . '/' . $context .'/' . $object->number;
			$reportid = $object->number;
			$message = $object->title;
			$label = $object->labels;
			$label = $label[0];
				$labelname = $label->name;
				$labelcolor = $label->color;
			$objecttime = $object->$reportobject;
		} else if ( 'commits' == $context ) {				
			$url = $object->url;
			$reportid = substr( $object->sha, 0, 6 );
			$commit = $object->commit;
				$message = $commit->message;
				$author = $commit->author;
			$objecttime = $author->date;
		}
		$time = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime( $objecttime ) ), 'U' );
		$timestamp = date( 'dMy', $time );
		$time_human = 'About ' . human_time_diff( $time, get_date_from_gmt( date( 'Y-m-d H:i:s' ), 'U' ) ) . ' ago';
		$time_machine = date( 'Y-m-d\TH:i:s\Z', $time );
		$time_title_attr = date( get_option( 'date_format' ) . ' at ' . get_option( 'time_format' ), $time );
		
		// Only output $data reported/created/closed since 
		// the last release
		if ( $time > $datelastrelease ) {
			$output .= "\n\t" . '<tr>';
			$output .= '<td style="padding:3px 5px;text-align:center;font-weight:bold;"><a href="' . esc_url( $url ) . '">' . $reportid . '</a></td>';
			$output .= '<td style="padding:3px 5px;text-align:center;color:#999;font-size:12px;"><time title="' . esc_attr( $time_title_attr ) . '" datetime="' . esc_attr( $time_machine ) . '">' . esc_html( $timestamp ) . '</time></td>';
			$output .= '<td style="padding:3px 5px;font-size:12px;">' . esc_html( $message ) . '</td>';
			if ( 'issues' == $context ) {
				$output .= '<td style="padding-left:5px;text-align:center;"><div style="text-shadow:#555 1px 1px 0px;border:1px solid #bbb;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;padding:3px;padding-bottom:5px;padding-top:1px;font-weight:bold;background-color:#ffffff;color:#' . $labelcolor . ';">' . $labelname . '</div></td>';
			}
			$output .= '</tr>';
		}
	}

	// Complete construction of the table
	$output .= "\n" . '</tbody>';
	$output .= "\n" . '</table>';

	// Set the transient (cache) for the API data
	set_transient( $transient_key, $output, 600 );

	// Return the output
	return $output;
}
?>