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
			'description' => 'Berries'
		),
		'cherryblossom' => array(
			'url' => '%s/../twentyten/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/cherryblossoms-thumbnail.jpg',
			'description' => 'Cherry Blossoms'
		),
		'concave' => array(
			'url' => '%s/../twentyten/images/headers/concave.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/concave-thumbnail.jpg',
			'description' => 'Concave'
		),
		'fern' => array(
			'url' => '%s/../twentyten/images/headers/fern.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/fern-thumbnail.jpg',
			'description' => 'Fern'
		),
		'forestfloor' => array(
			'url' => '%s/../twentyten/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/forestfloor-thumbnail.jpg',
			'description' => 'Forest Floor'
		),
		'inkwell' => array(
			'url' => '%s/../twentyten/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/inkwell-thumbnail.jpg',
			'description' => 'Inkwell', 'oenology'
		),
		'path' => array(
			'url' => '%s/../twentyten/images/headers/path.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/path-thumbnail.jpg',
			'description' => 'Path'
		),
		'sunset' => array(
			'url' => '%s/../twentyten/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/../twentyten/images/headers/sunset-thumbnail.jpg',
			'description' => 'Sunset'
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
		'nav-header' => 'Header Navigation',
		'nav-sidebar' => 'Sidebar Navigation',
	) );

	
} // function oenology_setup()

endif; // function_exists('oenology_setup')


