<?php
/**
 * Oenology Theme custom functions
 *
 * Contains all of the Theme's custom functions, which include
 * helper functions and various filters.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

/**
 * @todo	complete inline documentation
 * @todo	sort function definitions alphabetically
 */

/**
 * Get current page context
 * 
 * Returns a string containing the context of the
 * current page. This string is useful for several
 * purposes, including applying an ID to the HTML
 * body tag, and adding a contextual $name to calls
 * to get_header(), get_footer(), get_sidebar(), 
 * and get_template_part_file(), in order to 
 * facilitate Child Themes overriding default Theme
 * template part files.
 * 
 * @param	none
 * @return	string	current page context
 */
function oenology_get_context() {

	$context = 'index';
	
	if ( is_front_page() ) {
		// Front Page
		$context = 'front-page';
	} else if ( is_date() ) {
		// Date Archive Index
		$context = 'date';
	} else if ( is_author() ) {
		// Author Archive Index
		$context = 'author';
	} else if ( is_category() ) {
		// Category Archive Index
		$context = 'category';
	} else if ( is_tag() ) {
		// Tag Archive Index
		$context = 'tag';
	} else if ( is_tax() ) {
		// Taxonomy Archive Index
		$context = 'taxonomy';
	} else if ( is_archive() ) {
		// Archive Index
		$context = 'archive';
	} else if ( is_search() ) {
		// Search Results Page
		$context = 'search';
	} else if ( is_404() ) {
		// Error 404 Page
		$context = '404';
	} else if ( is_attachment() ) {
		// Attachment Page
		$context = 'attachment';
	} else if ( is_single() ) {
		// Single Blog Post
		$context = 'single';
	} else if ( is_page() ) {
		// Static Page
		$context = 'page';
	} else if ( is_home() ) {
		// Blog Posts Index
		$context = 'home';
	}
	
	return $context;
}

/**
 * Get Current Page Layout
 */
function oenology_get_current_page_layout() {
	
	// Use default layout for 404 pages
	if ( is_404() ) {
		return 'default';
	}
	
	// Otherwise, determine appropriate layout
	$layout = '';
	global $post;
	global $oenology_options;
	$custom = ( get_post_custom( $post->ID ) ? get_post_custom( $post->ID ) : false );
	$custom_layout = ( isset( $custom['_oenology_layout'][0] ) ? $custom['_oenology_layout'][0] : 'default' );	
	if ( ! is_admin() ) {
		if ( is_attachment() ) {
			$layout .= 'attachment';
		} 
		else if ( is_page() ) {
			if ( 'default' == $custom_layout ) {
				$layout .= $oenology_options['default_static_page_layout'];
			} else {
				$layout .= $custom_layout;
			}
		} 
		else if ( is_single() ) {
			if ( 'gallery' == get_post_format() || 'image' == get_post_format() || 'video' == get_post_format() ) {
				$layout .= 'full';
			} 
			else if ( 'default' == $custom_layout ) {
				$layout .= $oenology_options['default_single_post_layout'];
			} 
			else {
				$layout .= $custom_layout;
			}
		} 
		else if ( is_home() || is_archive() || is_search() || is_404() ) {
			$layout .= $oenology_options['post_index_layout'];
		}
	} 
	else if ( is_admin() ) {
		if ( 'attachment' == $post->post_type ) {
			$layout .= 'attachment';
		} 
		else if ( 'page' == $post->post_type ) {
			if ( 'default' == $custom_layout ) {
				$layout .= $oenology_options['default_static_page_layout'];
			} 
			else {
				$layout .= $custom_layout;
			}
		} 
		else if ( 'post' == $post->post_type ) {
			if ( 'gallery' == get_post_format( $post->ID ) || 'image' == get_post_format( $post->ID ) || 'video' == get_post_format( $post->ID ) ) {
				$layout .= 'full';
			} 
			if ( 'default' == $custom_layout ) {
				$layout .= $oenology_options['default_single_post_layout'];
			} 
			else {
				$layout .= $custom_layout;
			}
		}
	}
	return $layout;
}

/**
 * Get current settings page tab
 */
function oenology_get_current_tab() {

	$page = 'oenology-settings';
	if ( isset( $_GET['page'] ) && 'oenology-reference' == $_GET['page'] ) {
		$page = 'oenology-reference';
	}
    if ( isset( $_GET['tab'] ) ) {
        $current = $_GET['tab'];
    } else {
		$oenology_options = oenology_get_options();
		if ( 'oenology-settings' == $page ) {
			$current = $oenology_options['default_options_tab'];
		} else if ( 'oenology-reference' == $page ) {
			$current = $oenology_options['default_reference_tab'];
		}
    }	
	return $current;
}


/**
 * Get custom category list
 */
