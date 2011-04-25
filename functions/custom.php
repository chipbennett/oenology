<?php

/*****************************************************************************************
* Enqueue comment-reply script
*******************************************************************************************/

function oenology_enqueue_comment_reply() {
	// on single blog post pages with comments open and threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		// enqueue the javascript that performs in-link comment reply fanciness
		wp_enqueue_script( 'comment-reply' ); 
	}
}
// Hook into wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'oenology_enqueue_comment_reply' );


/*****************************************************************************************
* Filter wp_title function
*******************************************************************************************/

function oenology_filter_wp_title( $title, $separator ) { // taken from TwentyTen 1.0
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( 'Search results for %s', '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( 'Page %s', $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( 'Page %s', max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'oenology_filter_wp_title', 10, 2 );

/*****************************************************************************************
* Filter the_title to output '(Untitled)' if no Post Title is provided
*******************************************************************************************/

// If Post Title is omitted, set a default string
function oenology_untitled_post( $title ) {
	if ( '' == $title ) {
		return '<em>(Untitled)</em>';
	} else {
		return $title;
	}
}
add_filter( 'the_title', 'oenology_untitled_post', 10, 1 );

/*****************************************************************************************
* Display correct number of comments (count only comments, not trackbacks/pingbacks)
*******************************************************************************************/

// filter get_comments_number() to return only the number of comments (excluding trackbacks/pingbacks)
// http://www.wpbeginner.com/wp-tutorials/display-the-most-accurate-comment-count-in-wordpress/
function oenology_comment_count( $count ) {  
if ( ! is_admin() ) {
global $id;
$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
return count($comments_by_type['comment']);
} else {
return $count;
}
}
add_filter('get_comments_number', 'oenology_comment_count', 0);

/*****************************************************************************************
* wp_list_comments() Callback function for Pings (Trackbacks/Pingbacks)
*******************************************************************************************/

function oenology_comment_list_pings( $comment ) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php }

/*****************************************************************************************
* Display copyright notice customized according to date of first post
*******************************************************************************************/

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


/*****************************************************************************************
* Image Handling for gallery previous/next links
*******************************************************************************************/

// function needed because WP gives no easy way to display both image and text in prev/next links.
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

/*****************************************************************************************
* Image Handling for gallery image metadata
*******************************************************************************************/

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


/*****************************************************************************************
* 404 error handling
*******************************************************************************************/

function oenology_404_handler() {
	
		if ( ! is_404() )
		return;
		
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
	if ( !isset ( $oenology404suggestions ) || !is_array( $oenology404suggestions ) || count( $oenology404suggestions ) == 0 )  { 
		$oenology404nopostsorpages = true;
	} else { 
		$oenology404nopostsorpages = false;
		?>
		<p>Let me try to make it up to you!</p>
		<?php
		// Display list of post suggestions
		$suggestedposts = $oenology404postsuggestions;
		if ( $suggestedposts > 0 ) {
			?>
			<p>Here is a list of posts that you might have been looking for:</p>
			<ul class="oenology404_suggestions">
			<?php
			foreach ( $suggestedposts as $suggestedpost ) { ?>
				<li>
					<span style="text-transform:uppercase;"><?php echo $suggestedpost->post_type; ?></span>: <a href="<?php echo get_permalink($suggestedpost->ID); ?>"><?php echo $suggestedpost->post_title; ?></a>
					<blockquote>
						<?php 
							if (empty($suggestedpost->post_excerpt)) {
									$suggestedpost->post_excerpt = explode(" ",strrev(substr(strip_tags($suggestedpost->post_content), 0, 300)),2);
									$suggestedpost->post_excerpt = strrev($suggestedpost->post_excerpt[1]);
									$suggestedpost->post_excerpt.= " [...]";
								}
							if ($suggestedpost->post_excerpt) {
								echo $suggestedpost->post_excerpt; 
							} else {
								echo 'No excerpt available.';
							}
						?>
					</blockquote>
				</li>
			<?php } ?>
			</ul>
			<?php 
		}
		// Display list of page suggestions
		$suggestedpages = $oenology404pagesuggestions;
		if ( $suggestedpages > 0 ) {
			?>
			<p>Here is a list of pages that you might have been looking for:</p>
			<ul class="oenology404_suggestions">
			<?php
			foreach ( $suggestedpages as $suggestedpage ) { ?>
				<li>
					<span style="text-transform:uppercase;"><?php echo $suggestedpage->post_type; ?></span>: <a href="<?php echo get_permalink($suggestedpage->ID); ?>"><?php echo $suggestedpage->post_title; ?></a>
					<blockquote>
						<?php 
							if (empty($suggestedpage->post_excerpt)) {
									$suggestedpage->post_excerpt = explode(" ",strrev(substr(strip_tags($suggestedpage->post_content), 0, 300)),2);
									$suggestedpage->post_excerpt = strrev($suggestedpage->post_excerpt[1]);
									$suggestedpage->post_excerpt.= " [...]";
								}
							if ($suggestedpage->post_excerpt) {
								echo $suggestedpage->post_excerpt; 
							} else {
								echo 'No excerpt available.';
							}
						?>
					</blockquote>
				</li>
			<?php } ?>
			</ul>
			<?php 
		}
	}
		
	// See if we've matched a category
	$oenology404nocategories = true;
	$categories = get_categories( array ( "name__like" => $search ) );
	if ( count($categories) > 0) { 
		$oenology404nocategories = false;
		?>	
		<p>Perhaps you were looking for something in one of the following categories?</p>
		<ul class="oenology404_suggestions">
		<?php foreach ( $categories as $category ) { ?>
			<li><a href="<?php get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a></li>
		<?php } ?>
		</ul>
	<?php }
	// See if we've matched a tag
	$oenology404notags = true;
	$tags = get_tags( array ( "name__like" => $search ) );
	if ( count($tags) > 0) { 
		$oenology404notags = false;
		?>	
		<p>Perhaps you were looking for something with one of the following tags?</p>
		<ul class="oenology404_suggestions">
		<?php foreach ( $tags as $tag ) { ?>
			<li><a href="<?php get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a></li>
		<?php } ?>
		</ul>
	<?php }
	
	$oenology404noresults = false;
	if ( $oenology404nopostsorpages && $oenology404nocategories && $oenology404notags ) {
		$oenology404noresults = true;
	}
	
	if ( $oenology404noresults ) { ?>
		<p>I'm sorry. For the life of me, I can't figure out what you were trying to find. Perhaps try searching, using the search form in the upper right-hand corner?</p>
	<?php }
}


/*****************************************************************************************
* Add a "current-cat" CSS class declaration
*******************************************************************************************/

/* Credit: StudioGrasshopper
*	http://www.studiograsshopper.ch/code-snippets/dynamic-category-menu-highlighting-for-single-posts/
*/
function oenology_show_current_cat_on_single($output) { 

	global $post;
 
	if( is_single() ) {
 
		$categories = wp_get_post_categories($post->ID);
 
		foreach( $categories as $catid ) {
			$cat = get_category($catid);
			// Find cat-item-ID in the string
			if(preg_match('#cat-item-' . $cat->cat_ID . '#', $output)) {
				$output = str_replace('cat-item-'.$cat->cat_ID, 'cat-item-'.$cat->cat_ID . ' current-cat', $output);
			}
		}
 
	}
	return $output;
}
add_filter('wp_list_categories', 'oenology_show_current_cat_on_single');


/*****************************************************************************************
* Add navigation breadcrumb function
*******************************************************************************************/

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
  $baseLink = '';
  $hierarchy = '';
  $currentLocation = '';
  $currentBefore = '<strong>';
  $currentAfter = '</strong>';
  $currentLocationLink = '';
  $crumbPagination = '';
 
 // Start of Container
    echo $containerBefore;
// Start of Breadcrumbs
	echo $containerCrumb;

// Output the Base Link	
    global $post;
    $home = home_url('/');
    $baseLink =  '<a href="' . $home . '">' . $name . '</a>';
	echo $baseLink; 
 
 // Define Breadcrumb Hierarchy and Current Location for various page types 
 
    if ( is_category() ) { // Define Category Hierarchy Crumbs for Category Archive
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) {
		$hierarchy = ($delimiter . get_category_parents($parentCat, TRUE, $delimiter));
      } else {
		$hierarchy = $delimiter;
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
 
    } elseif ( is_page() && !$post->post_parent ) { // Define Current Location for Parent Pages
	  $hierarchy = $delimiter;
	  $currentLocation = (  get_the_title()  ? get_the_title() : '(No Page Title)' );
	  
    } elseif ( is_page() && $post->post_parent ) { // Define Parent Page Hierarchy Crumbs for Child Pages
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
      $hierarchy = $delimiter . 'Posts Tagged as: ';
      $currentLocation = single_tag_title( '' , FALSE ); 
 
    } elseif ( is_author() ) { // Define current location for Author Archives
      $hierarchy = $delimiter . 'Posts Written by: ';
	  $currentLocation = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
 
    } elseif ( is_404() ) { // Define current location for 404 Error page
      $hierarchy = $delimiter . 'Error 404: ';
      $currentLocation = 'Page Not Found';
	  
    } elseif ( get_post_format() && ! is_home() ) { // Define current location for Post Format Archives
		$hierarchy = $delimiter . 'Post Format: ';
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


/*****************************************************************************************
* Add navigation links to infobar
*******************************************************************************************/

function oenology_infobar_navigation() {
	
	// Start of Pagination
	if ( ! is_singular() ) {
		if ( function_exists( 'wp_paginate' ) ) {
			wp_paginate( 'title=' );
		} else { ?>
			<?php oenology_paginate_archive_page_links( 'list' ); ?>
		<?php }
	}
	
	if ( is_single() && ! is_attachment() ) {
		echo '<div class="prevnextpostlinks">';
		next_post_link( '%link', '&lArr; ' );
		previous_post_link( '%link', ' &rArr;' );
		echo '</div>';
	}

}

/*****************************************************************************************
* Paginate Archive Index Page Links
*******************************************************************************************/

function oenology_paginate_archive_page_links( $type = 'plain', $endsize = 1, $midsize = 1 ) {
	global $wp_query, $wp_rewrite;	
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	
	// Sanitize input argument values
	if ( ! in_array( $type, array( 'plain', 'list', 'array' ) ) ) $type = 'plain';
	$endsize = (int) $endsize;
	$midsize = (int) $midsize;
	
	// Setup argument array for paginate_links()
	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
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

	echo paginate_links( $pagination );
}

/*****************************************************************************************
* Display a Theme credit link in the site footer
*******************************************************************************************/

// This option is disabled by default
function oenology_footer_credit() {
	echo ' | <a href="http://www.chipbennett.net/themes/oenology">Oenology Theme</a>';
}

/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
add_filter()
----------------------------------
add_filter() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/add_filter

add_filter() is used to hook a function into a WordPress action

add_filter( $tag, $function_to_add, $priority, $accepted_args ) accepts four arguments:
 - $tag: WordPress filter into which to hook the function. Default: none
 - $function_to_add: function to hook into the WordPress filter. Default: none
 - $priority: relative priority (order of execution, lower numbers execute sooner) of function. Default: 10
 - $accepted_args: number of arguments accepted by function being hooked. Default: 1

Example:
<?php add_filter('get_comments_number', 'oenology_comment_count', 0); ?>
Hooks custom function oenology_comment_count() into the "get_comment_count" filter, with the highest priority (0)

***********************
array_map()
----------------------------------
array_map() is a PHP function.
PHP reference: http://php.net/manual/en/function.array-map.php

array_map() is used to apply a callback to the elements of the given array(s)

array_map() returns an array containing all the elements of arr1 after applying the callback function to each one. 
The number of parameters that the callback function accepts should match the number of arrays passed to the array_map()

array_map( $callback, $array ) accepts two arguments:
 - $callback: the function to apply to the array
 - $array: the array to which to apply the function

***********************
array_reverse()
----------------------------------
array_reverse() is a PHP function.
PHP reference: http://php.net/manual/en/function.array-reverse.php

array_reverse() is used to reverse the order of elements in an array

array_reverse() will take an array containing elements array[0] = A, array[1] = B, array[2] = C,
and reverse the array, such that array[0] = C, array[1] = B, array[2] = A.

array_reverse( $array, $preserve_keys ) accepts two arguments:
 - $array: the array to reverse
 - $preserve_keys: (boolean) set to TRUE to preserve keys

Example:
$breadcrumbs = array_reverse($breadcrumbs);
Reverses the order of elements in the $breadcrumb array (containing a list of Parent Categories)

***********************
array_values()
----------------------------------
array_values() is a PHP function.
PHP reference: http://php.net/manual/en/function.array-values.php

array_values() is used to return an array of indexed values

array_values() will take an array containing elements "size" => "XL", "color" => "black", "sleeve" => "long",
and return an array containing elements array[0] = "XL", array[1] = "black", array[3] = "long"

array_values( $array ) accepts one argument:
 - $array: array for which to return values

***********************
basename()
----------------------------------
basename() is a PHP function.
PHP reference: http://php.net/manual/en/function.basename.php

basename() is used to return the filename component of a "\path\to\filename.ext" string

basename( $path, $ext ) accepts two arguments:
 - $path: string containing a filepath
 - $ext: file extension, e.g. ".php". If included, the indicated extension will omitted from the returned value

***********************
count()
----------------------------------
count() is a PHP function.
PHP reference: http://php.net/manual/en/function.count.php

count() is used to count the number of elements in an array.

count() will take an array containing elements array[0] = "red", array[1] = "green", array[2] = "blue",
and return the value "3".

count( $array, $mode ) accepts two arguments:
 - $array: the array for which to count the elements.
 - $mode: count normally, or count recursively. Default: count_normal.

Example:
count($comments_by_type['comment']);
Returns the number of comments of type 'comment' (rather than 'trackback' or 'pingback') for the current Post->$ID.

***********************
create_function()
----------------------------------
create_function() is a WordPress function.
PHP reference: http://php.net/manual/en/function.create-function.php

create_function() is used to create an anonymous function from the parameters passed, 
and return a unique name for it. 

create_function( $args, $code ) accepts two arguments:
 - $args: the arguments to pass to the function
 - $code: the function code

***********************
date()
----------------------------------
date() is a PHP function that returns the current date.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.date.php

date() accepts one argument: a string indicating the date format.

***********************
function_exists()
----------------------------------
function_exists() is a boolean (returns TRUE or FALSE) conditional PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.function-exists.php

function_exists( 'foo' ) returns TRUE if a function named foo() is found; otherwise, it returns FALSE.

***********************
get_bloginfo()
----------------------------------
bloginfo() is a WordPress template tag.  
Codex reference: http://codex.wordpress.org/Function_Reference/bloginfo

bloginfo() can be used to print several useful WordPress-related parameters. For example:

	charset = (character set defined for the blog (see wp-config.php); usually UTF-8)
	description =  (blog description, as defined on the General Settings page in the administration panel)
	html_type =  (HTML type, as defined on the General Settings page in the administration panel. Usually "text/html")
	name =  (blog name, as defined on the General Settings page in the administration panel)
	template_directory = (url of the directory that contains the currently active theme)
	version = (version of WordPress installed)
	
For the full list of parameters returned by bloginfo(), see the Codex.

bloginfo() prints (displays/outputs) the data requested. To get, but not display/output the data, use get_bloginfo() instead.


***********************
get_category()
----------------------------------
the_category() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_category

the_category() is used to display a list of links to categories to which the post belongs.

the_category( $separator, $parents, $postid ) accepts three arguments:
 - $separator: separator list between categories. Defaults to placing categories in an unordered list (<ul>)
 - $parents: accepts 'multiple' or 'single':
      - 'multiple': Display separate links to parent/child categories, exhibiting parent/child relationship
	  - 'single': Display link to child categories only (default)
 - $postid: ID of post for which categories to list. Defaults to ID of current post.

Example:
<?php the_category( ', '); ?> displays: "Category1, Category2, Category3"

the_category() prints (displays/outputs) the data requested. To get, but not display/output the data, use get_category() instead.

the_category() must be used within the Loop, unless the $postid argument is specified.

***********************
get_category_parents()
----------------------------------
get_category_parents() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_category_parents

get_category_parents() is used to return a list of the parents of a category, 
including the category, sorted by ID.

get_category_parents( $category, $displaylink, $separator, $nicename ) accepts four arguments:
 - $category: category ID for which to return the list. Default: current category, or none
 - $displaylink: boolean (TRUE/FALSE) argument to display the list as links to the categories
  - TRUE: display list as links to categories
  - FALSE: display list as text-only
  - Default: TRUE
 - $separator: text string to be used as separator between categories in the list
 - $nicename: boolean (TRUE/FALSE) argument to display the category nicename (slug)
  - TRUE: Display the category nicename (e.g. "my-category")
  - FALSE: Display the category display name (e.g. "My Category")
  - Default: FALSE

***********************
get_children()
----------------------------------
get_children() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_children

get_children() is used to retrieve attachments, revisions of a given Post

get_children() returns an associative array of posts (of variable type set 
by $output parameter) with post IDs as array keys, or an empty array if no 
posts are found.

get_children( $args[string] ) accepts multiple arguments. See the Codex for full list.

***********************
get_month_link()
----------------------------------
get_month_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_month_link

get_month_link() is used to return the monthly archive URL to a specific year and month

get_month_link() returns, but does not display (print) the URL. Use echo get_month_link() to display the URL.

get_month_link( $year, $month ) accepts two arguments:
 - $year: the year from which to retrieve the archive URL
 - $month: the month from which to retrive the archive URL
 - Default: current year/month

***********************
get_permalink()
----------------------------------
get_permalink() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_permalink

get_permalink() is used to return the permalink URL for the current post. This tag
returns only the permalink URL, not a fully formed HTML anchor tag.

get_permalink() returns, but does not display, the requested post permalink.

get_permalink( $id ) accepts one argument:
 - $id: ID of the post for which to return the permalink

Example:
<?php echo get_permalink($post->post_parent); ?>
Displays the URL to the post parent of the current post.

Used in the following template files:
post-entry-image.php

***********************
get_post()
----------------------------------
get_post() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_post

get_post() is used to return an object or array containing the data for the specified post.

get_post() returns, but does not display, the requested data.

get_post( $post, $output ) accepts two arguments
 - $post: a variable containing the PostID interger value
 - $output: 'OBJECT', 'ARRAY_A', 'ARRAY_N'

***********************
get_posts()
----------------------------------
get_posts() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_posts

get_posts() is used to create/output multiple Post Loops.

get_posts( 'arguments' ) accepts various arguments. See the Codex for the complete list.

***********************
get_post_meta()
----------------------------------
get_post_meta() is a WordPress template tag.
Codex reference: Codex reference: http://codex.wordpress.org/Function_Reference/get_post_meta

get_post_meta() is used to return the value of a specified meta key for a given post.

get_post_meta( $id, $key, $single ) accepts three arguments:
 - $id: ID of the post for which to return the meta value.
 - $key: meta key for which to return the value.
 - $single: boolean value for whether or not to return the result as a string or an array.
   - If result is an array, it will be serialized in the database as a single string; thus, set $single 
      to TRUE to return back that serialized string as an unserialized array. Otherwise, it will be 
	  returned as an array, for which the [0] value will be the serialized string.

Example:
$m = get_post_meta($post->ID, '_wp_attachment_metadata' , true);
Creates an array, $m, containing the image metadata for the current post attachment, with the 
following possible values:
 - $m[width]: image width, in px
 - $m[height]: image height, in px
 - $m[file]: image file name
 - $m[image_meta][created_timestamp]: date image was created (taken)
 - $m[image_meta][copyright]: image copyright notice
 - $m[image_meta][credit]: photographer credit
 - $m[image_meta][aperture]: camera aperture setting
 - $m[image_meta][focal_length]: camera focal length setting
 - $m[image_meta][iso]: camera iso setting
 - $m[image_meta][shutter_speed]: camera shutter speed setting
 - $m[image_meta][camera]: camera type

***********************
get_queried_object()
----------------------------------
get_queried_object() is a property of the WordPress WP_Query class.
Codex reference: http://codex.wordpress.org/Function_Reference/WP_Query

get_queried_object() is used to return information about the current 
category, author, permalink, or page

get_queried_object() returns an object that contains the specified information.

get_queried_object() accepts no arguments

Example:
$my_obj = $wp_query->get_queried_object();
returns object $my_obj that contains the specified information from $wp_query.

***********************
get_query_var()
----------------------------------
get_query_var() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_query_var

get_query_var() is used to return the specified variable from the $wp_query object

get_query_var( $var ) accepts one argument:
 - $var: the query variable to return.

Examples:
<?php get_query_var('paged'); ?>
 - Returns the current page number of an index page (home, archive, etc.)
<?php get_query_var('page'); ?>
 - Returns the current page number of a Post or Page

***********************
get_search_query()
----------------------------------
get_search_query() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_search_query

get_search_query() is used to return the string used in a search query.

get_search_query() returns, but does not print/display, the search query string.
To print/display the search query string, use "echo get_search_query()" or "the_search_query()"

get_search_query( $args ) accepts no arguments

Example:
<?php get_search_query(); ?>
If e.g. "lorem ipsum" was entered as the search query, returns the string "lorem ipsum"

***********************
get_the_category()
----------------------------------
get_the_category() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_the_category

get_the_category() returns an array of categories for the current page. The returned 
array includes the following variables:
 - $cat[n]->cat_ID: the ID of category 'n'
 - $cat[n]->cat_name: the name of category 'n'
 - $cat[n]->category_nicename: the nicename (slug) of category 'n'
 - $cat[n]->category_description: the description of category 'n'
 - $cat[n]->category_parent: the name of the parent category of category 'n'
 - $cat[n]->category_count: the count of posts included in category 'n'

get_the_category( $id ) accepts one argument:
 - $id: post ID for which to return the category array. Defaults to current post ID.

Example:
<?php $cat = get_the_category(); $cat = $cat[0]; echo $cat->category_nicename;?>
displays the nicename (slug) of the first category returned in the category array.

get_the_category() must be used inside the loop, unless a post ID is passed 
using the $id argument.

***********************
get_the_excerpt()
----------------------------------
the_excerpt() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_excerpt

the_excerpt() is used to display the Post Excerpt for the current post.

the_excerpt()  accepts no arguments.

Example:
<?php the_excerpt(); ?>

To get the Post Excerpt without displaying it, use get_the_excerpt().

the_excerpt()  must be used within the Loop.

***********************
get_the_time()
----------------------------------
the_time() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_time

the_time() is used to display the Post Time.

the_time( $d ) accepts one argument:
 -$d: time format (per PHP date() function). Defaults to time format configured in General Settings

Example:
<?php the_time( 'Y' ); ?> displays the year the post was published, e.g. '2010'.

the_time() prints the date. To get (return) the date but not print it, use get_the_time().

the_time() must be used within the Loop.

Used in the following template files:
post-footer.php, post-header.php

***********************
get_the_title()
----------------------------------
get_the_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_the_title

get_the_title() is used to display the Post Title of the current post.

get_the_title( $id ) accepts one argument:
 - $id: ID of the post for which to return the Post Title

Example:
<?php echo get_the_title($post->post_parent); ?> 
Displays the Post Title of the current post's parent post. 

***********************
get_userdata()
----------------------------------
get_userdata() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_userdata

get_userdata() is used to return an object containing user data for the specified user.

get_userdata( userid ) accepts one argument:
 - userid: the ID of the user for which to return data

Example:
<?php $user_info = get_userdata($id); ?>
Returns the following object values (not inclusive):
 - $user_info->user_login
 - $user_info->user_pass
 - $user_info->user_nicename
 - $user_info->user_email
 - $user_info->user_url
 - $user_info->user_registered
 - $user_info->display_name
 - $user_info->user_firstname
 - $user_info->user_lastname
 - $user_info->nickname
 - $user_info->user_description

***********************
get_year_link()
----------------------------------
get_year_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_year_link

get_year_link() is used to return (not print) the URL for the year-archive for the specified year.

get_year_link( $year ) accepts one argument:
 - $year: year for which to return the year-archive URL. Default: current year

***********************
is_404()
----------------------------------
is_404() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_404

is_404() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a 404 error page is currently displayed.

A 404 error page corresponds to the 404.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="error404".

***********************
is_array()
----------------------------------
is_array() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.is-array.php

is_array() is a boolean (returns TRUE or FALSE) conditional function that returns true if
a variable is an array.

is_array() accepts one argument: the variable to be evaluated

***********************
is_attachment()
----------------------------------
is_attachment() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_attachment

is_attachment() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
an attachment post ("attachment" post-type) is currently displayed.

An attachment post corresponds to the attachment.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
attachment post will have class="attachment".

***********************
is_author()
----------------------------------
is_author() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_author

is_author() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
an author archive page is currently displayed.

An author archive page corresponds to the author.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
attachment post will have class="author".

***********************
is_category()
----------------------------------
is_category() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_category

is_category() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a category page is currently displayed.

A category page corresponds to the category.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="category".

is_category( $category ) accepts one optional argument:
 - $category: category ID, slug, or nicename. If used, will return TRUE if the current
  page corresponds to the indicated category.

***********************
is_day()
----------------------------------
is_day() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_day

is_day() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a date (day) archive page is currently displayed.

A date (day) archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="date".

***********************
is_feed()
----------------------------------
is_feed() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_feed

is_feed() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a feed is currently displayed.

A feed does not correspond to any template files in the Theme hierarchy.

***********************
is_front_page()
----------------------------------
is_front_page() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_front_page

is_front_page() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the front page page is currently displayed.

The front page corresponds to the frontpage.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="home".

***********************
is_home()
----------------------------------
is_home() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_home

is_home() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the home page is currently displayed.

The home page corresponds to the index.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="blog".

***********************
is_month()
----------------------------------
is_month() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_month

is_month() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a date (month) archive page is currently displayed.

A date (month) archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="date".

***********************
is_page()
----------------------------------
is_page() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_page

is_page() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a page ("page" post-type) is currently displayed.

A page corresponds to the page.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="page".

***********************
is_search()
----------------------------------
is_search() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_search

is_search() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a search results page is currently displayed.

A search results page corresponds to the search.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="search".

***********************
is_single()
----------------------------------
is_single() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_single

is_single() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a single post ("post" post-type, i.e. a single blog post) is currently displayed.

A single post corresponds to the single.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of a 
single post will have class="single".

***********************
is_singular()
----------------------------------
is_singular() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_singular

is_singular() is a boolean (returns TRUE or FALSE) conditional tag that returns true if any of the following are true:

	is_single() - a single post ("post" post-type, i.e. a single blog post) is displayed
	is_page() - a page ("page" post-type) is displayed
	is_attachment() - an attachment 

***********************
is_tag()
----------------------------------
is_tag() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_tag

is_tag() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a tag page is currently displayed.

A tag page corresponds to the tag.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="tag".

is_tag( $tag ) accepts one optional argument:
 - $tag: tag ID, slug, or nicename. If used, will return TRUE if the current
  page corresponds to the indicated tag.

***********************
is_year()
----------------------------------
is_year() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_year

is_year() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a date (year) archive page is currently displayed.

A date (year) archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="date".

***********************
isset()
----------------------------------
isset() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.isset.php

isset() is used to determine if a specified variable is set, and is not NULL

isset() returns TRUE if the specified veriable is set, and is not NULL. Otherwise, it
returns false. Note: a zero-value ("0") is *not* equivalent to a NULL value.

isset( $arg ) accepts arguments:
 - $arg: variable to evaluate
 - isset() can take multiple variables. In this case, variables ae evaluated as defined 
 from left to right, and the function returns true only if ALL variables return true. Upon
 the first occurrence of a NULL-value variable, the function stops evaluating, and returns false.

Example:
if ( ! isset( $content_width ) ) {
  $content_width = 640;
}
This conditional will determine if the $content_width variable is set. If $content_width is not already
set, then it is set to a value of "640".

***********************
next_post_link()
----------------------------------
next_post_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/next_post_link

next_post_link() is used to display the next post (older post) 

next_post_link() displays a fully-formed HTML link.

next_post_link( $format, $link, $in_same_cat, $exclude_categories ) accepts four arguments:
 - $format: string format of the link, using the %link% placeholder for the HTML link. Default: "%link% &raquo;"
 - $link: text (string) to display within the HTML link. Default: "%title%" (Post Title)
 - $in_same_cat: boolean (TRUE/FALSE) value to specify if linked post must be in the same category as the
 current post. Default: FALSE
 - $exclude_categories: list of categories by ID, separated by 'and', to exclude. Default: none.

Example:
next_post_link( '%link', '&lArr; ' );
Displays the link to the next post, with a left arrow as the link text.

next_post_link() must be used from within the Loop.

***********************
number_format()
----------------------------------
number_format() is a PHP function.
Codex reference: N/A
PHP reference: http://us.php.net/manual/en/function.number-format.php

number_format() is used to format a number with grouped thousands 

number_format( $number, $decimals, $dec_point, $thousands_sep ) accepts one, two, our four arguments:
 - $number: the number to be formatted
 - $decimals: (optional) the number of decimal places. Default: 0
 - $dec_point / $thousands_sep: (optional, but must be in tandem if used) string value to use for 
 decimal place and thousands separator. Defaults: dot (".") for decimal place, and comma (",") for 
 thousands separator.

***********************
oenology_admin_header_style()
----------------------------------
oenology_admin_header_style() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_admin_header_style() is used to define the CSS to apply to the header image displayed
on the Custom Header admin option page, as part of the Custom Image Header feature

***********************
oenology_comment_count()
----------------------------------
oenology_comment_count() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_comment_count() is used to return only the number of comment-type 
comments (excluding trackbacks/pingbacks)

oenology_comment_count() hooks into the get_comments_number() filter hook

***********************
oenology_filter_wp_title()
----------------------------------
oenology_filter_wp_title() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_filter_wp_title() is used to display more accurate information in wp_title,
according to current location (search query, single post, etc.)

oenology_filter_wp_title() hooks into the wp_title filter hook

***********************
oenology_header_style()
----------------------------------
oenology_header_style() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_header_style() is used to define the CSS to apply to the header image, as part
of the Custom Image Header feature

***********************
oenology_show_current_cat_on_single()
----------------------------------
oenology_show_current_cat_on_single() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_show_current_cat_on_single() is used to add a "current-cat" CSS class, analogous to the
"current-page" CSS class, for use in styling the output of wp_list_categories()

oenology_show_current_cat_on_single() hooks into the wp_list_categories filter hook

***********************
posts_nav_link()
----------------------------------
posts_nav_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/posts_nav_link

posts_nav_link() is used to display Previous/Next links for paginated lists of posts
(e.g. index.php, archive.php, category.php, tag.php).

Note: the "Previous" link indicates *newer* posts; the "Next" link indicates *older* posts.
Thus, "Previous" and "Next" indicate the reverse-chronological nature of blog posts;
i.e. Previous in time (more recent) and Next in time (older).

posts_nav_link( $sep, $prelabel, $nxtlabel ) accepts 3 arguments:
 - $sep: text displayed between "Previous" and "Next" links. Defaults to ' :: '.
 - $prelabel: Link text displayed for "Previous" link. Defaults to '<< Previous Page'.
 - $nxtlabel:  Link text displayed for "Next" link. Defaults to 'Next Page >>'.

Example:
<?php posts_nav_link('&nbsp;&diams;&nbsp;','&laquo;&laquo; Newer Posts','Older Posts &raquo;&raquo;'); ?>
Displays '<< Newer Posts' and 'Older Posts >>', with diamonds as a separator.

posts_nav_link() must be used within the Loop.

***********************
preg_replace()
----------------------------------
preg_replace() is a PHP function.
Codex reference: N/A
PHP reference: http://us.php.net/manual/en/function.preg-replace.php

preg_replace() is used to perform a regular-expression search-and-replace

preg_replace() returns an array if the subject parameter is an array, or a string otherwise. If matches are 
found, the new subject will be returned, otherwise subject will be returned unchanged or NULL if an error occurred.

preg_replace( $pattern, $replacement, $subject ) accepts arguments:
 - $pattern: the pattern for which to search
 - $replacement: the string with which to replace found instances of $pattern
 - $subject: the string on which to perform the search (for $pattern)-and-replace (with $replacement)

***********************
previous_post_link()
----------------------------------
previous_post_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/previous_post_link

previous_post_link() is used to display the previous post (newer post) 

previous_post_link() displays a fully-formed HTML link.

previous_post_link( $format, $link, $in_same_cat, $exclude_categories ) accepts four arguments:
 - $format: string format of the link, using the %link% placeholder for the HTML link. Default: "%link% &raquo;"
 - $link: text (string) to display within the HTML link. Default: "%title%" (Post Title)
 - $in_same_cat: boolean (TRUE/FALSE) value to specify if linked post must be in the same category as the
 current post. Default: FALSE
 - $exclude_categories: list of categories by ID, separated by 'and', to exclude. Default: none.

Example:
previous_post_link( '%link', '&rArr; ' );
Displays the link to the next post, with a right arrow as the link text.

previous_post_link() must be used from within the Loop.

***********************
single_cat_title()
----------------------------------
single_cat_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/single_cat_title

single_cat_title() is used to display the title for the current category when displaying
the category page.

single_cat_title( $prefix, $display ) accepts one argument:
 - $prefix: string to display before the category title. Defaults to 'null'
 - $display: boolean (TRUE or FALSE) display value. Defaults to 'true' (display)

single_cat_title() must be used outside the Loop.

***********************
single_tag_title()
----------------------------------
single_tag_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/single_tag_title

single_tag_title() is used to display the title for the current tag when displaying
the tag page.

single_tag_title( $prefix, $display ) accepts one argument:
 - $prefix: string to display before the category title. Defaults to 'null'
 - $display: boolean (TRUE or FALSE) display value. Defaults to 'true' (display)

single_tag_title() must be used outside the Loop.

***********************
size_format()
----------------------------------
size_format() is a WordPress function.
Codex reference: N/A

size_format() is used to format filesizes into human-readable
formats, from bytes into KB, MB, etc.

size_format() takes a value in bytes, and returns the same value 
in KiB, MiB (where 1 MiB = 1024 B), with units "MB", "KB", etc.

size_format( $bytes, $decimals ) accepts arguments:
 - $bytes: filesize value (up to 32bits)
 - $decimals: decimal places to return. Default: '0'.

Example:
<?php size_format( '1048576' ); ?>
 - returns "1 MB"

***********************
sprintf()
----------------------------------
sprintf() is a PHP function.
Codex reference: N/A
PHP reference: http://us.php.net/manual/en/function.sprintf.php

sprintf() is used to return a string formatted according to the
defined formatting string format. See the PHP reference for more information.

***********************
str_replace()
----------------------------------
str_replace() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.str-replace.php

str_replace() is used to replace all occurrences of the search string with
the replacement string 

str_replace() returns a string or array (depending on what arguments are passed)
that contains the replaced strings.

str_replace( $search, $replace, $subject, $count ) accepts arguments:
 - $search: string to be replaced. Can be a string, or an array of strings
 - $replace: string with which to replace. Can be a string, or an array of strings.
 - $subject: string from within to search/replace. Can be a string, or an arrya of strings.
 - $count: integer. If passed, holds the number of replacements performed.

***********************
trim()
----------------------------------
trim() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.trim.php

trim() is used to strip whitespace or characters from the beginning
and end of a string

trim( $string ) accepts arguments:
 - $string: string to be trimmed

***********************
urldecode()
----------------------------------
urldecode() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.urlencode.php

urldecode() is used to URL-encode a string

urldecode() returns a string in which all non-alphanumeric characters except -_. 
have been replaced with a percent (%) sign followed by two hex digits and spaces 
encoded as plus (+) signs. It is encoded the same way that the posted data from a 
WWW form is encoded, that is the same way as in application/x-www-form-urlencoded 
media type.

urldecode( $string ) accepts arguments:
 - $string: string to URL-encode

***********************
wp_get_attachment_image()
----------------------------------
wp_get_attachment_image() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_attachment_image

wp_get_attachment_image() is used to return an HTML image tag for an attachment image

wp_get_attachment_image( $id, $size, $icon ) accepts arguments:
 - $id: the ID of the attachment
 - $size: string ("thumbnail", "large", etc.), or array ( array('width','height') ). Default: "thumbnail"
 - $icon: boolean: return the media icon for the attachment (TRUE).  Default: FALSE 

***********************
wp_get_attachment_link()
----------------------------------
wp_get_attachment_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_attachment_link

wp_get_attachment_link() is used to return an HTML hyperlink to an attachment
page or file. 

wp_get_attachment_link( $id, $size, $permalink, $icon ) accepts four arguments:
 - $id: the ID of the attachment
 - $size: string ("thumbnail", "large", etc.), or array ( array('width','height') ). Default: "thumbnail"
 - $permalink: boolean: return permalink (TRUE) or the file directly (FALSE). Default: TRUE
 - $icon: boolean: return the media icon for the attachment (TRUE).  Default: FALSE

***********************
wp_get_post_categories()
----------------------------------
wp_get_post_categories() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_post_categories

wp_get_post_categories() is used to retrieve the list of categories for a post

wp_get_post_categories() returns an array of Category IDs.

wp_get_post_categories( $id, $args ) accepts arguments:
 - $id: PostID for which to retrieve the categories
 - $args: an array of arguments. See Codex.

***********************
wp_paginate()
----------------------------------
wp_paginate() is a custom function for the WP-Paginate plugin
Codex reference: N/A
Plugin reference: http://wordpress.org/extend/plugins/wp-paginate/

wp_paginate() accepts one argument, that can be used to override default settings.
Refer to the plugin reference for more information.

wp_paginate() is used to output page numbers, in place of Previous/Next Post links.

wp_paginate() must be used within the Loop.

***********************
wp_upload_dir()
----------------------------------
wp_upload_dir() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_upload_dir

wp_upload_dir() is used to return an array of information regarding the
current upload directory.

wp_upload_dir() returns the following $key => $value pairs:
 - [path] - base directory and sub directory or full path to upload directory
 - [url] - base url and sub directory or absolute URL to upload directory.
 - [subdir] - sub directory if uploads use year/month folders option is on.
 - [basedir] - path without subdir.
 - [baseurl] - URL path without subdir.
 - [error] - set to false.

wp_upload_dir( $time ) accepts arguments:
 - $time: time, as a string, formatted as 'yyyy/mm'. Default: null.

Example:
<?php
$upload_dir = wp_upload_dir();
echo $upload_dir['baseurl'];
?>
 - returns "http://www.mydomain.tld/wp-content/uploads/"

=============================================================================
*/

/*
array_merge
array_shift
empty
get_categories
get_category_link
get_comments
get_post_format
get_post_format_string
get_tag_link
get_tags
get_search_query
is_admin
is_parent
preg_match
strip_tags
strpos
strrev
wp_get_attachment_url
wp_list_categories
wp_query
*/
?>