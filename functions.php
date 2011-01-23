<?php
add_action( 'after_setup_theme', 'oenology_setup', 10 );
add_action( 'after_setup_theme', 'oenology_setup_widgets', 11 );

if ( ! function_exists( 'oenology_setup' ) ):

function oenology_setup() {

/*****************************************************************************************
* Add theme support for various WordPress features
*******************************************************************************************/

// Automatically add RSS feed links to document header (since WP 2.9.0)
add_theme_support('automatic-feed-links');

// Post Thumbnails (since WP 2.9.0)
add_theme_support('post-thumbnails'); 
set_post_thumbnail_size( 150, 150, true ); // default dimensions for "thumbnail" image size
add_image_size( 'post-title-thumbnail', 55, 55, true ); // Post Title thumbnail size (55px x 55px)
add_image_size( 'attachment-nav-thumbnail', 45, 45, true ); // Gallery Navigation image thumbnail size (55px x 55px)

// Custom Backgrounds (since WP 3.0.0)
add_custom_background();

// Custom Header Image (since WP 3.0.0)
add_custom_image_header( 'oenology_header_style', 'oenology_admin_header_style' );

// Custom WYSIWIG Editor Style (since WP 3.0.0)
add_editor_style();


/*****************************************************************************************
* Define content_width, to keep images from overflowing.
*******************************************************************************************/

if ( ! isset( $content_width ) ) {
  $content_width = 640;
}
//$GLOBALS['content_width'] = 640;


/*****************************************************************************************
* Define Custom Headers (since WordPress 3.0)
*******************************************************************************************/

// Your changeable header business starts here
define( 'HEADER_TEXTCOLOR', '000000' ); // Hex color value, without leading octothorpe (#)
define('HEADER_IMAGE', get_stylesheet_directory_uri() . '/images/headers/pxwhite.jpg'); // Default header image to use
define( 'HEADER_IMAGE_WIDTH', apply_filters( 'oenology_header_image_width', 1000 ) ); // Width to which WordPress will crop uploaded header images
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'oenology_header_image_height', 198 ) ); // Height to which WordPress will crop uploaded header images
define( 'NO_HEADER_TEXT', false ); // Allow text inside the header image.

// Add a way for the custom header to be styled in the admin panel that controls
// custom headers. See oenology_admin_header_style(), below.

// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/../twentyten/images/headers/berries.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/berries-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Berries', 'oenology' )
		),
		'cherryblossom' => array(
			'url' => '%s/../twentyten/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/cherryblossoms-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cherry Blossoms', 'oenology' )
		),
		'concave' => array(
			'url' => '%s/../twentyten/images/headers/concave.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/concave-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Concave', 'oenology' )
		),
		'fern' => array(
			'url' => '%s/../twentyten/images/headers/fern.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/fern-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Fern', 'oenology' )
		),
		'forestfloor' => array(
			'url' => '%s/../twentyten/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/forestfloor-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Forest Floor', 'oenology' )
		),
		'inkwell' => array(
			'url' => '%s/../twentyten/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/inkwell-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Inkwell', 'oenology' )
		),
		'path' => array(
			'url' => '%s/../twentyten/images/headers/path.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/path-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'oenology' )
		),
		'sunset' => array(
			'url' => '%s/../twentyten/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/sunset-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Sunset', 'oenology' )
		)
	) );
	
if ( ! function_exists( 'oenology_header_style' ) ) :

function oenology_header_style() {
?>
<style type="text/css">
/* Sets header image as background for div#header */
#header {
	background:url('<?php header_image(); ?>') no-repeat left top;
}
</style>
<?php
}

endif;

if ( ! function_exists( 'oenology_admin_header_style' ) ) :

function oenology_admin_header_style() {
?>
<style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        }
</style>
<?php
}

endif;

/*****************************************************************************************
* Define Nav Menus (since WordPress 3.0)
*******************************************************************************************/

// This theme uses wp_nav_menu() in two locations: main site navigation, and left-colum page navigation.
	register_nav_menus( array(
		'nav-header' => __( 'Header Navigation', 'oenology' ),
		'nav-sidebar' => __('Sidebar Navigation', 'oenology' ),
	) );

	
} // function oenology_setup()