/*****************************************************************************************
* Filter wp_theme function
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
        $title = apply_filters( 'widget_title', empty($instance['title']) ? 'oenology Recent Posts' : $instance['title'] );

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
FUNCTION()
----------------------------------
FUNCTION() is a WordPress function.
Codex reference: 

FUNCTION() is used to 

FUNCTION() 

FUNCTION( $args ) accepts arguments:
 - $arg: 

Example:


Used in the following template files:
functions.php

***********************
add_action()
----------------------------------
add_action() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/add_action

add_action() is used to hook a function into a WordPress action

add_action( $tag, $function_to_add, $priority, $accepted_args ) accepts four arguments:
 - $tag: WordPress action into which to hook the function. Default: none
 - $function_to_add: function to hook into the WordPress action. Default: none
 - $priority: relative priority (order of execution, lower numbers execute sooner) of function. Default: 10
 - $accepted_args: number of arguments accepted by function being hooked. Default: 1

Example:
<?php add_action( 'after_setup_theme', 'oenology_setup', 10 ); ?>
Hooks custom function oenology_setup() into the "after_setup_theme" action, with the default priority

***********************
add_custom_background()
----------------------------------
add_custom_background() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/add_custom_background

add_custom_background() is used to add Theme support for WordPress custom background functionality

add_custom_background( $header_callback, $admin_header_callback, $admin_image_div_callback ) accepts three arguments:
 - $header_callback: Callback to add to "wp_head". Default: none.
 - $admin_header_callack: Callback to add to Custom Background admin screen. Default: none.
 - $admin_image_div_callback: Output a custom background image div on Custom Background admin screen. Default: none

Example:
<?php add_custom_background(); ?>
Adds custom background support to Theme, with no default background image defined.

***********************
add_custom_image_header()
----------------------------------
add_custom_image_header() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/add_custom_image_header

add_custom_image_header() is used to add Theme support for WordPress custom background functionality

add_custom_image_header( $header_callback, $admin_header_callback ) accepts two arguments:
 - $header_callback: Callback to add to "wp_head". Default: none.
 - $admin_header_callback: Callback to add to Custom Image Header admin screen. Default: none.

Example:
<?php add_custom_image_header( 'oenology_header_style', 'oenology_admin_header_style' ); ?>
Adds custom image header support to Theme, using header style defined in custom function
oenology_header_style(), and Custom Image Header admin screen style defined in custom function
oenology_admin_header_style().

***********************
add_editor_style()
----------------------------------
add_editor_style() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/add_editor_style

add_editor_style() is used to add Theme support for WordPress custom visual editor style functionality

add_editor_style( $stylesheet ) accepts one argument:
 - $stylesheet: name (without file extension) of the CSS file that contains the custom editor style
 definitions. Default: editor-style.css ('editor-style')

Example:
<?php add_editor_style(); ?>
Adds custom visual editor style support to Theme, with styles defined in CSS file editor-style.css.

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
add_image_size()
----------------------------------
add_image_size() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/add_image_size

add_image_size() is used to define a custom thumbnail image size, which will be generated
along with the default sizes of "Original", "Large", "Medium", "Small", and "Thumbnail".

add_image_size( $name, $width, $height, $crop ) accepts four arguments:
 - $name: Name of the custom Image Size to be added. Default: none.
 - $width: Width (in pixels) of the custom image. Default: '0'.
 - $height: Height (in pixels) of the custom image. Default: '0'.
 - $crop: boolean (TRUE or FALSE) argument to indicate crop method:
  - TRUE: hard crop mode
  - FALSE: soft (proportional) crop mode

Example:
<?php add_image_size( 'attachment-nav-thumbnail', 45, 45, true ); ?>
Adds a custom image size "attachment-nav-thumbnail", 45px wide, 45px in height, hard-cropped.

***********************
add_theme_support()
----------------------------------
add_theme_support() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/add_theme_support

add_theme_support() is used to add Theme support for the specified functionality

add_theme_support( $feature ) accepts one argument:
 - $feature: feature for which to add Theme support. 
  - Currently, either 'automatic-feed-links' or 'post-thumbnails'
  - Default: none

Example:
<?php add_theme_support( 'post-thumbnails' ); ?>
Adds Theme support for core WordPress Post Thumbnails feature

***********************
apply_filters()
----------------------------------
apply_filters() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/apply_filters

apply_filters() is used to call the functions added to a filter hook, and apply them to a specified value.

apply_filters( $tag, $value ) accepts two arguments:
 - $tag: the name of the filter hook. Default: none.
 - $value: the value to be modified by the specified filter hook.

Examples:
apply_filters( 'oenology_header_image_width', 1000 ) );
 - Applies the value of 1000 (px) to the "oenology_header_image_width" filter hook.
$title = apply_filters( 'widget_title', empty($instance['title']) ? 'oenology Recent Posts' : $instance['title'] );
 - Applies a string (based on a shorthand conditional) to the "widget_title" filter hook, and sets that value to the variable "$title".

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
define()
----------------------------------
define() is a PHP function.
PHP reference: http://php.net/manual/en/function.define.php

define() is used to define a named constant.

define( $name, $value, $case_insensitive ) accepts arguments:
 - $name: name of the constant. Default: none.
 - $value: value of the constant. Default: none.
 - $case_insensitive: (boolean) determines if constant name is case-sensitive or not.
  - TRUE: name is case-sensitive ("CONSTANT" and "constant" are two different constants)
  - FALSE: name is case-insensitive ("CONSTANT" and "constant" are the same constant)
  - Default: FALSE

Example:
define( 'HEADER_TEXTCOLOR', '000000' );
Defines the "HEADER_TEXTCOLOR" constant, with a value of "000000" (the HEX value for black)

***********************
filesize()
----------------------------------
filesize() is a PHP function.
PHP reference: http://php.net/manual/en/function.filesize.php

filesize() is used to return the size, in bytes, of the specified file 

filesize( $file ) accepts arguments:
 - $file: string containing full path to file for which to return the size.

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
header_image()
----------------------------------
header_image() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/header_image

header_image() is used to display the path to the header image

header_image() accepts no arguments.

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
max()
----------------------------------
max() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.max.php

max() is used to determine the highest numerical value of a given group of inputs

max() returns the highest numerical value of the given inputs. String values can be passed to the function,
but are evaluated as a numerical value of zero.

max( $arg1, $arg2, etc ) accepts multiple arguments:
 - $arg1, $arg2, etc: a list of values

max( $array ) accepts one argument:
 - $array: an array, for which each array value will be evaluated.
 - If used, an array MUST be the FIRST and ONLY value passed to the function, in order for the function
 to evaluate each array value

Example:
max( $paged, $page ) );
Will return the higher value between $paged (index page number) and $page (single-post page number)

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
oenology_load_widgets()
----------------------------------
oenology_load_widgets() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_load_widgets() is used to register the custom Theme Widgets.

oenology_load_widgets() hooks into the widgets_init action hook

***********************
oenology_setup()
----------------------------------
oenology_setup() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_setup() is used to define and setup all of the custom Theme features, including
Theme support for optional WordPress features. This function is designed to be over-ridden
by a Child Theme, if necessary.

oenology_setup() hooks into the after_setup_theme action hook

***********************
oenology_setup_widgets()
----------------------------------
oenology_setup_widgets() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_setup_widgets() is used to define all of the custom Theme Widgets. This function is
designed to be over-ridden by a Child Theme, if necessary.

oenology_setup_widgets() hooks into the after_theme_setup action hook

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
oenology_widget_archives()
----------------------------------
oenology_widget_archives() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_archives() outputs the default "Archives" Widget, but adds a "show/hide" 
toggle to the Widget output.

***********************
oenology_widget_categories()
----------------------------------
oenology_widget_categories() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_categories() outputs the default "Categories" Widget, but adds a "show/hide" 
toggle to the Widget output. 

***********************
oenology_widget_linkrollbycat()
----------------------------------
oenology_widget_linkrollbycat() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_linkrollbycat() outputs the default "Linkroll" Widget, but adds a "show/hide" 
toggle to the Widget output. 

***********************
oenology_widget_recentposts()
----------------------------------
oenology_widget_recentposts() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_recentposts() outputs the default "Recent Posts" Widget, but adds a "show/hide" 
toggle to the Widget output. 

***********************
oenology_widget_tags()
----------------------------------
oenology_widget_tags() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_tags() outputs the default "Tags" Widget, but adds a "show/hide" 
toggle to the Widget output. 

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
register_default_headers()
----------------------------------
register_default_headers() is a WordPress function.
Codex reference: 

register_default_headers() is used to register default header images available through the
Custom Header admin option page, as part of the Custom Image Header feature. 

register_default_headers( $array ) accepts one argument, as an array-of-arrays:
 - $array: array of arrays containing the following key pairs:
   - 'url' => 'url/path/to/header/image'
   - 'thumbnail_url' => 'url/path/to/header/image/thumbnail'
   - 'description' => 'Description of the header image'

***********************
register_nav_menus()
----------------------------------
register_nav_menus() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/register_nav_menus

register_nav_menus() is used to register Navigation Menu locations, as part of the 
Navigation Menus feature 

register_nav_menus( $array ) accepts one argument, as an array:
 - $array: an array of key pairs, as $location => $description
   - $location: the menu location, used to add the Menu to a Theme template file
   - $description: description of the menu location, used on the Menus admin option page

***********************
register_sidebar()
----------------------------------
register_sidebar() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/register_sidebar

register_sidebar() is used to 

register_sidebar() 

register_sidebar( $array ) accepts one argument, as an array:
 - $array: array containing the following key pairs:
   - 'name' => 'sidebar_name'
   - 'description' => 'Description of the sidebar'
   - 'before_widget' => 'HTML to output before the widget'
   - 'after_widget' => 'HTML to output after the widget'
   - 'before_title' => 'HTML to output before the widget title'
   - 'after_title' => 'HTML to output after the widget title'

***********************
register_widget()
----------------------------------
register_widget() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/register_widget

register_widget() is used to register a custom Theme Widget

register_widget( $widget ) accepts one argument:
 - $widget: function that defines the Widget being registered

***********************
set_post_thumbnail_size()
----------------------------------
set_post_thumbnail_size() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/the_post_thumbnail

set_post_thumbnail_size() is used to define the default size for an image thumbnail,
for use with the_post_thumbnail()

set_post_thumbnail_size( $width, $height, $crop ) accepts arguments:
 - $width: image thumbnail width, in pixels
 - $height: image thumbnail height, in pixels
 - $crop: boolean (TRUE/FALSE) to determine whether thumbnail should be cropped
   - TRUE: hard-crop: image is resized and cropped to match the specified dimensions exactly
   - FALSE: box-resize: image is resized proportionally

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
*/ ?>