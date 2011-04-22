<ul class="postnav">
	<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<li id="breadcrumbs">','</li>');
	} else {
		oenology_breadcrumb();
	} ?>
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
is_user_logged_in()
----------------------------------
is_user_logged_in() is a WordPress conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_user_logged_in

is_user_logged_in() is a boolean (returns TRUE or FALSE) conditional tag that returns
true if the current user is logged in; otherwise it returns false.

is_user_logged_in() accepts no arguments.

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