endif; // function_exists('oenology_setup')


/*****************************************************************************************
* Filter wp_theme function
*******************************************************************************************/

function oenology_filter_wp_title( $title, $separator ) { // taken from TwentyTen theme
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'oenology' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'oenology' ), $paged );
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
		$title .= " $separator " . sprintf( __( 'Page %s', 'oenology' ), max( $paged, $page ) );

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
	$m = get_post_meta($post->ID, '_wp_attachment_metadata' , true);
	$image = wp_get_attachment_image( $post->ID, 'large' );
	$url = wp_get_attachment_url($post->ID);
	$uploaddir = wp_upload_dir();
	$imagesize = size_format( filesize($uploaddir['basedir'].'/'.$m['file']) );
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
	if ( !empty($post->post_excerpt) ) {
		$image_meta['caption'] = get_the_excerpt(); // this is the "caption"
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
      $cat = get_the_category($parent->ID); $cat = $cat[0];
	  $hierarchy = $delimiter . get_category_parents( $cat, TRUE, $delimiter ) . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter;
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
			posts_nav_link( '&Diams' , '&larr;' , '&rarr;' );
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


/*****************************************************************************************
* Widget Functions
* 
*  - Register Widget  Areas (Sidebars)
*  - Define Widgets
*  - Register Widgets
*******************************************************************************************/

function oenology_setup_widgets() {

/*****************************************************************************************
* Register all widget areas (sidebars) (since WordPress 2.8)
*******************************************************************************************/
if ( function_exists('register_sidebar') ) { 
register_sidebar(array( // Left Column widget area
'name'=>'sidebar-left',
'description' => 'Left-column; widget area for blog info (feeds, archives, etc.).',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<div class="title widgettitle">',
'after_title' => '</div>',
));
register_sidebar(array( // Right Column widget area
'name'=>'sidebar-right',
'description' => 'Right-column; widget area for miscellaneous.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<div class="title">',
'after_title' => '</div>',
));
}  

} // function oenology_widget_setup()


/* Define all widgets
**********************************************************/

/* oenology_widget_recentposts */

class oenology_widget_recentposts extends WP_Widget {

    function oenology_widget_recentposts() {
        $widget_ops = array('classname' => 'oenology-widget-recentposts', 'description' => 'oenology theme widget to display recent posts in the left column' );
        $this->WP_Widget('oenology_recentposts', 'oenology Recent Posts', $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'oenology Recent Posts' : $instance['title']);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Recent Posts -->
<span>Click to <span style="color:#5588aa;" onclick="document.getElementById('arch01').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('arch01').style.display='none';">hide</span>
</span>
<br /><br />
<div id="arch01" style="display:none;">
				<ul class="listrecentposts">
				<?php wp_get_archives('type=postbypost&limit=20'); ?>
				</ul>
</div>
<!-- End Recent Posts -->

<?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
    }
} 

/* oenology_widget_archives */

class oenology_widget_archives extends WP_Widget {

    function oenology_widget_archives() {
        $widget_ops = array('classname' => 'oenology-widget-archives', 'description' => 'oenology theme widget to display archives in the left column' );
        $this->WP_Widget('oenology_archives', 'oenology Archives', $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'oenology Archives' : $instance['title']);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Archives -->
<span>Click to <span style="color:#5588aa;" onclick="document.getElementById('arch02').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('arch02').style.display='none';">hide</span>
</span>
<br /><br />
<div id="arch02" style="display:none;">
	<ul class="listarchives">
		<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
	</ul>
</div>
<!-- End Archives -->

<?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
    }
} 

/* oenology_widget_categories */

class oenology_widget_categories extends WP_Widget {

    function oenology_widget_categories() {
        $widget_ops = array('classname' => 'oenology-widget-categories', 'description' => 'oenology theme widget to display the category list in the left column' );
        $this->WP_Widget('oenology_categories', 'oenology Categories', $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'oenology Categories' : $instance['title']);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Categories -->
<span>Click to <span style="color:#5588aa;" onclick="document.getElementById('arch03').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('arch03').style.display='none';">hide</span>
</span>
<br /><br />
<div id="arch03" style="display:none;">
	<ul class="leftcolcatlist">

		<?php
		 $catrssimg = "/images/rss.png";
		 $catrssurl = get_template_directory_uri() . $catrssimg;
		 $customcatlist ='';
		 $customcats=  get_categories();
		 foreach($customcats as $customcat) {
		 	$customcatlist = '<li><a title="Subscribe to the '.$customcat->name.' news feed" href="'.home_url().'/category/'.$customcat->category_nicename.'/feed/"><img src="'.$catrssurl.'" alt="feed" /></a><a href="'.home_url().'/category/'.$customcat->category_nicename.'/">'.$customcat->name.'</a> ('.$customcat->count.')</li>';
			echo $customcatlist;
		 }
		?>

	</ul>
</div>
<!-- End Categories -->

<?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
    }
} 

/* oenology_widget_tags */

class oenology_widget_tags extends WP_Widget {

    function oenology_widget_tags() {
        $widget_ops = array('classname' => 'oenology-widget-tags', 'description' => 'oenology theme widget to display the tag list in the left column' );
        $this->WP_Widget('oenology_tags', 'oenology Tags', $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'oenology Tags' : $instance['title']);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Tags -->
<span>Click to <span style="color:#5588aa;" onclick="document.getElementById('tag01').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('tag01').style.display='none';">hide</span>
</span>
<br /><br />
<div id="tag01" style="display:none;">
	<ul class="leftcolcatlist">

	<?php
		 $tagrssimg = "/images/rss.png";
		 $tagrssurl = get_template_directory_uri() . $tagrssimg;
		 $customtaglist ='';
		 $customtags =  get_tags();
		 foreach($customtags as $customtag) {
		 	$customtaglist = '<li><a title="Subscribe to the '.$customtag->name.' feed" href="'.home_url().'/tag/'.$customtag->slug.'/feed/"><img src="'.$tagrssurl.'" alt="feed" /></a><a href="'.home_url().'/tag/'.$customtag->slug.'/">'.$customtag->name.'</a> ('.$customtag->count.')</li>';
			echo $customtaglist;
		 } 
	?>
	</ul>

</div>
<!-- End Tags -->

<?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
    }
} 

/* oenology_widget_linkrollbycat */

class oenology_widget_linkrollbycat extends WP_Widget {

    function oenology_widget_linkrollbycat() {
        $widget_ops = array('classname' => 'oenology-widget-linkrollbycat', 'description' => 'oenology theme widget to display linkroll by category' );
        $this->WP_Widget('oenology_linkrollbycat', 'oenology Links By Cat', $widget_ops);
    }

    function widget( $args, $instance ) {
	
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'oenology Links By Cat' : $instance['title']);
	$defaultview = isset($instance['defaultView']) && $instance['defaultview'] == true  ? 'inline' : 'none'; 
	$show_description = isset($instance['description']) ? $instance['description'] : false; 
	$show_name = isset($instance['name']) ? $instance['name'] : false; 
	$show_rating = isset($instance['rating']) ? $instance['rating'] : false; 
	$show_images = isset($instance['images']) ? $instance['images'] : false; 
	$categorize = isset($instance['categorize']) ? $instance['categorize'] : false; 
	$category = isset($instance['category']) ? $instance['category'] : false; 
	$categoryid = $category;
	$bookmarkid = rand();
	$bookmarksexist = get_bookmarks( array( 'category' => $categoryid));

    	if ( $bookmarksexist ) {
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
?>
<span>Click to <span style="color:#5588aa;" onclick="document.getElementById('br<?php echo $categoryid; ?>-<?php echo $bookmarkid; ?>').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('br<?php echo $categoryid; ?>-<?php echo $bookmarkid; ?>').style.display='none';">hide</span>
</span>
<br /><br />
<div id="br<?php echo $categoryid; ?>-<?php echo $bookmarkid; ?>" style="display:<?php echo $defaultview; ?>;">
	<ul>
	<?php 
		wp_list_bookmarks(apply_filters('widget_links_args', array( 
			'title_li' => '', 'title_before' => '', 'title_after' => '', 
			'category_before' => $before_widget, 'category_after' => $after_widget, 
			'show_images' => $show_images, 'show_description' => $show_description, 
			'show_name' => $show_name, 'show_rating' => $show_rating, 
			'categorize' =>  $categorize, 'category' => $category, 
			'class' => 'linkcat widget' 
		))); 

	?>
	</ul>
</div>

<?php
			echo $after_widget;
		}
    }

    function update( $new_instance, $old_instance ) {
        $new_instance = (array) $new_instance; 
		$instance = array( 'defaultview' => 0, 'images' => 0, 'name' => 0, 'description' => 0, 'rating' => 0); 
			foreach ( $instance as $field => $val ) { 
				if ( isset($new_instance[$field]) ) 
					$instance[$field] = 1; 
			} 
			$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
			$instance['category'] = intval($new_instance['category']); 
			
        return $instance;
    }

    function form( $instance ) {
		$defaults = array( 'defaultview' => 'false' );
        $instance = wp_parse_args( (array) $instance, array( 
		'title' => '' , 
		'defaultview' => 'false' , 
		'category' => '' , 
		'images' => 'false' , 
		'name' => 'false' , 
		'description' => 'false' , 
		'rating' => 'false'
		) 
	  );
        $title = strip_tags($instance['title']);
?>
           	 <p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>">Bookmark Category:</label>
			<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" class="widefat" style="width:100%;">
			<?php $link_cats = get_terms( 'link_category'); ?>
			<?php foreach ( $link_cats as $link_cat ) : ?>
				<option <?php if ( $link_cat->term_id == $instance['category'] ) echo 'selected="selected"'; ?> value="<?php echo $link_cat->term_id; ?>"><?php echo $link_cat->name; ?></option>
			<?php endforeach; ?>
			</select>
		</p>
           	 <p>
			<input class="checkbox" type="checkbox" <?php checked($instance['defaultview'], true) ?> id="<?php echo $this->get_field_id('defaultview'); ?>" name="<?php echo $this->get_field_name('defaultview'); ?>" /> 
			<label for="<?php echo $this->get_field_id('defaultview'); ?>"><?php _e('View Inline (Unchecked: Hidden)'); ?></label><br /> 
           	 </p>
		<p> 
			<input class="checkbox" type="checkbox" <?php checked($instance['images'], true) ?> id="<?php echo $this->get_field_id('images'); ?>" name="<?php echo $this->get_field_name('images'); ?>" /> 
			<label for="<?php echo $this->get_field_id('images'); ?>"><?php _e('Show Link Image'); ?></label><br /> 
			<input class="checkbox" type="checkbox" <?php checked($instance['name'], true) ?> id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" /> 
			<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Show Link Name'); ?></label><br /> 
			<input class="checkbox" type="checkbox" <?php checked($instance['description'], true) ?> id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" /> 
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Show Link Description'); ?></label><br /> 
			<input class="checkbox" type="checkbox" <?php checked($instance['rating'], true) ?> id="<?php echo $this->get_field_id('rating'); ?>" name="<?php echo $this->get_field_name('rating'); ?>" /> 
			<label for="<?php echo $this->get_field_id('rating'); ?>"><?php _e('Show Link Rating'); ?></label> 
		</p> 

<?php
    }
} 


