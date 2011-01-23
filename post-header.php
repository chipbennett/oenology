<?php if ( ! is_page() && ! is_attachment() ) { // don't display timestamp on Pages ?>
	<span class="post-date">						
		<span class="post-date-year"><?php the_time('Y'); // Post Date: Year ?></span>			
		<span class="post-date-weekday"><?php the_time('D'); // Post Date: Weekday ?></span>
		<span class="post-date-day"><?php the_time('d'); // Post Date: Day of Month ?></span>
		<span class="post-date-month"><?php the_time('M'); // Post Date: Month ?></span>					
	</span>
<?php } 

if ( ( ! ( is_home() || is_single() || is_page() || is_attachment() ) ) && function_exists( 'the_post_thumbnail' ) ) { // display the post thumbnail in the post header for search and archive pages, since they are excerpted ?>
	<span class="post-title-thumbnail"><?php the_post_thumbnail( 'post-title-thumbnail' ); ?></span>
<?php } ?>

<h1><a href="<?php the_permalink(); //link Post Headline (H1) to post permalink ?>"><?php the_title(); // set Post Headline (H1) to Post Title ?></a>&nbsp;</h1>

<span class="post-title-metadata">
	<span id="post-<?php the_ID(); // unique ID for CSS purposes ?>">
		<a href="<?php the_permalink(); // link to post permalink ?>" rel="bookmark" title="Permanent Link to <?php the_title(); // display Post Title in tooltip on hover ?>"> Permalink</a>
	</span>	
	<?php if ( ! is_attachment() ) { // shortlink isn't generated for attachmets ?>
	<strong>|</strong>
	<span id="post-<?php the_ID(); // unique ID for CSS purposes ?>-shortlink">
		<?php the_shortlink( 'Shortlink' ); // link to post shortlink ?>
	</span>
	<?php }
	if ( !is_page() ) { // don't display comments and trackback links on Pages ?>
		<strong>|</strong>
		<a href="<?php comments_link(); ?>" target="_self" title="Comment on <?php the_title(); ?>">
			Comments (<?php comments_number('0','1','%'); // Display total number of post comments ?>)
		</a> 
		 | 
		<a href="<?php echo get_trackback_url(); // link to Trackback URL ?>" target="_self" title="Trackback to <?php the_title(); ?>">
			Trackback
		</a>
	<?php }
	if ( is_singular() ) { // only display a Print link on single posts, pages, and attachments ?>
	       <strong>|</strong> <a href="print" onclick="window.print();return false;">Print</a> 
	<?php } ?>
	<strong>|</strong>
	<?php edit_post_link('Edit','',''); // Display "Edit" link for logged-in Admin users ?>
</span>
<?php if( ! is_page() && ! is_attachment() ) { // don't display Categories and Tags on Pages ?>
	<span class="post-title-category">Filed in <?php the_category(', ');  // Display Post Categories ?></span>
	<span class="post-title-tags"><?php the_tags(); // Display Post Tags ?></span>
<?php } /*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
comments_link()
----------------------------------
comments_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/comments_link

comments_link() is used to display the URL to the current post's comments. This tag
returns the URL only, rather than the full HTML anchor-tag link.

comments_link() accepts no arguments.

Example:
<a href="<?php comments_link(); ?>">Comments</a>

comments_link() must be used within the Loop.

***********************
comments_number()
----------------------------------
comments_number() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/comments_number

comments_number() is used to display the number of comments (including 
comments, trackbacks, and pingbacks) on the current post.

comments_number( $a, $b, $c ) accepts three arguments:
 - $a: what to display for 0 comments
 - $b: what to display for 1 comment
 - $c: what to display for multiple comments
 
Example:
<?php comments_number('0','1','%'); ?> displays:
  - '0' if 0 comments
  - '1' if 1 comment
  - '#' (actual number of comments) if multiple comments

comments_number() must be used within the Loop.

***********************
edit_post_link()
----------------------------------
edit_post_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/edit_post_link

edit_post_link() is used to display a link to edit the current post. This link only
displays if the current user is logged in and has the edit_post capability
(typically, Admins, Editors, and Authors). 

This tag returns the full HTML anchor tag, rather than just the URL of the edit-post
link. To retrieve just the URL, use get_edit_post_link().

edit_post_link( $link, $before, $after, $id ) accepts four arguments:
- $link: link text to display. Defaults to "Edit This"
- $before: text to display before link. Defaults to no text.
- $after: text to display after link. Defaults to no text.
- $id: ID of post to be edited. Defaults to ID of current post.

Example:
<?php edit_post_link( 'Edit' ); ?> displays: "<a href='[link to post edit screen]'>Edit</a>"

edit_post_link() must be used within the Loop, unless the $id argument is specified.

***********************
get_trackback_url()
----------------------------------
get_trackback_url() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/trackback_url

get_trackback_url() is used to display the URL to the current post's trackback URL. This tag
returns the URL only, rather than a full HTML anchor-tag link.

get_trackback_url() accepts no arguments.

Example:
<a href="<?php get_trackback_url(); ?>">Trackback</a>

get_trackback_url() must be used within the Loop.

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
is_singular()
----------------------------------
is_singular() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_singular

is_singular() is a boolean (returns TRUE or FALSE) conditional tag that returns true if any of the following are true:

	is_single() - a single post ("post" post-type, i.e. a single blog post) is displayed
	is_page() - a page ("page" post-type) is displayed
	is_attachment() - an attachment 

***********************
the_category()
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

the_category() must be used within the Loop, unless the $postid argument is specified.

***********************
the_ID()
----------------------------------
the_ID() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_ID

the_ID() is used to display the Post ID for the current post.

the_ID()  accepts no arguments.

Example:
<?php the_ID(); ?>

To get the Post ID without displaying it, use get_the_ID().

the_ID()  must be used within the Loop.

***********************
the_permalink()
----------------------------------
the_permalink() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_permalink

the_permalink() is used to display the permalink URL for the current post. This tag
returns only the permalink URL, not a fully formed HTML anchor tag.

the_permalink() accepts no arguments.

Example:
<a href="<?php the_permalink(); ?>">Permalink</a>

the_permalink() must be used within the Loop.

***********************
the_post_thumbnail()
----------------------------------
the_post_thumbnail() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_post_thumbnail

the_post_thumbnail() is used to display the post thumbnail for the current post.

the_post_thumbnail( $size, $attr ) accepts two arguments:
 - $size: size of the thumbnail image:
     - 'thumbnail' (default)
	 - 'medium'
	 - 'large'
	 - 'full'
	 - array( 'W', 'H' , $crop )
	      - 'W': width, in pixels
		  - 'H': height, in pixels
		  - $crop: boolean (true/false) forced-cropping of image to specified dimensions. Defaults to 'false'
 - $attr: used to override default attributes, such as src, alt, title, or class

Example:
<?php the_post_thumbnail(); ?>

the_post_thumbnail() must be used within the Loop.

Post Thumbnails support must be defined and configured. Refer to functions.php for more information.

***********************
the_shortlink()
----------------------------------
the_shortlink() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_shortlink

the_shortlink() is used to display the Shortlink for the current post.

This tag returns the full HTML anchor tag, rather than just the URL of the Shortlink. To retrieve just 
the URL, use wp_get_shortlink().

the_shortlink( $text, $title, $before, $after ) accepts four arguments:
 - $text: Link text to display. Defaults to 'This is the shortlink'.
 - $title: HTML anchor tag title attribute text (displays in tooltip on hover). Defaults to Post Title.
 - $before: string to display before the Shortlink. Defaults to no text.
 - $after: string to display after the Shortlink. Defaults to no text.

Example:
<?php the_shortlink( 'Shortlink' ); ?> displays: <a href="[shortlink URL]" title="[Post Title]">Shortlink</a>.

the_shortlink() must be used within the Loop.

***********************
the_tags()
----------------------------------
the_tags() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_tags

the_tags() is used to display a list of links to tags to which the post belongs.

the_tags( $before, $separator, $after ) accepts three arguments:
 - $before: string to display before the tag list. Defaults to "Tags: ".
 - $separator: string/character to display between tags. Defaults to ", ".
 - $after: string to display after the tag list. Defaults to no text.

Example:
<?php the_tags(); ?>

the_tags() must be used within the Loop.

***********************
the_time()
----------------------------------
the_time() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_time

the_time() is used to display the Post Time.

the_time( $d ) accepts one argument:
 -$d: time format (per PHP date() function). Defaults to time format configured in General Settings

Example:
<?php the_time( 'Y' ); ?> displays the year the post was published, e.g. '2010'.

the_time() must be used within the Loop.

***********************
the_title()
----------------------------------
the_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_title

the_title() is used to display the Post Title of the current post.

the_title( $before, $after, $echo ) accepts three arguments:
 - $before: text string to display before the title. Defaults to no text.
 - $after:text string to display after the title. Defautls to no text.
 - $echo: boolean (true/false). 'True' displays the title; 'false' does not (for use in functions, etc.). Defaults to 'true'.

Example:
<?php the_title(); ?>

the_title() must be used within the Loop.

=============================================================================	
*/ ?> 
