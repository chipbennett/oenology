<?php if ( ( is_home() || is_single() || is_page() ) && ! is_attachment() ) { // only display the full post content on the blog home page, single blog posts, and Pages
	the_content('Read the rest of this entry &raquo;'); // if a blog post or Page uses the <!--more--> tag, display "Read the rest of this entry" on the blog home page.
	wp_link_pages(); // if the blog post or Page is paginated, display page links
	} else if ( is_attachment() ) { // display custom image content for image attachment 
		if ( wp_attachment_is_image() ) {
			get_template_part( 'post-entry-image' ); 
		} else {
			the_content('Read the rest of this entry &raquo;');
		}
	} else { // otherwise (i.e. if an archive/category/tag or search page is displayed) only show the post thumbnail and excerpt
		the_excerpt(); 
	}
/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
function_exists()
----------------------------------
function_exists() is a boolean (returns TRUE or FALSE) conditional PHP function.
Codex reference: N/A

function_exists( 'foo' ) returns TRUE if a function named foo() is found; otherwise, it returns FALSE.

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
is_home()
----------------------------------
is_home() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_home

is_home() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the home page is currently displayed.

The home page corresponds to the index.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="home".

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
the_content()
----------------------------------
the_content() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_content

the_content() is used to display the Post Content for the current post.

the_content( $more_link_text, $strip_teaser )  accepts two arguments:
 - $more_link_text: string to display for the "read more" link, if <!--more--> is used in the post. Defaults to '(more...)'.
 - $strip_teaser: boolean (true/false); 'false' displays the content before <!--more-->; 'false' hides this content on single.php. Defaults to 'false'

Example:
<?php the_content(); ?>

To get the Post Content without displaying it, use get_the_content().

the_content()  must be used within the Loop.

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
wp_attachment_is_image()
----------------------------------
wp_attachment_is_image() is a WordPress template conditional tag
Codex reference: http://codex.wordpress.org/Function_Reference/is_attachment

wp_attachment_is_image() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the current post's attachment is an image.

***********************
wp_link_pages()
----------------------------------
wp_link_pages() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_link_pages

wp_link_pages() is used to output page links for paginated posts. 

wp_link_pages() accepts several arguments, in array format.
To see the full list of arguments for wp_link_pages(), see the Codex.

Example:
wp_link_pages(); outputs e.g. "<p>Pages: 1 2 3</p>"

wp_link_pages() must be used within the Loop.

=============================================================================
*/ ?>