/* Register all widgets
**********************************************************/

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'oenology_load_widgets' );

/* Function that registers our widgets. */
function oenology_load_widgets() {
	register_widget( 'oenology_widget_recentposts' );
	register_widget( 'oenology_widget_archives' );
	register_widget( 'oenology_widget_categories' );
	register_widget( 'oenology_widget_tags' );
	register_widget( 'oenology_widget_linkrollbycat' );
}

/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
add_action()
----------------------------------

***********************
add_custom_background()
----------------------------------

***********************
add_custom_image_header()
----------------------------------

***********************
add_editor_style()
----------------------------------

***********************
add_filter()
----------------------------------

***********************
add_image_size()
----------------------------------

***********************
add_theme_support()
----------------------------------

***********************
apply_filters()
----------------------------------

***********************
array_map()
----------------------------------

***********************
array_reverse()
----------------------------------

***********************
array_values()
----------------------------------

***********************
basename()
----------------------------------

***********************
count()
----------------------------------

***********************
create_function()
----------------------------------

***********************
define()
----------------------------------

***********************
filesize()
----------------------------------

***********************
function_exists()
----------------------------------

***********************
get_bloginfo()
----------------------------------

***********************
get_category()
----------------------------------

***********************
get_category_parents()
----------------------------------

***********************
get_children()
----------------------------------