function oenology_get_custom_category_list() {
	$catrssurl = includes_url() . '/images/rss.png';
	$customcatlist ='';
	$customcats=  get_categories();
	foreach( $customcats as $customcat ) {
		$customcathref = get_category_link( $customcat->term_id );
		$customcatfeedlink = get_category_feed_link( $customcat->term_id );
		$customcatlist .= '<li><a title="' . esc_attr( sprintf( _x( 'Subscribe to the %s news feed', 'Category Name', 'oenology' ), $customcat->name ) ) . '" href="' . $customcatfeedlink . '"><img src="' . $catrssurl . '" alt="feed" /></a><a href="' . $customcathref . '">' . $customcat->name . '</a> (' . $customcat->count . ')</li>';
	}
	return $customcatlist;
}


/**
 * Get custom post format list
 */
function oenology_get_custom_post_format_list() {
	$postformatrssurl = includes_url() . '/images/rss.png';
	$postformatterms = get_terms( 'post_format' );
	$postformatlist = '';
	foreach( $postformatterms as $term ) {
		$termslug = substr( $term->slug, 12 );
		$termlink = get_post_format_link( $termslug );
		$postformatlist .= '<li><a title="' . esc_attr( sprintf( _x( 'Subscribe to the %s news feed', 'Post Format', 'oenology' ), $term->name ) ) . '" href="' . $termlink .'feed/"><img src="'.$postformatrssurl.'" alt="feed" /></a><a href="'. $termlink .'">' . $term->name . '</a> (' . $term->count . ')</li>';
	}
	return $postformatlist;
}


/**
 * Get custom tag list
 */
