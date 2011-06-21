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
	$image = wp_get_attachment_image( $imagepost, 'large' );
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
	} elseif ( $attachmentimage->post_excerpt ) {
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
	
	// Intro text
	
	$oenology_404_intro = '';
	$oenology_404_intro .= '<p>Oh no, not again.</p>';
	$oenology_404_intro .= '<p>Well, this is weird. The post, page, or file you requested could not be found. ';
	$oenology_404_intro .= 'The best laid plans of mice, and all that. Those who study the complex interplay '; 
	$oenology_404_intro .= 'of cause and effect in the history of the Universe say that this sort of thing is ';
	$oenology_404_intro .= 'going on all the time.</p>';
	$oenology_404_intro .= '<p>I apologize for the inconvenience. Let me try to make it up to you!</p>';

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
		$oenology_404_posts = '';
		$suggestedposts = $oenology404postsuggestions;
		if ( $suggestedposts > 0 ) {
		
			$oenology_404_posts .= '<p>Here is a list of posts that you might have been looking for:</p>';
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
					$oenology_404_posts .= 'No excerpt available.';
				}
						
				$oenology_404_posts .= '</blockquote>';
				$oenology_404_posts .= '</li>';
			}
			$oenology_404_posts .= '</ul>';
			
		}
		
		// Display list of page suggestions
		$oenology_404_pages = '';
		$suggestedpages = $oenology404pagesuggestions;
		if ( $suggestedpages > 0 ) {
			
			$oenology_404_pages .= '<p>Here is a list of pages that you might have been looking for:</p>';
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
								$oenology_404_pages .= 'No excerpt available.';
							}
						
				$oenology_404_pages .= '</blockquote>';
				$oenology_404_pages .= '</li>';
			}
			$oenology_404_pages .= '</ul>';
			
		}
	}
		
	// See if we've matched a category
	$oenology_404_category = '';
	$oenology404nocategories = true;
	$categories = get_categories( array ( "name__like" => $search ) );
	if ( count( $categories ) > 0 ) { 
	
		$oenology404nocategories = false;
			
		$oenology_404_category .= '<p>Perhaps you were looking for something in one of the following categories?</p>';
		$oenology_404_category .= '<ul class="oenology404_suggestions">';
		foreach ( $categories as $category ) {
			$oenology_404_category .= '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
		}
		$oenology_404_category .= '</ul>';
	}
	// See if we've matched a tag
	$oenology_404_tag = '';
	$oenology404notags = true;
	$tags = get_tags( array ( "name__like" => $search ) );
	if ( count( $tags ) > 0 ) { 
	
		$oenology404notags = false;		
		
		$oenology_404_tag = '<p>Perhaps you were looking for something with one of the following tags?</p>';
		$oenology_404_tag = '<ul class="oenology404_suggestions">';
		foreach ( $tags as $tag ) {
			$oenology_404_tag = '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
		}
		$oenology_404_tag = '</ul>';
	}

	$oenology_404_results = '';
	$oenology_404_noresults = '<p>I apologize. For the life of me, I can\'t figure out what you were trying to find. Perhaps try searching, using the search form in the upper right-hand corner?</p>';
	$oenology_404_results = $oenology_404_intro . $oenology_404_posts . $oenology_404_pages . $oenology_404_category . $oenology_404_tag;
	
	$oenology404noresults = false;

	if ( $oenology404nopostsorpages && $oenology404nocategories && $oenology404notags ) {
		$oenology404noresults = true;
	}	
	$oenology_404 = ( $oenology404noresults ? $oenology_404_noresults : $oenology_404_results );
	
	return $oenology_404;
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
 
 // Define Breadcrumb Hierarchy and Current Location for various page types 
 
    if ( is_category() ) { // Define Category Hierarchy Crumbs for Category Archive
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) {
		$hierarchy = ( $delimiter . 'Category Archive: ' . get_category_parents( $parentCat, TRUE, $delimiter ) );
      } else {
		$hierarchy = $delimiter . 'Category Archive: ';
      }
	  $currentLocation = single_cat_title( '' , FALSE ); // Set $currentLocation to the current category
 
    } elseif ( is_day() ) { // Define Year/Month Hierarchy Crumbs for Day Archive
      $hierarchy = $delimiter . 'Posts Published in: <a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ' . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      $currentLocation = get_the_time('d'); 
 
    } elseif ( is_month() ) { // Define Year Hierarchy Crumb for Month Archive
      $hierarchy = $delimiter . 'Posts Published in: <a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      $currentLocation = get_the_time('F'); 
 
    } elseif ( is_year() ) { // Set CurrentLocation for Year Archive
	  $hierarchy = $delimiter . 'Posts Published in: ';
      $currentLocation = get_the_time('Y'); 
 
    } elseif ( is_single() && !is_attachment() ) { // Define Category Hierarchy Crumbs for Single Posts
      $cat = get_the_category(); 
	  $cat = $cat[0];
	  $hierarchy = $delimiter . get_category_parents( $cat, TRUE, $delimiter );
	  $currentLocation = (  get_the_title()  ? get_the_title() : '(No Post Title)' );
	  
    } elseif ( is_attachment() ) { // Define Category and Parent Post Crumbs for Post Attachments
      $parent = get_post($post->post_parent);
	  $cat_parents = '';
	  if ( get_the_category($parent->ID) ) {
		$cat = get_the_category($parent->ID); 
		$cat = $cat[0];
		$cat_parents = get_category_parents( $cat, TRUE, $delimiter );
	  }
	  $hierarchy = $delimiter . $cat_parents . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter;
	  $currentLocation = (  get_the_title()  ? get_the_title() : '(No Attachment Title)' ); 
 
    } elseif ( ! is_front_page() && is_page() && ! $post->post_parent ) { // Define Current Location for Parent Pages
	  $hierarchy = $delimiter;
	  $currentLocation = (  get_the_title()  ? get_the_title() : '(No Page Title)' );
	  
    } elseif ( ! is_front_page() && is_page() && $post->post_parent ) { // Define Parent Page Hierarchy Crumbs for Child Pages
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
	  $currentLocation = (  get_the_title()  ? get_the_title() : '(No Page Title)' ); 
 
    } elseif ( is_search() ) { // Define current location for Search Results page
      $hierarchy = $delimiter . 'Search Results: ';
	  $currentLocation = get_search_query();
	  
    } elseif ( is_tag() ) {	  // Define current location for Tag Archives
      $hierarchy = $delimiter . 'Tag Archive: ';
      $currentLocation = single_tag_title( '' , FALSE ); 
 
    } elseif ( is_author() ) { // Define current location for Author Archives
      $hierarchy = $delimiter . 'Posts Written by: ';
	  $currentLocation = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
 
    } elseif ( is_404() ) { // Define current location for 404 Error page
      $hierarchy = $delimiter . 'Error 404: ';
      $currentLocation = 'Page Not Found';
	  
    } elseif ( get_post_format() && ! is_home() ) { // Define current location for Post Format Archives
		$hierarchy = $delimiter . 'Post Format Archive: ';
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