***********************
get_month_link()
----------------------------------

***********************
get_permalink()
----------------------------------

***********************
get_post()
----------------------------------

***********************
get_posts()
----------------------------------

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

***********************
get_query_var()
----------------------------------

***********************
get_search_query()
----------------------------------

***********************
get_the_excerpt()
----------------------------------

***********************
get_the_time()
----------------------------------

***********************
get_the_title()
----------------------------------

***********************
get_userdata()
----------------------------------

***********************
get_year_link()
----------------------------------

***********************
is_404()
----------------------------------

***********************
is_array()
----------------------------------

***********************
is_attachment()
----------------------------------

***********************
is_author()
----------------------------------

***********************
is_category()
----------------------------------

***********************
is_day()
----------------------------------

***********************
is_feed()
----------------------------------

***********************
is_front_page()
----------------------------------

***********************
is_home()
----------------------------------

***********************
is_month()
----------------------------------

***********************
is_page()
----------------------------------

***********************
is_search()
----------------------------------

***********************
is_single()
----------------------------------

***********************
is_singular()
----------------------------------

***********************
is_year()
----------------------------------

***********************
isset()
----------------------------------

***********************
max()
----------------------------------

***********************
next_post_link()
----------------------------------

***********************
number_format()
----------------------------------

***********************
oenology_404_handler()
----------------------------------

