<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to twentyten_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Oenology
 * @since Oenology 1.0
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : // don't display comments for password-protected posts ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'oenology' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<h2 class="commentsheader">Feedback</h2>

<?php if ( have_comments() ) : ?>

<?php
	$postrac = false; // Boolean (true/false) variable indicating if a post has Trackbacks or Pingbacks. Set to 'false' until determined to be true.
	if ($comments) { // if there are no comments, don't look for Trackbacks
	
		foreach ($comments as $comment) { // step through each comment
			if( get_comment_type() != "comment" ) { 
				$postrac = true;  // if a comment has a comment_type other than "comment" (i.e. a Trackback or Pingback), set $postrac to 'true'
				} 
			}
			
		if ( $postrac ) { // if the post has any trackbacks por pingbacks, display them as a list ?>
			<h3 class='trackbackheader'>Trackbacks</h3>
                        <ol class='trackbacklist'>
			<?php foreach ($comments as $comment) { // step through each comment
				if(get_comment_type() != "comment") { // if the comment is a Trackback or Pingback ?>
					<li><?php echo comment_author_link(); // display the Comment Author Link (the Trackback/Pingback URL) ?></li>
				<?php }
			} ?>
			</ol>
		<?php }
	}
?>

<h3>Comments <?php if ( ! comments_open() ) { ?> <small>(Comments are closed)</small><?php } ?></h3>

	