function oenology_get_custom_tag_list() {
	$tagrssurl = includes_url() . '/images/rss.png';
	$customtaglist ='';
	$customtags =  get_tags();
	foreach( $customtags as $customtag ) {
		$customtaghref = get_tag_link( $customtag->term_id );
		$customtagfeedlink = get_tag_feed_link( $customtag->term_id );
		$customtaglist .= '<li><a title="' . esc_attr( sprintf( _x( 'Subscribe to the %s feed', 'Tag Name', 'oenology' ), $customtag->name ) ) . '" href="' . $customtagfeedlink . '"><img src="' . $tagrssurl . '" alt="feed" /></a><a href="' . $customtaghref . '">' . $customtag->name . '</a> (' . $customtag->count . ')</li>';
	} 
	return $customtaglist;
}

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
function oenology_get_github_api_data( $context = 'commits', $status = 'open', $milestone = '8', $roadmap = false, $currentrelease = '2.7', $releasedate = '2012-06-15', $user = 'chipbennett', $repo = 'oenology' ) {

	$capability = 'read';

	// $branch is user/repository string.
	// Used variously throughout the function
	$branch = $user . '/' . $repo;

	// Create transient key string. Used to ensure API data are 
	// pinged only periodically. Different transient keys are
	// created for commits, open issues, and closed issues.
	$transient_key = 'oenology_' . $currentrelease . '_github_';
	if ( 'commits' == $context ) {
		$transient_key .= 'commits' . md5( $branch );
	} else if ( 'issues' == $context ) {
		$transient_key .= 'issues_' . $status . md5( $branch . $milestone );
	}

	// If cached (transient) data are used, output an HTML
	// comment indicating such
	$cached = get_transient( $transient_key );

	if ( false !== $cached ) {
		return $cached .= "\n" . '<!--Returned from transient cache.-->';
	}
	
	// Construct the API request URL, based on $branch and
	// $context, for issues, $status, and $milestone
	$apiurl = 'https://api.github.com/repos/' . $branch . '/' . $context;
	if ( 'commits' == $context ) {
		$apiurl .= '';
	} else if ( 'issues' == $context ) {
		$apiurl .= '?state=' . $status;
		$apiurl .= '&milestone=' . $milestone;
		$apiurl .= '&sort=created&direction=asc';
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
	if ( 'issues' == $context ) {
		// Test	
	}
	usort( $data, 'oenology_sort_github_data' );

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
	} else if ( 'commits' == $context ) {
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
	$output .= "\n" . '<table class="github-api github-' . $context . '">';
	$output .= "\n" . '<thead>';
	$output .= "\n\t" . '<tr><th>' . $reportidlabel . '</th><th>' . $reportdate . '</th>';
	if ( 'issues' == $context ) {
		$output .= '<th>Milestone</th><th>Label</th>';
	}
	$output .= '<th>Issue</th></tr>';
	$output .= "\n" . '</thead>';
	$output .= "\n" . '<tbody>';

	// Step through each object in the $data array
	foreach( $data as $object ) {
		if ( 'issues' == $context ) {
			$url = 'https://github.com/' . $branch . '/' . $context .'/' . $object->number;
			$reportid = $object->number;
			$message = $object->title;
			$label = $object->labels;
			$label = ( isset( $label[0] ) ? $label[0] : 'n/a' );
				$labelname = ( isset( $label->name ) ? $label->name : 'n/a' );
				$labelcolor = ( isset( $label->color ) ? $label->color : 'n/a' );
			$objecttime = $object->$reportobject;
			$milestoneobj = $object->milestone;
			$milestonetitle = ( isset( $milestoneobj->title ) ? $milestoneobj->title : 'n/a' );
			$milestonenumber = ( isset( $milestoneobj->number ) ? $milestoneobj->number : 'n/a' );
		} else if ( 'commits' == $context ) {				
			$url = 'https://github.com/' . $branch . '/commit/' . $object->sha;
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
		if ( ( 'issues' == $context && ( $milestone == $milestonenumber || ( true == $roadmap && $milestonetitle > $currentrelease ) ) ) || ( 'commits' == $context && $time > $datelastrelease ) ) {
			$output .= "\n\t" . '<tr>';
			$output .= '<td style="padding:3px 5px;text-align:center;font-weight:bold;"><a href="' . esc_url( $url ) . '">' . $reportid . '</a></td>';
			$output .= '<td style="padding:3px 5px;text-align:center;color:#999;font-size:12px;"><time title="' . esc_attr( $time_title_attr ) . '" datetime="' . esc_attr( $time_machine ) . '">' . esc_html( $timestamp ) . '</time></td>';
			if ( 'issues' == $context ) {
				$output .= '<td style="padding:3px 5px;text-align:center;color:#999;">' . $milestonetitle . '</td>';
				$output .= '<td style="padding-left:5px;text-align:center;"><div style="text-shadow:#555 1px 1px 0px;border:1px solid #bbb;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;padding:3px;padding-bottom:5px;padding-top:1px;font-weight:bold;background-color:#ffffff;color:#' . $labelcolor . ';">' . $labelname . '</div></td>';
			}
			$output .= '<td style="padding:3px 5px;font-size:12px;">' . esc_html( $message ) . '</td>';
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

/**
 * Sort GitHub API Data
 * 
 * Callback function for usort() to sort the GitHub 
 * API (v3) issues data by issue number or commit date
 * 
 * @return	object	object of GitHub API data sorted by issue number or commit date
 */
function oenology_sort_github_data( $a, $b ) {
	$sort = 0;
	$param_a = '';
	$param_b = '';
	if ( isset( $a->number ) ) {
		$param_a = $a->number;
		$param_b = $b->number;
	} else if ( isset( $a->committer ) ) {
		$commit_a = $a->commit;
		$commit_b = $b->commit;
		$committer_a = $commit_a->committer;
		$committer_b = $commit_b->committer;
		$param_a = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime( $committer_a->date ) ), 'U' );
		$param_b = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime( $committer_b->date ) ), 'U' );
	}
	if (  $param_a ==  $param_b ) { 
		$sort = 0; 
	} else {
		$sort = ( $param_a < $param_b ? -1 : 1 );
	}
	return $sort;
}
		
/**
 * Determine Header Text Color Setting
 * 
 * Determine what color value to pass to the
 * HEADER_TEXTCOLOR constant, based on whether a 
 * dark or light color scheme is being displayed.
 */
function oenology_get_header_textcolor() {

	$headertextcolor = ( get_header_textcolor() ? get_header_textcolor() : false );
	if ( ! $headertextcolor ) {
		$colorscheme = oenology_get_color_scheme();
		
		if ( 'light' == $colorscheme ) {
			$headertextcolor = '666666';
		} elseif ( 'dark' == $colorscheme ) {
			$headertextcolor = 'dddddd';
		}
	}
	return $headertextcolor;
}

/*
 * Define supported Post Format types
 * 
 * Return an array containing the list of Post Format types
 * supported by the Theme.
 * 
 * @param	none
 * @return	array	Post format types supported by the Theme
 * @since	Oenology 1.2
 */
function oenology_get_post_formats() {
	$postformats = array( 
		'aside' => array(
			'slug' => 'aside',
			'description' => __( 'An incidental remark; digression: a message that departs from the main subject.', 'oenology' )
		), 
		'audio' => array(
			'slug' => 'audio',
			'description' => __('A sound, or a sound signal; Of or relating to audible sound; Of or relating to the broadcasting or reproduction of sound, especially high-fidelity reproduction.', 'oenology' )
		), 
		'chat' => array(
			'slug' => 'chat',
			'description' => __('Any kind of communication over the Internet; primarily direct one-on-one chat or text-based group chat (formally also known as synchronous conferencing), using tools such as instant messengers and Internet Relay Chat.', 'oenology' )
		), 
		'gallery' => array(
			'slug' => 'gallery',
			'description' => __('A collection of art for exhibition.', 'oenology' )
		), 
		'image' => array(
			'slug' => 'image',
			'description' => __('picture: A visual representation (of an object or scene or person or abstraction) produced on a surface.', 'oenology' )
		), 
		'link' => array(
			'slug' => 'link',
			'description' => __('A reference to a document that the reader can directly follow, or that is followed automatically. The reference points to a whole document or to a specific element within a document.', 'oenology' )
		), 
		'quote' => array(
			'slug' => 'quote',
			'description' => __('A quotation, statement attributed to someone else; To refer to (part of) a statement that has been made by someone else.', 'oenology' )
		), 
		'status' => array(
			'slug' => 'status',
			'description' => __('state or condition of affairs', 'oenology' )
		), 
		'video'  => array(
			'slug' => 'video',
			'description' => __('A recording of both visual and audible components; Electronically capturing, recording, processing, storing, transmitting, and reconstructing a sequence of still images representing scenes in motion.', 'oenology' )
		)
	);
	return $postformats;
}

/**
 * Define Oenology Admin Page Tab Markup
 * 
 * @uses	oenology_get_current_tab()	defined in \functions\options.php
 * @uses	oenology_get_settings_page_tabs()	defined in \functions\options.php
 * 
 * @link	http://www.onedesigns.com/tutorials/separate-multiple-theme-options-pages-using-tabs	Daniel Tara
 */
function oenology_get_page_tab_markup() {

	$page = 'oenology-settings';

    $current = oenology_get_current_tab();
	
	$tabs = oenology_get_settings_page_tabs();
    
    $links = array();
    
    foreach( $tabs as $tab ) {
		$tabname = $tab['name'];
		$tabtitle = $tab['title'];
        if ( $tabname == $current ) {
            $links[] = "<a class='nav-tab nav-tab-active' href='?page=$page&tab=$tabname'>$tabtitle</a>";
        } else {
            $links[] = "<a class='nav-tab' href='?page=$page&tab=$tabname'>$tabtitle</a>";
        }
    }
    
    echo '<div id="icon-themes" class="icon32"><br /></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ( $links as $link )
        echo $link;
    echo '</h2>';
    
}

/**
 * Oenology Theme Social Networks
 * 
 * Array that holds all of the valid social
 * networks for Oenology.
 * 
 * @return	array	$socialnetworks	array of arrays of social network parameters
 */
function oenology_get_social_networks() {
	
	$socialnetworks = array( 
        'youtube' => array(
        	'name' => 'youtube',
        	'title' => __( 'YouTube', 'oenology' ),
        	'baseurl' => 'http://www.youtube.com'
        ),
        'myspace' => array(
        	'name' => 'myspace',
        	'title' => __( 'MySpace', 'oenology' ),
        	'baseurl' => 'http://www.myspace.com'
        ),
        'linkedin' => array(
        	'name' => 'linkedin',
        	'title' => __( 'Linked-In', 'oenology' ),
        	'baseurl' => 'http://www.linkedin.com/in'
        ),
        'flickr' => array(
        	'name' => 'flickr',
        	'title' => __( 'Flickr', 'oenology' ),
        	'baseurl' => 'http://www.flickr.com/photos'
        ),
        'facebook' => array(
        	'name' => 'facebook',
        	'title' => __( 'Facebook', 'oenology' ),
        	'baseurl' => 'http://www.facebook.com'
        ),
        'twitter' => array(
        	'name' => 'twitter',
        	'title' => __( 'Twitter', 'oenology' ),
        	'baseurl' => 'http://www.twitter.com'
        )
    );
	return $socialnetworks;
}

/**
 * Image Handling for gallery previous/next links
 * 
 * function needed because WP gives no easy way to 
 * display both image and text in prev/next links.
 */
function oenology_gallery_links() {
	global $post;
	$post = get_post($post);
	$attachments = array_values(get_children("post_parent=$post->post_parent&post_type=attachment&post_mime_type=image&orderby=menu_order ASC, ID ASC"));

	$k = 0;
	
	foreach ( $attachments as $k => $attachment )
		if ( $attachment->ID == $post->ID )
			break;

	$links = array( 'prevlink' => '', 'prevthumb' => '', 'nextlink' => '', 'nextthumb' => '' );

	if ( isset($attachments[$k+1]) ) {
		$links['prevlink'] = get_permalink($attachments[$k+1]->ID);
		$links['prevthumb'] = wp_get_attachment_link($attachments[$k+1]->ID, 'attachment-nav-thumbnail', true);
	}

	if ( isset($attachments[$k-1]) ) {
		$links['nextlink'] = get_permalink($attachments[$k-1]->ID);
		$links['nextthumb'] = wp_get_attachment_link($attachments[$k-1]->ID, 'attachment-nav-thumbnail', true);
	}

	return $links;
}

/**
 * Image Handling for gallery image metadata
 */
function oenology_gallery_image_meta() {
	global $post;
	$post = get_post($post);
	$is_parent = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
	$attachmentimage = ( $is_parent ? array_shift( $is_parent ) : false );
	$imagepost = ( $attachmentimage ? $attachmentimage->ID : $post->ID );
	$m = get_post_meta( $imagepost, '_wp_attachment_metadata' , true );
	$image = wp_get_attachment_image( $imagepost, 'full' );
	$url = wp_get_attachment_url( $imagepost );
	$uploaddir = wp_upload_dir();
	$imagesize = size_format( filesize( $uploaddir['basedir'] . '/' . $m['file'] ) );
	$image_meta = array (
		'image' => $image,
		'url' => $url,		
		'width' => $m['width'],
		'height' => $m['height'],
		'dimensions' => false,
		'filesize' => $imagesize,
		'created_timestamp' => $m['image_meta']['created_timestamp'],
		'copyright' => $m['image_meta']['copyright'],
		'credit' => $m['image_meta']['credit'],
		'aperture' => $m['image_meta']['aperture'],
		'focal_length' => $m['image_meta']['focal_length'],
		'iso' => $m['image_meta']['iso'],
		'shutter_speed' => $m['image_meta']['shutter_speed'],
		'camera' => $m['image_meta']['camera'],
		'caption' => '(No caption provided.)'
	);
	// image dimensions handler
	if ( $m['width'] && $m['height'] ) {
		$image_meta['dimensions'] = $m['width'] . '&#215;' . $m['height'] . ' px';
	}
	// image created_timestamp handler
	if ( $m['image_meta']['created_timestamp'] ) {
		$image_meta['created_timestamp'] = date( 'm M Y', $m['image_meta']['created_timestamp'] );
	}
	// image aperture handler
	if ( $m['image_meta']['aperture'] ) {
		$image_meta['aperture'] = 'f/' . $m['image_meta']['aperture'];
	}
	// shutter speed handler
	if ( ( $m['image_meta']['shutter_speed'] != '0' ) && ( ( 1 / $m['image_meta']['shutter_speed'] ) > 1 ) ) {
	$image_meta['shutter_speed'] =  "1/";
		if (number_format((1 / $m['image_meta']['shutter_speed']), 1) ==  number_format((1 / $m['image_meta']['shutter_speed']), 0)) {
			$image_meta['shutter_speed'] = $image_meta['shutter_speed'] . number_format((1 / $m['image_meta']['shutter_speed']), 0, '.', '') . ' sec';
		} else {
			$image_meta['shutter_speed'] = $image_meta['shutter_speed'] .  number_format((1 / $m['image_meta']['shutter_speed']), 1, '.', '') . ' sec';
		}
	} else {
		$image_meta['shutter_speed'] = $m['image_meta']['shutter_speed'].' sec';
	}
	// image caption handler
	if ( ! empty( $post->post_excerpt ) ) {
		$image_meta['caption'] = get_the_excerpt(); // this is the "caption"
	} else if ( is_object( $attachmentimage ) && $attachmentimage->post_excerpt ) {
		$image_meta['caption'] = $attachmentimage->post_excerpt;
	}
	return $image_meta;
}


/**
 * 404 error handling
 */
function oenology_get_404_content() {
	
	if ( ! is_404() )
		return;
	
	// Variable to hold function output
	$oenology_404 = '';
	
	// Variables to hold contextual output parts
	$oenology_404_intro = '';
	$oenology_404_posts = '';
	$oenology_404_pages = '';
	$oenology_404_category = '';
	$oenology_404_tag = '';
	$oenology_404_results = '';
	$oenology_404_noresults = '';
	
	// Intro text
	
	$oenology_404_intro .= '<p>';
	$oenology_404_intro .= __( 'Oh no, not again.', 'oenology' );
	$oenology_404_intro .= '</p>';
	$oenology_404_intro .= '<p>';
	$oenology_404_intro .= __( 'Well, this is weird.', 'oenology' ) . ' ' ;
	$oenology_404_intro .= __( 'The post, page, or file you requested could not be found. ', 'oenology' ) . ' ';
	$oenology_404_intro .= __( 'The best laid plans of mice, and all that. ', 'oenology' ) . ' ';
	$oenology_404_intro .= __( 'Those who study the complex interplay of cause and effect in the history of the Universe say that this sort of thing is going on all the time.', 'oenology' );
	$oenology_404_intro .= '</p>';
	$oenology_404_intro .= '<p>';
	$oenology_404_intro .= __( 'I apologize for the inconvenience.', 'oenology' ) . ' ';
	$oenology_404_intro .= __( 'Let me try to make it up to you!', 'oenology' );
	$oenology_404_intro .= '<p>';

	// array to hold suggestions
	if ( ! isset ( $oenology404suggestions ) ) {
		$oenology404postsuggestions = false;
		$oenology404pagesuggestions = false;
	}
	
	// Extract search term from URL
	$patterns_array[] = "/?(trackback|feed|page[0-9]*)/?$";
	$patterns_array[] = "\.html$";
	$patterns_array = array_map(create_function('$a', '$sep = (strpos($a, "@") === false ? "@" : "%"); return $sep.trim($a).$sep."i";'), $patterns_array);
	
	$search = preg_replace( $patterns_array, "", urldecode( $_SERVER["REQUEST_URI"] ) );
	$search = basename(trim($search));
	$search = preg_replace( $patterns_array, "", $search);
	$search_words = preg_replace( "@[_-]@", " ", $search);
	
	// Search for posts
	$posts = get_posts( array( "s" => $search_words ) );
	$oenology404postsuggestions = $posts;
	
	// Search for pages
	$pages = get_posts( array( "s" => $search_words, "post_type" => "page" ) );
	$oenology404pagesuggestions = $pages;
	
	$oenology404suggestions = array_merge ( $oenology404postsuggestions, $oenology404pagesuggestions );
	$oenology404nopostsorpages = true;

	if ( ! isset ( $oenology404suggestions ) || ! is_array( $oenology404suggestions ) || count( $oenology404suggestions ) == 0 )  { 
		$oenology404nopostsorpages = true;
	} else { 
		$oenology404nopostsorpages = false;
		
		// Display list of post suggestions
		$suggestedposts = $oenology404postsuggestions;
		if ( $suggestedposts > 0 ) {
		
			$oenology_404_posts .= '<p>' . __( 'Here is a list of posts that you might have been looking for:', 'oenology' ) . '</p>';
			$oenology_404_posts .= '<ul class="oenology404_suggestions">';
			
			foreach ( $suggestedposts as $suggestedpost ) {
				$oenology_404_posts .= '<li>';
				$oenology_404_posts .= '<span style="text-transform:uppercase;">' . $suggestedpost->post_type . '</span>: <a href="' . get_permalink( $suggestedpost->ID ) . '">' . $suggestedpost->post_title . '</a>';
				$oenology_404_posts .= '<blockquote>';
				
				if ( empty( $suggestedpost->post_excerpt ) ) {
					$suggestedpost->post_excerpt = explode(" ", strrev( substr( strip_tags( $suggestedpost->post_content ), 0, 300 ) ), 2 );
					$suggestedpost->post_excerpt = strrev( $suggestedpost->post_excerpt[1] );
					$suggestedpost->post_excerpt.= " [...]";
				}
				if ( $suggestedpost->post_excerpt ) {
					$oenology_404_posts .= $suggestedpost->post_excerpt; 
				} else {
					$oenology_404_posts .= __( 'No excerpt available.', 'oenology' );
				}
						
				$oenology_404_posts .= '</blockquote>';
				$oenology_404_posts .= '</li>';
			}
			$oenology_404_posts .= '</ul>';
			
		}
		
		// Display list of page suggestions
		$suggestedpages = $oenology404pagesuggestions;
		if ( $suggestedpages > 0 ) {
			
			$oenology_404_pages .= '<p>' . __( 'Here is a list of pages that you might have been looking for:', 'oenology' ) . '</p>';
			$oenology_404_pages .= '<ul class="oenology404_suggestions">';
			
			foreach ( $suggestedpages as $suggestedpage ) {
				$oenology_404_pages .= '<li>';
					$oenology_404_pages .= '<span style="text-transform:uppercase;">' . $suggestedpage->post_type . '</span>: <a href="' . get_permalink( $suggestedpage->ID ) . '">' . $suggestedpage->post_title . '</a>';
					$oenology_404_pages .= '<blockquote>';
						 
							if ( empty( $suggestedpage->post_excerpt ) ) {
									$suggestedpage->post_excerpt = explode(" ", strrev( substr( strip_tags( $suggestedpage->post_content ), 0, 300 ) ), 2 );
									$suggestedpage->post_excerpt = strrev( $suggestedpage->post_excerpt[1] );
									$suggestedpage->post_excerpt.= " [...]";
								}
							if ( $suggestedpage->post_excerpt ) {
								$oenology_404_pages .= $suggestedpage->post_excerpt; 
							} else {
								$oenology_404_pages .= __( 'No excerpt available.', 'oenology' );
							}
						
				$oenology_404_pages .= '</blockquote>';
				$oenology_404_pages .= '</li>';
			}
			$oenology_404_pages .= '</ul>';
			
		}
	}
		
	// See if we've matched a category
	$oenology404nocategories = true;
	$categories = get_categories( array ( "name__like" => $search ) );
	if ( count( $categories ) > 0 ) { 
	
		$oenology404nocategories = false;
			
		$oenology_404_category .= '<p>'. __( 'Perhaps you were looking for something in one of the following categories?', 'oenology' ) . '</p>';
		$oenology_404_category .= '<ul class="oenology404_suggestions">';
		foreach ( $categories as $category ) {
			$oenology_404_category .= '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
		}
		$oenology_404_category .= '</ul>';
	}
	// See if we've matched a tag
	$oenology404notags = true;
	$tags = get_tags( array ( "name__like" => $search ) );
	if ( count( $tags ) > 0 ) { 
	
		$oenology404notags = false;		
		
		$oenology_404_tag = '<p>' . __( 'Perhaps you were looking for something with one of the following tags?', 'oenology' ) . '</p>';
		$oenology_404_tag .= '<ul class="oenology404_suggestions">';
		foreach ( $tags as $tag ) {
			$oenology_404_tag .= '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
		}
		$oenology_404_tag .= '</ul>';
	}

	// Define "no results" output
	$oenology_404_noresults .= '<p>';
	$oenology_404_noresults .= __( 'I apologize.', 'oenology' ) . ' ';
	$oenology_404_noresults .= __( 'For the life of me, I am unable to figure out what you were trying to find.', 'oenology' ) . ' ';
	$oenology_404_noresults .= __( 'Perhaps try searching, using the search form in the upper right-hand corner?', 'oenology' );
	$oenology_404_noresults .= '</p>';
	
	// Concatenate "results" output
	$oenology_404_results = apply_filters( 'oenology_404_intro', $oenology_404_intro ) . apply_filters( 'oenology_404_posts', $oenology_404_posts ) . apply_filters( 'oenology_404_pages', $oenology_404_pages ) . apply_filters( 'oenology_404_category', $oenology_404_category ) . apply_filters( 'oenology_404_tag', $oenology_404_tag );
	
	$oenology404noresults = false;

	if ( $oenology404nopostsorpages && $oenology404nocategories && $oenology404notags ) {
		$oenology404noresults = true;
	}	
	$oenology_404 = ( $oenology404noresults ? apply_filters( 'oenology_404_noresults', $oenology_404_noresults ) : apply_filters( 'oenology_404_results', $oenology_404_results ) );
	
	return apply_filters( 'oenology_404', $oenology_404 );
}


/**
 * Add navigation breadcrumb function
 */

/* Credit: Dimox
*	http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
*/
function oenology_breadcrumb() {
 
	$containerBefore = '<li id="breadcrumbs">';
	$containerAfter = '</li>';
	$containerCrumb = '<div class="crumbs">';
	$containerCrumbEnd = '</div>';
	$delimiter = ' &raquo; ';
	$name = 'Home'; //text for the 'Home' link
	$blogname = 'Blog'; //text for the 'Blog' link
	$baseLink = '';
	$hierarchy = '';
	$currentLocation = '';
	$currentBefore = '<strong>';
	$currentAfter = '</strong>';
	$currentLocationLink = '';
	$crumbPagination = '';

	global $post;
 
	// Start of Container
    echo $containerBefore;
	// Start of Breadcrumbs
	echo $containerCrumb;

	// Output the Base Link	
	if ( is_front_page() ) {
		echo '<strong>' . $name . '</strong>';
	} else {
		$home = home_url('/');
		$baseLink =  '<a href="' . $home . '">' . $name . '</a>';
		echo $baseLink; 
	}
	// If static Page as Front Page, and on Blog Posts Index
	if ( is_home() && ( 'page' == get_option( 'show_on_front' ) ) ) {
		echo $delimiter . '<strong>' . $blogname . '</strong>';
	}
	// If static Page as Front Page, and on Blog, output Blog link
	if ( ! is_home() && ! is_page() && ! is_front_page() && ( 'page' == get_option( 'show_on_front' ) ) ) {
		$blogpageid = get_option( 'page_for_posts' );
		$bloglink = '<a href="' . get_permalink( $blogpageid ) . '">' . $blogname . '</a>';
		echo $delimiter . $bloglink;
	} 
    // Define Category Hierarchy Crumbs for Category Archive
	if ( is_category() ) { 
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();
		$thisCat = $cat_obj->term_id;
		$thisCat = get_category($thisCat);
		$parentCat = get_category($thisCat->parent);
		if ($thisCat->parent != 0) {
			$hierarchy = ( $delimiter . __( 'Category Archive: ', 'oenology' ) . get_category_parents( $parentCat, TRUE, $delimiter ) );
		} else {
			$hierarchy = $delimiter . __( 'Category Archive: ', 'oenology' );
		}
			// Set $currentLocation to the current category
			$currentLocation = single_cat_title( '' , FALSE ); 
	} 
	// Define Crumbs for Day/Year/Month Date-based Archives
	elseif ( is_date() ) { 
		// Define Year/Month Hierarchy Crumbs for Day Archive
		if  ( is_day() ) {
			$date_string = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ' . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ';
			$date_string .= $delimiter . ' ';
			$currentLocation = get_the_time('d'); 
		} 
		// Define Year Hierarchy Crumb for Month Archive
		elseif ( is_month() ) {
			$date_string = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ';
			$date_string .= $delimiter . ' ';
			$currentLocation = get_the_time('F'); 
		} 
		// Set CurrentLocation for Year Archive
		elseif ( is_year() ) {
			$date_string = '';
			$currentLocation = get_the_time('Y'); 
		}
		$hierarchy = $delimiter . sprintf( __( 'Posts Published in: %s', 'oenology' ), $date_string ); 
    } 
	// Define Category Hierarchy Crumbs for Single Posts
	elseif ( is_single() && !is_attachment() ) { 
		$cat = get_the_category(); 
		$cat = $cat[0];
		$hierarchy = $delimiter . get_category_parents( $cat, TRUE, $delimiter );
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title();	  
    } 
	// Define Category and Parent Post Crumbs for Post Attachments
	elseif ( is_attachment() ) { 
		$parent = get_post($post->post_parent);
		$cat_parents = '';
		if ( get_the_category($parent->ID) ) {
		$cat = get_the_category($parent->ID); 
		$cat = $cat[0];
		$cat_parents = get_category_parents( $cat, TRUE, $delimiter );
		}
		$hierarchy = $delimiter . $cat_parents . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter;
		// Note: Titles are forced for attachments; the
		// filename will be used if none is specified
		$currentLocation = get_the_title();  
    } 
	// Define Current Location for Parent Pages
	elseif ( ! is_front_page() && is_page() && ! $post->post_parent ) { 
		$hierarchy = $delimiter;
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title();	  
    } 
	// Define Parent Page Hierarchy Crumbs for Child Pages
	elseif ( ! is_front_page() && is_page() && $post->post_parent ) { 
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
		$page = get_page($parent_id);
		$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
		$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) {
		$hierarchy = $hierarchy . $delimiter . $crumb;
		}
		$hierarchy = $hierarchy . $delimiter;
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title(); 
    } 
	// Define current location for Search Results page
	elseif ( is_search() ) { 
		$hierarchy = $delimiter . __('Search Results:', 'oenology' ) . ' ';
		$currentLocation = get_search_query();	  
    } 
	// Define current location for Tag Archives
	elseif ( is_tag() ) {	  
		$hierarchy = $delimiter . __( 'Tag Archive:', 'oenology' ) . ' ';
		$currentLocation = single_tag_title( '' , FALSE );  
    } 
	// Define current location for Author Archives
	elseif ( is_author() ) { 
		$hierarchy = $delimiter . __( 'Posts Written by:', 'oenology' ) . ' ';
		$currentLocation = get_the_author_meta( 'display_name', get_query_var( 'author' ) ); 
    } 
	// Define current location for 404 Error page
	elseif ( is_404() ) { 
		$hierarchy = $delimiter . __( 'Error 404:', 'oenology' ) . ' ';
		$currentLocation = __( 'Page Not Found', 'oenology' );	  
    } 
	// Define current location for Post Format Archives
	elseif ( get_post_format() && ! is_home() ) { 
		$hierarchy = $delimiter . __( 'Post Format Archive:', 'oenology' ) . ' ';
		$currentLocation = get_post_format_string( get_post_format() ) . 's';
	}

// Build the Current Location Link markup
	$currentLocationLink = $currentBefore . $currentLocation . $currentAfter; 
 
// Define breadcrumb pagination
 
// Define pagination for paged Archive pages
    if ( get_query_var('paged') && ! function_exists( 'wp_paginate' ) ) {
      $crumbPagination = ' (Page ' . get_query_var('paged') . ')';
    }
 
 // Define pagination for Paged Posts and Pages
    if ( get_query_var('page') ) {
      $crumbPagination = ' (Page ' . get_query_var('page') . ') ';
    }

// Output the resulting Breadcrumbs
	
	echo $hierarchy; // Output Hierarchy	
	echo $currentLocationLink; // Output Current Location	
	echo $crumbPagination; // Output page number, if Post or Page is paginated	
	echo $containerCrumbEnd; // End of BreadCrumbs
 
    echo $containerAfter; // End of Container

}