***********************
oenology_breadcrumb()
----------------------------------

***********************
oenology_comment_count()
----------------------------------

***********************
oenology_copyright()
----------------------------------

***********************
oenology_filter_wp_title()
----------------------------------

***********************
oenology_gallery_links()
----------------------------------

***********************
oenology_gallery_image_meta()
----------------------------------

***********************
oenology_header_style()
----------------------------------

***********************
oenology_load_widgets()
----------------------------------

***********************
oenology_setup()
----------------------------------

***********************
oenology_setup_widgets()
----------------------------------

***********************
oenology_show_current_cat_on_single()
----------------------------------

***********************
oenology_widget_archives()
----------------------------------

***********************
oenology_widget_categories()
----------------------------------

***********************
oenology_widget_linkrollbycat()
----------------------------------

***********************
oenology_widget_recentposts()
----------------------------------

***********************
oenology_widget_tags()
----------------------------------

***********************
posts_nav_link()
----------------------------------

***********************
preg_replace()
----------------------------------

***********************
previous_post_link()
----------------------------------

***********************
register_default_headers()
----------------------------------

***********************
register_nav_menus()
----------------------------------

***********************
register_sidebar()
----------------------------------

***********************
register_widget()
----------------------------------

***********************
set_post_thumbnail_size()
----------------------------------

***********************
single_cat_title()
----------------------------------

***********************
single_tag_title()
----------------------------------

***********************
size_format()
----------------------------------

***********************
sprintf()
----------------------------------

***********************
str_replace()
----------------------------------

***********************
the_excerpt()
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
trim()
----------------------------------

***********************
urldecode()
----------------------------------

***********************
wp_get_attachment_image()
----------------------------------

***********************
wp_get_attachment_link()
----------------------------------

***********************
wp_get_post_categories()
----------------------------------

***********************
wp_paginate()
----------------------------------

***********************
wp_upload_dir()
----------------------------------


=============================================================================
*/ ?>