<?php $i = 0; ?>
	<span id="comments-responses" style="font-weight:bold;"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</span>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // If the paged comments setting is enabled, and enough comments exisst to cause comments to be paged ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span> Older Comments' ); ?></div>
				<div class="nav-next"><?php next_comments_link( 'Newer Comments <span class="meta-nav">&rarr;</span>' ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation 
		
		if ( get_comments_number() > '0' ) { ?>
			<ol class="commentlist">
				<?php	wp_list_comments( 'type=comment&avatar_size=40' ); ?>
			</ol>
		<?php }

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span> Older Comments' ); ?></div>
				<div class="nav-next"><?php next_comments_link( 'Newer Comments <span class="meta-nav">&rarr;</span>' ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

endif; // end have_comments() 

comment_form(); 
?>

</div><!-- #comments -->
<?php /*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
comment_form()
----------------------------------
comment_form() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/comment_form

comment_form() is used to output the comment reply form in the comments section
of a Post or Page.

comment_form() accepts two arguments:
 - $args: ampersand (&) joined list of arguments. See the Codex reference for full list. 
 - $postid: PostID of the post to which the comment form should post comments. 
    Defaults to the current post.

Example:
<?php comment_form(); ?>

comment_form() must be used from within the Loop, unless the $postid parameter is used.

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
comments_open()
----------------------------------
comments_open() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/comments_open

comments_open() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
comments are open for the current post.

comments_open( $postid ) accepts one argument:
 - $postid: PostID of the post being checked. Defaults to the current post.

comments_open() must be used from within the Loop, unless the $postid parameter is used.

***********************
get_comment_link()
----------------------------------
get_comment_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_comment_link

get_comment_link() is used to get the permalink to a given comment

get_comment_link() accepts two arguments:
 - $comment: Id for comment for which to output link. Defaults to current comment.
 - $args: ampersand (&) linked array of options. See Codex for full list.

Example:
<a href="<?php echo get_comment_link(); ?>">Comment</a>

get_comment_link() must be used from within the Loop, unless the $comment parameter is used.

***********************
get_comments_number()
----------------------------------
get_comments_number() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/get_comments_number

get_comments_number() is used to return the number (as a numeric value) of comments (including 
comments, trackbacks, and pingbacks) on the current post.

get_comments_number() accepts no arguments

get_comments_number() must be used within the Loop.

***********************
get_comment_pages_count()
----------------------------------
get_comment_pages_count() is a WordPress function.
Codex reference: N/A

get_comment_pages_count() is used to return the number of comment pages for a given post. Generally,
it is used as part a conditional, to display comment-page navigation links only if more than one comment
page exists.

get_comment_pages_count() accepts no arguments.

Examples:
 - get_comment_pages_count() returns a number equal to the number of comment pages, e.g. '1', '2', etc.

 - if (get_comment_pages_count() > 1 )  will return true if more than one comment page exists.

get_comment_pages_count() must be used from within the Loop.

***********************
get_comment_type()
----------------------------------
get_comment_type() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/comment_type

get_comment_type() is used to return (not output or print) the type of a given comment:
'comment', 'pingback', or 'trackback. To output this value, use comment_type().

get_comment_type() accepts no arguments.

Examples:
 - get_comment_type() will return either 'comment', 'pingback', or 'trackback'

 - if ( get_comment_type() != "comment" ) will return true if the current comment type is 
    'pingback' or 'trackback'

get_comment_type() must be used from within the Loop.

***********************
get_option()
----------------------------------
get_option() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_option

get_option() is used to return the value of a specified database option.
If the option does not exist or has no value, the function returns FALSE.

get_option( $show, $default ) accepts two arguments
 - $show: the database option for which to return a value
     - See this Codex reference for full list of options: http://codex.wordpress.org/Option_Reference
 - $default: the value to return if the option does not exist, or has no value. Default is FALSE

Example:
get_option( 'page_comments' ) returns TRUE is the "Paged Comments" option is true; otherwise returns FALSE

***********************
have_comments()
----------------------------------
have_comments() is a WordPress conditional tag.
Codex reference: N/A

have_comments() is a conditional that returns TRUE if the current post has comments
associated with it; otherwise, it returns FALSE. The most typical use of this conditional
is within the comments template, as part of the comments "Loop".

have_comments() accepts no arguments.

Example:
if ( have_comments() ) is used to begin the comments "Loop", which displays only if the current
post has comments.

have_comments() must be used from within the Loop.

***********************
next_comments_link()
----------------------------------
next_comments_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/next_comments_link
Codex reference: http://codex.wordpress.org/Function_Reference/next_comments_link

next_comments_link() is used to display the next page of comments (older comments)

next_comments_link( $label, $max_page ) accepts two arguments:
 - $label: text label for the link text. Defaults to '' (no label).
 - $max_page: maximum number of comment pages on which to place the link. Defaults to '0' (no limit)

Example:
<?php previous_comments_link( '<span class="meta-nav">&larr;</span> Older Comments' ); ?>
returns "<- Older Comments" (with an ASCII left-arrow symbol)

next_comments_link() must be used from within the Loop.

***********************
post_password_required()
----------------------------------
post_password_required() is a WordPress conditional tag.
Codex reference: N/A

post_password_required() is a conditional that returns TRUE if the current post is password-protected; 
otherwise, it returns FALSE. The most typical use of this conditional is within the comments template, as 
part of the comments "Loop".

post_password_required() accepts no arguments.

Example:
if ( post_password_required() ) is used to display a "password required" message, and prevents post
comments from displaying, if the post is password-protected.

post_password_required() must be used from within the Loop.

***********************
previous_comments_link()
----------------------------------
previous_comments_link() is a WordPress template tag.

Codex reference: http://codex.wordpress.org/Template_Tags/previous_comments_link
Codex reference: http://codex.wordpress.org/Function_Reference/previous_comments_link

previous_comments_link() is used to display the previous page of comments (newer comments)

previous_comments_link( $label, $max_page ) accepts two arguments:
 - $label: text label for the link text. Defaults to '' (no label).
 - $max_page: maximum number of comment pages on which to place the link. Defaults to '0' (no limit)

Example:
<?php next_comments_link( 'Newer Comments <span class="meta-nav">&rarr;</span>' ); ?>
returns "Newer Comments ->" (with an ASCII right-arrow symbol)

previous_comments_link() must be used from within the Loop.

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

***********************
wp_list_comments()
----------------------------------
wp_list_comments() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_list_comments

wp_list_comments() is used to display the comments associated with a given post.

wp_list_comments( array( 'arg1' => 'value' , 'arg2' => 'value' ) ) accepts several arguments, in the form of an array. Some of the more useful arguments:
 - max_depth: for threaded comments, the maximum thread depth. Defaults to user-configured setting in Settings -> Discussion.
 - style: HTML structure for the comment list. Can be 'ul', 'ol', or 'div'. Defaults to 'ul'.
     - Note: if using 'div' or 'ol', wp_list_comments() must be wrapped in a containing element of the specified type (i.e. <div></div> or <ol></ol>)
 - type: comment type to include. Can be 'all', 'comment', 'trackback', 'pingback', or 'pings' (both trackbacks and pingbacks). Defaults to 'all'
 - avatar_size: size (px) of the user avatar. Can be any interger value between '1' and '512'. Defaults to '32'.
 - per_page: number of comments to display per comments page. Defaults to user-configured setting in Settings -> Discussion.
 - reverse_top_level: if TRUE, will display the newest comments first. Defaults to user-configured setting in Settings -> Discussion.
 
Example:
<?php	wp_list_comments( 'type=comment&avatar_size=40' ); ?> displays comments that are "comment" type (no pingbacks or trackbacks),
with an avatar size of 40px.

wp_list_comments() must be used from within the Loop.

=============================================================================
*/ ?>