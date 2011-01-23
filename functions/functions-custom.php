<?php
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
* Display copyright notice customized according to date of first post
*******************************************************************************************/

function oenology_copyright() {
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
$output = '';
if($copyright_dates) {
$copyright = "&copy; " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
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
	
		if ( !is_404() )
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
       global $author;
      $userdata = get_userdata($author);
      $hierarchy = $delimiter . 'Posts Written by: ';
	  $currentLocation = $userdata->display_name;  
 
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
	
	// Start of Pagination
	if ( ! is_singular() ) {
		if ( function_exists( 'wp_paginate' ) ) {
			wp_paginate( 'title=' );
		} else {
			echo '<div class="postsnavlinks">';
			posts_nav_link( '&nbsp;' , '&larr;' , '&rarr;' );
			echo '</div>';
		}
	}
	
	if ( is_single() && ! is_attachment() ) {
		echo '<div class="prevnextpostlinks">';
		next_post_link( '%link', '&lArr; ' );
		previous_post_link( '%link', ' &rArr;' );
		echo '</div>';
	}
 
    echo $containerAfter; // End of Container

}
?>