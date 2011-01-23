<ul class="postnav">
	<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<li id="breadcrumbs">','</li>');
	} elseif ( function_exists('oenology_breadcrumb') ) {
		oenology_breadcrumb();
	} else { ?>
    <li class="postnavnewer">
      &nbsp;
      <?php if ( ! is_page() && ! is_home() ) {
	next_post_link('&laquo;&laquo; %link','Newer Post');
      } ?>
      </li>
      <li class="postnavhome">
	<!--&diams; &nbsp;&nbsp;&nbsp;-->
        <a href="<?php echo site_url(); ?>">Home</a>
        <!--&nbsp;&nbsp;&nbsp; &diams;-->
      </li>
      <li class="postnavolder">
	<?php if ( ! is_page() && ! is_home() ) {
	  previous_post_link('%link &raquo;&raquo;','Older Post');
	} ?>
	&nbsp;
      </li>
    <?php } ?>
    <li id="postnavlogin">
      <?php if ( is_user_logged_in() ) {
	wp_get_current_user();
	global $current_user;
	echo $current_user->display_name;
	echo ' | ';
	wp_register('','');
	echo ' | ';
      }
      wp_loginout(); ?>
    </li>
    <li id="postnavsearch">
      <?php get_search_form(); ?>
    </li>
</ul>
<?php
/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
get_search_form()
----------------------------------
get_search_form() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_search_form

get_search_form() is used to display the search form. If the Theme includes a
searchform.php template file, it will be used. Otherwise, the built-in search form
will be used.

get_search_form() accepts no arguments.

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
home_url()
----------------------------------
home_url() is a WordPress function
Codex reference: http://codex.wordpress.org/Function_Reference/home_url

home_url() is used to return the home URL (the 'home' option), using the appropriate protocol 
(http or https), based on value of is_ssl().

home_url() accepts no arguments.

Example:
home_url(); returns e.g. "http://www.domain.tld"

Used in the following template files:
site-navigation.php

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
is_user_logged_in()
----------------------------------
is_user_logged_in() is a WordPress conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_user_logged_in

is_user_logged_in() is a boolean (returns TRUE or FALSE) conditional tag that returns
true if the current user is logged in; otherwise it returns false.

is_user_logged_in() accepts no arguments.

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
oenology_breadcrumb()
----------------------------------
oenology_breadcrumb() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_breadcrumb() is used to output breadcrumb links.

oenology_breadcrumb() outputs a home link, followed by appropriate breadcrumb links,
including categories (hierarchical), tags, search query, etc.

oenology_breadcrumb() accepts no arguments.

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
wp_get_current_user()
----------------------------------
wp_get_current_user() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_current_user

wp_get_current_user() is used to retrieve the information contained in the 
$current_user global variable.

wp_get_current_user() accepts no arguments.

Example:
wp_get_current_user();
echo $current_user->display_name; will display e.g. "John Smith"

***********************
wp_loginout()
----------------------------------
wp_loginout() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_loginout

wp_loginout() displays a login link if user is logged out, or a logout link if user is logged in.

wp_loginout() accepts 1 argument:
 - $redirect: redirect location after login/out. Defaults to no redirect (current location)

***********************
wp_register()
----------------------------------
wp_register() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_register

wp_register() displays a registration link if user is logged out and user registration is 
permitted; otherwise, displays a link to site admin (Dashboard) if user is logged in.

wp_register() accepts 3 arguments:
 - $before: string to display before link. Defaults to '<li>'
 - $after:  string to display after link. Defaults to '</li>'
 - $echo: return result boolean (true/false). Defaults to 'true'

Example:
<?php wp_register( '' , '' ); ?> returns the Registration or Site Admin link, without wrapping
in <li></li> tags.

=============================================================================
*/ ?>