/**
 * Add navigation links to infobar
 */
function oenology_infobar_navigation() {
	
	// Start of Pagination
	if ( ! is_singular() ) {
		if ( function_exists( 'wp_paginate' ) ) {
			wp_paginate( 'title=' );
		} else { 
			echo oenology_get_paginate_archive_page_links( 'list' );
		}
	}
	
	if ( is_single() && ! is_attachment() ) {
		echo '<div class="prevnextpostlinks">';
		next_post_link( '%link', '&lArr; ' );
		previous_post_link( '%link', ' &rArr;' );
		echo '</div>';
	}

}

/**
 * Paginate Archive Index Page Links
 */
function oenology_get_paginate_archive_page_links( $type = 'plain', $endsize = 1, $midsize = 1 ) {
	global $wp_query, $wp_rewrite;	
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	
	// Sanitize input argument values
	if ( ! in_array( $type, array( 'plain', 'list', 'array' ) ) ) $type = 'plain';
	$endsize = (int) $endsize;
	$midsize = (int) $midsize;
	
	// Setup argument array for paginate_links()
	$pagination = array(
		'base' => @add_query_arg('paged','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => false,
		'end_size' => $endsize,
		'mid_size' => $midsize,
		'type' => $type,
		'prev_text' => '&lt;&lt;',
		'next_text' => '&gt;&gt;'
	);

	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

	return paginate_links( $pagination );
}

/**
 * Display copyright notice customized according to date of first post
 */
function oenology_copyright() {
	// check for cached values for copyright dates
	$copyright_cache = wp_cache_get( 'copyright_dates', 'oenology' );
	// query the database for first/last copyright dates, if no cache exists
	if ( false === $copyright_cache ) {	
		global $wpdb;
		$copyright_dates = $wpdb->get_results("
			SELECT
			YEAR(min(post_date_gmt)) AS firstdate,
			YEAR(max(post_date_gmt)) AS lastdate
			FROM
			$wpdb->posts
			WHERE
			post_status = 'publish'
		");
		$copyright_cache = $copyright_dates;
		// add the first/last copyright dates to the cache
		wp_cache_set( 'copyright_dates', $copyright_cache, 'oenology', '604800' );
	}
	// Build the copyright notice, based on cached date values
	$output = '&copy; ';
	if( $copyright_cache ) {
		$copyright = $copyright_cache[0]->firstdate;
		if( $copyright_cache[0]->firstdate != $copyright_cache[0]->lastdate ) {
			$copyright .= '-' . $copyright_cache[0]->lastdate;
		}
		$output .= $copyright;
	} else {
		$output .= date( 'Y' );
	}
	return $output;
}