<?php
/*
Template Name: Posts Footer
*/
?>

<div class="postmetadata <?php if (is_single()) { // add "alt" class if single post is displayed
          echo ' alt';
     } ?>"><?php if (! is_page() ) { // don't display the author's avatar on Pages ?>
				<span class="post-author-gravatar">
                                   <?php echo get_avatar( get_the_author_meta('email'), $size = '20'); // display a 20px avatar, to fit inside the post footer ?>
				</span>
<span class="postmetadata-author">Posted by <?php the_author() ?> <?php the_date(); ?> at <?php the_time(); ?></span><?php } // use the user-defined formats to display Post Date and Time ?>
<span class="postmetadata-license">&copy; <?php the_time('Y'); ?></span>
</div>
<?php /*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
get_avatar()
----------------------------------
get_avatar() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_avatar

get_avatar() is used to display the Post ID for the current post.

get_avatar( $id_or_email, $size, $default, $alt );  accepts four arguments:
 - $id_or_email: UserID or email address;
 - $size: width/height (in pixels) of the displayed avatar. Defaults to '96'.
 - $default: URL for default image to display if the user has no defined avatar. Defaults to "Mystery Man"
 - $alt: alt text to display for avatar image. Defaults to no alt text.

Example:
<?php echo get_avatar( get_the_author_meta('email'), $size = '20'); ?> displays a 20x20px avatar for the post author.

To get the Avatar without displaying it, omit "echo" in the function call for get_avatar().

***********************
get_the_author_meta()
----------------------------------
get_the_author_meta() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_author_meta

get_the_author_meta() is used to display the Post Author for the current post.

get_the_author_meta( $field, $userID )  accepts two arguments:
 - $field: field name for data item to be displayed. See the Codex for full list.
 - $userID: UserID for whom data item is displayed. Defaults to Post Author.

Example:
<?php get_the_author_meta( 'email' ); ?> returns the Post Author's email address.

To display the author meta information, use 'echo" in the function call
for get_the_author_meta(), or use the_author_meta() instead.

get_the_author_meta()  must be used within the Loop, unless the $userID argument is used.

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
the_author()
----------------------------------
the_author() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_author

the_author() is used to display the Post Author for the current post.

the_author()  accepts no arguments.

Example:
<?php the_author(); ?>

To get the Post Author without displaying it, use get_the_author().

the_author()  must be used within the Loop.

***********************
the_date()
----------------------------------
the_date() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_date

the_date() is used to display the Post Date.

the_date( $d ) accepts one argument:
 -$d: date format (per PHP date() function). Defaults to time format configured in General Settings

Example:
<?php the_date( 'Y' ); ?> displays the year the post was published, e.g. '2010'.

the_date() must be used within the Loop.

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

=============================================================================
*/ ?>