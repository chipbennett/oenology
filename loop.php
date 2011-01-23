<?php 

get_template_part('loop-header'); // loop-header.php contains anything to be displayed before the list of posts
			
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div <?php post_class(); ?>>	
		
		<div class="post-title">
		
			<!-- Post Header Begin -->
			<?php get_template_part('post-header'); // post-header.php contains the Post TItle and other post meta information ?>
			<!-- Post Header End -->
	
		</div>

		<div class="post-entry">
		
			<!-- Post Entry Begin -->
			<?php get_template_part('post-entry'); // post-entry.php contains the post content ?>
			<!-- Post Entry End -->
			
		</div>

		<div class="post-footer">
			
			<!-- Post footer Begin -->
			<?php get_template_part('post-footer'); // post-footer.php contains post timestamp and copyright information ?>
			<!-- Post Footer End -->
			
		</div>

	</div>

	<!-- Comments Begin -->
	<?php if ( is_single() || ( is_page() && comments_open() ) ) { // only display the comments on a single blog post or on a Page with open comments
		comments_template(); /* comments template */
	} ?>
	<!-- Comments End -->

<?php endwhile;

get_template_part('loop-footer'); // loop-footer.php contains anything to be displayed after the list of posts

else : ?>

	<h2 class="center">Not Found</h2>

	<p class="center">
		<?php _e("Sorry, but you are looking for something that isn't here."); ?>
	</p>

<?php endif; 
/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

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
get_template_part()
----------------------------------
get_template_part() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_template_part

get_template_part() is used to include a Theme template file within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_template_part( $file ) will attempt to include file.php. The function will attempt to 
include files in the following order, until it finds one that exists:
 - the Theme's file.php
 - the parent theme's file.php

get_template_part( $file , $foo ) will attempt to include file-foo.php. The function will
attempt to include files in the following order, until it finds one that exists:
 - the Theme's file-foo.php
 - the Theme's file.php
 - the parent theme's file-foo.php
 - the parent theme-s file.php

***********************
have_posts()
----------------------------------
have_posts() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/User:Samsm/have_posts

have_posts() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the current query has posts available. It is primarily used in conjunction with the_post() 
as part of the call to the Loop.

Example (the Loop):
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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
post_class()
----------------------------------
post_class() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/post_class

post_class() is added inside the HTML <div> or <span> tag that contains the post, 
and outputs various CSS class declarations, depending on which post is currently 
being displayed.

For the full list of CSS classes returned by post_class(), see the Codex.

***********************
the_post()
----------------------------------
the_post() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/User:Jefte/the_post

the_post() is used to output the content of each post. It is primarily used in conjunction
with have_posts() as part of the call to the Loop.

Example (the Loop):
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

=============================================================================
*/ ?>